(() => {
  const SVG_NS = 'http://www.w3.org/2000/svg';

  const rectAnchor = (rect, boardRect, towardRect) => {
    const cx = rect.left - boardRect.left + rect.width / 2;
    const cy = rect.top - boardRect.top + rect.height / 2;
    const tx = towardRect.left - boardRect.left + towardRect.width / 2;
    const ty = towardRect.top - boardRect.top + towardRect.height / 2;
    const dx = tx - cx;
    const dy = ty - cy;
    const safeDx = Math.abs(dx) < 0.001 ? 0.001 : Math.abs(dx);
    const safeDy = Math.abs(dy) < 0.001 ? 0.001 : Math.abs(dy);
    const scale = Math.min((rect.width / 2) / safeDx, (rect.height / 2) / safeDy);

    return {
      x: cx + dx * scale,
      y: cy + dy * scale
    };
  };

  const panelAnchor = (panelRect, boardRect) => ({
    x: panelRect.left - boardRect.left + panelRect.width / 2,
    y: panelRect.top - boardRect.top + 2
  });

  const createSvgElement = (name, className) => {
    const element = document.createElementNS(SVG_NS, name);
    if (className) element.setAttribute('class', className);
    return element;
  };

  const mountDetectiveThreads = (board, evidence, panel) => {
    const svg = board.querySelector('.thread-svg');
    if (!svg || evidence.length < 5) return;

    svg.setAttribute('aria-hidden', 'true');
    svg.setAttribute('preserveAspectRatio', 'none');
    svg.innerHTML = '';

    const connections = [
      { from: evidence[0], to: evidence[1], tone: 'soft', bend: -5, phase: 0 },
      { from: evidence[1], to: evidence[2], tone: 'soft', bend: 8, phase: 0.7 },
      { from: evidence[2], to: evidence[3], tone: 'hot', bend: -7, phase: 1.4 },
      { from: evidence[3], to: evidence[4], tone: 'hot', bend: 9, phase: 2.1 },
      { from: evidence[4], to: panel, tone: 'hot', bend: -4, phase: 2.8, panelTarget: true }
    ];

    const rendered = connections.map(connection => {
      const group = createSvgElement('g', `detective-thread detective-thread--${connection.tone}`);
      const shadow = createSvgElement('path', 'detective-thread__shadow');
      const fiber = createSvgElement('path', 'detective-thread__fiber');
      const twist = createSvgElement('path', 'detective-thread__twist');
      const pinStartHalo = createSvgElement('circle', 'detective-pin__halo');
      const pinStart = createSvgElement('circle', 'detective-pin');
      const pinStartCore = createSvgElement('circle', 'detective-pin__core');
      const pinEndHalo = createSvgElement('circle', 'detective-pin__halo');
      const pinEnd = createSvgElement('circle', 'detective-pin');
      const pinEndCore = createSvgElement('circle', 'detective-pin__core');

      [pinStartHalo, pinEndHalo].forEach(pin => pin.setAttribute('r', '7'));
      [pinStart, pinEnd].forEach(pin => pin.setAttribute('r', '4.2'));
      [pinStartCore, pinEndCore].forEach(pin => pin.setAttribute('r', '1.5'));

      group.append(shadow, fiber, twist, pinStartHalo, pinStart, pinStartCore, pinEndHalo, pinEnd, pinEndCore);
      svg.appendChild(group);

      return {
        ...connection,
        group,
        paths: [shadow, fiber, twist],
        pins: {
          start: [pinStartHalo, pinStart, pinStartCore],
          end: [pinEndHalo, pinEnd, pinEndCore]
        }
      };
    });

    let frame = 0;
    let running = true;
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const setPin = (pins, point) => {
      pins.forEach(pin => {
        pin.setAttribute('cx', point.x.toFixed(2));
        pin.setAttribute('cy', point.y.toFixed(2));
      });
    };

    const render = time => {
      if (!running) return;

      const boardRect = board.getBoundingClientRect();
      const width = Math.max(1, boardRect.width);
      const height = Math.max(1, boardRect.height);
      svg.setAttribute('viewBox', `0 0 ${width} ${height}`);

      rendered.forEach(connection => {
        const fromRect = connection.from.getBoundingClientRect();
        const toRect = connection.to.getBoundingClientRect();
        const start = rectAnchor(fromRect, boardRect, toRect);
        const end = connection.panelTarget
          ? panelAnchor(toRect, boardRect)
          : rectAnchor(toRect, boardRect, fromRect);
        const dx = end.x - start.x;
        const dy = end.y - start.y;
        const length = Math.max(1, Math.hypot(dx, dy));
        const px = -dy / length;
        const py = dx / length;
        const pulse = reducedMotion ? 0 : Math.sin(time / 875 + connection.phase) * 2.3;
        const bend = connection.bend + pulse;
        const first = {
          x: start.x + dx * 0.34 + px * bend,
          y: start.y + dy * 0.34 + py * bend
        };
        const second = {
          x: start.x + dx * 0.67 - px * bend * 0.62,
          y: start.y + dy * 0.67 - py * bend * 0.62
        };
        const d = `M ${start.x.toFixed(2)} ${start.y.toFixed(2)} L ${first.x.toFixed(2)} ${first.y.toFixed(2)} L ${second.x.toFixed(2)} ${second.y.toFixed(2)} L ${end.x.toFixed(2)} ${end.y.toFixed(2)}`;

        connection.paths.forEach(path => path.setAttribute('d', d));
        setPin(connection.pins.start, start);
        setPin(connection.pins.end, end);
      });

      if (!reducedMotion) frame = requestAnimationFrame(render);
    };

    render(0);

    document.addEventListener('visibilitychange', () => {
      running = !document.hidden;
      if (running && !reducedMotion) frame = requestAnimationFrame(render);
      else if (frame) cancelAnimationFrame(frame);
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

    const evidence = Array.from(board.querySelectorAll('.evidence'));
    const deploymentCard = evidence[evidence.length - 1];
    deploymentCard?.classList.add('evidence--hidden');

    mountDetectiveThreads(board, evidence, panel);
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => requestAnimationFrame(mountDeployment), { once: true });
  } else {
    requestAnimationFrame(mountDeployment);
  }
})();
