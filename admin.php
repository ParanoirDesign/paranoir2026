<?php
declare(strict_types=1);
session_start();
require __DIR__ . '/config.php';
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin V2 — Victoria Dury</title>
<style>
:root{--ink:#191210;--muted:#6c5b55;--paper:#f7f1e8;--carmine:#b11235;--green:#187a4d;--red:#b11235;--line:rgba(25,18,16,.14)}
*{box-sizing:border-box}
body{margin:0;font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:linear-gradient(135deg,#f7f1e8,#eadccd);color:var(--ink)}
.wrap{width:min(1240px,calc(100% - 40px));margin:32px auto}
.top{display:flex;justify-content:space-between;align-items:center;gap:20px;margin-bottom:22px}
h1{font-size:clamp(34px,5vw,64px);letter-spacing:-.06em;line-height:.95;margin:0}
.card{background:rgba(255,255,255,.66);border:1px solid rgba(255,255,255,.82);border-radius:28px;padding:22px;box-shadow:0 24px 80px rgba(25,18,16,.10)}
.login{max-width:440px;margin:12vh auto}
label{display:block;margin:14px 0 7px;color:var(--muted);font-size:12px;text-transform:uppercase;letter-spacing:.12em;font-weight:800}
input,textarea{width:100%;border:1px solid var(--line);border-radius:14px;padding:12px 13px;font:inherit;background:rgba(255,255,255,.78)}
textarea{min-height:100px;resize:vertical}
.editable-html{width:100%;min-height:100px;border:1px solid var(--line);border-radius:14px;padding:12px 13px;font:inherit;background:rgba(255,255,255,.78);line-height:1.55;outline:none;overflow:auto}
.editable-html:focus{border-color:rgba(177,18,53,.45);box-shadow:0 0 0 4px rgba(177,18,53,.10)}
.editable-html:empty:before{content:attr(data-placeholder);color:rgba(25,18,16,.36)}
.bool-row{grid-template-columns:1.2fr repeat(3,86px)!important}
.bool-name{width:100%;border:1px solid var(--line);border-radius:12px;padding:10px 11px;font:inherit;font-size:14px;font-weight:700;background:rgba(255,255,255,.72);color:var(--ink)}
button{border:0;border-radius:999px;padding:12px 17px;background:var(--ink);color:white;font-weight:800;cursor:pointer}
button.red{background:var(--carmine)}button.light{background:rgba(25,18,16,.08);color:var(--ink)}
button[disabled]{opacity:.55;cursor:wait}
.tabs{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:18px}
.tab{background:rgba(255,255,255,.7);color:var(--ink);border:1px solid var(--line)}
.tab.active{background:var(--carmine);color:white;border-color:var(--carmine)}
.section{display:none}.section.active{display:block}
.grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}.full{grid-column:1/-1}
.field-card{padding:14px;border:1px solid var(--line);border-radius:18px;background:rgba(255,255,255,.44)}
.field-card code{display:block;margin-bottom:8px;color:var(--muted);font-size:11px;word-break:break-all}
.cta-card{display:grid;grid-template-columns:1fr 1fr;gap:12px;padding:14px;border:1px solid var(--line);border-radius:18px;background:rgba(255,255,255,.44)}
.cta-card strong{grid-column:1/-1;font-size:13px;color:var(--muted);text-transform:uppercase;letter-spacing:.1em}
.bool-grid{display:grid;gap:10px}
.bool-row{display:grid;grid-template-columns:1fr repeat(3,86px);align-items:center;gap:10px;padding:12px;border:1px solid var(--line);border-radius:18px;background:rgba(255,255,255,.45)}
.bool-row strong{font-size:14px;line-height:1.35}.bool-row label{margin:0;display:flex;align-items:center;justify-content:center}.bool-row input{width:auto;accent-color:var(--carmine)}
.actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:18px}
.toast{position:fixed;right:22px;bottom:22px;z-index:20;max-width:420px;padding:15px 17px;border-radius:18px;color:white;box-shadow:0 18px 60px rgba(25,18,16,.22);display:none}
.toast.show{display:block}.toast.success{background:var(--green)}.toast.error{background:var(--red)}.toast.loading{background:var(--ink)}
.msg{margin-top:12px;color:var(--muted);line-height:1.55}.hidden{display:none!important}
iframe{width:100%;height:68vh;border:1px solid var(--line);border-radius:22px;background:white}
.search{margin-bottom:14px}
.search input{max-width:420px}
@media(max-width:850px){.grid,.cta-card{grid-template-columns:1fr}.bool-row{grid-template-columns:1fr repeat(3,54px)}.top{align-items:flex-start;flex-direction:column}}
</style>
</head>
<body>
<div class="toast" id="toast"></div>
<div class="wrap">
  <div id="login" class="login card hidden">
    <h1>Connexion</h1>
    <label>Utilisateur</label><input id="user" value="victoria" autocomplete="username">
    <label>Mot de passe</label><input id="pass" type="password" autocomplete="current-password">
    <div class="actions"><button class="red" id="loginBtn">Se connecter</button></div>
    <p class="msg">Change les identifiants dans <code>config.php</code>. La sécurité par flemme, curieusement, reste une mauvaise stratégie.</p>
  </div>

  <div id="app" class="hidden">
    <div class="top">
      <h1>Mini CMS V2</h1>
      <div class="actions">
        <button class="light" id="reloadBtn">Recharger</button>
        <button class="red" id="saveBtn">Publier</button>
        <button class="light" id="logoutBtn">Déconnexion</button>
      </div>
    </div>

    <div class="tabs">
      <button class="tab active" data-tab="texts">Textes de la page</button>
      <button class="tab" data-tab="ctas">Boutons + liens</button>
      <button class="tab" data-tab="images">Images</button>
      <button class="tab" data-tab="booleans">Tableau</button>
      <button class="tab" data-tab="json">JSON</button>
      <button class="tab" data-tab="preview">Prévisualisation</button>
    </div>

    <div class="card">
      <div class="section active" data-section="texts">
        <div class="search"><input id="textSearch" placeholder="Rechercher un texte..."></div>
        <div class="grid" id="textFields"></div>
      </div>

      <div class="section" data-section="ctas">
        <div class="grid" id="ctaFields"></div>
      </div>

      <div class="section" data-section="images">
        <div class="grid" id="imageFields"></div>
      </div>

      <div class="section" data-section="booleans">
        <p class="msg">Colonnes : 290 € · 990 € · 4 990 €. Toutes les lignes détectées dans le tableau sont ici.</p>
        <div class="bool-grid" id="boolFields"></div>
      </div>

      <div class="section" data-section="json">
        <label>JSON complet</label>
        <textarea id="jsonBox" style="min-height:460px;font-family:ui-monospace,Menlo,monospace"></textarea>
        <div class="actions"><button class="light" id="applyJsonBtn">Appliquer le JSON</button></div>
      </div>

      <div class="section" data-section="preview">
        <iframe src="/" id="preview"></iframe>
      </div>

      <p class="msg" id="message"></p>
    </div>
  </div>
</div>

<script>
let content = null;
let saving = false;

function toast(type, text){
  const el = document.getElementById("toast");
  el.className = "toast show " + type;
  el.textContent = text;
  if(type !== "loading") setTimeout(() => { el.className = "toast"; }, 4500);
}

function msg(text){ document.getElementById("message").textContent = text || ""; }

async function api(action, payload){
  const options = payload ? {
    method:"POST",
    headers:{"Content-Type":"application/json"},
    body:JSON.stringify(payload)
  } : {};
  const res = await fetch("api.php?action=" + encodeURIComponent(action), options);
  let json = null;
  try { json = await res.json(); }
  catch(e){ json = {ok:false,error:"Réponse serveur illisible"}; }
  return json;
}

function niceLabel(key){
  return key
    .replace(/^h\\d_/, "")
    .replace(/_\\d+$/, "")
    .replace(/_/g, " ")
    .replace(/\\b\\w/g, c => c.toUpperCase());
}


function fieldLabel(row){
  return (content.boolean_labels && content.boolean_labels[row]) ? content.boolean_labels[row] : niceLabel(row);
}

function adminFieldLabel(key){
  const labels = (content && content.field_labels) ? content.field_labels : {};
  if(labels[key]) return labels[key];
  return niceLabel(key);
}

function fieldSnippet(value){
  const tmp = document.createElement("div");
  tmp.innerHTML = value || "";
  return (tmp.textContent || tmp.innerText || "").replace(/\s+/g, " ").trim().slice(0, 120);
}

function createEditableHtml(name, value){
  const el = document.createElement("div");
  el.className = "editable-html";
  el.contentEditable = "true";
  el.dataset[name] = "";
  el.dataset.placeholder = "Modifier le texte...";
  el.innerHTML = value || "";
  return el;
}

function bindEditableDataset(el, attr, key){
  el.setAttribute(attr, key);
  return el;
}

async function check(){
  const status = await api("status");
  document.getElementById("login").classList.toggle("hidden", !!status.logged);
  document.getElementById("app").classList.toggle("hidden", !status.logged);
  if(status.logged) await load();
}

async function load(){
  const res = await api("content");
  if(!res.ok){ toast("error", res.error || "Impossible de charger le contenu"); return; }
  content = res.data || {texts:{},ctas:{},images:{},booleans:{},boolean_labels:{},field_labels:{}};
  render();
  msg("Contenu chargé.");
}

function render(){
  renderTexts();
  renderCtas();
  renderImages();
  renderBooleans();
  document.getElementById("jsonBox").value = JSON.stringify(content, null, 2);
}

function renderTexts(){
  const wrap = document.getElementById("textFields");
  const q = (document.getElementById("textSearch")?.value || "").toLowerCase();
  wrap.innerHTML = "";
  Object.entries(content.texts || {}).forEach(([key,value]) => {
    const readable = adminFieldLabel(key);
    const hay = (key + " " + readable + " " + fieldSnippet(value)).toLowerCase();
    if(q && !hay.includes(q)) return;
    const div = document.createElement("div");
    div.className = "field-card " + (String(value).length > 90 ? "full" : "");
    const code = document.createElement("code");
    code.textContent = adminFieldLabel(key);
    const editor = document.createElement("div");
    editor.className = "editable-html";
    editor.contentEditable = "true";
    editor.dataset.text = key;
    editor.dataset.placeholder = "Modifier le texte...";
    editor.innerHTML = value || "";
    div.appendChild(code);
    const hint = document.createElement("div");
    hint.style.cssText = "font-size:11px;color:rgba(25,18,16,.46);margin:-3px 0 8px;word-break:break-all";
    hint.textContent = key;
    div.appendChild(hint);
    div.appendChild(editor);
    wrap.appendChild(div);
  });
}

function renderCtas(){
  const wrap = document.getElementById("ctaFields");
  wrap.innerHTML = "";
  Object.entries(content.ctas || {}).forEach(([key,value]) => {
    const div = document.createElement("div");
    div.className = "cta-card";
    const title = document.createElement("strong");
    title.textContent = adminFieldLabel(key);
    const labelWrap = document.createElement("div");
    const label = document.createElement("label");
    label.textContent = "Texte du bouton";
    const labelEditor = document.createElement("div");
    labelEditor.className = "editable-html";
    labelEditor.contentEditable = "true";
    labelEditor.dataset.ctaLabel = key;
    labelEditor.dataset.placeholder = "Modifier le bouton...";
    labelEditor.innerHTML = value.label || "";
    labelWrap.appendChild(label);
    labelWrap.appendChild(labelEditor);
    const urlWrap = document.createElement("div");
    urlWrap.innerHTML = `<label>URL du bouton</label><input data-cta-url="${key}" />`;
    div.appendChild(title);
    div.appendChild(labelWrap);
    div.appendChild(urlWrap);
    div.querySelector(`[data-cta-url="${CSS.escape(key)}"]`).value = value.url || "";
    wrap.appendChild(div);
  });
}

function renderImages(){
  const wrap = document.getElementById("imageFields");
  wrap.innerHTML = "";
  const images = content.images || {};
  if(Object.keys(images).length === 0) images.aboutImage = "";
  Object.entries(images).forEach(([key,value]) => {
    const div = document.createElement("div");
    div.className = "field-card full";
    div.innerHTML = `<code>${adminFieldLabel(key)}</code><div style="font-size:11px;color:rgba(25,18,16,.46);margin:-3px 0 8px;word-break:break-all">${key}</div><label>URL image</label><input data-image="${key}" placeholder="https://..." />`;
    div.querySelector("input").value = value || "";
    wrap.appendChild(div);
  });
}

function renderBooleans(){
  const wrap = document.getElementById("boolFields");
  wrap.innerHTML = "";
  const groups = {};
  Object.entries(content.booleans || {}).forEach(([key,value]) => {
    const parts = key.split("_");
    const col = parts.pop();
    const row = parts.join("_");
    if(!groups[row]) groups[row] = {};
    groups[row][col] = !!value;
  });

  Object.entries(groups).forEach(([row, cols]) => {
    const div = document.createElement("div");
    div.className = "bool-row";
    div.innerHTML = `
      <input class="bool-name" data-bool-label="${row}" value="${fieldLabel(row).replace(/&/g, "&amp;").replace(/"/g, "&quot;")}" aria-label="Nom de la ligne ${fieldLabel(row).replace(/&/g, "&amp;").replace(/"/g, "&quot;")}">
      <label title="290 €"><input type="checkbox" data-bool="${row}_0"></label>
      <label title="990 €"><input type="checkbox" data-bool="${row}_1"></label>
      <label title="4 990 €"><input type="checkbox" data-bool="${row}_2"></label>
    `;
    wrap.appendChild(div);
    [0,1,2].forEach(i => {
      const input = div.querySelector(`[data-bool="${row}_${i}"]`);
      input.checked = !!cols[i];
    });
  });
}

function collect(){
  content.texts = content.texts || {};
  document.querySelectorAll("[data-text]").forEach(input => {
    content.texts[input.dataset.text] = input.innerHTML.trim();
  });

  content.ctas = content.ctas || {};
  document.querySelectorAll("[data-cta-label]").forEach(input => {
    const key = input.dataset.ctaLabel;
    content.ctas[key] = content.ctas[key] || {};
    content.ctas[key].label = input.innerHTML.trim();
  });
  document.querySelectorAll("[data-cta-url]").forEach(input => {
    const key = input.dataset.ctaUrl;
    content.ctas[key] = content.ctas[key] || {};
    content.ctas[key].url = input.value;
  });

  content.images = content.images || {};
  document.querySelectorAll("[data-image]").forEach(input => {
    content.images[input.dataset.image] = input.value;
  });

  content.boolean_labels = content.boolean_labels || {};
  document.querySelectorAll("[data-bool-label]").forEach(input => {
    content.boolean_labels[input.dataset.boolLabel] = input.value.trim() || niceLabel(input.dataset.boolLabel);
  });

  content.booleans = content.booleans || {};
  document.querySelectorAll("[data-bool]").forEach(input => {
    content.booleans[input.dataset.bool] = input.checked;
  });

  document.getElementById("jsonBox").value = JSON.stringify(content, null, 2);
  return content;
}

document.getElementById("loginBtn").addEventListener("click", async () => {
  toast("loading", "Connexion...");
  const res = await api("login", {
    user:document.getElementById("user").value,
    pass:document.getElementById("pass").value
  });
  if(res.ok){ toast("success", "Connexion réussie"); check(); }
  else toast("error", res.error || "Connexion impossible");
});

document.getElementById("saveBtn").addEventListener("click", async () => {
  if(saving) return;
  saving = true;
  const btn = document.getElementById("saveBtn");
  btn.disabled = true;
  btn.textContent = "Publication...";
  toast("loading", "Publication en cours...");
  const res = await api("save", collect());
  saving = false;
  btn.disabled = false;
  btn.textContent = "Publier";
  if(res.ok){
    toast("success", "✓ " + (res.message || "Modifications publiées") + (res.saved_at ? " · " + res.saved_at : ""));
    msg("Dernière sauvegarde : " + (res.saved_at || new Date().toLocaleTimeString()));
    document.getElementById("preview")?.contentWindow?.location.reload();
  } else {
    toast("error", "✕ " + (res.error || "Impossible de publier"));
    msg(res.error || "Erreur inconnue");
  }
});

document.getElementById("reloadBtn").addEventListener("click", load);

document.getElementById("logoutBtn").addEventListener("click", async () => {
  await api("logout");
  toast("success", "Déconnecté");
  check();
});

document.getElementById("applyJsonBtn").addEventListener("click", () => {
  try{
    content = JSON.parse(document.getElementById("jsonBox").value);
    content.field_labels = content.field_labels || {};
    render();
    toast("success", "JSON appliqué. Clique sur Publier pour sauvegarder.");
  }catch(e){
    toast("error", "JSON invalide");
  }
});

document.getElementById("textSearch").addEventListener("input", renderTexts);

document.querySelectorAll(".tab").forEach(tab => {
  tab.addEventListener("click", () => {
    collect();
    document.querySelectorAll(".tab").forEach(t => t.classList.remove("active"));
    document.querySelectorAll(".section").forEach(s => s.classList.remove("active"));
    tab.classList.add("active");
    document.querySelector(`[data-section="${tab.dataset.tab}"]`).classList.add("active");
    if(tab.dataset.tab === "json") document.getElementById("jsonBox").value = JSON.stringify(content, null, 2);
  });
});

check();
</script>
</body>
</html>
