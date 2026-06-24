<?php
declare(strict_types=1);

require_once __DIR__ . '/../config.php';

function cms_default_pages(): array {
    return [
        'home' => [
            'slug' => 'home',
            'title' => 'Accueil',
            'meta_title' => 'Victoria Dury — Où ça bloque vraiment ?',
            'meta_description' => 'Quiz de diagnostic gratuit : identifiez votre blocage probable, puis réservez directement votre Diagnostic Express à 290 €.',
            'kicker' => 'Diagnostic & clarté',
            'intro' => 'Page d’accueil principale du site. Cette page utilise encore le template index.php pendant la migration vers le CMS complet.',
            'content' => '<p>La home est enregistrée comme page CMS système. Son contenu visuel complet reste piloté par index.php pendant la migration progressive du design system.</p>',
            'template' => 'home',
            'system' => true,
            'status' => 'published'
        ],
        'mentions-legales' => [
            'slug' => 'mentions-legales',
            'title' => 'Mentions légales',
            'meta_title' => 'Mentions légales — Paranoir Studio',
            'meta_description' => 'Mentions légales de Paranoir Studio.',
            'kicker' => 'Informations légales',
            'intro' => 'Cette page rassemble les informations légales relatives au site Paranoir Studio.',
            'content' => '<h2>Éditeur du site</h2><p><strong>Nom commercial :</strong> Paranoir Studio<br><strong>Forme juridique :</strong> SARL<br><strong>Adresse :</strong> 31 rue Grande, 77760 Guercheville, France<br><strong>N° TVA intracommunautaire :</strong> FR44102885712<br><strong>Code NAF :</strong> 62.10Y — Activités de programmation informatique<br><strong>Responsable de la publication :</strong> Victoria Dury</p><h2>Contact</h2><p>Pour toute demande relative au site ou à son contenu, vous pouvez contacter Paranoir Studio depuis les moyens de contact indiqués sur le site principal.</p><h2>Hébergement</h2><p>Le site est hébergé par <strong>o2switch</strong>, service d’hébergement web français.</p><h2>Propriété intellectuelle</h2><p>Les textes, éléments graphiques, choix éditoriaux, mises en page, contenus, visuels et éléments de marque présents sur ce site sont protégés par le droit de la propriété intellectuelle. Toute reproduction, adaptation, diffusion ou exploitation sans autorisation préalable est interdite.</p><h2>Responsabilité</h2><p>Paranoir Studio s’efforce de fournir des informations exactes et à jour. Le contenu du site ne constitue pas un conseil juridique, fiscal ou financier. L’utilisation des informations disponibles se fait sous la responsabilité de l’utilisateur.</p><p class="small">Dernière mise à jour : 23 juin 2026.</p>',
            'status' => 'published'
        ],
        'politique-confidentialite' => [
            'slug' => 'politique-confidentialite',
            'title' => 'Politique de confidentialité',
            'meta_title' => 'Politique de confidentialité — Paranoir Studio',
            'meta_description' => 'Politique de confidentialité de Paranoir Studio.',
            'kicker' => 'Données personnelles',
            'intro' => 'Cette politique explique comment Paranoir Studio collecte, utilise et protège les données personnelles transmises via son site.',
            'content' => '<h2>Responsable du traitement</h2><p>Le responsable du traitement est <strong>Paranoir Studio</strong>, SARL située au 31 rue Grande, 77760 Guercheville, France.</p><h2>Données collectées</h2><p>Selon votre utilisation du site, Paranoir Studio peut collecter les données suivantes : nom, prénom, adresse e-mail professionnelle, site web ou profil professionnel transmis volontairement, contenu des réponses aux formulaires ou quiz, données techniques nécessaires au fonctionnement du site.</p><h2>Finalités</h2><p>Les données sont utilisées pour répondre aux demandes, préparer un diagnostic ou un échange, assurer le fonctionnement du site et respecter les obligations légales applicables.</p><h2>Base légale</h2><p>Les traitements reposent selon les cas sur votre consentement, sur l’intérêt légitime de Paranoir Studio à répondre aux demandes reçues, ou sur l’exécution de mesures précontractuelles lorsque vous sollicitez une prestation.</p><h2>Durée de conservation</h2><p>Les données sont conservées pendant une durée raisonnable au regard de la finalité de la demande, sauf obligation légale imposant une conservation plus longue.</p><h2>Vos droits</h2><p>Vous disposez d’un droit d’accès, de rectification, d’effacement, d’opposition, de limitation du traitement et, lorsque cela s’applique, d’un droit à la portabilité de vos données.</p><h2>Réclamation</h2><p>Si vous estimez que vos droits ne sont pas respectés, vous pouvez introduire une réclamation auprès de la CNIL.</p><p class="small">Dernière mise à jour : 23 juin 2026.</p>',
            'status' => 'published'
        ],
        'politique-cookies' => [
            'slug' => 'politique-cookies',
            'title' => 'Politique cookies',
            'meta_title' => 'Politique cookies — Paranoir Studio',
            'meta_description' => 'Politique cookies de Paranoir Studio.',
            'kicker' => 'Cookies et traceurs',
            'intro' => 'Cette page explique l’usage éventuel des cookies sur le site Paranoir Studio.',
            'content' => '<h2>Qu’est-ce qu’un cookie ?</h2><p>Un cookie est un petit fichier déposé sur votre terminal lors de la consultation d’un site. Il peut servir au fonctionnement technique du site, à la mesure d’audience ou à certains services tiers.</p><h2>Cookies nécessaires</h2><p>Le site peut utiliser des cookies strictement nécessaires à son fonctionnement, notamment pour maintenir une session d’administration ou assurer la sécurité des échanges.</p><h2>Mesure d’audience</h2><p>Si des outils de mesure d’audience sont ajoutés au site, ils devront respecter les règles applicables en matière de consentement et d’information des utilisateurs.</p><h2>Services tiers</h2><p>Certaines fonctionnalités, comme des polices externes, des outils de réservation, des formulaires ou des contenus intégrés, peuvent entraîner des requêtes vers des services tiers.</p><h2>Gestion des cookies</h2><p>Vous pouvez configurer votre navigateur pour bloquer, supprimer ou limiter les cookies. Le blocage de certains cookies peut toutefois altérer le fonctionnement normal du site.</p><p class="small">Dernière mise à jour : 23 juin 2026.</p>',
            'status' => 'published'
        ]
    ];
}

