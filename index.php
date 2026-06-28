<?php
require_once __DIR__ . '/includes/cms-data.php';
$homePage = cms_page('home') ?? [];
$homeTitle = (string)($homePage['meta_title'] ?? 'Victoria Dury — Où ça bloque vraiment ?');
$homeDescription = (string)($homePage['meta_description'] ?? 'Clarifiez votre offre, votre message et votre positionnement avant d\'investir. Rapport de Clarté gratuit remis en visio.');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<title><?php echo cms_e($homeTitle); ?></title>
<meta content="<?php echo cms_e($homeDescription); ?>" name="description"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Italiana&family=Poppins:wght@400;500;600;700&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="/assets/css/site.css?v=<?php echo filemtime(__DIR__.'/assets/css/site.css'); ?>"></head>
<body class="site-home">
<div aria-hidden="true" class="three-bg">
<canvas id="clarityCanvas"></canvas>
</div>
<div class="page">
<nav class="nav">
<a class="brand" data-edit="brand" data-link-edit="brand" href="#">Victoria Dury</a>
<div class="nav-mid" data-edit="navMid">Diagnostic &amp; Clarté</div>
<div class="nav-right">
<a class="nav-link" data-edit="nav_methode" data-link-edit="nav_methode" href="#method">Méthode</a>
<a class="nav-cta" data-edit="nav_test_de_clarte" data-link-edit="nav_test_de_clarte" href="#prediagnostic">Test de clarté</a>
</div>
</nav>
<section class="hero">
<div class="reveal">
<div class="eyebrow" data-edit="hero_victoria_dury_directrice_conseil"><span class="dot"></span>Nous aidons les entreprises à devenir plus faciles à comprendre.</div>
<h1 data-edit="heroTitle">Avant d'investir encore, vérifiez d'abord <span class="highlight">où ça bloque.</span></h1>
<p class="sub" data-edit="heroSub">
          Moins de demandes, message confus, site qui ne convertit pas :
          avant de refaire une énième action visible, commencez par identifier
          <span class="marker">la couche qui bloque vraiment</span>
          — offre, message, positionnement ou parcours.
        </p>
