<?php
declare(strict_types=1);
session_start();
require __DIR__ . '/config.php';

function is_logged_in(): bool { return !empty($_SESSION['cms_admin']); }

function require_admin(): void {
    if (!is_logged_in()) {
        json_response(['ok' => false, 'error' => 'Non autorisé'], 401);
    }
}

function get_default_content(): array {
    $file = __DIR__ . '/default-content.json';
    return file_exists($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];
}

function sanitize_content(array $data): array {
    $safe = [
        'texts' => [],
        'ctas' => [],
        'images' => [],
        'booleans' => [],
        'boolean_labels' => [],
        'field_labels' => [],
    ];

    foreach (($data['texts'] ?? []) as $key => $value) {
        if (!is_string($key)) continue;

        // CORRECTIF CRITIQUE :
        // On ne laisse jamais le CMS modifier des conteneurs structurels.
        if (preg_match('/^(div|section|article|main|nav|header|footer|canvas|script|style)_/i', $key)) {
            continue;
        }

        $safe['texts'][$key] = is_string($value) ? $value : '';
    }

    foreach (($data['ctas'] ?? []) as $key => $value) {
        if (!is_array($value)) continue;
        $safe['ctas'][$key] = [
            'label' => (string)($value['label'] ?? ''),
            'url' => (string)($value['url'] ?? '#'),
        ];
    }

    foreach (($data['images'] ?? []) as $key => $value) {
        $safe['images'][$key] = is_string($value) ? $value : '';
    }

    foreach (($data['booleans'] ?? []) as $key => $value) {
        $safe['booleans'][$key] = (bool)$value;
    }

    foreach (($data['boolean_labels'] ?? []) as $key => $value) {
        if (!is_string($key)) continue;
        $safe['boolean_labels'][$key] = is_string($value) ? trim($value) : '';
    }

    foreach (($data['field_labels'] ?? []) as $key => $value) {
        if (!is_string($key)) continue;
        $safe['field_labels'][$key] = is_string($value) ? trim($value) : '';
    }

    return $safe;
}

function keep_known_keys(array $data, array $base): array {
    foreach (['texts', 'ctas', 'images', 'booleans', 'boolean_labels', 'field_labels'] as $section) {
        $data[$section] = array_intersect_key($data[$section] ?? [], $base[$section] ?? []);
    }
    return $data;
}

function merge_safe(array $base, array $stored): array {
    $base = sanitize_content($base);
    $stored = keep_known_keys(sanitize_content($stored), $base);

    return [
        'texts' => array_merge($base['texts'], $stored['texts']),
        'ctas' => array_merge($base['ctas'], $stored['ctas']),
        'images' => array_merge($base['images'], $stored['images']),
        'booleans' => array_merge($base['booleans'], $stored['booleans']),
        'boolean_labels' => array_merge($base['boolean_labels'], $stored['boolean_labels']),
        'field_labels' => array_merge($base['field_labels'], $stored['field_labels']),
    ];
}

function sanitize_for_current_site(array $input): array {
    $base = sanitize_content(get_default_content());
    return keep_known_keys(sanitize_content($input), $base);
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

try {
    if ($action === 'login') {
        $input = json_decode(file_get_contents('php://input'), true) ?: $_POST;

        $user = (string)($input['user'] ?? '');
        $pass = (string)($input['pass'] ?? '');

        if (hash_equals(ADMIN_USER, $user) && hash_equals(ADMIN_PASS, $pass)) {
            $_SESSION['cms_admin'] = true;
            json_response(['ok' => true, 'message' => 'Connexion réussie']);
        }

        json_response(['ok' => false, 'error' => 'Identifiants invalides'], 403);
    }

    if ($action === 'logout') {
        session_destroy();
        json_response(['ok' => true, 'message' => 'Déconnecté']);
    }

    if ($action === 'status') {
        json_response(['ok' => true, 'logged' => is_logged_in()]);
    }

    if ($action === 'content') {
        $stmt = db()->prepare("SELECT content_value FROM cms_content WHERE content_key = 'site_content' LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch();

        $stored = $row ? (json_decode((string)$row['content_value'], true) ?: []) : [];
        $data = merge_safe(get_default_content(), $stored);

        json_response(['ok' => true, 'data' => $data]);
    }

    if ($action === 'save') {
        require_admin();

        $input = json_decode(file_get_contents('php://input'), true);
        if (!is_array($input)) {
            json_response(['ok' => false, 'error' => 'JSON invalide'], 400);
        }

        $input = sanitize_for_current_site($input);
        $content = json_encode($input, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        $stmt = db()->prepare("
            INSERT INTO cms_content (content_key, content_value)
            VALUES ('site_content', :content)
            ON DUPLICATE KEY UPDATE content_value = VALUES(content_value)
        ");
        $stmt->execute(['content' => $content]);

        $log = db()->prepare("INSERT INTO cms_logs (action, ip) VALUES ('save', :ip)");
        $log->execute(['ip' => $_SERVER['REMOTE_ADDR'] ?? null]);

        json_response([
            'ok' => true,
            'message' => 'Modifications publiées avec succès',
            'saved_at' => date('H:i:s'),
            'data' => $input
        ]);
    }

    if ($action === 'cleanup') {
        require_admin();

        $stmt = db()->prepare("SELECT content_value FROM cms_content WHERE content_key = 'site_content' LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch();

        $stored = $row ? (json_decode((string)$row['content_value'], true) ?: []) : [];
        $clean = sanitize_for_current_site($stored);

        $content = json_encode($clean, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        $save = db()->prepare("
            INSERT INTO cms_content (content_key, content_value)
            VALUES ('site_content', :content)
            ON DUPLICATE KEY UPDATE content_value = VALUES(content_value)
        ");
        $save->execute(['content' => $content]);

        json_response([
            'ok' => true,
            'message' => 'BDD nettoyée : clés structurelles supprimées',
            'data' => $clean
        ]);
    }

    json_response(['ok' => false, 'error' => 'Action inconnue'], 404);
} catch (Throwable $e) {
    json_response(['ok' => false, 'error' => $e->getMessage()], 500);
}
