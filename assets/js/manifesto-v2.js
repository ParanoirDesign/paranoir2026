(() => {
  const mountManifesto = () => {
    const section = document.querySelector('.statement');
    if (!section || section.classList.contains('manifesto-v2')) return;

    section.classList.add('manifesto-v2');
    section.innerHTML = `
      <div class="manifesto-v2__top">
        <div>
          <p class="manifesto-v2__kicker">Notre approche</p>
          <h2>Un site peut être parfaitement construit<span class="manifesto-v2__accent">et envoyer les mauvais signaux.</span></h2>
        </div>
        <div class="manifesto-v2__body">
          <p>Parce qu’un prospect ne suit pas un parcours bien rangé.</p>
          <p>Il peut vous découvrir sur <strong>Google</strong>, consulter votre <strong>site</strong>, vérifier votre activité sur <strong>LinkedIn ou Instagram</strong>, puis revenir lire vos avis.</p>
          <p>Si chaque support raconte une version différente de votre entreprise, <strong>la confiance se fragilise.</strong></p>
        </div>
      </div>
      <div class="manifesto-v2__rule" aria-hidden="true"></div>
      <div class="manifesto-v2__statement">
        <p class="manifesto-v2__strong">Nous ne travaillons pas uniquement sur votre site. <span>Nous alignons tout ce qui aide vos clients à vous comprendre et à vous choisir.</span></p>
        <p class="manifesto-v2__signature">Trois points de contact. Une seule stratégie.</p>
      </div>`;
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mountManifesto, { once: true });
  } else {
    mountManifesto();
  }
})();
