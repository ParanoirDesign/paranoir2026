# CMS V2 multi-pages — Paranoir Studio

## Ce qui change

- Ajout d'une architecture PHP avec includes :
  - `includes/cms-data.php`
  - `includes/site-head.php`
  - `includes/site-nav.php`
  - `includes/site-footer.php`
- Ajout d'un footer commun éditable depuis le CMS.
- Ajout d'une navigation commune éditable depuis le CMS.
- Ajout d'un moteur de pages CMS : `page.php?slug=...`.
- Ajout des pages PHP légales :
  - `mentions-legales.php`
  - `politique-confidentialite.php`
  - `politique-cookies.php`
- Les anciennes pages `.html` légales redirigent vers les nouvelles pages `.php`.
- Ajout d'un `.htaccess` pour donner la priorité à `index.php`.
- L'admin contient maintenant deux nouvelles sections :
  - `Nav + footer`
  - `Pages`

## Important

`config.php` n'est pas inclus dans cette archive. Il doit rester uniquement sur le FTP.

## Upload / déploiement

Comme GitHub Actions est déjà branché, il suffit de déposer les fichiers de cette archive dans le repo, puis de commit sur `main`.

GitHub déploiera automatiquement.

## Après déploiement

1. Ouvrir le site public.
2. Vérifier que la home s'affiche bien depuis `index.php`.
3. Ouvrir :
   - `/mentions-legales.php`
   - `/politique-confidentialite.php`
   - `/politique-cookies.php`
4. Ouvrir `/admin.php`.
5. Vérifier les onglets :
   - `Nav + footer`
   - `Pages`
6. Modifier un lien de footer ou une page test.
7. Cliquer sur `Publier`.
8. Recharger la page publique.

## Créer une nouvelle page

Dans `/admin.php` :

1. Aller dans l'onglet `Pages`.
2. Cliquer sur `+ Nouvelle page`.
3. Renseigner :
   - slug
   - titre H1
   - meta title
   - meta description
   - intro
   - contenu HTML
4. Passer le statut à `Publié`.
5. Cliquer sur `Publier`.
6. La page sera disponible via :

`/page.php?slug=mon-slug`

Pour une URL directe propre, il faudra ensuite ajouter un petit fichier PHP de redirection ou une règle de rewrite.

## Note technique

La home reste très proche du fichier historique, mais existe maintenant en `index.php` afin de pouvoir inclure le footer commun.

Le footer commun est dans :

`includes/site-footer.php`

La nav commune des pages secondaires est dans :

`includes/site-nav.php`

La home garde encore sa navigation historique pour éviter de casser le système d'édition front existant en un seul commit. Oui, prudence, ce mot étrange que les refontes ignorent avant de finir en page blanche.
