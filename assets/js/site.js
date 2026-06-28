// Smooth scroll only for anchor clicks (not all scroll)
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = document.querySelector(a.getAttribute('href'));
    if (target) { e.preventDefault(); target.scrollIntoView({behavior:'smooth',block:'start'}); }
  });
});

const reveals = document.querySelectorAll(".reveal");
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          entry.target.style.transitionDelay = `${Math.min(index * 35, 160)}ms`;
          entry.target.classList.add("visible");
        }
      });
    }, { threshold: .13 });
    reveals.forEach(el => io.observe(el));

    // Site preview — vitesse uniforme + lightbox
    (function(){
      const PX_PER_SEC = 40;
      const THUMB_H = 240;

      function applySpeed(img, containerH) {
        function calc() {
          const travel = img.naturalHeight - containerH;
          if (travel <= 0) return;
          img.style.setProperty('--travel', `-${travel}px`);
          img.style.animationDuration = `${travel / PX_PER_SEC}s`;
        }
        img.addEventListener('load', calc, {once: true});
        if (img.complete && img.naturalHeight > 0) calc();
      }

      document.querySelectorAll('.site-preview-scroll img').forEach(img => applySpeed(img, THUMB_H));

      const dlg = document.getElementById('siteLightbox');
      if (!dlg) return;
      const lbImg = document.getElementById('lightboxImg');
      const lbLabel = document.getElementById('lightboxLabel');
      const lbClose = document.getElementById('lightboxClose');

      function openLightbox(src, label, alt) {
        lbImg.src = src;
        lbImg.alt = alt || '';
        lbLabel.textContent = label || '';
        dlg.showModal();
        document.body.style.overflow = 'hidden';
        lbClose.focus();
        const vpH = dlg.querySelector('.lightbox-viewport').offsetHeight;
        applySpeed(lbImg, vpH);
      }

      function closeLightbox() {
        dlg.close();
        document.body.style.overflow = '';
        setTimeout(() => { lbImg.src = ''; lbImg.removeAttribute('style'); }, 300);
      }

      document.querySelectorAll('.site-preview-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          openLightbox(btn.dataset.src, btn.dataset.label, btn.querySelector('img')?.alt || '');
        });
      });
      lbClose.addEventListener('click', closeLightbox);
      dlg.addEventListener('click', e => { if (e.target === dlg) closeLightbox(); });
      dlg.addEventListener('cancel', e => { e.preventDefault(); closeLightbox(); });
    })();

    // Réalisations carousel
    (function(){
      const track = document.querySelector('.real-carousel');
      const prevBtn = document.querySelector('.real-prev');
      const nextBtn = document.querySelector('.real-next');
      if(!track || !prevBtn || !nextBtn) return;
      function slideWidth(){
        const card = track.querySelector('.real-card');
        if(!card) return 300;
        const gap = parseFloat(getComputedStyle(track).gap) || 20;
        return card.offsetWidth + gap;
      }
      prevBtn.addEventListener('click', () => track.scrollBy({left: -slideWidth(), behavior:'smooth'}));
      nextBtn.addEventListener('click', () => track.scrollBy({left: slideWidth(), behavior:'smooth'}));
      function updateNav(){
        prevBtn.disabled = track.scrollLeft < 8;
        nextBtn.disabled = track.scrollLeft + track.offsetWidth >= track.scrollWidth - 8;
      }
      track.addEventListener('scroll', updateNav, {passive:true});
      window.addEventListener('resize', updateNav);
      updateNav();
    })();


    const quiz = document.getElementById("growthQuiz");
    const steps = quiz ? Array.from(quiz.querySelectorAll(".quiz-step")) : [];
    const nextBtn = document.getElementById("quizNext");
    const backBtn = document.getElementById("quizBack");
    const submitBtn = document.getElementById("quizSubmit");
    const currentLabel = document.getElementById("quizCurrent");
    const quizBar = document.getElementById("quizBar");
    const quizResult = document.getElementById("quizResult");
    const resultCta = document.getElementById("resultCta");
    let currentStep = 0;
    const diagnosticHint = document.getElementById("diagnosticHint");
    const hints = [
      "On commence par le symptôme visible.",
      "On vérifie si l’offre se raconte clairement.",
      "On regarde si vous avez déjà corrigé la surface.",
      "On mesure le niveau de preuve derrière votre intuition.",
      "On prépare la suite, si elle mérite vraiment d’exister."
    ];

    function showQuizStep(index) {
      steps.forEach((step, stepIndex) => step.classList.toggle("active", stepIndex === index));
      if (currentLabel) currentLabel.textContent = String(index + 1);
      if (quizBar) quizBar.style.width = `${((index + 1) / steps.length) * 100}%`;
      if (backBtn) backBtn.disabled = index === 0;
      if (nextBtn) nextBtn.style.display = index === steps.length - 1 ? "none" : "inline-flex";
      if (submitBtn) submitBtn.style.display = index === steps.length - 1 ? "inline-flex" : "none";
      if (diagnosticHint) diagnosticHint.textContent = hints[index] || hints[0];
      if (quizResult) quizResult.classList.remove("active");
      if (resultCta) resultCta.classList.remove("active");
    }

    function validateQuizStep(index) {
      const step = steps[index];
      if (!step) return true;

      step.classList.remove("quiz-error");

      const requiredGroups = Array.from(step.querySelectorAll("[required]"));
      for (const input of requiredGroups) {
        if (input.type === "radio") {
          const checked = step.querySelector(`input[name="${input.name}"]:checked`);
          if (!checked) {
            step.classList.add("quiz-error");
            return false;
          }
        } else if (!input.checkValidity()) {
          input.reportValidity();
          step.classList.add("quiz-error");
          return false;
        }
      }

      return true;
    }

    function buildQuizResult() {
      const data = new FormData(quiz);
      const signal = data.get("signal");
      const offre = data.get("offre");
      const certitude = data.get("certitude");

      let message = "Votre situation mérite probablement un échange rapide avant de décider quoi corriger.";
      let label = "Hypothèse principale";

      if (offre === "long" || offre === "variable" || offre === "confus") {
        label = "Blocage probable : clarté de l’offre";
        message = "Votre problème ressemble moins à un problème d’exécution qu’à un problème de lisibilité : ce que vous vendez, à qui, et pourquoi on devrait vous choisir.";
      }

      if (signal === "conversion") {
        label = "Blocage probable : promesse ou parcours";
        message = "Votre site peut être en cause, mais il peut aussi n’être que le révélateur d’une promesse trop floue ou d’un parcours qui ne rassure pas assez.";
      }

      if (certitude === "urgent") {
        label = "Blocage probable : décision d’investissement";
        message = "Vous n’avez pas seulement besoin d’une idée. Vous avez besoin de savoir où investir sans corriger au hasard.";
      }

      if (quizResult) {
        quizResult.innerHTML = `<strong>${label}</strong><br>${message}<br><br><span class="marker">Prochaine étape : confirmer cette hypothèse avec votre Rapport de Clarté — gratuit, remis en visio.</span>`;
        quizResult.classList.add("active");
      }
      if (resultCta) resultCta.classList.add("active");
    }

    if (quiz && steps.length) {
      showQuizStep(currentStep);

      nextBtn?.addEventListener("click", () => {
        if (!validateQuizStep(currentStep)) return;
        currentStep = Math.min(currentStep + 1, steps.length - 1);
        showQuizStep(currentStep);
      });

      backBtn?.addEventListener("click", () => {
        currentStep = Math.max(currentStep - 1, 0);
        showQuizStep(currentStep);
      });


      quiz.addEventListener("change", (event) => {
        const input = event.target;
        if (!input.matches("input[type='radio'], input[type='checkbox']")) return;

        const step = input.closest(".quiz-step");
        if (!step) return;

        if (input.type === "radio") {
          step.querySelectorAll(`input[name="${input.name}"]`).forEach(other => {
            other.closest("label")?.classList.toggle("is-picked", other.checked);
          });
        } else {
          input.closest("label")?.classList.toggle("is-picked", input.checked);
        }
      });

      quiz.addEventListener("submit", (event) => {
        event.preventDefault();
        if (!validateQuizStep(currentStep)) return;
        buildQuizResult();
        quiz.scrollIntoView({ behavior: "smooth", block: "center" });

        const data = new FormData(quiz);
        const resultatEl = document.getElementById("quizResult");
        const resultatTexte = resultatEl ? resultatEl.textContent.trim() : "";

        const payload = {
          prenom:    data.get("prenom"),
          email:     data.get("email"),
          url:       data.get("url") || "",
          signal:    data.get("signal"),
          offre:     data.get("offre"),
          actions:   data.getAll("actions"),
          certitude: data.get("certitude"),
          resultat:  resultatTexte,
        };

        if (submitBtn) { submitBtn.disabled = true; submitBtn.textContent = "Envoi…"; }

        fetch("/mail.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(payload),
        })
          .then(r => r.json())
          .then(res => {
            if (submitBtn) {
              submitBtn.textContent = res.ok ? "✓ Rapport envoyé !" : "Erreur — réessayez";
              submitBtn.disabled = !res.ok;
            }
          })
          .catch(() => {
            if (submitBtn) { submitBtn.textContent = "Erreur réseau"; submitBtn.disabled = false; }
          });
      });
    }

    const board = document.getElementById("caseBoard");
    if (board) {
      window.addEventListener("pointermove", (e) => {
        if (window.innerWidth < 1040) return;
        const x = (e.clientX / window.innerWidth - .5) * 4.4;
        const y = (e.clientY / window.innerHeight - .5) * -3.6;
        board.style.transform = `rotateX(${1.5 + y}deg) rotateY(${-2.4 + x}deg)`;
      }, { passive:true });
    }
