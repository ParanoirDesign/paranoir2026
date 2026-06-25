<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . '/includes/cms-data.php';

/* --- Auth helpers -------------------------------------------------- */
function is_logged_in(): bool { return !empty($_SESSION['cms_user']); }
function current_user(): array { return $_SESSION['cms_user'] ?? []; }
function is_admin(): bool { return (current_user()['role'] ?? '') === 'admin'; }

function require_login(): void {
    if (!is_logged_in()) json_response(['ok' => false, 'error' => 'Non autorise'], 401);
}
function require_admin(): void {
    if (!is_admin()) json_response(['ok' => false, 'error' => 'Non autorise'], 403);
}

function check_csrf(): void {
    $token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!hash_equals((string)($_SESSION['csrf_token'] ?? ''), $token)) {
        json_response(['ok' => false, 'error' => 'Token CSRF invalide'], 403);
    }
}

/* --- Rate limiting -------------------------------------------------- */
function rate_limit_check(string $ip): void {
    $window = date('Y-m-d H:i:s', time() - 900);
    $stmt = db()->prepare(
        "SELECT COUNT(*) FROM cms_login_attempts WHERE ip = :ip AND attempted_at > :w"
    );
    $stmt->execute(['ip' => $ip, 'w' => $window]);
    if ((int)$stmt->fetchColumn() >= 5) {
        json_response(['ok' => false, 'error' => 'Trop de tentatives. Reessayez dans 15 minutes.'], 429);
    }
}

function rate_limit_record(string $ip): void {
    db()->prepare("INSERT INTO cms_login_attempts (ip) VALUES (:ip)")
        ->execute(['ip' => $ip]);
}

function rate_limit_clear(string $ip): void {
    db()->prepare("DELETE FROM cms_login_attempts WHERE ip = :ip")
        ->execute(['ip' => $ip]);
}

/* --- Content helpers ----------------------------------------------- */
function get_default_content(): array { return cms_default_content(); }

