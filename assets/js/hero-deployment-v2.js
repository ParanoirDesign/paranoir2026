(() => {
  const mountDeployment = () => {
    const hero = document.querySelector('.hero-v2');
    if (!hero) return;

    const board = hero.querySelector('.case-board');
    const panel = hero.querySelector('.hero-system-panel');
    if (!board || !panel || board.contains(panel)) return;

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

    board.appendChild(panel);

    const evidence = board.querySelectorAll('.evidence');
    const deploymentCard = evidence[evidence.length - 1];
    deploymentCard?.classList.add('evidence--hidden');
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => requestAnimationFrame(mountDeployment), { once: true });
  } else {
    requestAnimationFrame(mountDeployment);
  }
})();
