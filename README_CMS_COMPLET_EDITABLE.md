# CMS Paranoir Studio — version complète éditable

## Ce qui a été modifié

- Reprise depuis l'archive fournie par Victoria, pas depuis une ancienne version.
- Ajout de champs CMS pour la navigation : marque, lien Méthode, bouton Test de clarté.
- Ajout de champs CMS pour presque tous les textes visibles de la page : titres, paragraphes, FAQ, quiz, preuves, offres, footer, micro-textes.
- Ajout de champs CMS pour les boutons et leurs URLs quand ce sont des liens.
- Conservation des champs déjà fonctionnels : textes, images, tableau, libellés des lignes du tableau.
- Les titres des champs dans l'admin sont maintenant lisibles : section + contenu concerné, avec la clé technique en petit dessous.
- Le fichier `default-content.json` contient la structure complète des champs, mais le site continue bien à lire et écrire en BDD via `api.php`.

## Fichiers à uploader

Uploader à la racine du site :

- `index.html`
- `admin.php`
- `api.php`
- `default-content.json`

Ne pas remplacer `config.php` si celui en ligne fonctionne déjà.

## Après upload

1. Ouvrir `/admin.php`.
2. Se connecter.
3. Vérifier les onglets `Textes de la page` et `Boutons + liens`.
4. Modifier un texte de nav ou un bouton.
5. Cliquer sur `Publier`.
6. Recharger le site public avec cache vidé.

## Note sur le JSON

Le JSON n'est pas là pour remplacer la BDD. Il décrit les champs disponibles et sert de format d'échange entre le navigateur et `api.php`. Les modifications publiées passent bien par `api.php` et sont enregistrées dans MySQL.