<div class="hero-actions">
<a class="cta" data-edit="heroCta" data-link-edit="heroCta" href="#prediagnostic">Faire le test de clarté <span>→</span></a>
<p class="micro" data-edit="hero_3_minutes_gratuit_resultat_personnalise_puis_">3 minutes · Gratuit · Rapport de Clarté remis en visio</p>
</div>
</div>
<div class="reveal">
<div aria-label="Dossier ouvert de diagnostic" class="case-board" id="caseBoard">
<div class="board-top" data-edit="hero_dossier_ouvert_enquete_strategique">
<span>Dossier ouvert</span>
<span>Enquête stratégique</span>
</div>
<div class="paper-layer paper-a"></div>
<div class="paper-layer paper-b"></div>
<div class="paper-layer paper-c"></div>
<div class="paper-layer paper-d"></div>
<svg class="thread-svg" preserveaspectratio="none" viewbox="0 0 620 720">
<path class="thread soft" d="M115 158 C250 176 345 156 505 176"></path>
<path class="thread soft" d="M500 208 C390 255 300 292 230 360"></path>
<path class="thread" d="M230 392 C315 450 398 414 505 390"></path>
<path class="thread" d="M502 430 C408 506 310 536 160 582"></path>
<path class="thread" d="M185 594 C295 636 388 625 488 584"></path>
</svg>
<div class="evidence big ev1" data-edit="hero_moins_de_prospects_symptome_visible"><strong>Moins de prospects</strong><span>symptôme visible</span></div>
<div class="evidence false ev2" data-edit="hero_le_site_hypothese_eliminee"><strong>Le site ?</strong><span>hypothèse éliminée</span></div>
<div class="evidence false ev3" data-edit="hero_la_campagne_fausse_piste"><strong>La campagne ?</strong><span>fausse piste</span></div>
<div class="evidence ev4" data-edit="hero_message_confus_indice_fort"><strong>Message confus</strong><span>indice fort</span></div>
<div class="evidence ev5" data-edit="hero_offre_peu_lisible_cause_probable"><strong>Offre peu lisible</strong><span>cause probable</span></div>
<div class="evidence result big ev6" data-edit="hero_3_priorites_decision_claire"><strong>3 priorités</strong><span>décision claire</span></div>
<div class="stamp" data-edit="hero_cause_trouvee">Cause trouvée</div>
</div>
<div class="hero-offer">
<div>
<small data-edit="hero_etape_1">Étape 1</small>
<div class="offer-name" data-edit="heroOfferName">Test de clarté gratuit</div>
</div>
<p class="offer-text" data-edit="heroOfferText">Un test rapide pour vérifier si vous êtes en train de corriger le bon problème.</p>
<div class="offer-price" data-edit="heroOfferPrice">0 €</div>
</div>
</div>
</section>
<section class="proof">
<div class="liquid proof-item reveal">
<div class="stat" data-edit="proof_40">+40</div>
<p data-edit="proof_situations_clarifiees_offre_message_positionn">entreprises accompagnées : offre, message, positionnement, site ou parcours d’achat.</p>
</div>
<div class="liquid proof-item reveal">
<p class="quote" data-edit="proof_on_pensait_avoir_un_probleme_de_site_victoria">“On pensait avoir un problème de site. Victoria nous a aidés à voir que le vrai sujet, c'était notre offre.”</p>
<p class="byline" data-edit="proof_sophie_m_directrice_marketing_pme_industriell">Sophie M. — Directrice Marketing, PME industrielle, Lyon</p>
</div>
<div class="liquid proof-item reveal">
<p class="kicker" data-edit="proof_autorite">Autorité</p>
<p data-edit="proof_une_methode_pour_eviter_de_poser_du_design_du">Une méthode pour éviter de poser du design, du contenu ou du budget sur une offre encore floue.</p>
</div>
</section>
<section class="statement">
<p class="reveal lede" data-edit="statement_votre_probleme_visible_n_est_peut_etre_qu_un_" style="max-width:760px;margin:0 auto;text-align:center">Votre problème visible n’est peut-être qu’un <span class="highlight">symptôme</span>.<br/>Le test de clarté sert à vérifier.</p>
</section>
<section class="prequiz" id="prediagnostic">
<div class="prequiz-head reveal">
<p class="kicker" data-edit="quiz_test_de_clarte_gratuit">Test de clarté gratuit</p>
<h2 data-edit="quizTitle">Répondez à 5 questions. Voyez si vous regardez le bon problème.</h2>
<p class="lede" data-edit="quiz_ce_n_est_pas_un_formulaire_de_contact_c_est_u">
          Ce n’est pas un formulaire de contact. C’est un filtre stratégique.
          Vous avancez question par question, on élimine les fausses pistes,
          puis votre Rapport de Clarté vous est remis en visio — gratuit.
        </p>