function cms_default_content(): array {
    $file = __DIR__ . '/../default-content.json';
    $data = file_exists($file) ? (json_decode(file_get_contents($file), true) ?: []) : [];
    $data['settings'] = array_replace_recursive([
        'site_name' => 'Paranoir Studio',
        'footer_baseline' => 'Paranoir Studio — Clarifier avant de construire.',
        'nav' => [
            ['label' => 'Méthode', 'url' => 'index.php#method', 'type' => 'link'],
            ['label' => 'Test de clarté', 'url' => 'index.php#prediagnostic', 'type' => 'cta'],
        ],
        'footer_links' => [
            ['label' => 'Mentions légales', 'url' => 'mentions-legales.php'],
            ['label' => 'Confidentialité', 'url' => 'politique-confidentialite.php'],
            ['label' => 'Cookies', 'url' => 'politique-cookies.php'],
        ],
    ], $data['settings'] ?? []);
    $data['pages'] = array_replace_recursive(cms_default_pages(), $data['pages'] ?? []);
    return $data;
}

function cms_deep_merge(array $base, array $override): array {
    foreach ($override as $key => $value) {
        if (is_array($value) && isset($base[$key]) && is_array($base[$key])) $base[$key] = cms_deep_merge($base[$key], $value);
        else $base[$key] = $value;
    }
    return $base;
}

function cms_content(): array {
    static $content = null;
    if (is_array($content)) return $content;
    $default = cms_default_content();
    try {
        $stmt = db()->prepare("SELECT content_value FROM cms_content WHERE content_key = 'site_content' LIMIT 1");
        $stmt->execute();
        $row = $stmt->fetch();
        $stored = $row ? (json_decode((string)$row['content_value'], true) ?: []) : [];
        $content = cms_deep_merge($default, $stored);
    } catch (Throwable $e) {
        $content = $default;
    }
    return $content;
}

function cms_setting(string $key, mixed $fallback = ''): mixed {
    $data = cms_content();
    return $data['settings'][$key] ?? $fallback;
}

function cms_page(string $slug): ?array {
    $data = cms_content();
    $slug = strtolower(trim($slug));
    return $data['pages'][$slug] ?? null;
}

function cms_e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
function cms_abs_url(string $url): string { return $url !== '' ? $url : '#'; }
