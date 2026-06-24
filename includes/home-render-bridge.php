<?php
if (PHP_SAPI === 'cli') {
    return;
}

$script = basename((string)($_SERVER['SCRIPT_FILENAME'] ?? ''));
if ($script !== 'index.php') {
    return;
}

ob_start(function (string $html): string {
    if (strpos($html, '<nav class="nav">') === false) {
        return $html;
    }

    $nav = '';
    $navFile = __DIR__ . '/site-nav.php';
    if (is_file($navFile)) {
        ob_start();
        include $navFile;
        $nav = trim((string)ob_get_clean());
    }

    if ($nav === '') {
        return $html;
    }

    $pattern = '~<nav class="nav">.*?</nav>~s';
    return (string)preg_replace($pattern, $nav, $html, 1);
});
