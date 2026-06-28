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

(function(){
      async function loadCmsFromDatabase(){
        try{
          const response = await fetch("api.php?action=content", {cache:"no-store"});
          if(!response.ok) return;
          const payload = await response.json();
          if(!payload || !payload.ok || !payload.data) return;
          applyCmsContent(payload.data);
        }catch(error){
          console.warn("CMS: chargement BDD impossible", error);
        }
      }

      function setHtml(selector, html){
        document.querySelectorAll(selector).forEach(el => { el.innerHTML = html || ""; });
      }

      function applyCmsContent(data){
        Object.entries(data.texts || {}).forEach(([key, value]) => {
          setHtml(`[data-edit="${CSS.escape(key)}"]`, value);
        });

        Object.entries(data.ctas || {}).forEach(([key, value]) => {
          if(value && typeof value.label === "string" && value.label !== "") {
            setHtml(`[data-edit="${CSS.escape(key)}"]`, value.label);
          }
          if(value && typeof value.url === "string") {
            document.querySelectorAll(`[data-link-edit="${CSS.escape(key)}"], [data-edit="${CSS.escape(key)}"]`).forEach(el => {
              if(el.tagName === "A") el.setAttribute("href", value.url || "#");
            });
          }
        });

        Object.entries(data.images || {}).forEach(([key, value]) => {
          document.querySelectorAll(`[data-image-edit="${CSS.escape(key)}"]`).forEach(el => {
            el.dataset.imageUrl = value || "";
            if(value) el.style.backgroundImage = `linear-gradient(130deg,rgba(25,18,16,.12),rgba(177,18,53,.10)), url("${String(value).replace(/"/g, "%22")}")`;
          });
        });

        Object.entries(data.booleans || {}).forEach(([key, value]) => {
          document.querySelectorAll(`[data-bool="${CSS.escape(key)}"]`).forEach(cell => {
            cell.innerHTML = value ? '<span class="check">✓</span>' : '<span class="dash">×</span>';
          });
        });

        Object.entries(data.boolean_labels || {}).forEach(([key, value]) => {
          document.querySelectorAll(`[data-bool^="${CSS.escape(key)}_"]`).forEach(cell => {
            const row = cell.closest("tr");
            const name = row?.querySelector(".tool-name");
            if(name) name.textContent = value || key;
          });
        });
      }

      if(document.readyState === "loading") document.addEventListener("DOMContentLoaded", loadCmsFromDatabase);
      else loadCmsFromDatabase();
    })();

