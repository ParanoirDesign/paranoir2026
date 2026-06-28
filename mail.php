<?php
declare(strict_types=1);

// Autorisations CORS pour appels AJAX depuis le même domaine
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'JSON invalide']);
    exit;
}

$prenom  = trim(strip_tags((string)($input['prenom'] ?? '')));
$email   = filter_var(trim((string)($input['email'] ?? '')), FILTER_VALIDATE_EMAIL);
$url     = trim(strip_tags((string)($input['url'] ?? '')));
$signal  = trim(strip_tags((string)($input['signal'] ?? '')));
$offre   = trim(strip_tags((string)($input['offre'] ?? '')));
$actions = is_array($input['actions'] ?? null) ? implode(', ', array_map('strip_tags', $input['actions'])) : '';
$certitude = trim(strip_tags((string)($input['certitude'] ?? '')));
$resultat  = trim(strip_tags((string)($input['resultat'] ?? '')));

if (!$prenom || !$email) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Prénom et email requis']);
    exit;
}

$to      = 'victoria@paranoir.me';
$subject = "Nouveau Rapport de Clarté — $prenom";
$body    = "Prénom : $prenom\n"
         . "Email : $email\n"
         . ($url ? "Site/LinkedIn : $url\n" : '')
         . "\n--- Réponses quiz ---\n"
         . "Signal principal : $signal\n"
         . "Offre : $offre\n"
         . "Actions déjà tentées : $actions\n"
         . "Niveau de certitude : $certitude\n"
         . "Résultat affiché : $resultat\n";

$headers = "From: noreply@paranoir.pro\r\n"
         . "Reply-To: $email\r\n"
         . "X-Mailer: PHP/" . PHP_VERSION;

if (mail($to, $subject, $body, $headers)) {
    echo json_encode(['ok' => true]);
} else {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Erreur envoi email']);
}
