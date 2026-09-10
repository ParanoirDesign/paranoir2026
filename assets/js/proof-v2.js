(() => {
  const ensureStylesheet = () => {
    if (document.getElementById('proof-v2-css')) return;
    const link = document.createElement('link');
    link.id = 'proof-v2-css';
    link.rel = 'stylesheet';
    link.href = '/assets/css/proof-v2.css?v=1';
    document.head.appendChild(link);
  };

  const mountProof = () => {
    const section = document.querySelector('.proof');
    if (!section || section.classList.contains('proof-v2')) return;

    section.classList.add('proof-v2');
    section.setAttribute('aria-label', 'Quelques repères sur Paranoir Studio');
    section.innerHTML = `
      <article class="proof-v2__item">
        <strong class="proof-v2__value">+60</strong>
        <span class="proof-v2__label">entreprises accompagnées</span>
      </article>
      <article class="proof-v2__item">
        <strong class="proof-v2__value proof-v2__rating" aria-label="Note de 5 sur 5 sur Google">
          <span class="proof-v2__stars" aria-hidden="true">★★★★★</span>
          <span class="proof-v2__score">5/5</span>
        </strong>
        <span class="proof-v2__label">sur Google</span>
      </article>
      <article class="proof-v2__item">
        <strong class="proof-v2__value proof-v2__value--advice">Des conseils<br>en continu</strong>
        <nav class="proof-v2__links" aria-label="Suivre Paranoir Studio">
          <a href="https://www.linkedin.com/in/victoria-dury-paranoir/" target="_blank" rel="noopener noreferrer">LinkedIn ↗</a>
          <a href="https://www.instagram.com/paranoir_studio/" target="_blank" rel="noopener noreferrer">Instagram ↗</a>
        </nav>
      </article>`;
  };

  ensureStylesheet();
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', mountProof, { once: true });
  } else {
    mountProof();
  }
})();