<div aria-hidden="true" class="quiz-orbit" data-edit="quiz_site_message_offre_parcours">
<span class="orbit-center">?</span>
<span class="orbit-pill p1">site</span>
<span class="orbit-pill p2">message</span>
<span class="orbit-pill p3">offre</span>
<span class="orbit-pill p4">parcours</span>
</div>
</div>
<form class="quiz liquid reveal" id="growthQuiz">
<div class="quiz-progress">
<span data-edit="quiz_question_1_5">Question <strong id="quizCurrent">1</strong>/5</span>
<div><i id="quizBar"></i></div>
</div>
<div class="diagnostic-pulse" data-edit="quiz_hypothese_en_cours_on_commence_par_le_symptom" id="diagnosticPulse">
<span>Hypothèse en cours</span>
<strong id="diagnosticHint">On commence par le symptôme visible.</strong>
</div>
<fieldset class="quiz-step active" data-step="1">
<legend data-edit="quiz_quel_signal_vous_inquiete_le_plus_aujourd_hui">Quel signal vous inquiète le plus aujourd’hui ?</legend>
<label><input name="signal" required="" type="radio" value="prospects"/><span data-edit="quiz_option_moins_de_prospects_ou_de_demandes_qualifiees">Moins de prospects ou de demandes qualifiées</span> </label>
<label><input name="signal" type="radio" value="message"/><span data-edit="quiz_option_un_message_difficile_a_expliquer_simplement">Un message difficile à expliquer simplement</span> </label>
<label><input name="signal" type="radio" value="conversion"/><span data-edit="quiz_option_un_site_ou_des_contenus_qui_ne_convertissent_">Un site ou des contenus qui ne convertissent pas</span> </label>
<label><input name="signal" type="radio" value="dispersion"/><span data-edit="quiz_option_beaucoup_d_actions_peu_de_resultats_lisibles">Beaucoup d’actions, peu de résultats lisibles</span> </label>
</fieldset>
<fieldset class="quiz-step" data-step="2">
<legend data-edit="quiz_quand_vous_expliquez_votre_offre_que_se_passe">Quand vous expliquez votre offre, que se passe-t-il le plus souvent ?</legend>
<label><input name="offre" required="" type="radio" value="simple"/><span data-edit="quiz_option_les_gens_comprennent_vite">Les gens comprennent vite</span> </label>
<label><input name="offre" type="radio" value="long"/><span data-edit="quiz_option_il_faut_beaucoup_contextualiser">Il faut beaucoup contextualiser</span> </label>
<label><input name="offre" type="radio" value="variable"/><span data-edit="quiz_option_le_discours_change_selon_l_interlocuteur">Le discours change selon l’interlocuteur</span> </label>
<label><input name="offre" type="radio" value="confus"/><span data-edit="quiz_option_meme_en_interne_ce_n_est_pas_parfaitement_cla">Même en interne, ce n’est pas parfaitement clair</span> </label>
</fieldset>
<fieldset class="quiz-step" data-step="3">
<legend data-edit="quiz_qu_avez_vous_deja_essaye_de_corriger">Qu’avez-vous déjà essayé de corriger ?</legend>
<label><input name="actions" type="checkbox" value="site"/><span data-edit="quiz_option_refaire_ou_modifier_le_site">Refaire ou modifier le site</span> </label>
<label><input name="actions" type="checkbox" value="contenus"/><span data-edit="quiz_option_refaire_les_contenus_ou_les_posts">Refaire les contenus ou les posts</span> </label>
<label><input name="actions" type="checkbox" value="ads"/><span data-edit="quiz_option_relancer_une_campagne_ou_mettre_du_budget">Relancer une campagne ou mettre du budget</span> </label>
<label><input name="actions" type="checkbox" value="offre"/><span data-edit="quiz_option_repackager_l_offre">Repackager l’offre</span> </label>
<label><input name="actions" type="checkbox" value="rien"/><span data-edit="quiz_option_rien_de_structure_pour_l_instant">Rien de structuré pour l’instant</span> </label>
</fieldset>
<fieldset class="quiz-step" data-step="4">
<legend data-edit="quiz_a_quel_point_etes_vous_sur_du_vrai_probleme">À quel point êtes-vous sûr du vrai problème ?</legend>
<label><input name="certitude" required="" type="radio" value="faible"/><span data-edit="quiz_option_pas_vraiment_sur_justement">Pas vraiment sûr, justement</span> </label>
<label><input name="certitude" type="radio" value="moyenne"/><span data-edit="quiz_option_j_ai_une_hypothese_mais_peu_de_preuves">J’ai une hypothèse, mais peu de preuves</span> </label>
<label><input name="certitude" type="radio" value="forte"/><span data-edit="quiz_option_je_pense_savoir_mais_je_veux_confirmer">Je pense savoir, mais je veux confirmer</span> </label>
<label><input name="certitude" type="radio" value="urgent"/><span data-edit="quiz_option_je_dois_decider_vite_ou_investir">Je dois décider vite où investir</span> </label>
</fieldset>
<fieldset class="quiz-step" data-step="5">
<legend data-edit="quiz_ou_voulez_vous_recevoir_la_suite">Où voulez-vous recevoir la suite ?</legend>
<div class="quiz-fields">
<label><input autocomplete="given-name" name="prenom" placeholder="Victoria" required="" type="text"/><span data-edit="quiz_option_prenom">Prénom</span> 
</label>
<label><input autocomplete="email" name="email" placeholder="vous@entreprise.fr" required="" type="email"/><span data-edit="quiz_option_email_professionnel">Email professionnel</span> 
</label>
<label>Site ou LinkedIn <span data-edit="quiz_facultatif">facultatif</span>
<input name="url" placeholder="https://" type="url"/>
</label>
</div>
<p class="quiz-note" data-edit="quiz_apres_validation_votre_resultat_s_affiche_dir">Après validation, votre résultat s’affiche directement. Votre Rapport de Clarté vous est remis en visio — gratuit.</p>
</fieldset>
<div aria-live="polite" class="quiz-result" id="quizResult"></div>
<div class="result-cta" id="resultCta">
<div data-edit="quiz_suite_logique_diagnostic_express_290_60_minut">
<small>Votre livrable gratuit</small>
<strong>Rapport de Clarté — Gratuit</strong>
<span>Votre Rapport de Clarté est gratuit. Il vous est remis en visio — 30 minutes pour comprendre ce qui bloque vraiment et décider ensemble de la suite.</span>
</div>
<a class="cta" data-edit="offerCta" data-link-edit="offerCta" href="#">Obtenir mon Rapport de Clarté <span>→</span></a>
</div>
<div class="quiz-actions">
<button class="quiz-back" data-edit="quiz_retour" id="quizBack" type="button">← Retour</button>
<button class="cta quiz-next" data-edit="quiz_continuer" id="quizNext" type="button">Continuer →</button>
<button class="cta quiz-submit" data-edit="quiz_voir_mon_resultat" id="quizSubmit" type="submit">Voir mon résultat →</button>
</div>
<p class="quiz-privacy" data-edit="quiz_vos_reponses_servent_uniquement_a_preparer_l_">Vos réponses servent uniquement à préparer l’échange. Pas d’abonnement, pas de relance automatique déguisée en relation humaine.</p>
</form>
</section>
<section class="chapter split">
<div class="reveal">
<p class="kicker" data-edit="problem_avant_de_corriger">Avant de corriger</p>
<h2 data-edit="problem_ne_corrigez_pas_encore_identifiez_la_bonne_co">Ne corrigez pas encore. Identifiez la bonne couche.</h2>
<p class="lede" data-edit="problem_le_reflexe_classique_refaire_ce_qui_se_voit_l">
          Le réflexe classique : refaire ce qui se voit. Le site, les messages,
          les posts, la campagne. Le risque : améliorer la surface pendant que le vrai blocage reste intact.
        </p>
