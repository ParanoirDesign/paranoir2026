<?php
declare(strict_types=1);
// SCRIPT TEMPORAIRE — À SUPPRIMER APRÈS USAGE
// Accès protégé par token
define('SECRET', 'paranoir-reset-2026');
if (($_GET['token'] ?? '') !== SECRET) {
    http_response_code(403);
    die('Accès refusé');
}

require_once __DIR__ . '/config.php';

$username = 'victoria';
$password = 'Paranoir2026!';
$hash     = password_hash($password, PASSWORD_DEFAULT);
$role     = 'admin';

$stmt = db()->prepare("
    INSERT INTO cms_users (username, password_hash, role, active)
    VALUES (:u, :h, :r, 1)
    ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash), active = 1
");
$stmt->execute(['u' => $username, 'h' => $hash, 'r' => $role]);

echo '<pre>';
echo "Utilisateur : $username\n";
echo "Mot de passe : $password\n";
echo "Hash généré  : $hash\n";
echo "Vérifie      : " . (password_verify($password, $hash) ? 'OK ✓' : 'ERREUR') . "\n";
echo '</pre>';
echo '<p style="color:red"><strong>Supprime ce fichier maintenant.</strong></p>';