function sanitize_content(array $data): array {
    $safe = [
        'texts' => [], 'ctas' => [], 'images' => [],
        'booleans' => [], 'boolean_labels' => [], 'field_labels' => [],
        'settings' => [], 'pages' => [],
    ];

    foreach (($data['texts'] ?? []) as $key => $value) {
        if (!is_string($key)) continue;
        if (preg_match('/^(div|section|article|main|nav|header|footer|canvas|script|style)_/i', $key)) continue;
        $safe['texts'][$key] = is_string($value) ? $value : '';
    }

    foreach (($data['ctas'] ?? []) as $key => $value) {
        if (!is_array($value)) continue;
        $safe['ctas'][$key] = [
            'label' => (string)($value['label'] ?? ''),
            'url'   => (string)($value['url'] ?? '#'),
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

    $settings = $data['settings'] ?? [];
    if (is_array($settings)) {
        $safe['settings']['site_name'] = trim((string)($settings['site_name'] ?? 'Paranoir Studio')) ?: 'Paranoir Studio';
        $safe['settings']['footer_baseline'] = trim((string)($settings['footer_baseline'] ?? 'Paranoir Studio — Clarifier avant de construire.')) ?: 'Paranoir Studio — Clarifier avant de construire.';

        $safe['settings']['nav'] = [];
        foreach (($settings['nav'] ?? []) as $item) {
            if (!is_array($item)) continue;
            $label = trim((string)($item['label'] ?? ''));
            $url   = trim((string)($item['url'] ?? '#'));
            $type  = (string)($item['type'] ?? 'link');
            if ($label === '') continue;
            $safe['settings']['nav'][] = [
                'label' => $label,
                'url'   => $url !== '' ? $url : '#',
                'type'  => $type === 'cta' ? 'cta' : 'link',
            ];
        }

        $safe['settings']['footer_links'] = [];
        foreach (($settings['footer_links'] ?? []) as $item) {
            if (!is_array($item)) continue;
            $label = trim((string)($item['label'] ?? ''));
            $url   = trim((string)($item['url'] ?? '#'));
            if ($label === '') continue;
            $safe['settings']['footer_links'][] = [
                'label' => $label,
                'url'   => $url !== '' ? $url : '#',
            ];
        }
    }

    foreach (($data['pages'] ?? []) as $key => $page) {
        if (!is_array($page)) continue;
        $slug = strtolower(trim((string)($page['slug'] ?? $key)));
        $slug = preg_replace('/[^a-z0-9\-]/', '-', $slug);
        $slug = trim((string)preg_replace('/-+/', '-', (string)$slug), '-');
        if ($slug === '') continue;
        $safe['pages'][$slug] = [
            'slug'             => $slug,
            'title'            => trim((string)($page['title'] ?? 'Nouvelle page')) ?: 'Nouvelle page',
            'meta_title'       => trim((string)($page['meta_title'] ?? '')),
            'meta_description' => trim((string)($page['meta_description'] ?? '')),
            'kicker'           => trim((string)($page['kicker'] ?? '')),
            'intro'            => trim((string)($page['intro'] ?? '')),
            'content'          => is_string($page['content'] ?? '') ? (string)$page['content'] : '',
            'template'         => trim((string)($page['template'] ?? 'default')) ?: 'default',
            'system'           => !empty($page['system']),
            'status'           => (($page['status'] ?? 'draft') === 'published') ? 'published' : 'draft',
            'client_editable'  => !empty($page['client_editable']),
        ];
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
    $base   = sanitize_content($base);
    $stored = keep_known_keys(sanitize_content($stored), $base);
    return [
        'texts'          => array_merge($base['texts'], $stored['texts']),
        'ctas'           => array_merge($base['ctas'], $stored['ctas']),
        'images'         => array_merge($base['images'], $stored['images']),
        'booleans'       => array_merge($base['booleans'], $stored['booleans']),
        'boolean_labels' => array_merge($base['boolean_labels'], $stored['boolean_labels']),
        'field_labels'   => array_merge($base['field_labels'], $stored['field_labels']),
        'settings'       => array_replace_recursive($base['settings'] ?? [], $stored['settings'] ?? []),
        'pages'          => array_replace_recursive($base['pages'] ?? [], $stored['pages'] ?? []),
    ];
}

function sanitize_for_current_site(array $input): array {
    $base  = sanitize_content(get_default_content());
    $clean = sanitize_content($input);
    $known = keep_known_keys($clean, $base);
    $known['settings'] = $clean['settings'] ?? ($base['settings'] ?? []);
    $known['pages']    = array_replace_recursive($base['pages'] ?? [], $clean['pages'] ?? []);
    return $known;
}

/* --- Router -------------------------------------------------------- */
$action = $_GET['action'] ?? $_POST['action'] ?? '';

try {

    /* LOGIN */
    if ($action === 'login') {
        $input    = json_decode(file_get_contents('php://input'), true) ?: $_POST;
        $username = trim((string)($input['user'] ?? ''));
        $pass     = (string)($input['pass'] ?? '');
        $ip       = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        rate_limit_check($ip);

        $stmt = db()->prepare(
            "SELECT id, username, password_hash, role FROM cms_users WHERE username = :u AND active = 1 LIMIT 1"
        );
        $stmt->execute(['u' => $username]);
        $row = $stmt->fetch();

        if ($row && password_verify($pass, $row['password_hash'])) {
            rate_limit_clear($ip);
            $_SESSION['cms_user'] = [
                'id'       => (int)$row['id'],
                'username' => $row['username'],
                'role'     => $row['role'],
            ];
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
            json_response([
                'ok'      => true,
                'message' => 'Connexion reussie',
                'role'    => $row['role'],
                'csrf'    => $_SESSION['csrf_token'],
            ]);
        }

        rate_limit_record($ip);
        json_response(['ok' => false, 'error' => 'Identifiants invalides'], 403);
    }

    /* LOGOUT */
    if ($action === 'logout') {
        session_destroy();
        json_response(['ok' => true, 'message' => 'Deconnecte']);
    }

    /* STATUS */
    if ($action === 'status') {
        $user = current_user();
        json_response([
            'ok'     => true,
            'logged' => is_logged_in(),
            'role'   => $user['role'] ?? null,
            'csrf'   => $_SESSION['csrf_token'] ?? null,
        ]);
    }

    /* CONTENT — public (site.js en a besoin) */
    if ($action === 'content') {
        $stmt = db()->prepare("SELECT content_value FROM cms_content WHERE content_key = 'site_content' LIMIT 1");
        $stmt->execute();
        $row    = $stmt->fetch();
        $stored = $row ? (json_decode((string)$row['content_value'], true) ?: []) : [];
        $data   = merge_safe(get_default_content(), $stored);
        json_response(['ok' => true, 'data' => $data]);
    }

    /* SAVE */
    if ($action === 'save') {
        require_login();
        check_csrf();

        $input = json_decode(file_get_contents('php://input'), true);
        if (!is_array($input)) json_response(['ok' => false, 'error' => 'JSON invalide'], 400);

        if (is_admin()) {
            $data = sanitize_for_current_site($input);
        } else {
            /* Client : charger le contenu DB, ne fusionner que les pages autorisees */
            $stmt = db()->prepare("SELECT content_value FROM cms_content WHERE content_key = 'site_content' LIMIT 1");
            $stmt->execute();
            $row    = $stmt->fetch();
            $stored = $row ? (json_decode((string)$row['content_value'], true) ?: []) : [];
            $data   = merge_safe(get_default_content(), $stored);

            $ALLOWED = ['title', 'meta_title', 'meta_description', 'kicker', 'intro', 'content', 'status'];
            foreach (($input['pages'] ?? []) as $slug => $page) {
                if (empty($data['pages'][$slug]['client_editable'])) continue;
                foreach ($ALLOWED as $f) {
                    if (array_key_exists($f, $page)) {
                        $data['pages'][$slug][$f] = $f === 'status'
                            ? ($page[$f] === 'published' ? 'published' : 'draft')
                            : (string)$page[$f];
                    }
                }
            }
        }

        $content = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        $stmt = db()->prepare("
            INSERT INTO cms_content (content_key, content_value)
            VALUES ('site_content', :content)
            ON DUPLICATE KEY UPDATE content_value = VALUES(content_value)
        ");
        $stmt->execute(['content' => $content]);

        $log = db()->prepare("INSERT INTO cms_logs (action, ip) VALUES ('save', :ip)");
        $log->execute(['ip' => $_SERVER['REMOTE_ADDR'] ?? null]);

        json_response([
            'ok'       => true,
            'message'  => 'Modifications publiees avec succes',
            'saved_at' => date('H:i:s'),
            'data'     => $data,
        ]);
    }

    /* LIST USERS — admin only */
    if ($action === 'list_users') {
        require_admin();
        check_csrf();
        $stmt  = db()->query("SELECT id, username, role, active, created_at FROM cms_users ORDER BY id");
        $users = $stmt->fetchAll();
        json_response(['ok' => true, 'users' => $users]);
    }

    /* CREATE USER — admin only */
    if ($action === 'create_user') {
        require_admin();
        check_csrf();
        $input    = json_decode(file_get_contents('php://input'), true) ?: [];
        $username = trim((string)($input['username'] ?? ''));
        $password = (string)($input['password'] ?? '');
        $role     = ($input['role'] ?? 'client') === 'admin' ? 'admin' : 'client';

        if (strlen($username) < 2) json_response(['ok' => false, 'error' => 'Identifiant trop court (2 caracteres min.)'], 400);
        if (strlen($password) < 6) json_response(['ok' => false, 'error' => 'Mot de passe trop court (6 caracteres min.)'], 400);
        if (!preg_match('/^[a-z0-9._-]+$/i', $username)) json_response(['ok' => false, 'error' => 'Identifiant invalide (lettres, chiffres, . _ - uniquement)'], 400);

        try {
            $stmt = db()->prepare("INSERT INTO cms_users (username, password_hash, role) VALUES (:u, :h, :r)");
            $stmt->execute(['u' => $username, 'h' => password_hash($password, PASSWORD_DEFAULT), 'r' => $role]);
            json_response(['ok' => true, 'message' => 'Utilisateur cree', 'id' => (int)db()->lastInsertId()]);
        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), 'Duplicate')) {
                json_response(['ok' => false, 'error' => 'Cet identifiant est deja utilise'], 409);
            }
            throw $e;
        }
    }

    /* DELETE USER — admin only, cannot delete self */
    if ($action === 'delete_user') {
        require_admin();
        check_csrf();
        $input = json_decode(file_get_contents('php://input'), true) ?: [];
        $id    = (int)($input['id'] ?? 0);
        if ($id === (int)(current_user()['id'] ?? 0)) {
            json_response(['ok' => false, 'error' => 'Impossible de supprimer votre propre compte'], 400);
        }
        db()->prepare("DELETE FROM cms_users WHERE id = :id")->execute(['id' => $id]);
        json_response(['ok' => true, 'message' => 'Utilisateur supprime']);
    }

    json_response(['ok' => false, 'error' => 'Action inconnue'], 404);

} catch (Throwable $e) {
    json_response(['ok' => false, 'error' => $e->getMessage()], 500);
}
