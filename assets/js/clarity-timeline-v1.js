(() => {
  const ensureStylesheet = () => {
    if (document.querySelector('link[href*="clarity-timeline-v1.css"]')) return;
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '/assets/css/clarity-timeline-v1.css?v=1';
    document.head.appendChild(link);
  };

  const mount = () => {
    const section = document.querySelector('.statement');
    if (!section || section.classList.contains('clarity-timeline-v1')) return;

    section.classList.add('clarity-timeline-v1');
    section.innerHTML = `
      <div class="clarity-timeline__head reveal">
        <p class="clarity-timeline__kicker">Le flou s’installe progressivement</p>
        <h2>Quand votre clarté se dégrade, <span class="highlight">les décisions se compliquent.</span></h2>
        <p class="clarity-timeline__lede">Tout ne se casse pas d’un coup. Votre activité évolue, vos messages s’écartent, puis comprendre votre offre demande de plus en plus d’effort.</p>
      </div>
      <div class="clarity-timeline__viewport" aria-label="Comment le manque de clarté complique progressivement la décision du client">
        <div class="clarity-timeline__stage">
          <svg class="clarity-timeline__thread" viewBox="0 0 1200 354" preserveAspectRatio="none" aria-hidden="true">
            <defs>
              <filter id="clarityThreadTexture" x="-10%" y="-20%" width="120%" height="140%">
                <feTurbulence type="fractalNoise" baseFrequency="0.012 0.09" numOctaves="2" seed="7" result="noise"/>
                <feDisplacementMap in="SourceGraphic" in2="noise" scale="2.4" xChannelSelector="R" yChannelSelector="G"/>
              </filter>
            </defs>
            <path class="clarity-timeline__thread-shadow" d="M 20 184 C 100 157 170 211 245 179 S 385 157 455 190 S 585 219 660 177 S 805 151 875 194 S 1010 224 1080 181 S 1150 157 1180 174"/>
            <path id="clarityTimelinePath" class="clarity-timeline__thread-fiber" d="M 20 184 C 100 157 170 211 245 179 S 385 157 455 190 S 585 219 660 177 S 805 151 875 194 S 1010 224 1080 181 S 1150 157 1180 174"/>
            <path class="clarity-timeline__thread-strand" d="M 20 184 C 100 157 170 211 245 179 S 385 157 455 190 S 585 219 660 177 S 805 151 875 194 S 1010 224 1080 181 S 1150 157 1180 174"/>
            <path class="clarity-timeline__thread-soft" d="M 52 189 C 140 169 180 198 272 180 M 425 191 C 520 206 573 205 680 177 M 842 190 C 931 213 1003 208 1102 177"/>
            <g>
              <circle class="clarity-timeline__pin-halo" cx="83" cy="170" r="9"/><circle class="clarity-timeline__pin" cx="83" cy="170" r="5"/><circle class="clarity-timeline__pin-core" cx="83" cy="170" r="1.8"/>
              <circle class="clarity-timeline__pin-halo" cx="272" cy="181" r="9"/><circle class="clarity-timeline__pin" cx="272" cy="181" r="5"/><circle class="clarity-timeline__pin-core" cx="272" cy="181" r="1.8"/>
              <circle class="clarity-timeline__pin-halo" cx="469" cy="193" r="9"/><circle class="clarity-timeline__pin" cx="469" cy="193" r="5"/><circle class="clarity-timeline__pin-core" cx="469" cy="193" r="1.8"/>
              <circle class="clarity-timeline__pin-halo" cx="672" cy="174" r="9"/><circle class="clarity-timeline__pin" cx="672" cy="174" r="5"/><circle class="clarity-timeline__pin-core" cx="672" cy="174" r="1.8"/>
              <circle class="clarity-timeline__pin-halo" cx="881" cy="197" r="9"/><circle class="clarity-timeline__pin" cx="881" cy="197" r="5"/><circle class="clarity-timeline__pin-core" cx="881" cy="197" r="1.8"/>
              <circle class="clarity-timeline__pin-halo" cx="1118" cy="169" r="9"/><circle class="clarity-timeline__pin" cx="1118" cy="169" r="5"/><circle class="clarity-timeline__pin-core" cx="1118" cy="169" r="1.8"/>
            </g>
          </svg>

          <article class="clarity-timeline__card clarity-timeline__card--1 is-top" data-step="1">
            <span class="clarity-timeline__card-num">01</span>
            <strong>Votre activité évolue</strong>
            <span>Vos priorités changent.</span>
          </article>
          <article class="clarity-timeline__card clarity-timeline__card--2 is-bottom" data-step="2">
            <span class="clarity-timeline__card-num">02</span>
            <strong>Votre offre se brouille</strong>
            <span>Ce qui était évident l’est moins.</span>
          </article>
          <article class="clarity-timeline__card clarity-timeline__card--3 is-top" data-step="3">
            <span class="clarity-timeline__card-num">03</span>
            <strong>Site, réseaux et Google</strong>
            <span>ne disent plus la même chose.</span>
          </article>
          <article class="clarity-timeline__card clarity-timeline__card--4 is-bottom" data-step="4">
            <span class="clarity-timeline__card-num">04</span>
            <strong>Le client hésite</strong>
            <span>Il doit reconstruire votre logique.</span>
          </article>
          <article class="clarity-timeline__card clarity-timeline__card--5 is-top" data-step="5">
            <span class="clarity-timeline__card-num">05</span>
            <strong>Vous sur-expliquez</strong>
            <span>Vous ajoutez du contenu pour compenser.</span>
          </article>
          <article class="clarity-timeline__card clarity-timeline__card--6 is-bottom" data-step="6">
            <span class="clarity-timeline__card-num">06</span>
            <strong>Le client choisit la concurrence</strong>
            <span>Parce qu’elle est plus simple à comprendre.</span>
          </article>

          <div class="clarity-timeline__traveller" data-state="1" aria-hidden="true">
            <span class="clarity-timeline__eyes"><i></i><i></i></span>
            <span class="clarity-timeline__mouth"></span>
          </div>
        </div>
      </div>`;

    const stage = section.querySelector('.clarity-timeline__stage');
    const path = section.querySelector('#clarityTimelinePath');
    const traveller = section.querySelector('.clarity-timeline__traveller');
    const cards = Array.from(section.querySelectorAll('.clarity-timeline__card'));
    if (!stage || !path || !traveller || !cards.length) return;

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const pathLength = path.getTotalLength();
    const duration = 13200;
    let raf = 0;
    let startTime = null;
    let active = false;

    const setProgress = progress => {
      const point = path.getPointAtLength(pathLength * progress);
      const stageRect = stage.getBoundingClientRect();
      const x = point.x * (stageRect.width / 1200);
      const y = point.y * (stageRect.height / 354);
      const state = Math.min(6, Math.max(1, Math.floor(progress * 6) + 1));
      const tilt = state === 6 ? -10 : (state >= 4 ? -4 : 0);

      traveller.dataset.state = String(state);
      traveller.style.transform = `translate(${x - 17}px, ${y - 17}px) rotate(${tilt}deg)`;
      cards.forEach((card, index) => card.classList.toggle('is-active', index === state - 1));
    };

    const tick = time => {
      if (!active) return;
      if (startTime === null) startTime = time;
      const progress = ((time - startTime) % duration) / duration;
      setProgress(progress);
      raf = requestAnimationFrame(tick);
    };

    if (reducedMotion) {
      setProgress(.5);
      return;
    }

    const observer = new IntersectionObserver(entries => {
      const visible = entries.some(entry => entry.isIntersecting);
      if (visible && !active) {
        active = true;
        startTime = null;
        raf = requestAnimationFrame(tick);
      } else if (!visible && active) {
        active = false;
        cancelAnimationFrame(raf);
      }
    }, { threshold: .22 });

    observer.observe(section);
  };

  ensureStylesheet();
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => requestAnimationFrame(mount), { once: true });
  } else {
    requestAnimationFrame(mount);
  }
})();
