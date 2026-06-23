# Patch réparation BDD contaminée

Ne touche pas à config.php.

## Fichiers à uploader

- api.php
- default-content.json
- repair_db.php

## Étapes

1. Uploade ces 3 fichiers à la racine de paranoir.paranoir.pro.
2. Va sur :
   https://paranoir.paranoir.pro/repair_db.php
3. Recharge le front.
4. Supprime repair_db.php.

## Pourquoi

La BDD contenait des clés `div_*`, `section_*`, etc.
Le front les appliquait via `innerHTML`, ce qui écrasait la structure HTML.

Ce patch :
- filtre ces clés côté API ;
- nettoie définitivement la BDD ;
- remplace default-content.json par une version sans clés structurelles.
