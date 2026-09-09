<?php
declare(strict_types=1);

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

$clean = static fn($value): string => trim(strip_tags((string)$value));
$cleanArray = static function ($value): array {
    if (!is_array($value)) {
        return [];
    }
    return array_values(array_filter(array_map(
        static fn($item): string => trim(strip_tags((string)$item)),
        $value
    )));
};

$prenom = $clean($input['prenom'] ?? '');
$emailRaw = trim((string)($input['email'] ?? ''));
$email = filter_var($emailRaw, FILTER_VALIDATE_EMAIL);

if (!$prenom || !$email) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Prénom et email requis']);
    exit;
}

// Nouveau diagnostic en 7 questions.
$etat = $clean($input['etat'] ?? '');
$offres = $clean($input['offres'] ?? '');
$comprehension = $clean($input['comprehension'] ?? '');
$alignement = $clean($input['alignement'] ?? '');
$existant = $cleanArray($input['existant'] ?? []);
$frein = $clean($input['frein'] ?? '');
$priorite = $clean($input['priorite'] ?? '');
$resultatCode = $clean($input['resultatCode'] ?? '');
$resultat = $clean($input['resultat'] ?? '');

// Compatibilité temporaire avec l’ancien formulaire.
$url = $clean($input['url'] ?? '');
$signal = $clean($input['signal'] ?? '');
$offreLegacy = $clean($input['offre'] ?? '');
$actionsLegacy = $cleanArray($input['actions'] ?? []);
$certitude = $clean($input['certitude'] ?? '');

$to = 'victoria@paranoir.me';
$subject = "Nouveau diagnostic gratuit — $prenom";

if ($etat || $offres || $comprehension || $alignement || $frein || $priorite) {
    $body = "Prénom : $prenom\n"
          . "Email : $email\n"
          . "\n--- Diagnostic gratuit ---\n"
          . "1. État de l’activité : $etat\n"
          . "2. Nombre / organisation des offres : $offres\n"
          . "3. Compréhension rapide de l’offre : $comprehension\n"
          . "4. Alignement site / réseau social / fiche Google : $alignement\n"
          . "5. Existant : " . ($existant ? implode(', ', $existant) : 'Non renseigné') . "\n"
          . "6. Frein principal : $frein\n"
          . "7. Priorité : $priorite\n"
          . "\n--- Résultat automatique ---\n"
          . "Code : $resultatCode\n"
          . "Diagnostic : $resultat\n";
} else {
    $body = "Prénom : $prenom\n"
          . "Email : $email\n"
          . ($url ? "Site/LinkedIn : $url\n" : '')
          . "\n--- Ancien questionnaire ---\n"
          . "Signal principal : $signal\n"
          . "Offre : $offreLegacy\n"
          . "Actions déjà tentées : " . ($actionsLegacy ? implode(', ', $actionsLegacy) : 'Non renseigné') . "\n"
          . "Niveau de certitude : $certitude\n"
          . "Résultat : $resultat\n";
}

$headers = "From: noreply@paranoir.pro\r\n"
         . "Reply-To: $email\r\n"
         . "X-Mailer: PHP/" . PHP_VERSION;

if (mail($to, $subject, $body, $headers)) {
    echo json_encode(['ok' => true]);
} else {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Erreur envoi email']);
}
