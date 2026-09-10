(() => {
  const VIEWBOX_WIDTH = 1200;
  const VIEWBOX_HEIGHT = 336;
  const FLOAT_CYCLE = 6400;
  const TRAVEL_DURATION = 13200;
  const ANCHORS = [.055, .225, .395, .565, .745, .94];

  const ensureStylesheet = () => {
    if (document.querySelector('link[href*="clarity-timeline-v1.css"]')) return;
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '/assets/css/clarity-timeline-v1.css?v=3';
    document.head.appendChild(link);
  };

  let activeSection = null;
  let animationCleanup = null;
  let scheduled = false;

  const smoothPath = points => {
    if (!points.length) return '';
    if (points.length === 1) return `M ${points[0].x} ${points[0].y}`;

    let d = `M ${points[0].x.toFixed(2)} ${points[0].y.toFixed(2)}`;
    const tension = .78;

    for (let i = 0; i < points.length - 1; i += 1) {
      const p0 = points[Math.max(0, i - 1)];
      const p1 = points[i];
      const p2 = points[i + 1];
      const p3 = points[Math.min(points.length - 1, i + 2)];
      const cp1x = p1.x + ((p2.x - p0.x) / 6) * tension;
      const cp1y = p1.y + ((p2.y - p0.y) / 6) * tension;
      const cp2x = p2.x - ((p3.x - p1.x) / 6) * tension;
      const cp2y = p2.y - ((p3.y - p1.y) / 6) * tension;
      d += ` C ${cp1x.toFixed(2)} ${cp1y.toFixed(2)} ${cp2x.toFixed(2)} ${cp2y.toFixed(2)} ${p2.x.toFixed(2)} ${p2.y.toFixed(2)}`;
    }

    return d;
  };

  const mountTimeline = section => {
    if (!section || section.classList.contains('clarity-timeline-v1')) return;

    animationCleanup?.();
    activeSection = section;

    section.id = 'approche';
    section.classList.remove('cycle-section', 'cycle-section--problem', 'approach-frieze-v2');
    section.classList.add('clarity-timeline-v1');
    section.innerHTML = `
      <div class="clarity-timeline__inner">
        <div class="clarity-timeline__shell">
          <div class="clarity-timeline__head">
            <p class="clarity-timeline__kicker">Le flou s’installe progressivement</p>
            <h2>Quand votre clarté se dégrade, <span class="highlight">les décisions se compliquent.</span></h2>
            <p class="clarity-timeline__lede">Tout ne se casse pas d’un coup. Votre activité évolue, vos messages s’écartent, puis comprendre votre offre demande de plus en plus d’effort.</p>
          </div>
          <div class="clarity-timeline__viewport" aria-label="Comment le manque de clarté complique progressivement la décision du client">
            <div class="clarity-timeline__stage">
              <svg class="clarity-timeline__thread" viewBox="0 0 ${VIEWBOX_WIDTH} ${VIEWBOX_HEIGHT}" preserveAspectRatio="none" aria-hidden="true">
                <defs>
                  <filter id="clarityThreadTexture" x="-10%" y="-20%" width="120%" height="140%">
                    <feTurbulence type="fractalNoise" baseFrequency="0.012 0.09" numOctaves="2" seed="7" result="noise"/>
                    <feDisplacementMap in="SourceGraphic" in2="noise" scale="2.4" xChannelSelector="R" yChannelSelector="G"/>
                  </filter>
                </defs>
                <path fill="none" class="clarity-timeline__thread-shadow"/>
                <path fill="none" id="clarityTimelinePath" class="clarity-timeline__thread-fiber"/>
                <path fill="none" class="clarity-timeline__thread-strand"/>
                <path fill="none" class="clarity-timeline__thread-soft"/>
                <g class="clarity-timeline__pins">
                  ${ANCHORS.map((_, index) => `
                    <g class="clarity-timeline__pin-group" data-pin="${index}">
                      <circle class="clarity-timeline__pin-halo" r="9"/>
                      <circle class="clarity-timeline__pin" r="5"/>
                      <circle class="clarity-timeline__pin-core" r="1.8"/>
                    </g>`).join('')}
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
          </div>
        </div>
      </div>`;

    const stage = section.querySelector('.clarity-timeline__stage');
    const path = section.querySelector('#clarityTimelinePath');
    const shadowPath = section.querySelector('.clarity-timeline__thread-shadow');
    const strandPath = section.querySelector('.clarity-timeline__thread-strand');
    const softPath = section.querySelector('.clarity-timeline__thread-soft');
    const traveller = section.querySelector('.clarity-timeline__traveller');
    const cards = Array.from(section.querySelectorAll('.clarity-timeline__card'));
    const pins = Array.from(section.querySelectorAll('.clarity-timeline__pin-group'));
    if (!stage || !path || !shadowPath || !strandPath || !softPath || !traveller || cards.length !== ANCHORS.length || pins.length !== ANCHORS.length) return;

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const baseOffsets = [0, -14, 9, -8, 11, -10, 7, -6, 1];
    const xPoints = [20, 165, 315, 465, 615, 765, 915, 1060, 1180];
    let raf = 0;
    let startTime = null;
    let active = false;
    let lastProgress = .03;

    const buildThread = time => {
      const phase = reducedMotion ? 0 : (time % FLOAT_CYCLE) / FLOAT_CYCLE * Math.PI * 2;
      const globalFloat = reducedMotion ? 0 : Math.sin(phase) * 5.2;
      const points = xPoints.map((x, index) => ({
        x,
        y: 170 + baseOffsets[index] + globalFloat + (reducedMotion ? 0 : Math.sin(phase + index * .72) * 3.1)
      }));
      const d = smoothPath(points);
      path.setAttribute('d', d);
      shadowPath.setAttribute('d', d);
      strandPath.setAttribute('d', d);

      const softPoints = points.map((point, index) => ({
        x: point.x,
        y: point.y + Math.sin(index * 1.37) * 2.2 + 2.6
      }));
      softPath.setAttribute('d', smoothPath(softPoints));
      return { phase, globalFloat };
    };

    const setAnchors = (phase, globalFloat) => {
      const length = Math.max(1, path.getTotalLength());
      const stageRect = stage.getBoundingClientRect();
      const scaleX = stageRect.width / VIEWBOX_WIDTH;

      ANCHORS.forEach((ratio, index) => {
        const point = path.getPointAtLength(length * ratio);
        pins[index].setAttribute('transform', `translate(${point.x.toFixed(2)} ${point.y.toFixed(2)})`);

        const card = cards[index];
        const desiredLeft = point.x * scaleX - card.offsetWidth / 2;
        const left = Math.max(0, Math.min(stageRect.width - card.offsetWidth, desiredLeft));
        const localFloat = reducedMotion ? 0 : globalFloat * .38 + Math.sin(phase + index * .72) * 2.2;
        card.style.left = `${left.toFixed(2)}px`;
        card.style.setProperty('--float-y', `${localFloat.toFixed(2)}px`);
      });
    };

    const setTraveller = progress => {
      const length = Math.max(1, path.getTotalLength());
      const point = path.getPointAtLength(length * progress);
      const stageRect = stage.getBoundingClientRect();
      const x = point.x * (stageRect.width / VIEWBOX_WIDTH);
      const y = point.y * (stageRect.height / VIEWBOX_HEIGHT);
      const state = Math.min(6, Math.max(1, Math.floor(progress * 6) + 1));
      const tilt = state === 6 ? -10 : (state >= 4 ? -4 : 0);

      traveller.dataset.state = String(state);
      traveller.style.transform = `translate(${(x - 17).toFixed(2)}px, ${(y - 17).toFixed(2)}px) rotate(${tilt}deg)`;
      cards.forEach((card, index) => card.classList.toggle('is-active', index === state - 1));
    };

    const renderScene = (time, progress) => {
      const { phase, globalFloat } = buildThread(time);
      setAnchors(phase, globalFloat);
      setTraveller(progress);
    };

    const tick = time => {
      if (!active) return;
      if (startTime === null) startTime = time;
      lastProgress = ((time - startTime) % TRAVEL_DURATION) / TRAVEL_DURATION;
      renderScene(time, lastProgress);
      raf = requestAnimationFrame(tick);
    };

    renderScene(0, lastProgress);

    const resizeObserver = new ResizeObserver(() => {
      if (!active || reducedMotion) renderScene(performance.now(), lastProgress);
    });
    resizeObserver.observe(stage);

    if (reducedMotion) {
      lastProgress = .5;
      renderScene(0, lastProgress);
      animationCleanup = () => resizeObserver.disconnect();
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
    }, { threshold: .16 });

    observer.observe(section);
    animationCleanup = () => {
      active = false;
      cancelAnimationFrame(raf);
      observer.disconnect();
      resizeObserver.disconnect();
    };
  };

  const tryMount = () => {
    scheduled = false;
    const section = document.getElementById('approche');
    if (!section) return;
    if (section === activeSection && section.classList.contains('clarity-timeline-v1')) return;
    mountTimeline(section);
  };

  const scheduleMount = () => {
    if (scheduled) return;
    scheduled = true;
    requestAnimationFrame(tryMount);
  };

  const start = () => {
    ensureStylesheet();
    scheduleMount();

    const main = document.getElementById('main');
    if (!main) return;
    const observer = new MutationObserver(scheduleMount);
    observer.observe(main, { childList: true, subtree: true });
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', start, { once: true });
  } else {
    start();
  }
})();
