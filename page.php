<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/cms-data.php';

function render_404(string $message): void {
    http_response_code(404);
    $pageTitle = 'Page introuvable — Paranoir Studio';
    $pageDescription = 'Page introuvable.';
    include __DIR__ . '/includes/site-head.php';
    include __DIR__ . '/includes/site-nav.php';
    echo '<main class="content-page">';
    echo '<p class="kicker">Erreur</p>';
    echo '<h1 class="page-title">Page introuvable</h1>';
    echo '<section class="card wysiwyg"><p>' . cms_e($message) . '</p></section>';
    echo '</main>';
    include __DIR__ . '/includes/site-footer.php';
    exit;
}

$slug = (string)($_GET['slug'] ?? '');
$slug = strtolower(trim($slug));

if ($slug === '') {
    render_404('Cette page n’existe pas ou plus.');
}

$page = cms_page($slug);
if (!$page || ($page['status'] ?? 'draft') !== 'published') {
    render_404('Cette page n’existe pas ou n’est pas publiée.');
}

$pageTitle = (string)($page['meta_title'] ?? $page['title'] ?? 'Paranoir Studio');
$pageDescription = (string)($page['meta_description'] ?? '');
$pageContent = (string)($page['content'] ?? '');
$pageContent = html_entity_decode($pageContent, ENT_QUOTES | ENT_HTML5, 'UTF-8');

include __DIR__ . '/includes/site-head.php';
include __DIR__ . '/includes/site-nav.php';
?>
<main class="content-page">
  <p class="kicker"><?= cms_e((string)($page['kicker'] ?? 'Page')) ?></p>
  <h1 class="page-title"><?= cms_e((string)($page['title'] ?? 'Page')) ?></h1>
  <?php if (!empty($page['intro'])): ?>
    <p class="intro page-intro"><?= cms_e((string)$page['intro']) ?></p>
  <?php endif; ?>
  <section class="card card-glass wysiwyg">
    <?= $pageContent ?>
  </section>
</main>
<?php include __DIR__ . '/includes/site-footer.php'; ?>
