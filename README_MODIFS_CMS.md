# Modifications CMS

## Ce qui change

1. Les champs de texte de l'admin n'affichent plus le HTML brut.
   - Les contenus sont maintenant éditables dans des zones visuelles `contenteditable`.
   - Les balises utiles comme `<span>`, `<br>` ou les mises en emphase sont conservées en arrière-plan, sans polluer l'édition courante.
   - Le JSON reste disponible pour les corrections techniques avancées.

2. Les libellés des lignes du tableau sont modifiables.
   - Dans l'onglet `Tableau`, la première colonne devient un champ texte.
   - Les coches restent modifiables comme avant.
   - Les nouveaux libellés sont sauvegardés dans `boolean_labels`.

## Fichiers modifiés

- `admin.php`
- `api.php`
- `default-content.json`
- `index.html`

## Upload

Uploader les fichiers à la racine du site, en remplaçant les versions existantes.
Ne pas modifier `config.php` si les accès et la BDD fonctionnent déjà.