<p class="risk" data-edit="problem_la_cause_est_souvent_ailleurs">La cause est souvent ailleurs.</p>
</div>
<div class="symptoms reveal">
<div class="symptom" data-edit="problem_les_prospects_qualifies_se_font_plus_rares_sy"><strong>Les prospects qualifiés se font plus rares.</strong><span>symptôme</span></div>
<div class="symptom" data-edit="problem_votre_offre_est_difficile_a_expliquer_symptom"><strong>Votre offre est difficile à expliquer.</strong><span>symptôme</span></div>
<div class="symptom" data-edit="problem_votre_site_ou_vos_contenus_ne_prennent_pas_sy"><strong>Votre site ou vos contenus ne prennent pas.</strong><span>symptôme</span></div>
<div class="symptom" data-edit="problem_vous_faites_beaucoup_pour_peu_d_effet_symptom"><strong>Vous faites beaucoup, pour peu d'effet.</strong><span>symptôme</span></div>
</div>
</section>
<section class="method" id="method">
<div class="reveal">
<p class="kicker" data-edit="method_le_travail">Le travail</p>
<h2 data-edit="method_le_diagnostic_commence_avant_la_solution">Le diagnostic commence avant la solution.</h2>
<p data-edit="method_vous_arrivez_avec_un_symptome_nous_cherchons_">
          Vous arrivez avec un symptôme. Nous cherchons les preuves.
          Nous éliminons les fausses pistes. Nous remontons les causes.
          Nous identifions la décision la plus utile.
          <span class="marker">Puis seulement, on décide où investir.</span>
