<?php
declare(strict_types=1);
session_start();
require __DIR__ . '/config.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$isLoggedIn      = !empty($_SESSION['cms_user']);
$currentUser     = $_SESSION['cms_user'] ?? [];
$isAdmin         = ($currentUser['role'] ?? '') === 'admin';
$csrfToken       = $_SESSION['csrf_token'];
$currentUsername = htmlspecialchars($currentUser['username'] ?? '', ENT_QUOTES, 'UTF-8');
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>CMS — Victoria Dury</title>
<link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
<div class="toast" id="toast"></div>
<div class="wrap">
  <div id="login" class="login card<?= $isLoggedIn ? ' hidden' : '' ?>">
    <h1>Connexion</h1>
    <label>Identifiant</label><input id="user" autocomplete="username">
    <label>Mot de passe</label><input id="pass" type="password" autocomplete="current-password">
    <div class="actions"><button class="red" id="loginBtn">Se connecter</button></div>
  </div>

  <div id="app" class="<?= $isLoggedIn ? '' : 'hidden' ?>">
    <div class="top">
      <h1>Mini CMS</h1>
      <div class="actions">
        <span id="userBadge" style="font-size:12px;color:var(--muted);align-self:center"></span>
        <button class="light" id="reloadBtn">Recharger</button>
        <button class="red" id="saveBtn">Publier</button>
        <button class="light" id="logoutBtn">Deconnexion</button>
      </div>
    </div>

    <div class="tabs">
      <button class="tab active" data-tab="pages">Pages</button>
      <?php if ($isAdmin): ?>
      <button class="tab" data-tab="settings">Nav + footer</button>
      <button class="tab" data-tab="users">Utilisateurs</button>
      <?php endif; ?>
      <button class="tab" data-tab="account">Mon compte</button>
      <button class="tab" data-tab="json">JSON</button>
      <button class="tab" data-tab="preview">Previsualisation</button>
    </div>

    <div class="card">
      <div class="section active" data-section="pages">
        <div class="pages-list">
          <div>
            <?php if ($isAdmin): ?>
            <div class="actions" style="margin-top:0;margin-bottom:12px"><button class="red" id="addPageBtn" type="button">+ Nouvelle page</button></div>
            <?php endif; ?>
            <div class="page-buttons" id="pageButtons"></div>
          </div>
          <div class="page-editor" id="pageEditor"></div>
        </div>
      </div>

      <?php if ($isAdmin): ?>
      <div class="section" data-section="settings">
        <h2 class="mini-title">Navigation commune</h2>
        <div class="grid">
          <div class="field-card full"><label>Nom du site</label><input id="siteNameInput" placeholder="Paranoir Studio"></div>
        </div>
        <div class="list-editor" id="navItems"></div>
        <div class="actions"><button class="light" id="addNavBtn" type="button">+ Ajouter un lien de nav</button></div>
        <h2 class="mini-title" style="margin-top:28px">Footer commun</h2>
        <div class="field-card full"><label>Baseline footer</label><input id="footerBaselineInput" placeholder="Paranoir Studio — Clarifier avant de construire."></div>
        <div class="list-editor" id="footerItems"></div>
        <div class="actions"><button class="light" id="addFooterBtn" type="button">+ Ajouter un lien footer</button></div>
        <p class="msg">Ces elements sont partages par toutes les pages PHP.</p>
      </div>

      <div class="section" data-section="users">
        <h2 class="mini-title">Acces existants</h2>
        <div id="usersList" class="grid" style="margin-bottom:18px"></div>
        <h2 class="mini-title">Creer un acces</h2>
        <div class="grid">
          <div class="field-card"><label>Identifiant</label><input id="newUsername" placeholder="prenom.client" autocomplete="off"></div>
          <div class="field-card"><label>Mot de passe</label><input id="newPassword" type="password" placeholder="6 caracteres min." autocomplete="new-password"></div>
          <div class="field-card"><label>Role</label><select id="newRole"><option value="client">Client (pages assignees seulement)</option><option value="admin">Admin (acces complet)</option></select></div>
        </div>
        <div class="actions"><button class="red" id="createUserBtn" type="button">Creer l'acces</button></div>
        <p class="msg">Le client ne voit que les pages ou "Accessible au client" est coche. Il ne peut pas modifier la nav, le footer, ni ajouter de pages.</p>
      </div>
      <?php endif; ?>

      <div class="section" data-section="account">
        <h2 class="mini-title">Changer mon mot de passe</h2>
        <div class="grid">
          <div class="field-card"><label>Mot de passe actuel</label><input id="currentPassword" type="password" autocomplete="current-password"></div>
          <div class="field-card"><label>Nouveau mot de passe</label><input id="newPasswordAccount" type="password" autocomplete="new-password" placeholder="6 caracteres min."></div>
          <div class="field-card"><label>Confirmer</label><input id="confirmPassword" type="password" autocomplete="new-password" placeholder="Identique au precedent"></div>
        </div>
        <div class="actions"><button class="red" id="changePasswordBtn" type="button">Changer le mot de passe</button></div>
      </div>

      <div class="section" data-section="json">
        <label>JSON complet</label>
        <textarea id="jsonBox" style="min-height:460px;font-family:ui-monospace,Menlo,monospace"></textarea>
        <div class="actions"><button class="light" id="applyJsonBtn">Appliquer le JSON</button></div>
      </div>

      <div class="section" data-section="preview">
        <iframe src="/" id="preview"></iframe>
      </div>
    </div>
    <p class="msg" id="message"></p>
  </div>
