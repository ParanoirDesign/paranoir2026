# CMS Paranoir Studio — mini édition directe sur le front

## Ce qui est ajouté

- Quand la session admin est ouverte, le front affiche un bouton `✎ Éditer` devant chaque élément éditable détecté.
- Le clic ouvre un mini panneau d’édition direct sur le front.
- Le mini panneau permet de modifier :
  - les textes `data-edit` ;
  - les URLs des liens `data-link-edit` ;
  - les images `data-image-edit` ;
  - les coches du tableau `data-bool` ;
  - les libellés des lignes du tableau.
- Le bouton `Publier` enregistre directement en BDD via `api.php?action=save`.

## Fichiers à uploader

Uploader à la racine du site :

- `index.html`
- `admin.php`
- `api.php`
- `default-content.json`

`config.php` est inclus dans l’archive par cohérence, mais ne le remplace pas si celui du serveur fonctionne déjà.

## Utilisation

1. Connecte-toi dans `/admin.php`.
2. Ouvre le front dans le même navigateur.
3. Les boutons `✎ Éditer` apparaissent sur les éléments modifiables.
4. Clique, modifie, puis `Publier`.

## Note

Le mini panneau ne remplace pas le back-office complet. Il ajoute une édition rapide directement depuis la page publique, pour éviter de chercher le bon champ dans le CMS comme si on fouillait une cave sans lumière.