</p>
</div>
<div class="timeline reveal">
<div class="step">
<div class="num">01</div>
<div data-edit="method_vous_reservez_vous_choisissez_votre_creneau_e"><strong>Vous réservez</strong><span>Vous choisissez votre créneau et remplissez un court formulaire.</span></div>
</div>
<div class="step">
<div class="num">02</div>
<div data-edit="method_je_prepare_j_analyse_votre_site_votre_offre_v"><strong>Je prépare</strong><span>J'analyse votre site, votre offre, votre LinkedIn ou vos supports.</span></div>
</div>
<div class="step">
<div class="num">03</div>
<div data-edit="method_on_echange_60_minutes_structurees_sur_les_sym"><strong>On échange</strong><span>60 minutes structurées sur les symptômes, contraintes et tests déjà faits.</span></div>
</div>
<div class="step">
<div class="num">04</div>
<div data-edit="method_vous_recevez_une_restitution_loom_ou_pdf_avec"><strong>Vous recevez</strong><span>Une restitution Loom ou PDF avec la cause probable et vos 3 priorités.</span></div>
</div>
</div>
</section>
<section class="offer" id="reservation">
<div class="offer-layout">
<div class="price-panel reveal">
<div>
<p class="kicker" data-edit="offer_suite_possible" style="color:rgba(255,255,255,.72)">Votre livrable gratuit</p>
<h2 data-edit="offerTitle">Rapport de Clarté</h2>
<div class="price" data-edit="offerPrice">Gratuit</div>
<p class="price-line" data-edit="offerLine">Remis en visio.<br/>30 minutes.<br/>La suite décidée ensemble.</p>
</div>
<div>
<a class="cta" data-edit="offer_reserver_mon_diagnostic_express" data-link-edit="offer_reserver_mon_diagnostic_express" href="#">Obtenir mon Rapport de Clarté <span>→</span></a>
<p class="micro" data-edit="offer_paiement_unique_pas_d_abonnement_restitution_">Gratuit · Visio obligatoire · Aucun engagement</p>
</div>
</div>
<div class="offer-list reveal">
<div class="liquid detail" data-edit="offer_la_cause_la_plus_probable_formulee_clairement"><strong>Score de clarté sur 5 critères</strong><span>Formulé clairement, à partir des indices et des preuves disponibles.</span></div>
<div class="liquid detail" data-edit="offer_les_points_de_friction_identifies_sur_votre_o"><strong>La cause la plus probable identifiée</strong><span>Sur votre offre, votre message, votre positionnement ou votre parcours.</span></div>
<div class="liquid detail" data-edit="offer_vos_3_priorites_concretes_dans_le_bon_ordre_a"><strong>Vos 3 priorités concrètes</strong><span>Dans le bon ordre, avec la logique derrière chaque choix.</span></div>
<div class="liquid detail" data-edit="offer_une_suite_seulement_si_utile_si_le_sujet_est_"><strong>La suite décidée ensemble</strong><span>30 minutes en visio pour comprendre ce qui bloque vraiment et décider ensemble de la prochaine étape.</span></div>
</div>
</div>
</section>
<section class="about">
<div aria-label="Emplacement photo éditoriale" class="photo liquid reveal" data-image-edit="aboutImage"></div>
<div class="about-copy liquid reveal">
<p class="kicker" data-edit="about_a_propos">À propos</p>
<h2 data-edit="about_une_approche_construite_sur_une_observation_s">Une approche construite sur une observation simple.</h2>
<p data-edit="about_je_suis_victoria_dury_directrice_conseil_pend">Je suis Victoria Dury, Directrice Conseil. Pendant des années, j'ai travaillé sur des missions qui semblaient parler de site, de message ou de communication.</p>
<p data-edit="about_tres_souvent_le_vrai_sujet_etait_ailleurs_une">Très souvent, le vrai sujet était ailleurs : une offre devenue confuse, une hypothèse de marché jamais revalidée, une différence mal formulée.</p>
<p data-edit="about_j_ai_donc_recentre_mon_travail_sur_cette_etap"><strong>J'ai donc recentré mon travail sur cette étape-là : comprendre avant de corriger.</strong></p>
<div class="about-member" style="margin-top:28px;padding-top:24px;border-top:1px solid var(--line)">
<p data-edit="about_alexandre"><strong>Alexandre — Directeur des Opérations &amp; Associé</strong><br>En charge du déploiement, de la production et de la qualité des livrables. Son rôle est de s'assurer que chaque mission est livrée de façon fiable, structurée et dans les délais.</p>
</div>
</div>
</section>
<section class="faq">
<p class="kicker reveal" data-edit="faq_questions">Questions</p>
<h2 class="reveal" data-edit="faq_faq">FAQ</h2>
<details class="reveal">
<summary data-edit="faq_pourquoi_commencer_par_un_test_de_clarte_grat">Pourquoi commencer par un test de clarté gratuit ?</summary>
<p data-edit="faq_parce_qu_avant_de_parler_d_offre_de_site_ou_d">Parce qu’avant de parler d’offre, de site ou de budget, il faut vérifier que le problème mérite bien un diagnostic. Le test de clarté sert à qualifier votre situation et à éviter de partir sur la mauvaise piste.</p>
</details>
<details class="reveal">
<summary data-edit="faq_que_se_passe_t_il_apres_le_quiz">Que se passe-t-il après le quiz ?</summary>
<p data-edit="faq_vous_voyez_un_resultat_personnalise_si_vous_v">Vous voyez un résultat personnalisé. Votre Rapport de Clarté vous est ensuite remis en visio — gratuit. 30 minutes pour comprendre ce qui bloque vraiment et décider ensemble de la suite.</p>
</details>
<details class="reveal">
<summary data-edit="faq_faut_il_deja_avoir_un_site">Faut-il déjà avoir un site ?</summary>
<p data-edit="faq_non_le_point_de_depart_peut_etre_une_offre_un">Non. Le point de départ peut être une offre, un discours commercial, une page LinkedIn, une baisse de demandes ou une impression générale de flou.</p>
</details>
<details class="reveal">
<summary data-edit="faq_et_si_mon_probleme_est_plus_strategique_que_p">Et si mon problème est plus stratégique que prévu ?</summary>
<p data-edit="faq_je_vous_le_dirai_clairement_le_but_n_est_pas_">Je vous le dirai clairement. Le but n’est pas d’empiler des prestations, mais de comprendre quelle décision doit venir ensuite.</p>
</details>
</section>
<section class="realisations">
<div class="realisations-inner">
<div class="reveal">
<p class="kicker" data-edit="real_kicker">Réalisations</p>
<h2 data-edit="real_title">Ils sont passés du flou à <span class="highlight">l’évidence.</span></h2>
</div>
<div class="real-carousel reveal">
<div class="real-card">
<div class="real-text">
<p class="real-client"><strong>EEV Paysages</strong></p>
<p class="real-meta">Paysagiste · Bourron-Marlotte</p>
<p class="real-before"><span class="real-label cross">✗ Avant</span>Perçu comme un paysagiste généraliste, comparé uniquement sur le prix.</p>
<p class="real-after"><span class="real-label check">✓ Après</span>Repositionné en expert du Jardin Vivant sobre en eau. Offre restructurée en 3 portes d’entrée.</p>
<p class="real-offer">— Clarté Déployée</p>
</div>
<button class="real-visual" aria-label="Voir le visuel EEV Paysages" data-modal="real1">
<span class="real-placeholder">Visuel à venir</span>
</button>
</div>
<div class="real-card real-placeholder-card">
<div class="real-text">
<p class="real-client"><strong>Client à venir</strong></p>
<p class="real-meta">Client à venir · Client à venir</p>
<p class="real-before"><span class="real-label cross">✗ Avant</span>Client à venir</p>
<p class="real-after"><span class="real-label check">✓ Après</span>Client à venir</p>
<p class="real-offer">— Clarté Déployée</p>
</div>
<div class="real-visual real-visual-placeholder" aria-hidden="true">
<span class="real-placeholder">Visuel à venir</span>
</div>
</div>
<div class="real-card real-placeholder-card">
<div class="real-text">
<p class="real-client"><strong>Client à venir</strong></p>
<p class="real-meta">Client à venir · Client à venir</p>
<p class="real-before"><span class="real-label cross">✗ Avant</span>Client à venir</p>
<p class="real-after"><span class="real-label check">✓ Après</span>Client à venir</p>
<p class="real-offer">— Clarté Déployée</p>
</div>
<div class="real-visual real-visual-placeholder" aria-hidden="true">
<span class="real-placeholder">Visuel à venir</span>
</div>
</div>
</div>
</div>
</section>