</div>

<script>
const CURRENT_USER = <?= json_encode(['role' => $isAdmin ? 'admin' : 'client', 'username' => $currentUser['username'] ?? '']) ?>;
let CSRF_TOKEN = <?= json_encode($csrfToken) ?>;

let content = null;
let saving = false;
let selectedPageSlug = 'home';

function toast(type, text){
  const el = document.getElementById('toast');
  el.className = 'toast show ' + type;
  el.textContent = text;
  if(type !== 'loading') setTimeout(() => { el.className = 'toast'; }, 4500);
}

function msg(text){ document.getElementById('message').textContent = text || ''; }

async function api(action, payload){
  const options = payload ? {
    method: 'POST',
    headers: {'Content-Type': 'application/json', 'X-Csrf-Token': CSRF_TOKEN},
    body: JSON.stringify(payload)
  } : {};
  const res = await fetch('api.php?action=' + encodeURIComponent(action), options);
  let json = null;
  try { json = await res.json(); }
  catch(e){ json = {ok: false, error: 'Reponse serveur illisible'}; }
  return json;
}

function niceLabel(key){
  return key
    .replace(/^h\d_/, '')
    .replace(/_\d+$/, '')
    .replace(/_/g, ' ')
    .replace(/\b\w/g, c => c.toUpperCase());
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
  const tmp = document.createElement('div');
  tmp.innerHTML = value || '';
  return (tmp.textContent || tmp.innerText || '').replace(/\s+/g, ' ').trim().slice(0, 120);
}