(function(){
      const ADMIN_KEY = "victoria";
      const STORAGE_KEY = "victoriaLandingAdminConfig";
      const params = new URLSearchParams(window.location.search);
      const hash = window.location.hash.replace("#", "").toLowerCase();

      /*
        Le mode admin accepte maintenant 3 entrées :
        - ?admin=1&key=victoria
        - #admin
        - ?admin=1 tout court en local/sandbox
        Ce n'est pas une vraie sécurité, c'est un panneau d'édition statique.
      */
      const isAdmin =
        (params.get("admin") === "1" && (params.get("key") === ADMIN_KEY || window.location.protocol === "file:" || window.location.href.includes("sandbox"))) ||
        hash === "admin" ||
        hash === "edit";

      const editableTexts = Array.from(document.querySelectorAll("[data-edit]"));
      const editableImages = Array.from(document.querySelectorAll("[data-image-edit]"));
      const boolCells = Array.from(document.querySelectorAll("[data-bool]"));
      const checkoutLinks = Array.from(document.querySelectorAll("[data-link-edit='checkoutUrl']"));
      const heroCtaLinks = Array.from(document.querySelectorAll("[data-link-edit='heroCtaLink']"));

      const defaultState = {
        texts:{},
        links:{ checkoutUrl:"#", heroCtaLink:"#prediagnostic" },
        images:{},
        booleans:{},
        boolean_labels:{}
      };

      function getCellValue(cell){ return !!cell.querySelector(".check"); }
      function setCellValue(cell, value){
        cell.innerHTML = value ? '<span class="check">✓</span>' : '<span class="dash">×</span>';
      }

      function readCurrentState(){
        const state = JSON.parse(JSON.stringify(defaultState));
        editableTexts.forEach(el => state.texts[el.dataset.edit] = el.innerHTML.trim());
        checkoutLinks.forEach(el => state.links.checkoutUrl = el.getAttribute("href") || "#");
        if (heroCtaLinks[0]) state.links.heroCtaLink = heroCtaLinks[0].getAttribute("href") || "#prediagnostic";
        editableImages.forEach(el => state.images[el.dataset.imageEdit] = el.dataset.imageUrl || "");
        boolCells.forEach(cell => state.booleans[cell.dataset.bool] = getCellValue(cell));
        document.querySelectorAll("[data-offer-table] tbody tr").forEach(row => {
          const cells = Array.from(row.querySelectorAll("[data-bool]"));
          if (!cells[0]) return;
          const rowKey = cells[0].dataset.bool.replace(/_\d+$/, "");
          state.boolean_labels[rowKey] = row.querySelector(".tool-name")?.textContent?.trim() || rowKey;
        });
        return state;
      }

      function mergeState(base, patch){
        return {
          texts:{...(base.texts || {}), ...((patch && patch.texts) || {})},
          links:{...(base.links || {}), ...((patch && patch.links) || {})},
          images:{...(base.images || {}), ...((patch && patch.images) || {})},
          booleans:{...(base.booleans || {}), ...((patch && patch.booleans) || {})},
          boolean_labels:{...(base.boolean_labels || {}), ...((patch && patch.boolean_labels) || {})}
        };
      }

      function applyState(state){
        if (!state) return;
        Object.entries(state.texts || {}).forEach(([key, value]) => {
          document.querySelectorAll(`[data-edit="${CSS.escape(key)}"]`).forEach(el => el.innerHTML = value);
        });

        const checkoutUrl = state.links?.checkoutUrl || "#";
        checkoutLinks.forEach(el => el.setAttribute("href", checkoutUrl));

        const heroCtaLink = state.links?.heroCtaLink || "#prediagnostic";
        heroCtaLinks.forEach(el => el.setAttribute("href", heroCtaLink));

        Object.entries(state.images || {}).forEach(([key, value]) => {
          document.querySelectorAll(`[data-image-edit="${CSS.escape(key)}"]`).forEach(el => {
            el.dataset.imageUrl = value || "";
            if (value) {
              el.style.backgroundImage = `linear-gradient(130deg,rgba(25,18,16,.12),rgba(177,18,53,.10)), url("${value}")`;
            }
          });
        });

        Object.entries(state.booleans || {}).forEach(([key, value]) => {
          document.querySelectorAll(`[data-bool="${CSS.escape(key)}"]`).forEach(cell => setCellValue(cell, !!value));
        });

        Object.entries(state.boolean_labels || {}).forEach(([key, value]) => {
          document.querySelectorAll(`[data-bool^="${CSS.escape(key)}_"]`).forEach(cell => {
            const row = cell.closest("tr");
            const name = row?.querySelector(".tool-name");
            if (name) name.textContent = value;
          });
        });
      }

      function encodeState(state){
        const json = JSON.stringify(state);
        return btoa(unescape(encodeURIComponent(json))).replace(/\+/g, "-").replace(/\//g, "_").replace(/=+$/,"");
      }

      function decodeState(value){
        try{
          let base64 = value.replace(/-/g, "+").replace(/_/g, "/");
          while(base64.length % 4) base64 += "=";
          const json = decodeURIComponent(escape(atob(base64)));
          return JSON.parse(json);
        }catch(error){
          console.warn("Config data invalide", error);
          return null;
        }
      }

      const baseState = readCurrentState();

      // Le front public est maintenant alimenté par api.php?action=content, donc par la BDD.
      // L'ancien stockage local ne s'applique plus aux visiteurs, sinon deux systèmes se battent. Passionnant, mais inutile.
      if (!isAdmin) return;

      const saved = localStorage.getItem(STORAGE_KEY);
      if (saved) {
        try { applyState(mergeState(baseState, JSON.parse(saved))); }
        catch(error){ console.warn("Sauvegarde locale invalide", error); }
      }

      const urlData = params.get("data");
      if (urlData) {
        const decoded = decodeState(urlData);
        if (decoded) applyState(mergeState(baseState, decoded));
      }
      document.body.classList.add("admin-mode");

      const panel = document.getElementById("adminPanel");
      if (panel) panel.classList.remove("collapsed");
      const toggle = document.getElementById("adminToggle");
      const close = document.getElementById("adminClose");
      const output = document.getElementById("adminOutput");
      const textFields = document.getElementById("adminTextFields");
      const imageFields = document.getElementById("adminImageFields");
      const boolFields = document.getElementById("adminBoolFields");
      const checkoutInput = document.getElementById("adminCheckout");
      const heroCtaInput = document.getElementById("adminHeroCtaLink");

      function currentState(){ return readCurrentState(); }
      function updateOutput(value){ if (output) output.value = value; }

      function buildTextControls(){
        textFields.innerHTML = "";
        editableTexts.forEach(el => {
          const key = el.dataset.edit;
          const wrap = document.createElement("div");
          wrap.className = "admin-field";
          const label = document.createElement("label");
          label.textContent = key;
          const input = document.createElement("div");
          input.className = "admin-editable-html";
          input.contentEditable = "true";
          input.dataset.adminText = key;
          input.innerHTML = el.innerHTML.trim();
          input.addEventListener("input", () => {
            document.querySelectorAll(`[data-edit="${CSS.escape(key)}"]`).forEach(target => target.innerHTML = input.innerHTML.trim());
          });
          wrap.appendChild(label);
          wrap.appendChild(input);
          textFields.appendChild(wrap);
        });
      }

      function buildImageControls(){
        imageFields.innerHTML = "";
        editableImages.forEach(el => {
          const key = el.dataset.imageEdit;
          const wrap = document.createElement("div");
          wrap.className = "admin-field";
          wrap.innerHTML = `<label>${key} URL image</label><input type="url" data-admin-image="${key}" placeholder="https://..." />`;
          const input = wrap.querySelector("input");
          input.value = el.dataset.imageUrl || "";
          input.addEventListener("input", () => {
            const value = input.value.trim();
            document.querySelectorAll(`[data-image-edit="${CSS.escape(key)}"]`).forEach(target => {
              target.dataset.imageUrl = value;
              if (value) {
                target.style.backgroundImage = `linear-gradient(130deg,rgba(25,18,16,.12),rgba(177,18,53,.10)), url("${value}")`;
              }
            });
          });
          imageFields.appendChild(wrap);
        });
      }

      function buildBoolControls(){
        boolFields.innerHTML = "";
        const rows = Array.from(document.querySelectorAll("[data-offer-table] tbody tr"));
        rows.forEach(row => {
          const name = row.querySelector(".tool-name")?.textContent?.trim() || "Ligne";
          const cells = Array.from(row.querySelectorAll("[data-bool]"));
          const wrap = document.createElement("div");
          wrap.className = "admin-bool-row";

          const firstKey = cells[0]?.dataset.bool?.replace(/_\d+$/, "") || name;
          const title = document.createElement("input");
          title.className = "admin-bool-name";
          title.value = name;
          title.setAttribute("aria-label", "Nom de la ligne du tableau");
          title.addEventListener("input", () => {
            row.querySelector(".tool-name").textContent = title.value;
          });
          wrap.appendChild(title);

          cells.forEach(cell => {
            const label = document.createElement("label");
            const input = document.createElement("input");
            input.type = "checkbox";
            input.checked = getCellValue(cell);
            input.title = cell.dataset.bool;
            input.addEventListener("change", () => setCellValue(cell, input.checked));
            label.appendChild(input);
            wrap.appendChild(label);
          });

          boolFields.appendChild(wrap);
        });
      }

      function syncLinkInputs(){
        const state = currentState();
        if (checkoutInput) checkoutInput.value = state.links.checkoutUrl || "#";
        if (heroCtaInput) heroCtaInput.value = state.links.heroCtaLink || "#prediagnostic";
      }

      checkoutInput?.addEventListener("input", () => {
        checkoutLinks.forEach(el => el.setAttribute("href", checkoutInput.value || "#"));
      });

      heroCtaInput?.addEventListener("input", () => {
        heroCtaLinks.forEach(el => el.setAttribute("href", heroCtaInput.value || "#prediagnostic"));
      });

      document.querySelectorAll("[data-admin-tab]").forEach(tab => {
        tab.addEventListener("click", () => {
          document.querySelectorAll("[data-admin-tab]").forEach(t => t.classList.remove("active"));
          document.querySelectorAll("[data-admin-section]").forEach(s => s.classList.remove("active"));
          tab.classList.add("active");
          document.querySelector(`[data-admin-section="${tab.dataset.adminTab}"]`)?.classList.add("active");
        });
      });

      toggle?.addEventListener("click", () => panel.classList.toggle("collapsed"));
      close?.addEventListener("click", () => panel.classList.add("collapsed"));

      document.getElementById("adminSave")?.addEventListener("click", () => {
        const state = currentState();
        localStorage.setItem(STORAGE_KEY, JSON.stringify(state));
        updateOutput("Sauvegardé localement dans ce navigateur.");
      });

      document.getElementById("adminReset")?.addEventListener("click", () => {
        localStorage.removeItem(STORAGE_KEY);
        applyState(baseState);
        buildTextControls();
        buildImageControls();
        buildBoolControls();
        syncLinkInputs();
        updateOutput("Réinitialisé.");
      });

      document.getElementById("adminCopyJson")?.addEventListener("click", async () => {
        const json = JSON.stringify(currentState(), null, 2);
        updateOutput(json);
        try { await navigator.clipboard.writeText(json); } catch(error){}
      });

      document.getElementById("adminCopyUrl")?.addEventListener("click", async () => {
        const url = new URL(window.location.href);
        url.search = "";
        url.searchParams.set("data", encodeState(currentState()));
        const value = url.toString();
        updateOutput(value);
        try { await navigator.clipboard.writeText(value); } catch(error){}
      });

      document.getElementById("adminApplyImport")?.addEventListener("click", () => {
        const raw = document.getElementById("adminImport")?.value || "";
        try{
          const imported = JSON.parse(raw);
          applyState(mergeState(currentState(), imported));
          buildTextControls();
          buildImageControls();
          buildBoolControls();
          syncLinkInputs();
          updateOutput("Import appliqué.");
        }catch(error){
          updateOutput("JSON invalide. Naturellement, la machine refuse de deviner.");
        }
      });

      editableTexts.forEach(el => {
        el.addEventListener("click", () => {
          panel.classList.remove("collapsed");
          document.querySelector('[data-admin-tab="texts"]')?.click();
          document.querySelector(`[data-admin-text="${CSS.escape(el.dataset.edit)}"]`)?.focus();
        });
      });

      editableImages.forEach(el => {
        el.addEventListener("click", () => {
          panel.classList.remove("collapsed");
          document.querySelector('[data-admin-tab="images"]')?.click();
        });
      });

      boolCells.forEach(cell => {
        cell.addEventListener("click", () => {
          setCellValue(cell, !getCellValue(cell));
          buildBoolControls();
        });
      });

      buildTextControls();
      buildImageControls();
      buildBoolControls();
      syncLinkInputs();
    })();

(function(){
    const API_URL = "api.php";
    let cmsData = null;
    let buttons = [];
    let currentTarget = null;
    let panel = null;
    let toastEl = null;

    function ready(fn){
      if(document.readyState === "loading") document.addEventListener("DOMContentLoaded", fn);
      else fn();
    }

    async function cmsApi(action, payload){
      const options = payload ? {
        method:"POST",
        headers:{"Content-Type":"application/json"},
        body:JSON.stringify(payload)
      } : {cache:"no-store"};
      const response = await fetch(API_URL + "?action=" + encodeURIComponent(action), options);
      let data = null;
      try{ data = await response.json(); }
      catch(error){ data = {ok:false,error:"Réponse serveur illisible"}; }
      return data;
    }

    function niceLabel(key){
      return String(key || "")
        .replace(/^h\d_/, "")
        .replace(/_\d+$/, "")
        .replace(/_/g, " ")
        .replace(/\b\w/g, c => c.toUpperCase());
    }

    function fieldLabel(key){
      return (cmsData && cmsData.field_labels && cmsData.field_labels[key]) ? cmsData.field_labels[key] : niceLabel(key);
    }

    function isVisible(el){
      if(!el || !el.isConnected) return false;
      if(el.closest(".admin-panel") || el.closest(".front-edit-panel")) return false;
      const style = window.getComputedStyle(el);
      if(style.display === "none" || style.visibility === "hidden" || style.opacity === "0") return false;
      const rect = el.getBoundingClientRect();
      return rect.width > 0 && rect.height > 0 && rect.bottom > 0 && rect.right > 0 && rect.top < window.innerHeight && rect.left < window.innerWidth;
    }

    function toast(message){
      if(!toastEl) return;
      toastEl.textContent = message;
      toastEl.classList.add("show");
      window.clearTimeout(toastEl._timer);
      toastEl._timer = window.setTimeout(() => toastEl.classList.remove("show"), 3200);
    }

    function getEditType(el){
      if(el.dataset.imageEdit) return "image";
      if(el.dataset.bool) return "boolean";
      if(el.dataset.frontBoolLabel) return "booleanLabel";
      return "text";
    }

    function getEditKey(el){
      if(el.dataset.imageEdit) return el.dataset.imageEdit;
      if(el.dataset.bool) return el.dataset.bool;
      if(el.dataset.frontBoolLabel) return el.dataset.frontBoolLabel;
      return el.dataset.edit || el.dataset.linkEdit || "";
    }

    function makeButtons(){
      buttons.forEach(item => item.button.remove());
      buttons = [];

      document.querySelectorAll("[data-offer-table] tbody tr").forEach(row => {
        const firstBool = row.querySelector("[data-bool]");
        const name = row.querySelector(".tool-name");
        if(firstBool && name && !name.dataset.frontBoolLabel){
          name.dataset.frontBoolLabel = firstBool.dataset.bool.replace(/_\d+$/, "");
        }
      });

      const selector = "[data-edit], [data-link-edit], [data-image-edit], [data-bool], .tool-name[data-front-bool-label]";
      const seen = new Set();
      document.querySelectorAll(selector).forEach(target => {
        if(target.closest(".admin-panel") || target.closest(".front-edit-panel")) return;
        const key = getEditType(target) + ":" + getEditKey(target) + ":" + Array.prototype.indexOf.call(document.querySelectorAll(selector), target);
        if(seen.has(key)) return;
        seen.add(key);
        const button = document.createElement("button");
        button.type = "button";
        button.className = "front-edit-badge";
        button.setAttribute("aria-label", "Modifier ce bloc");
        button.innerHTML = '<span aria-hidden="true">✎</span>';
        button.addEventListener("click", event => {
          event.preventDefault();
          event.stopPropagation();
          openPanel(target);
        });
        document.body.appendChild(button);
        buttons.push({target, button});
      });
      positionButtons();
    }

    function positionButtons(){
      buttons.forEach(({target, button}) => {
        if(!isVisible(target)){
          button.style.visibility = "hidden";
          return;
        }
        button.style.visibility = "";
        const rect = target.getBoundingClientRect();
        button.style.left = Math.max(8, rect.left + window.scrollX) + "px";
        button.style.top = Math.max(8, rect.top + window.scrollY) + "px";
      });
    }

    function ensurePanel(){
      if(panel) return panel;
      toastEl = document.createElement("div");
      toastEl.className = "front-edit-toast";
      document.body.appendChild(toastEl);

      panel = document.createElement("aside");
      panel.className = "front-edit-panel";
      panel.innerHTML = `
        <div class="front-edit-head">
          <div class="front-edit-title">
            <strong id="frontEditTitle">Modifier</strong>
            <code id="frontEditKey"></code>
          </div>
          <button type="button" class="front-edit-close" id="frontEditClose">×</button>
        </div>
        <div id="frontEditBody"></div>
        <div class="front-edit-actions">
          <button type="button" class="front-edit-btn primary" id="frontEditSave">Publier</button>
          <button type="button" class="front-edit-btn light" id="frontEditCancel">Fermer</button>
        </div>
        <p class="front-edit-msg" id="frontEditMsg">Les modifications sont enregistrées en BDD via api.php. Donc oui, le bouton fait vraiment quelque chose, miracle administratif.</p>
      `;
      document.body.appendChild(panel);
      panel.querySelector("#frontEditClose").addEventListener("click", closePanel);
      panel.querySelector("#frontEditCancel").addEventListener("click", closePanel);
      panel.querySelector("#frontEditSave").addEventListener("click", saveCurrentEdit);
      return panel;
    }

    function closePanel(){
      if(panel) panel.classList.remove("open");
      currentTarget = null;
    }

    function openPanel(target){
      ensurePanel();
      currentTarget = target;
      const type = getEditType(target);
      const key = getEditKey(target);
      const title = panel.querySelector("#frontEditTitle");
      const keyEl = panel.querySelector("#frontEditKey");
      const body = panel.querySelector("#frontEditBody");
      const msg = panel.querySelector("#frontEditMsg");
      title.textContent = fieldLabel(key);
      keyEl.textContent = key;
      msg.textContent = "Modifiez puis publiez. La BDD sera mise à jour, pas un souvenir flou dans le navigateur.";
      body.innerHTML = "";

      if(type === "text"){
        const textKey = target.dataset.edit || "";
        const linkKey = target.dataset.linkEdit || "";
        const value = textKey && cmsData?.texts?.[textKey] !== undefined ? cmsData.texts[textKey] : target.innerHTML.trim();
        body.insertAdjacentHTML("beforeend", `
          <div class="front-edit-field">
            <label>Texte visible</label>
            <div class="front-edit-html" id="frontEditHtml" contenteditable="true"></div>
          </div>
        `);
        body.querySelector("#frontEditHtml").innerHTML = value || "";

        if(linkKey || target.tagName === "A"){
          const urlKey = linkKey || textKey;
          const currentUrl = cmsData?.ctas?.[urlKey]?.url || target.getAttribute("href") || "#";
          body.insertAdjacentHTML("beforeend", `
            <div class="front-edit-field">
              <label>URL du lien</label>
              <input type="text" id="frontEditUrl" value="">
            </div>
          `);
          body.querySelector("#frontEditUrl").value = currentUrl;
        }
      }

      if(type === "image"){
        const value = cmsData?.images?.[key] || target.dataset.imageUrl || "";
        body.insertAdjacentHTML("beforeend", `
          <div class="front-edit-field">
            <label>URL de l’image</label>
            <input type="url" id="frontEditImage" placeholder="https://...">
          </div>
        `);
        body.querySelector("#frontEditImage").value = value;
      }

      if(type === "boolean"){
        const current = cmsData?.booleans?.[key] !== undefined ? !!cmsData.booleans[key] : !!target.querySelector(".check");
        body.insertAdjacentHTML("beforeend", `
          <div class="front-edit-field">
            <label>Présence dans le tableau</label>
            <label style="display:flex;align-items:center;gap:10px;text-transform:none;letter-spacing:0;font-size:14px;color:var(--ink,#191210)">
              <input type="checkbox" id="frontEditBool" style="width:auto" ${current ? "checked" : ""}> Afficher une coche
            </label>
          </div>
        `);
      }

      if(type === "booleanLabel"){
        const value = cmsData?.boolean_labels?.[key] || target.textContent.trim() || key;
        body.insertAdjacentHTML("beforeend", `
          <div class="front-edit-field">
            <label>Nom de la ligne du tableau</label>
            <input type="text" id="frontEditBoolLabel" value="">
          </div>
        `);
        body.querySelector("#frontEditBoolLabel").value = value;
      }

      panel.classList.add("open");
      setTimeout(() => body.querySelector(".front-edit-html, input")?.focus(), 30);
    }

    function applyTextChange(target, value){
      const textKey = target.dataset.edit || "";
      const linkKey = target.dataset.linkEdit || "";
      if(textKey){
        cmsData.texts = cmsData.texts || {};
        cmsData.texts[textKey] = value;
        document.querySelectorAll(`[data-edit="${CSS.escape(textKey)}"]`).forEach(el => el.innerHTML = value);
      }
      const ctaKey = linkKey || (cmsData.ctas && cmsData.ctas[textKey] ? textKey : "");
      if(ctaKey){
        cmsData.ctas = cmsData.ctas || {};
        cmsData.ctas[ctaKey] = cmsData.ctas[ctaKey] || {label:"",url:"#"};
        cmsData.ctas[ctaKey].label = value;
        document.querySelectorAll(`[data-edit="${CSS.escape(ctaKey)}"]`).forEach(el => el.innerHTML = value);
      }
    }

    function applyUrlChange(target, url){
      const linkKey = target.dataset.linkEdit || target.dataset.edit || "";
      if(!linkKey) return;
      cmsData.ctas = cmsData.ctas || {};
      cmsData.ctas[linkKey] = cmsData.ctas[linkKey] || {label:"",url:"#"};
      cmsData.ctas[linkKey].url = url || "#";
      document.querySelectorAll(`[data-link-edit="${CSS.escape(linkKey)}"], [data-edit="${CSS.escape(linkKey)}"]`).forEach(el => {
        if(el.tagName === "A") el.setAttribute("href", url || "#");
      });
    }

    function applyImageChange(key, value){
      cmsData.images = cmsData.images || {};
      cmsData.images[key] = value || "";
      document.querySelectorAll(`[data-image-edit="${CSS.escape(key)}"]`).forEach(el => {
        el.dataset.imageUrl = value || "";
        if(value) el.style.backgroundImage = `linear-gradient(130deg,rgba(25,18,16,.12),rgba(177,18,53,.10)), url("${String(value).replace(/"/g, "%22")}")`;
        else el.style.backgroundImage = "";
      });
    }

    function applyBooleanChange(key, value){
      cmsData.booleans = cmsData.booleans || {};
      cmsData.booleans[key] = !!value;
      document.querySelectorAll(`[data-bool="${CSS.escape(key)}"]`).forEach(cell => {
        cell.innerHTML = value ? '<span class="check">✓</span>' : '<span class="dash">×</span>';
      });
    }

    function applyBooleanLabelChange(key, value){
      cmsData.boolean_labels = cmsData.boolean_labels || {};
      cmsData.boolean_labels[key] = value || key;
      document.querySelectorAll(`[data-bool^="${CSS.escape(key)}_"]`).forEach(cell => {
        const row = cell.closest("tr");
        const name = row?.querySelector(".tool-name");
        if(name) name.textContent = value || key;
      });
    }

    async function saveCurrentEdit(){
      if(!currentTarget || !cmsData) return;
      const saveButton = panel.querySelector("#frontEditSave");
      saveButton.disabled = true;
      saveButton.textContent = "Publication...";
      try{
        const type = getEditType(currentTarget);
        const key = getEditKey(currentTarget);
        if(type === "text"){
          const html = panel.querySelector("#frontEditHtml")?.innerHTML.trim() || "";
          applyTextChange(currentTarget, html);
          const urlInput = panel.querySelector("#frontEditUrl");
          if(urlInput) applyUrlChange(currentTarget, urlInput.value.trim() || "#");
        }
        if(type === "image") applyImageChange(key, panel.querySelector("#frontEditImage")?.value.trim() || "");
        if(type === "boolean") applyBooleanChange(key, !!panel.querySelector("#frontEditBool")?.checked);
        if(type === "booleanLabel") applyBooleanLabelChange(key, panel.querySelector("#frontEditBoolLabel")?.value.trim() || key);

        const response = await cmsApi("save", cmsData);
        if(!response.ok) throw new Error(response.error || "Publication impossible");
        cmsData = response.data || cmsData;
        toast("Modification publiée.");
        closePanel();
        setTimeout(positionButtons, 60);
      }catch(error){
        toast(error.message || "Erreur pendant la publication.");
      }finally{
        saveButton.disabled = false;
        saveButton.textContent = "Publier";
      }
    }

    async function init(){
      let status = {logged:false};
      try{ status = await cmsApi("status"); }catch(error){}
      const urlParams = new URLSearchParams(window.location.search);
      const forcedLocal = urlParams.get("admin") === "1" || ["#admin", "#edit"].includes(window.location.hash.toLowerCase());
      if(!status.logged && !forcedLocal) return;

      try{
        const content = await cmsApi("content");
        cmsData = content.ok && content.data ? content.data : {texts:{},ctas:{},images:{},booleans:{},boolean_labels:{},field_labels:{}};
      }catch(error){
        cmsData = {texts:{},ctas:{},images:{},booleans:{},boolean_labels:{},field_labels:{}};
      }

      document.body.classList.add("front-edit-mode");
      ensurePanel();
      makeButtons();
      window.addEventListener("scroll", positionButtons, {passive:true});
      window.addEventListener("resize", positionButtons);
      window.setInterval(positionButtons, 1200);

      const fab = document.createElement("button");
      fab.type = "button";
      fab.className = "front-edit-fab";
      fab.innerHTML = '<span aria-hidden="true">✎</span> Éditer';
      fab.addEventListener("click", () => {
        const on = document.body.classList.toggle("pencils-on");
        fab.innerHTML = on ? '<span aria-hidden="true">✎</span> Terminer' : '<span aria-hidden="true">✎</span> Éditer';
        positionButtons();
      });
      document.body.appendChild(fab);
    }

    ready(init);
  })();