<section class="google-reviews">
<div class="reviews-inner">
<div class="reviews-head reveal">
<p class="kicker">Avis Google vérifiés</p>
<div class="reviews-stars" aria-label="5 étoiles sur 5">★★★★★</div>
</div>
<div class="reviews-grid">
<div class="review-card liquid reveal">
<div class="review-stars" aria-hidden="true">★★★★★</div>
<p class="review-text">"Merci Victoria pour la création de mon site à mon image. C’est un plaisir de travailler avec vous. Vous alliez le meilleur de l’écoute et de la compétence."</p>
<p class="review-author">— Sonia W., Fondatrice Eudokima</p>
</div>
<div class="review-card liquid reveal">
<div class="review-stars" aria-hidden="true">★★★★★</div>
<p class="review-text">"Déjà la 2e collaboration avec Victoria. C’est simple, fluide, professionnel, efficace… et bien sympathique. Jamais 2 sans 3, nous ne ferons pas mentir l’adage&nbsp;!"</p>
<p class="review-author">— Client Paranoir Studio</p>
</div>
<div class="review-card liquid reveal">
<div class="review-stars" aria-hidden="true">★★★★★</div>
<p class="review-text">"Un grand merci à Victoria qui a fait preuve d’une grande écoute et d’un vrai professionnalisme. Je la recommande sans hésiter."</p>
<p class="review-author">— Client Paranoir Studio</p>
</div>
</div>
<div class="reviews-footer reveal">
<a class="buttonlike" href="#" target="_blank" rel="noopener">Voir tous les avis Google →</a>
</div>
</div>
</section>

