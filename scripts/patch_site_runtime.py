from pathlib import Path

index = Path("index.html")
site = Path("assets/js/site.js")

if not index.exists() or not site.exists():
    raise SystemExit("Fichiers publics introuvables pendant le build")

html = index.read_text(encoding="utf-8")
html = html.replace('href="#prediagnostic"', 'href="#test"')
html = html.replace('href="#diagnostic"', 'href="#test"')

if 'class="site-home home-v3-ready"' not in html:
    raise RuntimeError("La home v3 n'est pas marquée comme prête dans le HTML public")

index.write_text(html, encoding="utf-8")
print("Public runtime anchors normalized; home v3 marker present")
