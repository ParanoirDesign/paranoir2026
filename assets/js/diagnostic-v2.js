(() => {
  const mountDiagnostic = () => {
    const section = document.querySelector('section.prequiz#prediagnostic, section.prequiz#test, section.prequiz');
    if (!section || section.dataset.diagnosticV2Mounted === 'true') return;

    section.dataset.diagnosticV2Mounted = 'true';
    section.classList.add('diagnostic-v2');

    if (!document.getElementById('diagnostic')) {
      const anchor = document.createElement('span');
      anchor.id = 'diagnostic';
      anchor.className = 'diagnostic-v2__anchor';
      anchor.setAttribute('aria-hidden', 'true');
      section.prepend(anchor);
    }

    const quiz = section.querySelector('#growthQuiz');
    if (!quiz) return;

    const progress = quiz.querySelector('.quiz-progress');
    if (progress && !quiz.querySelector('.diagnostic-v2__casebar')) {
      const casebar = document.createElement('div');
      casebar.className = 'diagnostic-v2__casebar';
      casebar.setAttribute('aria-hidden', 'true');
      casebar.innerHTML = '<span>Dossier de clarté</span><span>5 indices</span><span>≈ 3 min</span>';
      progress.before(casebar);
    }
  };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => requestAnimationFrame(mountDiagnostic), { once: true });
  } else {
    requestAnimationFrame(mountDiagnostic);
  }
})();