<section class="final">
<div class="final-inner">
<h2 class="reveal" data-edit="finalTitle">Avant de refaire votre site, vérifiez que c’est bien <span class="highlight">le problème.</span></h2>
<p class="reveal" data-edit="finalText">Commencez par le test de clarté. En quelques questions, vous vérifiez si votre blocage vient plutôt de l’offre, du message, du positionnement ou du parcours.</p>
<a class="cta reveal" data-edit="finalCta" data-link-edit="finalCta" href="#">Obtenir mon Rapport de Clarté <span>→</span></a>
<p class="micro reveal" data-edit="final_3_minutes_gratuit_resultat_personnalise_puis_">3 minutes · Gratuit · Rapport de Clarté remis en visio</p>
</div>
</section>
<section class="offer-comparison" id="comparatif-offres">
<div class="comparison-inner">
<div class="comparison-head">
<div class="reveal">
<p class="kicker" data-edit="comparison_les_trois_offres">Les trois offres</p>
<h2 data-edit="comparison_trois_niveaux_d_intervention_une_seule_logiqu">Trois niveaux d’intervention. Une seule logique : clarifier avant d’agir.</h2>
</div>
<p class="lede reveal" data-edit="comparison_le_quiz_reste_un_outil_d_entree_gratuit_les_o">
            Le point d’entrée, c’est le Rapport de Clarté. Gratuit. Remis en visio. Ensuite, si le sujet mérite d’aller plus loin, deux offres prolongent le travail.
          </p>
