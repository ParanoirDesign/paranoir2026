<?php

require_once __DIR__.'/includes/cms-data.php';

echo '<pre>';

$page = cms_page('home');

var_dump($page);

echo '</pre>';
