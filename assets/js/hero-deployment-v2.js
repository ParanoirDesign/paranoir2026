(() => {
  const heroStylesheet = document.getElementById('hero-v2-css');
  if (heroStylesheet) heroStylesheet.href = '/assets/css/hero-v2.css?v=11';

  const SVG_NS = 'http://www.w3.org/2000/svg';

  const createSvgElement = (name, className) => {
    const element = document.createElementNS(SVG_NS, name);
    if (className) element.setAttribute('class', className);
    return element;
  };

  const pointOnRect = (rect, boardRect, xRatio, yRatio) => ({
    x: rect.left - boardRect.left + rect.width * xRatio,
    y: rect.top - boardRect.top + rect.height * yRatio
  });

  const buildThreadPath = points => {
    if (!points.length) return '';

    let d = `M ${points[0].x.toFixed(2)} ${points[0].y.toFixed(2)}`;

    for (let index = 0; index < points.length - 1; index += 1) {
      const start = points[index];
      const end = points[index + 1];
      const dx = end.x - start.x;
      const dy = end.y - start.y;
      const length = Math.max(1, Math.hypot(dx, dy));
      const perpendicularX = -dy / length;
      const perpendicularY = dx / length;
      const sag = Math.min(13, Math.max(5, length * 0.035)) * (index % 2 === 0 ? 1 : -1);
      const controlX = start.x + dx * 0.5 + perpendicularX * sag;
      const controlY = start.y + dy * 0.5 + perpendicularY * sag;

      d += ` Q ${controlX.toFixed(2)} ${controlY.toFixed(2)} ${end.x.toFixed(2)} ${end.y.toFixed(2)}`;
    }

    return d;
  };

  const mountDetectiveThread = (board, evidence, panel) => {
    const threadSvg = board.querySelector('.thread-svg');
    if (!threadSvg || evidence.length < 5) return;

    threadSvg.setAttribute('aria-hidden', 'true');
    threadSvg.setAttribute('preserveAspectRatio', 'none');
    threadSvg.innerHTML = '';

    const shadow = createSvgElement('path', 'detective-thread__shadow');
    const fiber = createSvgElement('path', 'detective-thread__fiber');
    const twist = createSvgElement('path', 'detective-thread__twist');
    threadSvg.append(shadow, fiber, twist);

    const previousPins = board.querySelector('.detective-pin-svg');
    previousPins?.remove();

    const pinSvg = createSvgElement('svg', 'detective-pin-svg');
    pinSvg.setAttribute('aria-hidden', 'true');
    pinSvg.setAttribute('preserveAspectRatio', 'none');
    board.appendChild(pinSvg);

    const pins = Array.from({ length: 6 }, () => {
      const group = createSvgElement('g', 'detective-pin-group');
      const halo = createSvgElement('circle', 'detective-pin__halo');
      const head = createSvgElement('circle', 'detective-pin');
      const core = createSvgElement('circle', 'detective-pin__core');
      halo.setAttribute('r', '7');
      head.setAttribute('r', '4.4');
      core.setAttribute('r', '1.45');
      group.append(halo, head, core);
      pinSvg.appendChild(group);
      return [halo, head, core];
    });

    const setPin = (pinParts, point) => {
      pinParts.forEach(part => {
        part.setAttribute('cx', point.x.toFixed(2));
        part.setAttribute('cy', point.y.toFixed(2));
      });
    };

    let frameId = 0;
    let active = true;
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const render = () => {
      if (!active) return;

      const boardRect = board.getBoundingClientRect();
      const width = Math.max(1, boardRect.width);
      const height = Math.max(1, boardRect.height);
      const panelRect = panel.getBoundingClientRect();
      const evidenceRects = evidence.slice(0, 5).map(item => item.getBoundingClientRect());

      threadSvg.setAttribute('viewBox', `0 0 ${width} ${height}`);
      pinSvg.setAttribute('viewBox', `0 0 ${width} ${height}`);

      const points = [
        pointOnRect(evidenceRects[0], boardRect, 0.94, 0.56),
        pointOnRect(evidenceRects[1], boardRect, 0.06, 0.68),
        pointOnRect(evidenceRects[2], boardRect, 0.94, 0.35),
        pointOnRect(evidenceRects[3], boardRect, 0.06, 0.67),
        pointOnRect(evidenceRects[4], boardRect, 0.94, 0.36),
        pointOnRect(panelRect, boardRect, 0.5, 0.03)
      ];

      const d = buildThreadPath(points);
      shadow.setAttribute('d', d);
      fiber.setAttribute('d', d);
      twist.setAttribute('d', d);
      points.forEach((point, index) => setPin(pins[index], point));

      if (!reducedMotion) frameId = requestAnimationFrame(render);
    };

    render();

    document.addEventListener('visibilitychange', () => {
      active = !document.hidden;
      if (active && !reducedMotion) frameId = requestAnimationFrame(render);
      else if (frameId) cancelAnimationFrame(frameId);
    });
  };

  const mountDeployment = () => {
    const hero = document.querySelector('.hero-v2');
    if (!hero) return;

    const board = hero.querySelector('.case-board');
    const panel = hero.querySelector('.hero-system-panel');
    if (!board || !panel) return;

    const items = panel.querySelectorAll('.hero-system-panel__item');
    const labels = [
      ['01 · Site', 'Le socle'],
      ['02 · Réseau social', 'La voix'],
      ['03 · Fiche Google', 'La confiance']
    ];

    items.forEach((item, index) => {
      const data = labels[index];
      if (!data) return;
      item.innerHTML = `<small>${data[0]}</small><strong>${data[1]}</strong>`;
    });

    if (!board.contains(panel)) board.appendChild(panel);

    const stamp = board.querySelector('.stamp');
    if (stamp) stamp.textContent = 'Cause trouvée';

    const evidence = Array.from(board.querySelectorAll('.evidence'));
    const deploymentCard = evidence[evidence.length - 1];
    deploymentCard?.classList.add('evidence--hidden');

    mountDetectiveThread(board, evidence, panel);
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => requestAnimationFrame(mountDeployment), { once: true });
  } else {
    requestAnimationFrame(mountDeployment);
  }
})();