</div>
<div class="comparison-table-wrap reveal">
<table aria-label="Comparatif des trois offres Paranoir" class="comparison-table">
<thead>
<tr>
<th></th>
<th>
<div class="offer-col" data-edit="comparison_offre_rapport_de_clarte_gratuit">
<small>Point d’entrée</small>
<strong>Rapport de Clarté</strong>
<span>Gratuit</span>
</div>
</th>
<th>
<div class="offer-col" data-edit="comparison_offre_clarte_deployee_990">
<small>Offre intermédiaire</small>
<strong>Clarté Déployée</strong>
<span>990 € HT</span>
</div>
</th>
<th>
<div class="offer-col" data-edit="comparison_offre_formation_clarte_2990">
<small>Offre formation</small>
<strong>Formation Clarté</strong>
<span>2 990 € HT</span>
</div>
</th>
</tr>
</thead>
<tbody>
<tr class="group-header"><td colspan="4">Collecte</td></tr>
<tr><td class="tool-name">Entretien de diagnostic (visio)</td><td><span class="check">✓</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Audit de l’existant (site, offre, message)</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Analyse concurrentielle</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr class="group-header"><td colspan="4">Analyse</td></tr>
<tr><td class="tool-name">Identification du blocage principal</td><td><span class="check">✓</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Positionnement &amp; différenciation</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Analyse de l’offre &amp; du message</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr class="group-header"><td colspan="4">Stratégie</td></tr>
<tr><td class="tool-name">Hypothèse de blocage formulée</td><td><span class="check">✓</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Plan d’action priorisé</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Recommandations de déploiement</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr class="group-header"><td colspan="4">Déploiement</td></tr>
<tr><td class="tool-name">Reformulation du message (site, profil…)</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Mise à jour LinkedIn &amp; Google Business</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Création d’une page de présentation</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="dash">—</span></td></tr>
<tr class="group-header"><td colspan="4">Livrables</td></tr>
<tr><td class="tool-name">Rapport de Clarté remis en visio</td><td><span class="check">✓</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Restitution enregistrée (Loom ou PDF)</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Support de travail structuré</td><td><span class="dash">—</span></td><td><span class="check">✓</span></td><td><span class="check">✓</span></td></tr>
<tr class="group-header"><td colspan="4">Formation</td></tr>
<tr><td class="tool-name">Atelier équipe (demi-journée)</td><td><span class="dash">—</span></td><td><span class="dash">—</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Méthode transmise à l’équipe</td><td><span class="dash">—</span></td><td><span class="dash">—</span></td><td><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Support de formation remis</td><td><span class="dash">—</span></td><td><span class="dash">—</span></td><td><span class="check">✓</span></td></tr>
</tbody>
</table>
</div>
<div class="comparison-cta reveal">
<p data-edit="comparison_le_bon_point_d_entree_reste_le_rapport_de_clarte"><strong>Le bon point d’entrée, c’est le Rapport de Clarté.</strong> Gratuit, remis en visio — il confirme la cause probable avant de décider si une suite est utile.</p>
<a class="cta" data-edit="comparison_obtenir_mon_rapport_de_clarte" data-link-edit="comparison_obtenir_mon_rapport_de_clarte" href="#prediagnostic">Obtenir mon Rapport de Clarté <span>→</span></a>
</div>
</div>
</section>
<?php include __DIR__ . '/includes/site-footer.php'; ?>
</div>
<script type="module" src="/assets/js/home-three.js"></script>
<script src="/assets/js/site.js"></script>
<button class="admin-toggle" data-edit="page_modifier" id="adminToggle" type="button">Modifier</button>
<aside aria-label="Panneau d’édition" class="admin-panel collapsed" id="adminPanel">
<div class="admin-head">
<div data-edit="page_mode_edition_modifiez_les_textes_liens_images">
<strong>Mode édition</strong>
<span>Modifiez les textes, liens, images et cases du tableau. Les changements publics passent par api.php et sont chargés depuis la BDD.</span>
</div>
<button class="admin-close" id="adminClose" type="button">×</button>
</div>
<div class="admin-tabs">
<button class="admin-tab active" data-admin-tab="texts" data-edit="page_textes" type="button">Textes</button>
<button class="admin-tab" data-admin-tab="links" data-edit="page_liens" type="button">Liens</button>
<button class="admin-tab" data-admin-tab="images" data-edit="page_images" type="button">Images</button>
<button class="admin-tab" data-admin-tab="booleans" data-edit="page_tableau" type="button">Tableau</button>
<button class="admin-tab" data-admin-tab="export" data-edit="page_export" type="button">Export</button>
</div>
<div class="admin-section active" data-admin-section="texts">
<div id="adminTextFields"></div>
</div>
<div class="admin-section" data-admin-section="links">
<div class="admin-field">
<label for="adminCheckout">Lien paiement Diagnostic Express</label>
<input id="adminCheckout" placeholder="https://buy.stripe.com/..." type="url">
</input></div>
<div class="admin-field">
<label for="adminHeroCtaLink">Lien CTA hero</label>
<input id="adminHeroCtaLink" placeholder="#prediagnostic" type="text">
</input></div>
</div>
<div class="admin-section" data-admin-section="images">
<div id="adminImageFields"></div>
</div>
<div class="admin-section" data-admin-section="booleans">
<p class="admin-help" data-edit="page_cochez_decochez_les_inclusions_du_tableau">Cochez / décochez les inclusions du tableau.</p>
<div class="admin-bool-grid" id="adminBoolFields"></div>
</div>
<div class="admin-section" data-admin-section="export">
<div class="admin-actions">
<button class="admin-btn carmine" data-edit="page_sauver_local" id="adminSave" type="button">Sauver local</button>
<button class="admin-btn secondary" data-edit="page_reinitialiser" id="adminReset" type="button">Réinitialiser</button>
<button class="admin-btn" data-edit="page_copier_json" id="adminCopyJson" type="button">Copier JSON</button>
<button class="admin-btn" data-edit="page_copier_url" id="adminCopyUrl" type="button">Copier URL</button>
</div>
<textarea class="admin-output" id="adminOutput" placeholder="Export JSON ou URL générée"></textarea>
<div class="admin-field">
<label for="adminImport">Importer JSON</label>
<textarea id="adminImport" placeholder='{"texts":{...},"links":{...},"images":{...},"booleans":{...}}'></textarea>
</div>
<button class="admin-btn carmine" data-edit="page_importer" id="adminApplyImport" type="button">Importer</button>
<p class="admin-help">Mode admin : <code>#admin</code> ou <code>?admin=1&amp;key=victoria</code>. Version partageable : <code>?data=...</code>.</p>
</div>
</aside>





</body>
</html>
