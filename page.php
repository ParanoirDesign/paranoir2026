<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/cms-data.php';
$slug = (string)($_GET['slug'] ?? '');
$slug = strtolower(trim($slug));
if ($slug === '') {
    http_response_code(404);
    $pageTitle = 'Page introuvable — Paranoir Studio';
    $pageDescription = 'Page introuvable.';
    include __DIR__ . '/includes/site-head.php';
    include __DIR__ . '/includes/site-nav.php';
    echo '<main class="legal-wrap"><p class="kicker">Erreur</p><h1>Page introuvable</h1><section class="legal-card"><p>Cette page n’existe pas ou plus.</p></section></main>';
    include __DIR__ . '/includes/site-footer.php';
    exit;
}
$page = cms_page($slug);
if (!$page || ($page['status'] ?? 'draft') !== 'published') {
    http_response_code(404);
    $pageTitle = 'Page introuvable — Paranoir Studio';
    $pageDescription = 'Page introuvable.';
    include __DIR__ . '/includes/site-head.php';
    include __DIR__ . '/includes/site-nav.php';
    echo '<main class="legal-wrap"><p class="kicker">Erreur</p><h1>Page introuvable</h1><section class="legal-card"><p>Cette page n’existe pas ou n’est pas publiée.</p></section></main>';
    include __DIR__ . '/includes/site-footer.php';
    exit;
}
$pageTitle = (string)($page['meta_title'] ?? $page['title'] ?? 'Paranoir Studio');
$pageDescription = (string)($page['meta_description'] ?? '');
include __DIR__ . '/includes/site-head.php';
include __DIR__ . '/includes/site-nav.php';
?>
<main class="legal-wrap">
  <p class="kicker"><?= cms_e((string)($page['kicker'] ?? 'Page')) ?></p>
  <h1><?= cms_e((string)($page['title'] ?? 'Page')) ?></h1>
  <?php if (!empty($page['intro'])): ?><p class="intro"><?= cms_e((string)$page['intro']) ?></p><?php endif; ?>
  <section class="legal-card">
    <?= (string)($page['content'] ?? '') ?>
  </section>
</main>
<?php include __DIR__ . '/includes/site-footer.php'; ?>
