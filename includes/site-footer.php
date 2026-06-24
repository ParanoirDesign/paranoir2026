<?php
require_once __DIR__ . '/cms-data.php';
$footerLinks = cms_setting('footer_links', []);
$baseline = (string) cms_setting('footer_baseline', 'Paranoir Studio');
?>
<footer class="site-footer">
  <span><?php echo cms_e($baseline); ?></span>
  <nav class="site-footer-links" aria-label="Liens légaux">
    <?php foreach ($footerLinks as $item): ?>
      <a href="<?php echo cms_e((string)($item['url'] ?? '#')); ?>"><?php echo cms_e((string)($item['label'] ?? 'Lien')); ?></a>
    <?php endforeach; ?>
  </nav>
</footer>
