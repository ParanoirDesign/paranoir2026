<?php
if (PHP_SAPI === 'cli') return;
if (basename((string)($_SERVER['SCRIPT_FILENAME'] ?? '')) !== 'index.php') return;

require_once __DIR__ . '/cms-data.php';

ob_start(function (string $html): string {
    $homePage = cms_page('home') ?? [];
    $title = cms_e((string)($homePage['meta_title'] ?? 'Victoria Dury — Où ça bloque vraiment ?'));
    $description = cms_e((string)($homePage['meta_description'] ?? 'Quiz de diagnostic gratuit : identifiez votre blocage probable, puis réservez directement votre Diagnostic Express à 290 €.'));

    $html = str_replace('<title>Victoria Dury — Où ça bloque vraiment ?</title>', '<title>' . $title . '</title>', $html);
    $html = str_replace('<meta content="Quiz de diagnostic gratuit : identifiez votre blocage probable, puis réservez directement votre Diagnostic Express à 290 €." name="description"/>', '<meta content="' . $description . '" name="description"/>', $html);

    if (strpos($html, '/assets/css/components.css') === false) {
        $html = str_replace('<link rel="stylesheet" href="/assets/css/site.css">', '<link rel="stylesheet" href="/assets/css/site.css">' . "\n" . '<link rel="stylesheet" href="/assets/css/components.css">', $html);
    }

    $html = str_replace('<body>', '<body class="site-home">', $html);
    return $html;
});
