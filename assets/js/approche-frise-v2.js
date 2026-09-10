(() => {
  const buildFrieze = section => {
    if (!section || section.classList.contains('approach-frieze-v2')) return false;

    const kicker = section.querySelector('.home-kicker')?.textContent?.trim() || 'Quand le message se dérègle';
    const title = section.querySelector('h2')?.textContent?.trim() || 'Le client ne devrait pas avoir à deviner ce que vous faites.';
    const lede = section.querySelector('.home-lede')?.textContent?.trim() || 'Votre activité peut évoluer plus vite que votre communication. Le problème commence souvent là.';
    const note = section.querySelector('.cycle-copy__note')?.textContent?.trim() || 'La solution n’est pas d’en dire davantage. C’est de repartir d’une base commune.';
    const steps = Array.from(section.querySelectorAll('.cycle-node')).map(node => node.textContent.trim()).filter(Boolean);

    if (!steps.length) return false;

    const noteHtml = note.replace('repartir d’une base commune', '<strong>repartir d’une base commune</strong>');
    const stepHtml = steps.map((text, index) => `
      <li class="approach-frieze-v2__step">
        <span class="approach-frieze-v2__connector" aria-hidden="true"></span>
        <span class="approach-frieze-v2__pin" aria-hidden="true"></span>
        <article class="approach-frieze-v2__card">
          <span class="approach-frieze-v2__number">${String(index + 1).padStart(2, '0')}</span>
          <p>${text}</p>
        </article>
      </li>`).join('');

    section.classList.add('approach-frieze-v2');
    section.innerHTML = `
      <div class="home-section__inner">
        <header class="approach-frieze-v2__head">
          <p class="home-kicker">${kicker}</p>
          <h2>${title}</h2>
          <p class="home-lede">${lede}</p>
        </header>
        <div class="approach-frieze-v2__rail" aria-label="Les étapes qui font perdre de la clarté à votre communication">
          <svg class="approach-frieze-v2__thread" viewBox="0 0 1000 90" preserveAspectRatio="none" aria-hidden="true">
            <path class="approach-frieze-v2__thread-shadow" d="M0 46 C85 42 145 51 220 46 S365 41 445 47 S590 52 670 45 S820 40 1000 46"/>
            <path class="approach-frieze-v2__thread-main" d="M0 46 C85 42 145 51 220 46 S365 41 445 47 S590 52 670 45 S820 40 1000 46"/>
            <path class="approach-frieze-v2__thread-fiber" d="M0 44.8 C85 40.8 145 49.8 220 44.8 S365 39.8 445 45.8 S590 50.8 670 43.8 S820 38.8 1000 44.8"/>
          </svg>
          <ol class="approach-frieze-v2__steps">${stepHtml}</ol>
        </div>
        <p class="approach-frieze-v2__note">${noteHtml}</p>
      </div>`;

    return true;
  };

  const apply = () => {
    document.querySelector('#preuve.home-proof')?.remove();
    return buildFrieze(document.querySelector('#approche'));
  };

  const start = () => {
    if (apply()) return;

    const observer = new MutationObserver(() => {
      const proof = document.querySelector('#preuve.home-proof');
      if (proof) proof.remove();
      if (buildFrieze(document.querySelector('#approche'))) observer.disconnect();
    });

    observer.observe(document.body, { childList: true, subtree: true });
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', start, { once: true });
  } else {
    start();
  }
})();
