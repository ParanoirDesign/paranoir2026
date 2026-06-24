<?php
$pageTitle = $pageTitle ?? 'Paranoir Studio';
$pageDescription = $pageDescription ?? 'Paranoir Studio clarifie votre business avant de construire votre site.';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo cms_e((string)$pageTitle); ?></title>
<meta name="description" content="<?php echo cms_e((string)$pageDescription); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/site.css">
<link rel="stylesheet" href="/assets/css/components.css">
</head>
<body class="site-page">