function htmlEscape(value){
  return String(value || '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

function slugify(value){
  return String(value || '')
    .toLowerCase()
    .normalize('NFD').replace(/[̀-ͯ]/g, '')
    .replace(/[^a-z0-9]+/g, '-')
    .replace(/^-+|-+$/g, '') || 'nouvelle-page';
}

async function check(){
  const status = await api('status');
  if(status.csrf) CSRF_TOKEN = status.csrf;
  document.getElementById('login').classList.toggle('hidden', !!status.logged);
  document.getElementById('app').classList.toggle('hidden', !status.logged);
  if(status.logged){
    const badge = document.getElementById('userBadge');
    if(badge) badge.textContent = CURRENT_USER.username + ' · ' + (CURRENT_USER.role === 'admin' ? 'Admin' : 'Client');
    await load();
  }
}

async function load(){
  const res = await api('content');
  if(!res.ok){ toast('error', res.error || 'Impossible de charger le contenu'); return; }
  content = res.data || {texts:{},ctas:{},images:{},booleans:{},boolean_labels:{},field_labels:{},settings:{},pages:{}};
  render();
  msg('Contenu charge.');
}

function render(){
  if(CURRENT_USER.role === 'admin') renderSettings();
  renderPages();
  document.getElementById('jsonBox').value = JSON.stringify(content, null, 2);
}

function renderTexts(){
  const wrap = document.getElementById('textFields');
  if(!wrap) return;
  const q = (document.getElementById('textSearch')?.value || '').toLowerCase();
  wrap.innerHTML = '';
  const EXCLUDE_PREFIXES = ['page_'];
  const EXCLUDE_KEYS = new Set([
    'quiz_site_message_offre_parcours',
    'hero_dossier_ouvert_enquete_strategique',
    'quiz_hypothese_en_cours_on_commence_par_le_symptom',
    'quiz_question_1_5'
  ]);
  const sections = {};
  Object.entries(content.texts || {}).forEach(([key, value]) => {
    if(EXCLUDE_PREFIXES.some(p => key.startsWith(p))) return;
    if(EXCLUDE_KEYS.has(key)) return;
    const full = adminFieldLabel(key);
    const dot = full.indexOf(' · ');
    const section = dot > -1 ? full.slice(0, dot) : 'General';
    const label = dot > -1 ? full.slice(dot + 3) : full;
    const hay = (key + ' ' + full + ' ' + fieldSnippet(value)).toLowerCase();
    if(q && !hay.includes(q)) return;
    if(!sections[section]) sections[section] = [];
    sections[section].push({key, value, label});
  });
  if(Object.keys(sections).length === 0){
    wrap.innerHTML = '<p class="msg" style="grid-column:1/-1">Aucun champ trouve.</p>';
    return;
  }
  Object.entries(sections).forEach(([section, fields]) => {
    const heading = document.createElement('div');
    heading.className = 'full';
    heading.innerHTML = '<p style="font-size:11px;text-transform:uppercase;letter-spacing:.12em;font-weight:800;color:var(--muted);margin:18px 0 8px;padding-bottom:6px;border-bottom:1px solid var(--line)">' + section + '</p>';
    wrap.appendChild(heading);
    fields.forEach(({key, value, label}) => {
      const div = document.createElement('div');
      div.className = 'field-card' + (String(value).length > 90 ? ' full' : '');
      const lbl = document.createElement('code');
      lbl.textContent = label;
      const editor = document.createElement('div');
      editor.className = 'editable-html';
      editor.contentEditable = 'true';
      editor.dataset.text = key;
      editor.dataset.placeholder = 'Modifier le texte...';
      editor.innerHTML = value || '';
      div.appendChild(lbl);
      div.appendChild(editor);
      wrap.appendChild(div);
    });
  });
}

function renderCtas(){
  const wrap = document.getElementById('ctaFields');
  if(!wrap) return;
  wrap.innerHTML = '';
  const HIDE_CTA = new Set(['heroCtaLink']);
  Object.entries(content.ctas || {}).forEach(([key, value]) => {
    if(HIDE_CTA.has(key)) return;
    const full = adminFieldLabel(key);
    const dot = full.indexOf(' · ');
    const label = dot > -1 ? full.slice(dot + 3) : full;
    const div = document.createElement('div');
    div.className = 'cta-card';
    const titleEl = document.createElement('strong');
    titleEl.textContent = label;
    const labelWrap = document.createElement('div');
    const lbl = document.createElement('label');
    lbl.textContent = 'Texte du bouton';
    const labelEditor = document.createElement('div');
    labelEditor.className = 'editable-html';
    labelEditor.contentEditable = 'true';
    labelEditor.dataset.ctaLabel = key;
    labelEditor.dataset.placeholder = 'Modifier le bouton...';
    labelEditor.innerHTML = value.label || '';
    labelWrap.appendChild(lbl);
    labelWrap.appendChild(labelEditor);
    const urlWrap = document.createElement('div');
    urlWrap.innerHTML = '<label>URL</label><input data-cta-url="' + htmlEscape(key) + '" />';
    div.appendChild(titleEl);
    div.appendChild(labelWrap);
    div.appendChild(urlWrap);
    div.querySelector('[data-cta-url="' + CSS.escape(key) + '"]').value = value.url || '';
    wrap.appendChild(div);
  });
}

function renderImages(){
  const wrap = document.getElementById('imageFields');
  if(!wrap) return;
  wrap.innerHTML = '';
  const images = content.images || {};
  Object.entries(images).forEach(([key, value]) => {
    const full = adminFieldLabel(key);
    const dot = full.indexOf(' · ');
    const label = dot > -1 ? full.slice(dot + 3) : full;
    const div = document.createElement('div');
    div.className = 'field-card full';
    div.innerHTML = '<code>' + htmlEscape(label) + '</code><label>URL de l\'image</label><input data-image="' + htmlEscape(key) + '" placeholder="https://..." />';
    div.querySelector('input').value = value || '';
    wrap.appendChild(div);
  });
}

function renderBooleans(){
  const wrap = document.getElementById('boolFields');
  if(!wrap) return;
  wrap.innerHTML = '';
  const groups = {};
  Object.entries(content.booleans || {}).forEach(([key,value]) => {
    const parts = key.split('_');
    const col = parts.pop();
    const row = parts.join('_');
    if(!groups[row]) groups[row] = {};
    groups[row][col] = !!value;
  });
  Object.entries(groups).forEach(([row, cols]) => {
    const div = document.createElement('div');
    div.className = 'bool-row';
    div.innerHTML =
      '<input class="bool-name" data-bool-label="' + htmlEscape(row) + '" value="' + htmlEscape(fieldLabel(row)) + '" aria-label="Nom de la ligne">' +
      '<label title="290 €"><input type="checkbox" data-bool="' + htmlEscape(row) + '_0"></label>' +
      '<label title="990 €"><input type="checkbox" data-bool="' + htmlEscape(row) + '_1"></label>' +
      '<label title="4 990 €"><input type="checkbox" data-bool="' + htmlEscape(row) + '_2"></label>';
    wrap.appendChild(div);
    [0,1,2].forEach(i => {
      const input = div.querySelector('[data-bool="' + row + '_' + i + '"]');
      if(input) input.checked = !!cols[i];
    });
  });
}

function renderSettings(){
  content.settings = content.settings || {};
  content.settings.nav = Array.isArray(content.settings.nav) ? content.settings.nav : [];
  content.settings.footer_links = Array.isArray(content.settings.footer_links) ? content.settings.footer_links : [];
  const sni = document.getElementById('siteNameInput');
  const fbi = document.getElementById('footerBaselineInput');
  if(sni) sni.value = content.settings.site_name || 'Paranoir Studio';
  if(fbi) fbi.value = content.settings.footer_baseline || '';

  const navWrap = document.getElementById('navItems');
  if(navWrap){
    navWrap.innerHTML = '';
    content.settings.nav.forEach((item, index) => {
      const row = document.createElement('div');
      row.className = 'list-row';
      row.innerHTML =
        '<div><label>Libelle</label><input data-nav-label="' + index + '" value="' + htmlEscape(item.label) + '"></div>' +
        '<div><label>URL</label><input data-nav-url="' + index + '" value="' + htmlEscape(item.url) + '"></div>' +
        '<div><label>Type</label><select data-nav-type="' + index + '"><option value="link">Lien</option><option value="cta">CTA</option></select></div>' +
        '<button class="light" type="button" data-remove-nav="' + index + '">Suppr.</button>';
      navWrap.appendChild(row);
      row.querySelector('[data-nav-type="' + index + '"]').value = item.type === 'cta' ? 'cta' : 'link';
    });
  }

  const footerWrap = document.getElementById('footerItems');
  if(footerWrap){
    footerWrap.innerHTML = '';
    content.settings.footer_links.forEach((item, index) => {
      const row = document.createElement('div');
      row.className = 'list-row footer-row';
      row.innerHTML =
        '<div><label>Libelle</label><input data-footer-label="' + index + '" value="' + htmlEscape(item.label) + '"></div>' +
        '<div><label>URL</label><input data-footer-url="' + index + '" value="' + htmlEscape(item.url) + '"></div>' +
        '<button class="light" type="button" data-remove-footer="' + index + '">Suppr.</button>';
      footerWrap.appendChild(row);
    });
  }
}

function renderPages(){
  content.pages = content.pages || {};
  const allSlugs = Object.keys(content.pages);

  // Clients only see client_editable pages
  const slugs = CURRENT_USER.role === 'admin'
    ? allSlugs
    : allSlugs.filter(s => content.pages[s] && content.pages[s].client_editable);

  if(!selectedPageSlug || !content.pages[selectedPageSlug] || !slugs.includes(selectedPageSlug)){
    selectedPageSlug = slugs[0] || null;
  }

  const buttons = document.getElementById('pageButtons');
  const editor  = document.getElementById('pageEditor');
  buttons.innerHTML = '';

  slugs.forEach(slug => {
    const page = content.pages[slug] || {};
    const btn  = document.createElement('button');
    btn.type = 'button';
    btn.className = 'page-button' + (slug === selectedPageSlug ? ' active' : '');
    btn.dataset.selectPage = slug;
    btn.textContent = (page.title || slug) + (page.system ? '' : (page.status === 'published' ? ' · publiee' : ' · brouillon'));
    buttons.appendChild(btn);
  });

  if(!selectedPageSlug){
    editor.innerHTML = CURRENT_USER.role === 'admin'
      ? '<p class="msg">Aucune page. Cliquez sur + Nouvelle page.</p>'
      : '<p class="msg">Aucune page ne vous a ete assignee pour le moment.</p>';
    return;
  }

  const page     = content.pages[selectedPageSlug] || {};
  const isSystem = !!page.system;
  const isHome   = selectedPageSlug === 'home';
  const isAdminUser = CURRENT_USER.role === 'admin';
  const pageUrl  = isHome ? '/' : 'page.php?slug=' + encodeURIComponent(page.slug || selectedPageSlug);

  // Admin-only client_editable toggle (not on system pages)
  const clientToggle = isAdminUser && !isSystem ?
    '<div style="display:flex;align-items:center;gap:10px;padding:12px 14px;border:1px solid var(--line);border-radius:18px;background:rgba(255,255,255,.44)">' +
    '<input type="checkbox" id="pageClientEditable"' + (page.client_editable ? ' checked' : '') + '>' +
    '<label for="pageClientEditable" style="margin:0;cursor:pointer;color:var(--ink);font-size:13px;text-transform:none;letter-spacing:0;font-weight:600">Accessible au client</label>' +
    '</div>'
    : '';

  editor.innerHTML =
    '<div class="page-meta">' +
    '<div><label>Slug URL</label><input id="pageSlug" value="' + htmlEscape(page.slug || selectedPageSlug) + '"' + (isSystem ? ' readonly style="opacity:.55;cursor:default"' : '') + '></div>' +
    '<div><label>Statut</label><select id="pageStatus"' + (isHome ? ' disabled style="opacity:.55"' : '') + '><option value="draft">Brouillon</option><option value="published">Publie</option></select></div>' +
    '</div>' +
    '<div><label>Meta title</label><input id="pageMetaTitle" value="' + htmlEscape(page.meta_title || '') + '"></div>' +
    '<div><label>Meta description</label><textarea id="pageMetaDescription">' + htmlEscape(page.meta_description || '') + '</textarea></div>' +
    (!isHome ?
      '<div><label>Titre H1</label><input id="pageTitle" value="' + htmlEscape(page.title || '') + '"></div>' +
      '<div><label>Surtitre</label><input id="pageKicker" value="' + htmlEscape(page.kicker || '') + '"></div>' +
      '<div><label>Intro</label><textarea id="pageIntro">' + htmlEscape(page.intro || '') + '</textarea></div>' +
      '<div><label>Contenu HTML</label><div id="pageContent" class="editable-html page-content" contenteditable="true" data-placeholder="Contenu de la page...">' + (page.content || '') + '</div><p class="hint">Tu peux utiliser h2, p, strong, ul/li.</p></div>'
    : '') +
    clientToggle +
    '<div class="actions">' +
    (isAdminUser && !isSystem ? '<button class="light" type="button" id="deletePageBtn">Supprimer cette page</button>' : '') +
    '<a class="buttonlike" id="openPageLink" target="_blank" rel="noopener" href="' + htmlEscape(pageUrl) + '">Voir la page</a>' +
    '</div>';

  document.getElementById('pageStatus').value = page.status === 'published' ? 'published' : 'draft';

  if(isHome){
    const homeExtra = document.createElement('div');
    homeExtra.style.cssText = 'display:grid;gap:10px;margin-top:4px';
    homeExtra.innerHTML =
      '<details open>' +
      '<summary style="cursor:pointer;user-select:none;font-size:18px;font-weight:700;letter-spacing:-.03em;margin-bottom:10px">Textes de la page</summary>' +
      '<div class="search" style="margin:10px 0 4px"><input id="textSearch" placeholder="Rechercher un texte..."></div>' +
      '<div class="grid" id="textFields"></div>' +
      '</details>' +
      '<details>' +
      '<summary style="cursor:pointer;user-select:none;font-size:18px;font-weight:700;letter-spacing:-.03em;margin-bottom:10px">Boutons + liens</summary>' +
      '<div class="grid" id="ctaFields" style="margin-top:10px"></div>' +
      '</details>' +
      '<details>' +
      '<summary style="cursor:pointer;user-select:none;font-size:18px;font-weight:700;letter-spacing:-.03em;margin-bottom:10px">Images</summary>' +
      '<div class="grid" id="imageFields" style="margin-top:10px"></div>' +
      '</details>' +
      '<details>' +
      '<summary style="cursor:pointer;user-select:none;font-size:18px;font-weight:700;letter-spacing:-.03em;margin-bottom:10px">Tableau de comparaison</summary>' +
      '<p class="msg" style="margin-top:10px">Colonnes : 290 € · 990 € · 4 990 €.</p>' +
      '<div class="bool-grid" id="boolFields"></div>' +
      '</details>';
    editor.appendChild(homeExtra);
    document.getElementById('textSearch').addEventListener('input', renderTexts);
    renderTexts();
    renderCtas();
    renderImages();
    renderBooleans();
  }
}

async function loadUsers(){
  const res = await api('list_users', {});
  const wrap = document.getElementById('usersList');
  if(!wrap) return;
  if(!res.ok){ wrap.innerHTML = '<p class="msg">' + htmlEscape(res.error) + '</p>'; return; }
  wrap.innerHTML = '';
  if(!res.users.length){ wrap.innerHTML = '<p class="msg">Aucun utilisateur.</p>'; return; }
  res.users.forEach(u => {
    const div = document.createElement('div');
    div.className = 'field-card';
    div.innerHTML =
      '<strong style="font-size:14px">' + htmlEscape(u.username) + '</strong>' +
      '<code style="margin-top:4px;margin-bottom:10px;display:block">' + htmlEscape(u.role) + ' · cree le ' + htmlEscape(String(u.created_at).slice(0,10)) + '</code>' +
      (u.username !== CURRENT_USER.username
        ? '<button class="light" style="border-radius:14px;padding:8px 12px;font-size:12px" data-delete-user="' + htmlEscape(String(u.id)) + '" data-delete-username="' + htmlEscape(u.username) + '">Supprimer</button>'
        : '<em style="font-size:12px;color:var(--muted)">Votre compte</em>');
    wrap.appendChild(div);
  });
}

function collectSettings(){
  if(CURRENT_USER.role !== 'admin') return;
  content.settings = content.settings || {};
  const sni = document.getElementById('siteNameInput');
  const fbi = document.getElementById('footerBaselineInput');
  if(sni) content.settings.site_name = sni.value || 'Paranoir Studio';
  if(fbi) content.settings.footer_baseline = fbi.value || '';
  const nav = [];
  document.querySelectorAll('[data-nav-label]').forEach(input => {
    const i = input.dataset.navLabel;
    const label = input.value.trim();
    const url   = document.querySelector('[data-nav-url="' + CSS.escape(i) + '"]')?.value.trim() || '#';
    const type  = document.querySelector('[data-nav-type="' + CSS.escape(i) + '"]')?.value || 'link';
    if(label) nav.push({label, url, type});
  });
  content.settings.nav = nav;
  const footer = [];
  document.querySelectorAll('[data-footer-label]').forEach(input => {
    const i = input.dataset.footerLabel;
    const label = input.value.trim();
    const url   = document.querySelector('[data-footer-url="' + CSS.escape(i) + '"]')?.value.trim() || '#';
    if(label) footer.push({label, url});
  });
  content.settings.footer_links = footer;
}

function collectCurrentPage(){
  if(!selectedPageSlug || !content.pages || !content.pages[selectedPageSlug]) return;
  const oldPage  = content.pages[selectedPageSlug] || {};
  const isSystem = !!oldPage.system;
  const isHome   = selectedPageSlug === 'home';
  const oldSlug  = selectedPageSlug;
  const slug     = isSystem ? oldSlug : slugify(document.getElementById('pageSlug')?.value || oldSlug);

  const page = {
    slug,
    title:            isSystem ? (oldPage.title || slug) : (document.getElementById('pageTitle')?.value.trim() || 'Nouvelle page'),
    meta_title:       document.getElementById('pageMetaTitle')?.value.trim() || '',
    meta_description: document.getElementById('pageMetaDescription')?.value.trim() || '',
    kicker:           isSystem ? (oldPage.kicker || '') : (document.getElementById('pageKicker')?.value.trim() || ''),
    intro:            isSystem ? (oldPage.intro || '') : (document.getElementById('pageIntro')?.value.trim() || ''),
    content:          isSystem ? (oldPage.content || '') : (document.getElementById('pageContent')?.innerHTML.trim() || ''),
    status:           isSystem ? 'published' : (document.getElementById('pageStatus')?.value === 'published' ? 'published' : 'draft'),
    ...(oldPage.template ? {template: oldPage.template} : {}),
    ...(isSystem ? {system: true} : {}),
    // Preserve client_editable: admin can change via checkbox, client preserves existing value
    client_editable: CURRENT_USER.role === 'admin'
      ? (isSystem ? false : !!(document.getElementById('pageClientEditable')?.checked))
      : !!(oldPage.client_editable),
  };

  if(!isSystem && slug !== oldSlug) delete content.pages[oldSlug];
  content.pages[slug] = page;
  selectedPageSlug = slug;
}

function collect(){
  collectSettings();
  collectCurrentPage();

  if(document.querySelectorAll('[data-text]').length > 0){
    content.texts = content.texts || {};
    document.querySelectorAll('[data-text]').forEach(input => {
      content.texts[input.dataset.text] = input.innerHTML.trim();
    });
  }
  if(document.querySelectorAll('[data-cta-label]').length > 0){
    content.ctas = content.ctas || {};
    document.querySelectorAll('[data-cta-label]').forEach(input => {
      const key = input.dataset.ctaLabel;
      content.ctas[key] = content.ctas[key] || {};
      content.ctas[key].label = input.innerHTML.trim();
    });
    document.querySelectorAll('[data-cta-url]').forEach(input => {
      const key = input.dataset.ctaUrl;
      content.ctas[key] = content.ctas[key] || {};
      content.ctas[key].url = input.value;
    });
  }
  if(document.querySelectorAll('[data-image]').length > 0){
    content.images = content.images || {};
    document.querySelectorAll('[data-image]').forEach(input => {
      content.images[input.dataset.image] = input.value;
    });
  }
  if(document.querySelectorAll('[data-bool-label]').length > 0){
    content.boolean_labels = content.boolean_labels || {};
    document.querySelectorAll('[data-bool-label]').forEach(input => {
      content.boolean_labels[input.dataset.boolLabel] = input.value.trim() || niceLabel(input.dataset.boolLabel);
    });
    content.booleans = content.booleans || {};
    document.querySelectorAll('[data-bool]').forEach(input => {
      content.booleans[input.dataset.bool] = input.checked;
    });
  }

  document.getElementById('jsonBox').value = JSON.stringify(content, null, 2);
  return content;
}

/* --- Event listeners ----------------------------------------------- */

document.getElementById('loginBtn').addEventListener('click', async () => {
  toast('loading', 'Connexion...');
  const res = await fetch('api.php?action=login', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({user: document.getElementById('user').value, pass: document.getElementById('pass').value})
  }).then(r => r.json()).catch(() => ({ok: false, error: 'Erreur reseau'}));
  if(res.ok){
    if(res.csrf) CSRF_TOKEN = res.csrf;
    toast('success', 'Connexion reussie');
    location.reload();
  } else {
    toast('error', res.error || 'Connexion impossible');
  }
});

document.getElementById('saveBtn').addEventListener('click', async () => {
  if(saving) return;
  saving = true;
  const btn = document.getElementById('saveBtn');
  btn.disabled = true; btn.textContent = 'Publication...';
  toast('loading', 'Publication en cours...');
  const res = await api('save', collect());
  saving = false; btn.disabled = false; btn.textContent = 'Publier';
  if(res.ok){
    toast('success', '✓ ' + (res.message || 'Modifications publiees') + (res.saved_at ? ' · ' + res.saved_at : ''));
    msg('Derniere sauvegarde : ' + (res.saved_at || new Date().toLocaleTimeString()));
    document.getElementById('preview')?.contentWindow?.location.reload();
  } else {
    toast('error', '✕ ' + (res.error || 'Impossible de publier'));
    msg(res.error || 'Erreur inconnue');
  }
});

document.getElementById('reloadBtn').addEventListener('click', load);

document.getElementById('logoutBtn').addEventListener('click', async () => {
  await api('logout');
  toast('success', 'Deconnecte');
  location.reload();
});

document.getElementById('applyJsonBtn').addEventListener('click', () => {
  try{
    content = JSON.parse(document.getElementById('jsonBox').value);
    content.field_labels = content.field_labels || {};
    render();
    toast('success', 'JSON applique. Clique sur Publier pour sauvegarder.');
  }catch(e){ toast('error', 'JSON invalide'); }
});

document.querySelectorAll('.tab').forEach(tab => {
  tab.addEventListener('click', () => {
    collect();
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    tab.classList.add('active');
    document.querySelector('[data-section="' + tab.dataset.tab + '"]').classList.add('active');
    if(tab.dataset.tab === 'json') document.getElementById('jsonBox').value = JSON.stringify(content, null, 2);
    if(tab.dataset.tab === 'users') loadUsers();
  });
});

document.addEventListener('click', event => {
  const navRemove = event.target.closest('[data-remove-nav]');
  if(navRemove){ collectSettings(); content.settings.nav.splice(Number(navRemove.dataset.removeNav),1); renderSettings(); return; }

  const footerRemove = event.target.closest('[data-remove-footer]');
  if(footerRemove){ collectSettings(); content.settings.footer_links.splice(Number(footerRemove.dataset.removeFooter),1); renderSettings(); return; }

  const pageSelect = event.target.closest('[data-select-page]');
  if(pageSelect){ collectCurrentPage(); selectedPageSlug = pageSelect.dataset.selectPage; renderPages(); return; }

  if(event.target.id === 'deletePageBtn' && selectedPageSlug){
    if(confirm('Supprimer cette page du CMS ?')){
      delete content.pages[selectedPageSlug];
      selectedPageSlug = Object.keys(content.pages)[0] || null;
      renderPages();
    }
    return;
  }

  const deleteUser = event.target.closest('[data-delete-user]');
  if(deleteUser){
    const id       = deleteUser.dataset.deleteUser;
    const username = deleteUser.dataset.deleteUsername;
    if(confirm('Supprimer l\'acces de ' + username + ' ?')){
      api('delete_user', {id: parseInt(id)}).then(res => {
        if(res.ok){ toast('success', 'Acces supprime'); loadUsers(); }
        else toast('error', res.error || 'Erreur');
      });
    }
    return;
  }
});

document.getElementById('addNavBtn')?.addEventListener('click', () => {
  collectSettings(); content.settings.nav.push({label:'Nouveau lien', url:'#', type:'link'}); renderSettings();
});
document.getElementById('addFooterBtn')?.addEventListener('click', () => {
  collectSettings(); content.settings.footer_links.push({label:'Nouveau lien', url:'#'}); renderSettings();
});
document.getElementById('addPageBtn')?.addEventListener('click', () => {
  collectCurrentPage();
  content.pages = content.pages || {};
  let base = 'nouvelle-page', slug = base, i = 2;
  while(content.pages[slug]) slug = base + '-' + i++;
  content.pages[slug] = {slug, title:'Nouvelle page', meta_title:'', meta_description:'', kicker:'', intro:'', content:'<h2>Nouvelle section</h2><p>Texte de la page.</p>', status:'draft', client_editable:false};
  selectedPageSlug = slug; renderPages();
});

document.getElementById('changePasswordBtn')?.addEventListener('click', async () => {
  const current  = document.getElementById('currentPassword').value;
  const next     = document.getElementById('newPasswordAccount').value;
  const confirm  = document.getElementById('confirmPassword').value;
  if(!current || !next){ toast('error', 'Remplissez tous les champs'); return; }
  if(next !== confirm){ toast('error', 'Les mots de passe ne correspondent pas'); return; }
  if(next.length < 6){ toast('error', 'Nouveau mot de passe trop court (6 caracteres min.)'); return; }
  const res = await api('change_password', {current_password: current, new_password: next});
  if(res.ok){
    toast('success', 'Mot de passe mis a jour');
    document.getElementById('currentPassword').value = '';
    document.getElementById('newPasswordAccount').value = '';
    document.getElementById('confirmPassword').value = '';
  } else {
    toast('error', res.error || 'Erreur');
  }
});

document.getElementById('createUserBtn')?.addEventListener('click', async () => {
  const username = document.getElementById('newUsername').value.trim();
  const password = document.getElementById('newPassword').value;
  const role     = document.getElementById('newRole').value;
  if(!username || !password){ toast('error', 'Identifiant et mot de passe requis'); return; }
  const res = await api('create_user', {username, password, role});
  if(res.ok){
    toast('success', 'Acces cree pour ' + username);
    document.getElementById('newUsername').value = '';
    document.getElementById('newPassword').value = '';
    loadUsers();
  } else {
    toast('error', res.error || 'Erreur');
  }
});

<?php if ($isLoggedIn): ?>
load();
<?php else: ?>
// Will check on login
<?php endif; ?>
</script>
</body>
</html>
