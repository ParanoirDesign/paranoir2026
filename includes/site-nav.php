<?php
require_once __DIR__ . '/cms-data.php';
$siteName = (string) cms_setting('site_name', 'Paranoir Studio');
$navItems = cms_setting('nav', []);
if (!is_array($navItems) || count($navItems) === 0) {
    $navItems = [
        ['label' => 'Méthode', 'url' => 'index.php#method', 'type' => 'link'],
        ['label' => 'Diagnostic Express', 'url' => 'index.php#prediagnostic', 'type' => 'cta'],
    ];
}
?>
<nav class="site-nav nav" aria-label="Navigation principale">
  <a class="site-brand brand" href="index.php"><?php echo cms_e($siteName); ?></a>
  <div class="site-nav-links nav-right">
    <?php foreach ($navItems as $item): ?>
      <?php
        if (!is_array($item)) { continue; }
        $label = (string)($item['label'] ?? 'Lien');
        $url = (string)($item['url'] ?? '#');
        $type = (string)($item['type'] ?? 'link');
        $class = $type === 'cta' ? 'site-nav-cta nav-cta' : 'site-nav-link nav-link';
      ?>
      <a class="<?php echo cms_e($class); ?>" href="<?php echo cms_e($url); ?>"><?php echo cms_e($label); ?></a>
    <?php endforeach; ?>
  </div>
</nav>
