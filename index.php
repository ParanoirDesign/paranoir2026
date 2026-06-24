<!DOCTYPE html>

<html lang="fr">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<title>Victoria Dury — Où ça bloque vraiment ?</title>
<meta content="Quiz de diagnostic gratuit : identifiez votre blocage probable, puis réservez directement votre Diagnostic Express à 290 €." name="description"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Sora:wght@500;600;700;800&amp;display=swap" rel="stylesheet"/>
<style>
    :root{
      --paper:#f7f1e8;
      --paper2:#eadccd;
      --cream:#fffaf2;
      --ink:#191210;
      --ink2:#43332f;
      --muted:rgba(25,18,16,.66);
      --faint:rgba(25,18,16,.43);
      --line:rgba(25,18,16,.14);
      --carmine:#b11235;
      --carmine2:#df2d55;
      --rose:#f7c0cc;
      --glass:rgba(255,255,255,.52);
      --max:1220px;
      --gutter:clamp(20px,4vw,56px);
      --title:"Sora",system-ui,sans-serif;
      --body:"Poppins",system-ui,sans-serif;
      --highlight:"Gemola",Georgia,"Times New Roman",serif;
    }

    *{box-sizing:border-box}
    html{scroll-behavior:smooth}
    body{
      margin:0;
      font-family:var(--body);
      color:var(--ink);
      background:
        radial-gradient(circle at 12% 8%,rgba(177,18,53,.13),transparent 28%),
        radial-gradient(circle at 92% 10%,rgba(255,255,255,.85),transparent 28%),
        linear-gradient(135deg,var(--paper),var(--paper2));
      overflow-x:hidden;
    }

    body::before{
      content:"";
      position:fixed;
      inset:0;
      pointer-events:none;
      z-index:0;
      background-image:
        linear-gradient(rgba(25,18,16,.032) 1px,transparent 1px),
        linear-gradient(90deg,rgba(25,18,16,.025) 1px,transparent 1px);
      background-size:74px 74px;
      mask-image:linear-gradient(to bottom,black 0%,transparent 76%);
    }

    body::after{
      content:"";
      position:fixed;
      inset:-40%;
      pointer-events:none;
      z-index:0;
      opacity:.055;
      background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 260 260' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
      animation:grain 9s steps(10) infinite;
    }

    a{color:inherit;text-decoration:none}
    h1,h2,h3,p{margin:0}
    .page{position:relative;z-index:1}

    .nav{
      position:fixed;
      z-index:30;
      top:14px;
      left:50%;
      transform:translateX(-50%);
      width:min(calc(100% - 28px),var(--max));
      display:grid;
      grid-template-columns:1fr auto 1fr;
      align-items:center;
      gap:18px;
      padding:10px 13px 10px 17px;
      border:1px solid rgba(255,255,255,.68);
      border-radius:999px;
      background:rgba(255,255,255,.50);
      backdrop-filter:blur(26px) saturate(1.35);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.86),0 18px 50px rgba(71,43,31,.10);
    }

    .brand{font-family:var(--title);font-weight:800;font-size:14px;letter-spacing:-.025em}
    .nav-mid{font-size:11px;text-transform:uppercase;letter-spacing:.17em;color:var(--faint);font-weight:700}
    .nav-right{display:flex;justify-content:flex-end;align-items:center;gap:18px}
    .nav-link{font-size:13px;font-weight:600;color:rgba(25,18,16,.58)}
    .nav-cta{
      background:var(--ink);
      color:var(--cream);
      padding:10px 16px;
      border-radius:999px;
      font-size:13px;
      font-weight:700;
      box-shadow:0 10px 28px rgba(25,18,16,.14);
    }

    section{width:min(calc(100% - 2*var(--gutter)),var(--max));margin:0 auto;position:relative}

    .hero{
      min-height:calc(100svh - 18px);
      padding:92px 0 22px;
      display:grid;
      grid-template-columns:minmax(0,.92fr) minmax(390px,.86fr);
      gap:clamp(30px,5vw,68px);
      align-items:center;
    }

    .eyebrow{
      display:flex;align-items:center;gap:10px;
      margin-bottom:16px;
      color:var(--carmine);
      text-transform:uppercase;
      letter-spacing:.13em;
      font-size:12px;
      font-weight:700;
    }
    .dot{width:7px;height:7px;border-radius:999px;background:var(--carmine);box-shadow:0 0 18px rgba(177,18,53,.45)}

    h1{
      max-width:760px;
      font-family:var(--title);
      font-size:clamp(34px,4.6vw,60px);
      line-height:1.12;
      letter-spacing:-.05em;
      font-weight:700;
    }
    .highlight{
      font-family:var(--highlight);
      font-weight:400;
      font-style:italic;
      color:var(--carmine);
      letter-spacing:-.045em;
    }
    .sub{
      margin-top:20px;
      max-width:680px;
      color:var(--muted);
      font-size:clamp(14.5px,1.15vw,16.5px);
      line-height:1.78;
    }
    .marker{
      color:var(--ink);
      font-weight:600;
      background:linear-gradient(transparent 58%,rgba(177,18,53,.16) 58%);
    }
    .hero-actions{display:flex;align-items:center;gap:16px;flex-wrap:wrap;margin-top:26px}
    .cta{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      gap:10px;
      min-height:52px;
      padding:14px 22px;
      border-radius:999px;
      background:var(--carmine);
      color:white;
      font-weight:700;
      box-shadow:0 22px 54px rgba(177,18,53,.22),inset 0 1px 0 rgba(255,255,255,.26);
      transition:transform .22s ease,box-shadow .22s ease;
    }
    .cta:hover{transform:translateY(-3px);box-shadow:0 28px 72px rgba(177,18,53,.31),inset 0 1px 0 rgba(255,255,255,.32)}
    .micro{max-width:300px;color:rgba(25,18,16,.48);font-size:13px;line-height:1.6}

    /* DOSSIER OUVERT PREMIUM */
    .case-board{
      position:relative;
      min-height:455px;
      border:1px solid rgba(255,255,255,.72);
      border-radius:34px;
      background:
        linear-gradient(135deg,rgba(255,255,255,.64),rgba(255,255,255,.30)),
        rgba(255,255,255,.40);
      backdrop-filter:blur(32px) saturate(1.38);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.88),0 36px 104px rgba(76,45,32,.14);
      overflow:hidden;
      transform:rotateX(1.5deg) rotateY(-2.4deg);
      transform-style:preserve-3d;
    }
    .case-board::before{
      content:"";
      position:absolute;
      inset:0;
      background:
        radial-gradient(circle at 22% 4%,rgba(255,255,255,.88),transparent 27%),
        radial-gradient(circle at 84% 90%,rgba(177,18,53,.13),transparent 28%);
      pointer-events:none;
    }
    .case-board::after{
      content:"";
      position:absolute;
      inset:0;
      background:linear-gradient(115deg,transparent 8%,rgba(255,255,255,.42) 36%,transparent 52%);
      transform:translateX(-80%);
      animation:sheen 7.5s ease-in-out infinite;
      pointer-events:none;
    }

    .board-top{
      position:absolute;
      top:20px;left:22px;right:22px;
      z-index:4;
      display:flex;
      justify-content:space-between;
      gap:18px;
      color:rgba(25,18,16,.42);
      text-transform:uppercase;
      letter-spacing:.17em;
      font-size:11px;
      font-weight:700;
    }

    .paper-layer{
      position:absolute;
      border-radius:22px;
      background:rgba(255,250,242,.62);
      border:1px solid rgba(255,255,255,.72);
      box-shadow:0 18px 56px rgba(74,43,31,.09);
      transform:rotate(var(--r));
      z-index:1;
    }
    .paper-a{width:43%;height:23%;left:6%;top:14%;--r:-3deg}
    .paper-b{width:47%;height:25%;right:6%;top:16%;--r:2.4deg}
    .paper-c{width:45%;height:22%;left:9%;bottom:18%;--r:2deg}
    .paper-d{width:41%;height:22%;right:7%;bottom:19%;--r:-2.6deg}

    .thread-svg{
      position:absolute;
      inset:0;
      width:100%;
      height:100%;
      z-index:2;
      pointer-events:none;
    }
    .thread{
      fill:none;
      stroke:var(--carmine);
      stroke-width:2.2;
      stroke-linecap:round;
      stroke-dasharray:720;
      stroke-dashoffset:720;
      opacity:.58;
      animation:draw 2.3s ease forwards .45s;
    }
    .thread.soft{stroke:rgba(25,18,16,.20);animation-delay:.15s}

    .evidence{
      position:absolute;
      z-index:3;
      padding:11px 13px;
      border:1px solid rgba(255,255,255,.78);
      border-radius:18px;
      background:rgba(255,255,255,.66);
      backdrop-filter:blur(18px);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.90),0 18px 46px rgba(74,43,31,.10);
      animation:float 5.5s ease-in-out infinite;
    }
    .evidence strong{
      display:block;
      font-family:var(--title);
      font-size:clamp(12px,1vw,14.5px);
      line-height:1.18;
      letter-spacing:-.03em;
      font-weight:700;
      white-space:nowrap;
    }
    .evidence span{
      display:block;
      margin-top:5px;
      color:rgba(25,18,16,.50);
      font-size:11px;
      font-weight:600;
    }
    .evidence.big strong{font-size:clamp(15px,1.45vw,20px)}
    .evidence.false strong{
      color:rgba(25,18,16,.46);
      text-decoration:line-through;
      text-decoration-color:var(--carmine);
      text-decoration-thickness:2px;
    }
    .evidence.result{
      background:var(--carmine);
      color:white;
      border-color:rgba(255,255,255,.42);
    }
    .evidence.result span{color:rgba(255,255,255,.72)}
    .ev1{left:8%;top:16%;animation-delay:0s}
    .ev2{right:9%;top:18%;animation-delay:.42s}
    .ev3{left:22%;top:43%;animation-delay:.78s}
    .ev4{right:11%;top:45%;animation-delay:.18s}
    .ev5{left:10%;bottom:14%;animation-delay:.62s}
    .ev6{right:10%;bottom:15%;animation-delay:.36s}

    .stamp{
      position:absolute;
      z-index:4;
      left:45%;
      top:55%;
      transform:rotate(-9deg) scale(1.22);
      border:3px solid var(--carmine);
      color:var(--carmine);
      padding:9px 14px;
      border-radius:12px;
      background:rgba(247,241,232,.50);
      font-family:var(--title);
      font-size:12px;
      font-weight:800;
      letter-spacing:.08em;
      text-transform:uppercase;
      opacity:0;
      animation:stamp .58s cubic-bezier(.15,1.6,.25,1) forwards 2.15s;
    }

    .hero-offer{
      margin-top:12px;
      display:grid;
      grid-template-columns:auto 1fr auto;
      align-items:center;
      gap:20px;
      padding:14px 18px;
      border-radius:24px;
      border:1px solid rgba(255,255,255,.72);
      background:rgba(255,255,255,.55);
      backdrop-filter:blur(26px) saturate(1.3);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.88),0 22px 60px rgba(76,45,32,.10);
    }
    .hero-offer small{
      display:block;
      color:var(--carmine);
      text-transform:uppercase;
      letter-spacing:.15em;
      font-size:11px;
      font-weight:700;
      margin-bottom:4px;
    }
    .offer-name{
      font-family:var(--title);
      font-size:15px;
      line-height:1.1;
      letter-spacing:-.02em;
      font-weight:700;
    }
    .offer-text{
      color:var(--ink2);
      font-size:13px;
      line-height:1.45;
      font-weight:500;
    }
    .offer-price{
      font-family:var(--title);
      font-size:36px;
      line-height:.9;
      letter-spacing:-.05em;
      font-weight:700;
      white-space:nowrap;
      color:var(--carmine);
    }

    .proof{
      padding:18px 0 76px;
      display:grid;
      grid-template-columns:.78fr 1.44fr .78fr;
      gap:18px;
    }
    .liquid{
      border:1px solid rgba(255,255,255,.68);
      background:linear-gradient(135deg,rgba(255,255,255,.58),rgba(255,255,255,.31));
      backdrop-filter:blur(24px) saturate(1.35);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.86),0 22px 58px rgba(72,43,31,.09);
    }
    .proof-item{
      border-radius:30px;
      padding:24px;
      min-height:176px;
      display:flex;
      flex-direction:column;
      justify-content:space-between;
    }
    .stat{font-family:var(--title);font-size:46px;line-height:.95;letter-spacing:-.05em;color:var(--carmine);font-weight:700}
    .proof-item p{color:var(--muted);line-height:1.65;font-size:14px}
    .quote{font-family:var(--highlight);font-size:clamp(21px,2vw,29px)!important;line-height:1.28!important;letter-spacing:-.035em;color:var(--ink)!important}
    .byline{font-family:var(--body);font-size:13px!important;color:rgba(25,18,16,.46)!important;margin-top:16px}

    .statement{
      min-height:82svh;
      display:grid;
      place-items:center;
      text-align:center;
      padding:96px 0;
    }
    .statement h2{
      max-width:920px;
      font-family:var(--title);
      font-size:clamp(34px,5.5vw,76px);
      line-height:1.16;
      letter-spacing:-.05em;
      font-weight:700;
    }
    .statement .highlight{
      position:relative;
      display:inline-block;
    }
    .statement .highlight::after{
      content:"";
      position:absolute;
      left:-3%;right:-3%;top:57%;
      height:.10em;
      background:var(--carmine);
      transform:scaleX(0);
      transform-origin:left;
      animation:strike linear both;
      animation-timeline:view();
      animation-range:entry 8% cover 45%;
    }

    .chapter{padding:76px 0}
    .split{
      display:grid;
      grid-template-columns:.78fr 1.22fr;
      gap:clamp(38px,7vw,98px);
      align-items:start;
    }
    .kicker{
      margin-bottom:16px;
      color:var(--carmine);
      font-size:12px;
      text-transform:uppercase;
      letter-spacing:.16em;
      font-weight:700;
    }
    h2{
      font-family:var(--title);
      font-size:clamp(29px,3.7vw,52px);
      line-height:1.16;
      letter-spacing:-.045em;
      font-weight:700;
    }
    .lede{
      margin-top:22px;
      max-width:610px;
      color:var(--muted);
      font-size:16.5px;
      line-height:1.82;
    }
    .symptoms{display:grid;border-top:1px solid var(--line)}
    .symptom{
      display:grid;
      grid-template-columns:1fr auto;
      gap:24px;
      align-items:baseline;
      padding:22px 0;
      border-bottom:1px solid var(--line);
    }
    .symptom strong{
      font-family:var(--title);
      font-size:clamp(19px,2vw,29px);
      line-height:1.18;
      letter-spacing:-.035em;
      font-weight:600;
    }
    .symptom span{
      color:var(--carmine);
      text-transform:uppercase;
      letter-spacing:.13em;
      font-size:11px;
      font-weight:700;
    }
    .risk{
      margin-top:28px;
      padding-left:20px;
      border-left:4px solid var(--carmine);
      font-family:var(--highlight);
      color:var(--carmine);
      font-size:clamp(25px,3vw,40px);
      line-height:1.08;
      letter-spacing:-.04em;
    }

    .method{
      padding:86px 0;
      display:grid;
      grid-template-columns:.85fr 1.15fr;
      gap:clamp(38px,6vw,86px);
      align-items:center;
    }
    .method p:not(.kicker){
      margin-top:22px;
      color:var(--muted);
      font-size:16.5px;
      line-height:1.86;
      max-width:580px;
    }
    .timeline{position:relative;padding:18px 0}
    .timeline::before{
      content:"";
      position:absolute;
      left:23px;top:38px;bottom:38px;width:2px;
      background:rgba(177,18,53,.18);
    }
    .timeline::after{
      content:"";
      position:absolute;
      left:23px;top:38px;height:calc(100% - 76px);width:2px;
      background:var(--carmine);
      transform-origin:top;
      transform:scaleY(0);
      animation:progress linear both;
      animation-timeline:view();
      animation-range:entry 12% cover 74%;
    }
    .step{
      position:relative;
      display:grid;
      grid-template-columns:48px 1fr;
      gap:22px;
      align-items:start;
      padding:18px 0 22px;
      opacity:.36;
      transform:translateX(-10px);
      animation:stepFade linear both;
      animation-timeline:view();
      animation-range:entry 0% cover 40%;
    }
    .num{
      position:relative;
      z-index:2;
      width:48px;height:48px;
      display:grid;place-items:center;
      border-radius:999px;
      background:var(--carmine);
      color:white;
      font-weight:700;
      font-size:13px;
      box-shadow:0 0 0 9px rgba(255,250,242,.74);
    }
    .step strong{
      display:block;
      font-family:var(--title);
      font-size:clamp(19px,2vw,28px);
      line-height:1.12;
      letter-spacing:-.035em;
      font-weight:700;
    }
    .step span{
      display:block;
      margin-top:7px;
      color:var(--muted);
      font-size:14.5px;
      line-height:1.62;
      max-width:540px;
    }

    .offer{padding:86px 0}
    .offer-layout{
      display:grid;
      grid-template-columns:.72fr 1.28fr;
      gap:18px;
      align-items:stretch;
    }
    .price-panel{
      border-radius:34px;
      background:var(--carmine);
      color:white;
      padding:34px;
      min-height:430px;
      display:flex;
      flex-direction:column;
      justify-content:space-between;
      box-shadow:0 28px 74px rgba(177,18,53,.22);
    }
    .price-panel h2{color:white;font-size:clamp(29px,3.1vw,43px);line-height:1.14}
    .price{
      margin-top:24px;
      font-family:var(--title);
      font-size:clamp(64px,7vw,100px);
      line-height:.88;
      letter-spacing:-.06em;
      font-weight:700;
      white-space:nowrap;
    }
    .price-line{
      margin-top:26px;
      color:rgba(255,255,255,.82);
      font-family:var(--highlight);
      font-size:clamp(24px,2.8vw,38px);
      line-height:1.12;
      letter-spacing:-.035em;
    }
    .price-panel .cta{
      margin-top:28px;
      background:white;color:var(--carmine);
      box-shadow:0 18px 42px rgba(0,0,0,.12),inset 0 1px 0 rgba(255,255,255,.8);
      font-size:15px;padding:15px 20px;
    }
    .price-panel .micro{color:rgba(255,255,255,.72);margin-top:15px}
    .offer-list{display:grid;gap:12px}
    .detail{border-radius:26px;padding:22px 24px}
    .detail strong{
      display:block;
      font-family:var(--title);
      font-size:clamp(18px,1.65vw,24px);
      line-height:1.18;
      letter-spacing:-.03em;
    }
    .detail span{
      display:block;
      margin-top:8px;
      color:var(--muted);
      font-size:14.5px;
      line-height:1.65;
    }

    .about{
      padding:82px 0;
      display:grid;
      grid-template-columns:.78fr 1.22fr;
      gap:18px;
    }
    .photo{
      min-height:430px;
      border-radius:34px;
      background:
        linear-gradient(130deg,rgba(25,18,16,.12),rgba(177,18,53,.10)),
        url("data:image/svg+xml,%3Csvg width='900' height='1000' viewBox='0 0 900 1000' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='900' height='1000' fill='%23eadccd'/%3E%3Cpath d='M120 180h520v46H120zM120 260h390v24H120zM120 312h470v24H120zM120 364h330v24H120zM120 590h650v9H120zM170 630h260v20H170zM170 680h360v20H170zM170 730h300v20H170z' fill='%23191210' opacity='.14'/%3E%3Ccircle cx='650' cy='730' r='105' fill='%23b11235' opacity='.20'/%3E%3C/svg%3E");
      background-size:cover;
      background-position:center;
    }
    .about-copy{
      border-radius:34px;
      padding:clamp(28px,4vw,48px);
    }
    .about-copy p{
      margin-top:20px;
      color:var(--muted);
      font-size:16.5px;
      line-height:1.86;
    }

    .faq{max-width:900px;padding:82px 0}
    details{padding:24px 0;border-bottom:1px solid var(--line)}
    summary{
      list-style:none;cursor:pointer;
      display:flex;justify-content:space-between;gap:24px;
      font-family:var(--title);
      font-size:clamp(20px,2.35vw,31px);
      line-height:1.18;
      letter-spacing:-.035em;
      font-weight:700;
    }
    summary::after{content:"+";color:var(--carmine);font-family:var(--body);font-weight:500}
    details[open] summary::after{content:"–"}
    details p{
      margin-top:15px;
      max-width:740px;
      color:var(--muted);
      line-height:1.76;
      font-size:15.5px;
    }

    .final{
      width:100%;
      max-width:none;
      background:var(--carmine);
      color:white;
      text-align:center;
      padding:clamp(70px,9vw,126px) var(--gutter);
      margin-top:58px;
    }
    .final-inner{max-width:960px;margin:0 auto}
    .final h2{color:white;font-size:clamp(35px,5vw,70px)}
    .final .highlight{color:rgba(255,255,255,.84)}
    .final p{
      max-width:650px;
      margin:24px auto 0;
      color:rgba(255,255,255,.76);
      line-height:1.76;
      font-size:16.5px;
    }
    .final .cta{margin-top:32px;background:white;color:var(--carmine);box-shadow:0 20px 50px rgba(0,0,0,.13)}
    .final .micro{margin:15px auto 0;color:rgba(255,255,255,.68)}

    footer{
      width:min(calc(100% - 2*var(--gutter)),var(--max));
      margin:0 auto;
      padding:34px 0 56px;
      display:flex;
      justify-content:space-between;
      gap:22px;
      color:rgba(25,18,16,.48);
      font-size:13px;
    }


    .site-footer{
      width:min(calc(100% - 2*var(--gutter)),var(--max));
      margin:0 auto;
      padding:34px 0 56px;
      display:flex;
      justify-content:space-between;
      gap:18px;
      flex-wrap:wrap;
      color:rgba(25,18,16,.48);
      font-size:13px;
    }
    .site-footer-links{display:flex;gap:14px;flex-wrap:wrap}
    .site-footer-links a{font-weight:800;color:rgba(25,18,16,.56)}
    .site-footer-links a:hover{color:var(--carmine)}

    .reveal{opacity:0;transform:translateY(24px);transition:opacity .7s ease,transform .7s ease}
    .visible{opacity:1;transform:translateY(0)}


    /* FOND THREE.JS — clair, discret, piloté par le scroll et la souris */
    .three-bg{
      position:fixed;
      inset:0;
      z-index:0;
      pointer-events:none;
      overflow:hidden;
      opacity:.44;
      mix-blend-mode:multiply;
    }

    #clarityCanvas{
      width:100%;
      height:100%;
      display:block;
    }

    .page{
      position:relative;
      z-index:2;
    }

    .nav{
      z-index:40;
    }

    @media(max-width:720px){
      .three-bg{opacity:.28}
    }

    @media(prefers-reduced-motion:reduce){
      .three-bg{display:none}
    }


    .prequiz{
      padding:86px 0;
      display:grid;
      grid-template-columns:.72fr 1.28fr;
      gap:clamp(28px,5vw,72px);
      align-items:start;
    }
    .prequiz-head{
      position:sticky;
      top:112px;
      align-self:start;
    }
    .prequiz .lede{
      max-width:520px;
    }
    .quiz{
      border-radius:34px;
      padding:clamp(24px,3.5vw,40px);
      min-height:520px;
    }
    .quiz-progress{
      display:grid;
      grid-template-columns:auto 1fr;
      gap:18px;
      align-items:center;
      margin-bottom:30px;
      color:var(--faint);
      font-size:12px;
      text-transform:uppercase;
      letter-spacing:.14em;
      font-weight:700;
    }
    .quiz-progress div{
      height:6px;
      border-radius:999px;
      background:rgba(25,18,16,.10);
      overflow:hidden;
    }
    .quiz-progress i{
      display:block;
      height:100%;
      width:20%;
      border-radius:999px;
      background:var(--carmine);
      transition:width .35s ease;
    }
    .quiz-step{
      display:none;
      border:0;
      padding:0;
      margin:0;
    }
    .quiz-step.active{
      display:block;
      animation:quizIn .32s ease both;
    }
    .quiz-step legend{
      display:block;
      margin-bottom:22px;
      font-family:var(--title);
      font-size:clamp(24px,3vw,38px);
      line-height:1.15;
      letter-spacing:-.04em;
      font-weight:700;
    }
    .quiz-step label{
      display:flex;
      align-items:flex-start;
      gap:12px;
      margin:10px 0;
      padding:14px 16px;
      border:1px solid rgba(255,255,255,.68);
      border-radius:18px;
      background:rgba(255,255,255,.36);
      color:var(--ink2);
      line-height:1.45;
      cursor:pointer;
      transition:transform .18s ease, border-color .18s ease, background .18s ease;
    }
    .quiz-step label:hover{
      transform:translateY(-2px);
      border-color:rgba(177,18,53,.32);
      background:rgba(255,255,255,.54);
    }
    .quiz-step input[type="radio"],
    .quiz-step input[type="checkbox"]{
      accent-color:var(--carmine);
      margin-top:3px;
    }
    .quiz-fields{
      display:grid;
      gap:12px;
    }
    .quiz-fields label{
      display:grid;
      gap:8px;
      margin:0;
      cursor:default;
    }
    .quiz-fields label span{
      color:var(--faint);
      font-size:12px;
      font-weight:500;
    }
    .quiz-fields input{
      width:100%;
      min-height:50px;
      border:1px solid rgba(25,18,16,.13);
      border-radius:16px;
      background:rgba(255,255,255,.64);
      padding:0 15px;
      font:inherit;
      color:var(--ink);
      outline:none;
    }
    .quiz-fields input:focus{
      border-color:rgba(177,18,53,.42);
      box-shadow:0 0 0 4px rgba(177,18,53,.10);
    }
    .quiz-note,.quiz-privacy{
      margin-top:16px;
      color:rgba(25,18,16,.50);
      font-size:13px;
      line-height:1.6;
    }
    .quiz-result{
      display:none;
      margin-top:22px;
      padding:18px;
      border-radius:20px;
      background:rgba(177,18,53,.08);
      color:var(--ink2);
      line-height:1.62;
    }
    .quiz-result.active{
      display:block;
    }
    .quiz-actions{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:14px;
      flex-wrap:wrap;
      margin-top:28px;
    }
    .quiz-back{
      min-height:48px;
      padding:12px 18px;
      border:1px solid rgba(25,18,16,.12);
      border-radius:999px;
      background:rgba(255,255,255,.42);
      color:var(--ink2);
      font:inherit;
      font-weight:700;
      cursor:pointer;
    }
    .quiz-next,.quiz-submit{
      border:0;
      cursor:pointer;
      font:inherit;
    }
    .quiz-submit{
      display:none;
    }
    .quiz-back[disabled]{
      opacity:.35;
      cursor:not-allowed;
    }
    .quiz-error{
      outline:2px solid rgba(177,18,53,.28);
      outline-offset:6px;
      border-radius:22px;
    }
    @keyframes quizIn{
      from{opacity:0;transform:translateY(12px)}
      to{opacity:1;transform:translateY(0)}
    }


    /* TEST DE CLARTÉ — version plus immersive, moins formulaire triste */
    .quiz-orbit{
      position:relative;
      width:min(360px,100%);
      aspect-ratio:1;
      margin-top:34px;
      border-radius:999px;
      border:1px solid rgba(177,18,53,.16);
      background:
        radial-gradient(circle at center,rgba(177,18,53,.10),transparent 38%),
        rgba(255,255,255,.26);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.80),0 28px 80px rgba(72,43,31,.08);
      overflow:hidden;
    }
    .quiz-orbit::before,
    .quiz-orbit::after{
      content:"";
      position:absolute;
      inset:16%;
      border-radius:999px;
      border:1px dashed rgba(177,18,53,.20);
      animation:orbitSpin 18s linear infinite;
    }
    .quiz-orbit::after{
      inset:31%;
      animation-duration:11s;
      animation-direction:reverse;
      opacity:.7;
    }
    .orbit-center{
      position:absolute;
      left:50%;
      top:50%;
      transform:translate(-50%,-50%);
      width:72px;
      height:72px;
      display:grid;
      place-items:center;
      border-radius:999px;
      background:var(--carmine);
      color:white;
      font-family:var(--title);
      font-size:38px;
      font-weight:800;
      box-shadow:0 18px 48px rgba(177,18,53,.25);
    }
    .orbit-pill{
      position:absolute;
      padding:9px 12px;
      border-radius:999px;
      background:rgba(255,255,255,.64);
      border:1px solid rgba(255,255,255,.72);
      backdrop-filter:blur(14px);
      color:var(--ink2);
      font-size:12px;
      text-transform:uppercase;
      letter-spacing:.13em;
      font-weight:700;
      box-shadow:0 14px 34px rgba(72,43,31,.08);
      animation:orbitFloat 5s ease-in-out infinite;
    }
    .orbit-pill.p1{left:10%;top:20%;animation-delay:.1s}
    .orbit-pill.p2{right:6%;top:28%;animation-delay:.5s}
    .orbit-pill.p3{left:14%;bottom:18%;color:var(--carmine);animation-delay:.9s}
    .orbit-pill.p4{right:10%;bottom:23%;animation-delay:1.2s}

    .diagnostic-pulse{
      position:relative;
      margin-bottom:26px;
      padding:18px 20px;
      border-radius:24px;
      background:
        linear-gradient(135deg,rgba(177,18,53,.10),rgba(255,255,255,.36));
      border:1px solid rgba(177,18,53,.16);
      overflow:hidden;
    }
    .diagnostic-pulse::before{
      content:"";
      position:absolute;
      inset:0;
      background:linear-gradient(115deg,transparent 0%,rgba(255,255,255,.44) 42%,transparent 62%);
      transform:translateX(-110%);
      animation:diagnosticSheen 4.6s ease-in-out infinite;
      pointer-events:none;
    }
    .diagnostic-pulse span{
      display:block;
      margin-bottom:7px;
      color:var(--carmine);
      text-transform:uppercase;
      letter-spacing:.15em;
      font-size:11px;
      font-weight:800;
    }
    .diagnostic-pulse strong{
      display:block;
      font-family:var(--title);
      font-size:clamp(18px,2vw,26px);
      line-height:1.18;
      letter-spacing:-.035em;
    }
    .quiz-step label.is-picked{
      border-color:rgba(177,18,53,.42);
      background:rgba(177,18,53,.08);
      transform:translateY(-2px);
      box-shadow:0 18px 44px rgba(177,18,53,.08);
    }
    .quiz-step label.is-picked::after{
      content:"✓";
      margin-left:auto;
      color:var(--carmine);
      font-weight:900;
    }
    .quiz-step.active legend{
      animation:legendPop .36s ease both;
    }
    .quiz-result.active{
      animation:resultReveal .48s cubic-bezier(.16,1,.3,1) both;
      border:1px solid rgba(177,18,53,.18);
      background:
        radial-gradient(circle at 12% 0%,rgba(177,18,53,.13),transparent 36%),
        rgba(255,255,255,.42);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.80),0 24px 72px rgba(72,43,31,.09);
    }

    @keyframes orbitSpin{to{transform:rotate(360deg)}}
    @keyframes orbitFloat{
      0%,100%{transform:translateY(0) rotate(-1deg)}
      50%{transform:translateY(-8px) rotate(1deg)}
    }
    @keyframes diagnosticSheen{
      0%,52%{transform:translateX(-110%)}
      76%,100%{transform:translateX(110%)}
    }
    @keyframes legendPop{
      from{opacity:0;transform:translateY(10px) scale(.98)}
      to{opacity:1;transform:translateY(0) scale(1)}
    }
    @keyframes resultReveal{
      from{opacity:0;transform:translateY(14px) scale(.98)}
      to{opacity:1;transform:translateY(0) scale(1)}
    }


    .offer-comparison{
      width:100%;
      max-width:none;
      padding:clamp(70px,9vw,118px) var(--gutter);
      background:
        radial-gradient(circle at 18% 10%,rgba(177,18,53,.10),transparent 30%),
        linear-gradient(135deg,var(--paper),var(--paper2));
    }
    .comparison-inner{
      width:min(100%,var(--max));
      margin:0 auto;
    }
    .comparison-head{
      display:grid;
      grid-template-columns:.82fr 1.18fr;
      gap:clamp(28px,6vw,78px);
      align-items:end;
      margin-bottom:34px;
    }
    .comparison-head h2{
      max-width:720px;
    }
    .comparison-head .lede{
      margin-top:0;
      max-width:620px;
    }
    .comparison-table-wrap{
      overflow:auto;
      border-radius:34px;
      border:1px solid rgba(255,255,255,.70);
      background:linear-gradient(135deg,rgba(255,255,255,.62),rgba(255,255,255,.34));
      backdrop-filter:blur(26px) saturate(1.25);
      box-shadow:inset 0 1px 0 rgba(255,255,255,.88),0 30px 84px rgba(72,43,31,.10);
    }
    .comparison-table{
      width:100%;
      min-width:760px;
      border-collapse:separate;
      border-spacing:0;
      color:var(--ink);
    }
    .comparison-table th,
    .comparison-table td{
      padding:18px 20px;
      border-bottom:1px solid rgba(25,18,16,.10);
      border-right:1px solid rgba(25,18,16,.08);
      vertical-align:middle;
    }
    .comparison-table th:last-child,
    .comparison-table td:last-child{
      border-right:0;
    }
    .comparison-table tr:last-child td{
      border-bottom:0;
    }
    .comparison-table thead th{
      position:sticky;
      top:0;
      z-index:2;
      background:rgba(255,250,242,.82);
      backdrop-filter:blur(18px);
      text-align:left;
    }
    .comparison-table thead th:first-child{
      width:34%;
    }
    .offer-col{
      display:grid;
      gap:7px;
    }
    .offer-col small{
      color:var(--carmine);
      text-transform:uppercase;
      letter-spacing:.15em;
      font-size:10px;
      font-weight:800;
    }
    .offer-col strong{
      font-family:var(--title);
      font-size:clamp(18px,1.8vw,24px);
      line-height:1.08;
      letter-spacing:-.035em;
    }
    .offer-col span{
      color:var(--muted);
      font-size:13px;
      line-height:1.45;
      font-weight:500;
    }
    .tool-name{
      font-weight:700;
      color:var(--ink2);
      font-size:14.5px;
      line-height:1.35;
    }
    .comparison-table td:not(:first-child){
      text-align:center;
    }
    .check,
    .dash{
      display:inline-grid;
      place-items:center;
      width:30px;
      height:30px;
      border-radius:999px;
      font-weight:900;
      font-size:14px;
    }
    .check{
      background:rgba(177,18,53,.10);
      color:var(--carmine);
      border:1px solid rgba(177,18,53,.22);
    }
    .dash{
      background:rgba(25,18,16,.06);
      color:rgba(25,18,16,.32);
      border:1px solid rgba(25,18,16,.08);
    }
    .cell-note{
      display:block;
      margin-top:8px;
      color:var(--muted);
      font-size:12.5px;
      line-height:1.45;
    }
    .cell-note{display:none!important}
    .comparison-cta{
      display:flex;
      justify-content:space-between;
      align-items:center;
      gap:18px;
      margin-top:24px;
      padding:22px 24px;
      border-radius:28px;
      background:var(--ink);
      color:var(--cream);
      box-shadow:0 24px 70px rgba(25,18,16,.14);
    }
    .comparison-cta p{
      max-width:720px;
      color:rgba(255,250,242,.72);
      line-height:1.65;
      font-size:14.5px;
      margin:0;
    }
    .comparison-cta strong{
      color:white;
    }
    .comparison-cta .cta{
      background:white;
      color:var(--carmine);
      box-shadow:none;
      white-space:nowrap;
    }
    @media(max-width:1040px){
      .comparison-head{grid-template-columns:1fr}
      .comparison-head .lede{margin-top:0}
    }
    @media(max-width:720px){
      .offer-comparison{padding-inline:20px}
      .comparison-table-wrap{border-radius:26px}
      .comparison-cta{align-items:flex-start;flex-direction:column}
      .comparison-cta .cta{width:100%;white-space:normal}
    }


    .result-cta{
      display:none;
      margin-top:18px;
      padding:20px;
      border-radius:24px;
      background:var(--carmine);
      color:white;
      box-shadow:0 24px 70px rgba(177,18,53,.22);
      grid-template-columns:1fr auto;
      gap:18px;
      align-items:center;
    }
    .result-cta.active{display:grid;animation:resultReveal .48s cubic-bezier(.16,1,.3,1) both}
    .result-cta small{
      display:block;margin-bottom:6px;color:rgba(255,255,255,.72);
      text-transform:uppercase;letter-spacing:.15em;font-size:11px;font-weight:800;
    }
    .result-cta strong{
      display:block;font-family:var(--title);font-size:clamp(20px,2vw,28px);
      line-height:1.12;letter-spacing:-.035em;
    }
    .result-cta span{
      display:block;margin-top:8px;color:rgba(255,255,255,.76);
      line-height:1.55;font-size:14px;
    }
    .result-cta .cta{background:white;color:var(--carmine);box-shadow:0 18px 42px rgba(0,0,0,.12);white-space:nowrap}
    @media(max-width:720px){
      .result-cta{grid-template-columns:1fr}
      .result-cta .cta{width:100%;white-space:normal}
    }

    @keyframes draw{to{stroke-dashoffset:0}}
    @keyframes sheen{
      0%,46%{transform:translateX(-88%)}
      64%,100%{transform:translateX(88%)}
    }
    @keyframes float{
      0%,100%{transform:translateY(0) rotate(-.4deg)}
      50%{transform:translateY(-8px) rotate(.6deg)}
    }
    @keyframes stamp{
      from{opacity:0;transform:rotate(-9deg) scale(1.35)}
      to{opacity:1;transform:rotate(-9deg) scale(1)}
    }
    @keyframes strike{to{transform:scaleX(1)}}
    @keyframes progress{to{transform:scaleY(1)}}
    @keyframes stepFade{
      0%{opacity:.36;transform:translateX(-10px)}
      55%,100%{opacity:1;transform:translateX(0)}
    }
    @keyframes grain{
      0%,100%{transform:translate(0,0)}
      20%{transform:translate(-8%,4%)}
      40%{transform:translate(6%,-8%)}
      60%{transform:translate(-5%,10%)}
      80%{transform:translate(8%,5%)}
    }



    /* Fallback Safari / navigateurs sans animation-timeline:view().
       Oui, en 2026 on écrit encore des rustines pour que les navigateurs lisent du CSS. Splendide civilisation. */
    @supports not (animation-timeline: view()) {
      .statement .highlight::after{
        transform:scaleX(1);
        animation:none!important;
      }
      .timeline::after{
        transform:scaleY(1);
        animation:none!important;
      }
      .step{
        opacity:1;
        transform:none;
        animation:none!important;
      }
      .reveal{
        opacity:1;
        transform:none;
      }
      .thread{
        stroke-dashoffset:0;
        animation:none!important;
      }
    }


    /* ADMIN ÉDITABLE — activé avec ?admin=1&key=victoria */
    .admin-toggle,.admin-panel{display:none}
    body.admin-mode [data-edit],
    body.admin-mode [data-image-edit],
    body.admin-mode [data-bool]{
      outline:2px dashed rgba(177,18,53,.34);
      outline-offset:4px;
      cursor:pointer;
    }
    body.admin-mode [data-edit]:hover,
    body.admin-mode [data-image-edit]:hover,
    body.admin-mode [data-bool]:hover{outline-color:var(--carmine)}
    body.admin-mode .admin-toggle{
      display:flex;
      position:fixed;
      right:18px;
      bottom:18px;
      z-index:9998;
      border:0;
      border-radius:999px;
      background:var(--ink);
      color:var(--cream);
      padding:13px 16px;
      font:700 13px var(--body);
      box-shadow:0 18px 52px rgba(25,18,16,.22);
      cursor:pointer;
    }
    body.admin-mode .admin-panel{
      display:block;
      position:fixed;
      top:16px;
      right:16px;
      bottom:16px;
      width:min(430px,calc(100vw - 32px));
      z-index:9999;
      border:1px solid rgba(255,255,255,.70);
      border-radius:28px;
      background:rgba(255,250,242,.88);
      backdrop-filter:blur(28px) saturate(1.25);
      box-shadow:0 32px 110px rgba(25,18,16,.24),inset 0 1px 0 rgba(255,255,255,.92);
      overflow:auto;
      padding:18px;
      color:var(--ink);
    }
    body.admin-mode .admin-panel.collapsed{display:none}
    .admin-head{
      display:flex;
      justify-content:space-between;
      gap:14px;
      align-items:flex-start;
      padding-bottom:14px;
      border-bottom:1px solid rgba(25,18,16,.12);
      margin-bottom:14px;
    }
    .admin-head strong{
      display:block;
      font-family:var(--title);
      font-size:21px;
      letter-spacing:-.04em;
      line-height:1.1;
    }
    .admin-head span{
      display:block;
      margin-top:5px;
      color:var(--muted);
      font-size:12.5px;
      line-height:1.45;
    }
    .admin-close{
      border:0;
      width:36px;
      height:36px;
      border-radius:999px;
      background:rgba(25,18,16,.08);
      cursor:pointer;
      font-weight:900;
      color:var(--ink);
    }
    .admin-tabs{
      display:flex;
      gap:8px;
      flex-wrap:wrap;
      margin-bottom:14px;
    }
    .admin-tab{
      border:1px solid rgba(25,18,16,.10);
      background:rgba(255,255,255,.52);
      border-radius:999px;
      padding:9px 11px;
      font:700 12px var(--body);
      cursor:pointer;
      color:var(--ink2);
    }
    .admin-tab.active{background:var(--carmine);color:white;border-color:var(--carmine)}
    .admin-section{display:none}
    .admin-section.active{display:block}
    .admin-field{display:grid;gap:7px;margin:12px 0}
    .admin-field label,.admin-label{
      color:var(--faint);
      text-transform:uppercase;
      letter-spacing:.12em;
      font-size:10.5px;
      font-weight:800;
    }
    .admin-field input,.admin-field textarea{
      width:100%;
      border:1px solid rgba(25,18,16,.14);
      border-radius:14px;
      background:rgba(255,255,255,.68);
      padding:11px 12px;
      font:500 13px var(--body);
      color:var(--ink);
      outline:none;
    }
    .admin-field textarea{min-height:92px;resize:vertical}
    .admin-editable-html{width:100%;min-height:92px;border:1px solid rgba(25,18,16,.14);border-radius:14px;background:rgba(255,255,255,.68);padding:11px 12px;font:500 13px var(--body);color:var(--ink);line-height:1.55;outline:none;overflow:auto}
    .admin-editable-html:focus{border-color:rgba(177,18,53,.45);box-shadow:0 0 0 4px rgba(177,18,53,.10)}
    .admin-bool-name{width:100%;border:1px solid rgba(25,18,16,.14);border-radius:12px;background:rgba(255,255,255,.66);padding:9px 10px;font:700 12.5px var(--body);color:var(--ink);outline:none}
    .admin-field input:focus,.admin-field textarea:focus{
      border-color:rgba(177,18,53,.45);
      box-shadow:0 0 0 4px rgba(177,18,53,.10);
    }
    .admin-actions{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-top:14px}
    .admin-btn{
      border:0;
      border-radius:14px;
      padding:12px 13px;
      background:var(--ink);
      color:white;
      font:800 12px var(--body);
      cursor:pointer;
    }
    .admin-btn.secondary{background:rgba(25,18,16,.08);color:var(--ink)}
    .admin-btn.carmine{background:var(--carmine);color:white}
    .admin-output{
      width:100%;
      min-height:120px;
      margin-top:10px;
      border:1px solid rgba(25,18,16,.14);
      border-radius:16px;
      padding:12px;
      font:500 12px ui-monospace,SFMono-Regular,Menlo,monospace;
      background:rgba(255,255,255,.58);
      color:var(--ink2);
      resize:vertical;
    }
    .admin-bool-grid{display:grid;gap:8px}
    .admin-bool-row{
      display:grid;
      grid-template-columns:1fr auto auto auto;
      gap:8px;
      align-items:center;
      padding:10px;
      border:1px solid rgba(25,18,16,.10);
      border-radius:16px;
      background:rgba(255,255,255,.44);
    }
    .admin-bool-row strong{font-size:12.5px;line-height:1.35}
    .admin-bool-row label{
      display:grid;
      place-items:center;
      width:30px;
      height:30px;
      border-radius:999px;
      background:rgba(25,18,16,.06);
      cursor:pointer;
    }
    .admin-bool-row input{accent-color:var(--carmine)}
    .admin-help{margin-top:10px;color:var(--muted);font-size:12.5px;line-height:1.55}
    @media(max-width:720px){
      body.admin-mode .admin-panel{inset:8px;width:auto;border-radius:22px}
    }

    @media (max-height: 780px) and (min-width: 1041px){
      .hero{padding-top:82px;gap:42px}
      h1{font-size:clamp(34px,4.25vw,56px)}
      .sub{font-size:14.5px;line-height:1.68;margin-top:16px}
      .hero-actions{margin-top:22px}
      .case-board{min-height:410px}
      .evidence span{display:none}
      .hero-offer{padding:12px 16px}
      .offer-price{font-size:32px}
      .offer-text{font-size:12.5px}
    }

    @media(max-width:1040px){
      .hero,.split,.method,.offer-layout,.about,.prequiz{grid-template-columns:1fr}
      .prequiz-head{position:relative;top:auto}
      .case-board{transform:none;min-height:455px}
      .proof{grid-template-columns:1fr}
    }

    @media(max-width:720px){
      .nav{grid-template-columns:1fr auto}
      .nav-mid,.nav-link{display:none}
      .hero{padding-top:96px}
      h1{font-size:clamp(36px,10.4vw,54px);line-height:1.13}
      .case-board{min-height:500px;border-radius:30px}
      .evidence{padding:11px 12px;border-radius:17px}
      .evidence strong{font-size:12.5px;white-space:normal}
      .evidence.big strong{font-size:16px}
      .ev1{left:6%;top:16%}
      .ev2{right:6%;top:18%}
      .ev3{left:14%;top:43%}
      .ev4{right:6%;top:47%}
      .ev5{left:6%;bottom:20%}
      .ev6{right:6%;bottom:20%}
      .stamp{left:30%;top:58%}
      .hero-offer{grid-template-columns:1fr;gap:10px}
      .offer-price{font-size:38px}
      .symptom{grid-template-columns:1fr;gap:7px}
      .price{font-size:clamp(58px,18vw,84px)}
      footer{flex-direction:column}
    }

    @media(prefers-reduced-motion:reduce){
      *,*::before,*::after{animation:none!important;transition:none!important;scroll-behavior:auto!important}
      .reveal{opacity:1;transform:none}
      .thread{stroke-dashoffset:0}
    }
  

    /* FRONT MINI-EDITION — visible uniquement quand la session admin est ouverte */
    body.front-edit-mode [data-edit],
    body.front-edit-mode [data-link-edit],
    body.front-edit-mode [data-image-edit],
    body.front-edit-mode [data-bool],
    body.front-edit-mode .tool-name[data-front-bool-label]{
      outline:2px dashed rgba(177,18,53,.26);
      outline-offset:4px;
    }
    .front-edit-badge{
      position:absolute;
      z-index:9996;
      display:inline-flex;
      align-items:center;
      gap:6px;
      min-height:30px;
      padding:7px 10px;
      border:1px solid rgba(255,255,255,.72);
      border-radius:999px;
      background:rgba(25,18,16,.92);
      color:#fffaf2;
      font:800 11px var(--body,system-ui,sans-serif);
      box-shadow:0 14px 38px rgba(25,18,16,.22);
      cursor:pointer;
      opacity:.86;
      transform:translate(-6px,-38px);
      backdrop-filter:blur(12px);
    }
    .front-edit-badge:hover{opacity:1;background:var(--carmine,#b11235)}
    .front-edit-badge span{font-size:13px;line-height:1}
    .front-edit-panel{
      position:fixed;
      right:18px;
      bottom:18px;
      z-index:9999;
      width:min(430px,calc(100vw - 36px));
      max-height:min(78vh,680px);
      overflow:auto;
      display:none;
      border:1px solid rgba(255,255,255,.76);
      border-radius:28px;
      background:rgba(255,250,242,.94);
      color:var(--ink,#191210);
      box-shadow:0 32px 110px rgba(25,18,16,.28),inset 0 1px 0 rgba(255,255,255,.92);
      backdrop-filter:blur(28px) saturate(1.25);
      padding:18px;
      font-family:var(--body,system-ui,sans-serif);
    }
    .front-edit-panel.open{display:block}
    .front-edit-head{
      display:flex;
      justify-content:space-between;
      gap:14px;
      align-items:flex-start;
      padding-bottom:14px;
      margin-bottom:14px;
      border-bottom:1px solid rgba(25,18,16,.12);
    }
    .front-edit-title strong{
      display:block;
      font-family:var(--title,system-ui,sans-serif);
      font-size:21px;
      line-height:1.08;
      letter-spacing:-.04em;
    }
    .front-edit-title code{
      display:block;
      margin-top:6px;
      color:rgba(25,18,16,.48);
      font-size:11px;
      word-break:break-all;
    }
    .front-edit-close{
      border:0;
      width:36px;
      height:36px;
      border-radius:999px;
      background:rgba(25,18,16,.08);
      color:var(--ink,#191210);
      cursor:pointer;
      font-weight:900;
    }
    .front-edit-field{display:grid;gap:8px;margin:13px 0}
    .front-edit-field label{
      color:rgba(25,18,16,.50);
      text-transform:uppercase;
      letter-spacing:.12em;
      font-size:10.5px;
      font-weight:900;
    }
    .front-edit-field input,
    .front-edit-field textarea{
      width:100%;
      border:1px solid rgba(25,18,16,.14);
      border-radius:14px;
      background:rgba(255,255,255,.72);
      padding:11px 12px;
      font:500 13px var(--body,system-ui,sans-serif);
      color:var(--ink,#191210);
      outline:none;
    }
    .front-edit-html{
      width:100%;
      min-height:122px;
      max-height:260px;
      overflow:auto;
      border:1px solid rgba(25,18,16,.14);
      border-radius:14px;
      background:rgba(255,255,255,.72);
      padding:11px 12px;
      font:500 13px var(--body,system-ui,sans-serif);
      color:var(--ink,#191210);
      line-height:1.55;
      outline:none;
    }
    .front-edit-html:focus,
    .front-edit-field input:focus,
    .front-edit-field textarea:focus{
      border-color:rgba(177,18,53,.45);
      box-shadow:0 0 0 4px rgba(177,18,53,.10);
    }
    .front-edit-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:14px}
    .front-edit-btn{
      border:0;
      border-radius:999px;
      padding:12px 14px;
      background:var(--ink,#191210);
      color:white;
      font:900 12px var(--body,system-ui,sans-serif);
      cursor:pointer;
    }
    .front-edit-btn.primary{background:var(--carmine,#b11235)}
    .front-edit-btn.light{background:rgba(25,18,16,.08);color:var(--ink,#191210)}
    .front-edit-msg{margin-top:10px;color:rgba(25,18,16,.60);font-size:12.5px;line-height:1.5}
    .front-edit-toast{
      position:fixed;
      left:50%;
      bottom:20px;
      transform:translateX(-50%);
      z-index:10000;
      display:none;
      max-width:min(520px,calc(100vw - 32px));
      padding:12px 15px;
      border-radius:999px;
      background:var(--ink,#191210);
      color:white;
      font:800 13px var(--body,system-ui,sans-serif);
      box-shadow:0 18px 60px rgba(25,18,16,.24);
    }
    .front-edit-toast.show{display:block}
    @media(max-width:720px){
      .front-edit-badge{transform:translate(0,-34px);padding:6px 9px}
      .front-edit-badge em{display:none}
      .front-edit-panel{right:8px;left:8px;bottom:8px;width:auto;border-radius:22px}
    }
</style>
</head>
<body>
<div aria-hidden="true" class="three-bg">
<canvas id="clarityCanvas"></canvas>
</div>
<div class="page">
<nav class="nav">
<a class="brand" data-edit="brand" data-link-edit="brand" href="#">Victoria Dury</a>
<div class="nav-mid" data-edit="navMid">Diagnostic &amp; Clarté</div>
<div class="nav-right">
<a class="nav-link" data-edit="nav_methode" data-link-edit="nav_methode" href="#method">Méthode</a>
<a class="nav-cta" data-edit="nav_test_de_clarte" data-link-edit="nav_test_de_clarte" href="#prediagnostic">Test de clarté</a>
</div>
</nav>
<section class="hero">
<div class="reveal">
<div class="eyebrow" data-edit="hero_victoria_dury_directrice_conseil"><span class="dot"></span>Victoria Dury — Directrice Conseil</div>
<h1 data-edit="heroTitle">Avant d'investir encore, vérifiez d'abord <span class="highlight">où ça bloque.</span></h1>
<p class="sub" data-edit="heroSub">
          Moins de demandes, message confus, site qui ne convertit pas :
          avant de refaire une énième action visible, commencez par identifier
          <span class="marker">la couche qui bloque vraiment</span>
          — offre, message, positionnement ou parcours.
        </p>
<div class="hero-actions">
<a class="cta" data-edit="heroCta" data-link-edit="heroCta" href="#prediagnostic">Faire le test de clarté <span>→</span></a>
<p class="micro" data-edit="hero_3_minutes_gratuit_resultat_personnalise_puis_">3 minutes · Gratuit · Résultat personnalisé · puis paiement direct 290 €</p>
</div>
</div>
<div class="reveal">
<div aria-label="Dossier ouvert de diagnostic" class="case-board" id="caseBoard">
<div class="board-top" data-edit="hero_dossier_ouvert_enquete_strategique">
<span>Dossier ouvert</span>
<span>Enquête stratégique</span>
</div>
<div class="paper-layer paper-a"></div>
<div class="paper-layer paper-b"></div>
<div class="paper-layer paper-c"></div>
<div class="paper-layer paper-d"></div>
<svg class="thread-svg" preserveaspectratio="none" viewbox="0 0 620 720">
<path class="thread soft" d="M115 158 C250 176 345 156 505 176"></path>
<path class="thread soft" d="M500 208 C390 255 300 292 230 360"></path>
<path class="thread" d="M230 392 C315 450 398 414 505 390"></path>
<path class="thread" d="M502 430 C408 506 310 536 160 582"></path>
<path class="thread" d="M185 594 C295 636 388 625 488 584"></path>
</svg>
<div class="evidence big ev1" data-edit="hero_moins_de_prospects_symptome_visible"><strong>Moins de prospects</strong><span>symptôme visible</span></div>
<div class="evidence false ev2" data-edit="hero_le_site_hypothese_eliminee"><strong>Le site ?</strong><span>hypothèse éliminée</span></div>
<div class="evidence false ev3" data-edit="hero_la_campagne_fausse_piste"><strong>La campagne ?</strong><span>fausse piste</span></div>
<div class="evidence ev4" data-edit="hero_message_confus_indice_fort"><strong>Message confus</strong><span>indice fort</span></div>
<div class="evidence ev5" data-edit="hero_offre_peu_lisible_cause_probable"><strong>Offre peu lisible</strong><span>cause probable</span></div>
<div class="evidence result big ev6" data-edit="hero_3_priorites_decision_claire"><strong>3 priorités</strong><span>décision claire</span></div>
<div class="stamp" data-edit="hero_cause_trouvee">Cause trouvée</div>
</div>
<div class="hero-offer">
<div>
<small data-edit="hero_etape_1">Étape 1</small>
<div class="offer-name" data-edit="heroOfferName">Test de clarté gratuit</div>
</div>
<p class="offer-text" data-edit="heroOfferText">Un test rapide pour vérifier si vous êtes en train de corriger le bon problème.</p>
<div class="offer-price" data-edit="heroOfferPrice">0 €</div>
</div>
</div>
</section>
<section class="proof">
<div class="liquid proof-item reveal">
<div class="stat" data-edit="proof_40">+40</div>
<p data-edit="proof_situations_clarifiees_offre_message_positionn">situations clarifiées : offre, message, positionnement, site ou parcours d’achat.</p>
</div>
<div class="liquid proof-item reveal">
<p class="quote" data-edit="proof_on_pensait_avoir_un_probleme_de_site_victoria">“On pensait avoir un problème de site. Victoria nous a aidés à voir que le vrai sujet, c'était notre offre.”</p>
<p class="byline" data-edit="proof_sophie_m_directrice_marketing_pme_industriell">Sophie M. — Directrice Marketing, PME industrielle, Lyon</p>
</div>
<div class="liquid proof-item reveal">
<p class="kicker" data-edit="proof_autorite">Autorité</p>
<p data-edit="proof_une_methode_pour_eviter_de_poser_du_design_du">Une méthode pour éviter de poser du design, du contenu ou du budget sur une offre encore floue.</p>
</div>
</section>
<section class="statement">
<h2 class="reveal" data-edit="statement_votre_probleme_visible_n_est_peut_etre_qu_un_">Votre problème visible n’est peut-être qu’un <span class="highlight">symptôme</span>.<br/>Le test de clarté sert à vérifier.</h2>
</section>
<section class="prequiz" id="prediagnostic">
<div class="prequiz-head reveal">
<p class="kicker" data-edit="quiz_test_de_clarte_gratuit">Test de clarté gratuit</p>
<h2 data-edit="quizTitle">Répondez à 5 questions. Voyez si vous regardez le bon problème.</h2>
<p class="lede" data-edit="quiz_ce_n_est_pas_un_formulaire_de_contact_c_est_u">
          Ce n’est pas un formulaire de contact. C’est un filtre stratégique.
          Vous avancez question par question, on élimine les fausses pistes,
          puis vous accédez à un paiement du Diagnostic Express à 290 € si le sujet mérite d’être creusé.
        </p>
<div aria-hidden="true" class="quiz-orbit" data-edit="quiz_site_message_offre_parcours">
<span class="orbit-center">?</span>
<span class="orbit-pill p1">site</span>
<span class="orbit-pill p2">message</span>
<span class="orbit-pill p3">offre</span>
<span class="orbit-pill p4">parcours</span>
</div>
</div>
<form class="quiz liquid reveal" id="growthQuiz">
<div class="quiz-progress">
<span data-edit="quiz_question_1_5">Question <strong id="quizCurrent">1</strong>/5</span>
<div><i id="quizBar"></i></div>
</div>
<div class="diagnostic-pulse" data-edit="quiz_hypothese_en_cours_on_commence_par_le_symptom" id="diagnosticPulse">
<span>Hypothèse en cours</span>
<strong id="diagnosticHint">On commence par le symptôme visible.</strong>
</div>
<fieldset class="quiz-step active" data-step="1">
<legend data-edit="quiz_quel_signal_vous_inquiete_le_plus_aujourd_hui">Quel signal vous inquiète le plus aujourd’hui ?</legend>
<label><input name="signal" required="" type="radio" value="prospects"/><span data-edit="quiz_option_moins_de_prospects_ou_de_demandes_qualifiees">Moins de prospects ou de demandes qualifiées</span> </label>
<label><input name="signal" type="radio" value="message"/><span data-edit="quiz_option_un_message_difficile_a_expliquer_simplement">Un message difficile à expliquer simplement</span> </label>
<label><input name="signal" type="radio" value="conversion"/><span data-edit="quiz_option_un_site_ou_des_contenus_qui_ne_convertissent_">Un site ou des contenus qui ne convertissent pas</span> </label>
<label><input name="signal" type="radio" value="dispersion"/><span data-edit="quiz_option_beaucoup_d_actions_peu_de_resultats_lisibles">Beaucoup d’actions, peu de résultats lisibles</span> </label>
</fieldset>
<fieldset class="quiz-step" data-step="2">
<legend data-edit="quiz_quand_vous_expliquez_votre_offre_que_se_passe">Quand vous expliquez votre offre, que se passe-t-il le plus souvent ?</legend>
<label><input name="offre" required="" type="radio" value="simple"/><span data-edit="quiz_option_les_gens_comprennent_vite">Les gens comprennent vite</span> </label>
<label><input name="offre" type="radio" value="long"/><span data-edit="quiz_option_il_faut_beaucoup_contextualiser">Il faut beaucoup contextualiser</span> </label>
<label><input name="offre" type="radio" value="variable"/><span data-edit="quiz_option_le_discours_change_selon_l_interlocuteur">Le discours change selon l’interlocuteur</span> </label>
<label><input name="offre" type="radio" value="confus"/><span data-edit="quiz_option_meme_en_interne_ce_n_est_pas_parfaitement_cla">Même en interne, ce n’est pas parfaitement clair</span> </label>
</fieldset>
<fieldset class="quiz-step" data-step="3">
<legend data-edit="quiz_qu_avez_vous_deja_essaye_de_corriger">Qu’avez-vous déjà essayé de corriger ?</legend>
<label><input name="actions" type="checkbox" value="site"/><span data-edit="quiz_option_refaire_ou_modifier_le_site">Refaire ou modifier le site</span> </label>
<label><input name="actions" type="checkbox" value="contenus"/><span data-edit="quiz_option_refaire_les_contenus_ou_les_posts">Refaire les contenus ou les posts</span> </label>
<label><input name="actions" type="checkbox" value="ads"/><span data-edit="quiz_option_relancer_une_campagne_ou_mettre_du_budget">Relancer une campagne ou mettre du budget</span> </label>
<label><input name="actions" type="checkbox" value="offre"/><span data-edit="quiz_option_repackager_l_offre">Repackager l’offre</span> </label>
<label><input name="actions" type="checkbox" value="rien"/><span data-edit="quiz_option_rien_de_structure_pour_l_instant">Rien de structuré pour l’instant</span> </label>
</fieldset>
<fieldset class="quiz-step" data-step="4">
<legend data-edit="quiz_a_quel_point_etes_vous_sur_du_vrai_probleme">À quel point êtes-vous sûr du vrai problème ?</legend>
<label><input name="certitude" required="" type="radio" value="faible"/><span data-edit="quiz_option_pas_vraiment_sur_justement">Pas vraiment sûr, justement</span> </label>
<label><input name="certitude" type="radio" value="moyenne"/><span data-edit="quiz_option_j_ai_une_hypothese_mais_peu_de_preuves">J’ai une hypothèse, mais peu de preuves</span> </label>
<label><input name="certitude" type="radio" value="forte"/><span data-edit="quiz_option_je_pense_savoir_mais_je_veux_confirmer">Je pense savoir, mais je veux confirmer</span> </label>
<label><input name="certitude" type="radio" value="urgent"/><span data-edit="quiz_option_je_dois_decider_vite_ou_investir">Je dois décider vite où investir</span> </label>
</fieldset>
<fieldset class="quiz-step" data-step="5">
<legend data-edit="quiz_ou_voulez_vous_recevoir_la_suite">Où voulez-vous recevoir la suite ?</legend>
<div class="quiz-fields">
<label><input autocomplete="given-name" name="prenom" placeholder="Victoria" required="" type="text"/><span data-edit="quiz_option_prenom">Prénom</span> 
</label>
<label><input autocomplete="email" name="email" placeholder="vous@entreprise.fr" required="" type="email"/><span data-edit="quiz_option_email_professionnel">Email professionnel</span> 
</label>
<label>Site ou LinkedIn <span data-edit="quiz_facultatif">facultatif</span>
<input name="url" placeholder="https://" type="url"/>
</label>
</div>
<p class="quiz-note" data-edit="quiz_apres_validation_votre_resultat_s_affiche_dir">Après validation, votre résultat s’affiche directement. Le Diagnostic Express devient la suite si vous voulez confirmer l’hypothèse.</p>
</fieldset>
<div aria-live="polite" class="quiz-result" id="quizResult"></div>
<div class="result-cta" id="resultCta">
<div data-edit="quiz_suite_logique_diagnostic_express_290_60_minut">
<small>Suite logique</small>
<strong>Diagnostic Express — 290 €</strong>
<span>60 minutes + restitution claire pour confirmer la cause probable et prioriser les prochaines actions.</span>
</div>
<a class="cta" data-edit="offerCta" data-link-edit="offerCta" href="#">Réserver mon Diagnostic Express <span>→</span></a>
</div>
<div class="quiz-actions">
<button class="quiz-back" data-edit="quiz_retour" id="quizBack" type="button">← Retour</button>
<button class="cta quiz-next" data-edit="quiz_continuer" id="quizNext" type="button">Continuer →</button>
<button class="cta quiz-submit" data-edit="quiz_voir_mon_resultat" id="quizSubmit" type="submit">Voir mon résultat →</button>
</div>
<p class="quiz-privacy" data-edit="quiz_vos_reponses_servent_uniquement_a_preparer_l_">Vos réponses servent uniquement à préparer l’échange. Pas d’abonnement, pas de relance automatique déguisée en relation humaine.</p>
</form>
</section>
<section class="chapter split">
<div class="reveal">
<p class="kicker" data-edit="problem_avant_de_corriger">Avant de corriger</p>
<h2 data-edit="problem_ne_corrigez_pas_encore_identifiez_la_bonne_co">Ne corrigez pas encore. Identifiez la bonne couche.</h2>
<p class="lede" data-edit="problem_le_reflexe_classique_refaire_ce_qui_se_voit_l">
          Le réflexe classique : refaire ce qui se voit. Le site, les messages,
          les posts, la campagne. Le risque : améliorer la surface pendant que le vrai blocage reste intact.
        </p>
<p class="risk" data-edit="problem_la_cause_est_souvent_ailleurs">La cause est souvent ailleurs.</p>
</div>
<div class="symptoms reveal">
<div class="symptom" data-edit="problem_les_prospects_qualifies_se_font_plus_rares_sy"><strong>Les prospects qualifiés se font plus rares.</strong><span>symptôme</span></div>
<div class="symptom" data-edit="problem_votre_offre_est_difficile_a_expliquer_symptom"><strong>Votre offre est difficile à expliquer.</strong><span>symptôme</span></div>
<div class="symptom" data-edit="problem_votre_site_ou_vos_contenus_ne_prennent_pas_sy"><strong>Votre site ou vos contenus ne prennent pas.</strong><span>symptôme</span></div>
<div class="symptom" data-edit="problem_vous_faites_beaucoup_pour_peu_d_effet_symptom"><strong>Vous faites beaucoup, pour peu d'effet.</strong><span>symptôme</span></div>
</div>
</section>
<section class="method" id="method">
<div class="reveal">
<p class="kicker" data-edit="method_le_travail">Le travail</p>
<h2 data-edit="method_le_diagnostic_commence_avant_la_solution">Le diagnostic commence avant la solution.</h2>
<p data-edit="method_vous_arrivez_avec_un_symptome_nous_cherchons_">
          Vous arrivez avec un symptôme. Nous cherchons les preuves.
          Nous éliminons les fausses pistes. Nous remontons les causes.
          Nous identifions la décision la plus utile.
          <span class="marker">Puis seulement, on décide où investir.</span>
</p>
</div>
<div class="timeline reveal">
<div class="step">
<div class="num">01</div>
<div data-edit="method_vous_reservez_vous_choisissez_votre_creneau_e"><strong>Vous réservez</strong><span>Vous choisissez votre créneau et remplissez un court formulaire.</span></div>
</div>
<div class="step">
<div class="num">02</div>
<div data-edit="method_je_prepare_j_analyse_votre_site_votre_offre_v"><strong>Je prépare</strong><span>J'analyse votre site, votre offre, votre LinkedIn ou vos supports.</span></div>
</div>
<div class="step">
<div class="num">03</div>
<div data-edit="method_on_echange_60_minutes_structurees_sur_les_sym"><strong>On échange</strong><span>60 minutes structurées sur les symptômes, contraintes et tests déjà faits.</span></div>
</div>
<div class="step">
<div class="num">04</div>
<div data-edit="method_vous_recevez_une_restitution_loom_ou_pdf_avec"><strong>Vous recevez</strong><span>Une restitution Loom ou PDF avec la cause probable et vos 3 priorités.</span></div>
</div>
</div>
</section>
<section class="offer" id="reservation">
<div class="offer-layout">
<div class="price-panel reveal">
<div>
<p class="kicker" data-edit="offer_suite_possible" style="color:rgba(255,255,255,.72)">Suite possible</p>
<h2 data-edit="offerTitle">Diagnostic Express</h2>
<div class="price" data-edit="offerPrice">290 €</div>
<p class="price-line" data-edit="offerLine">60 minutes.<br/>Une hypothèse solide.<br/>Trois priorités.</p>
</div>
<div>
<a class="cta" data-edit="offer_reserver_mon_diagnostic_express" data-link-edit="offer_reserver_mon_diagnostic_express" href="#">Réserver mon Diagnostic Express <span>→</span></a>
<p class="micro" data-edit="offer_paiement_unique_pas_d_abonnement_restitution_">Paiement unique · Pas d’abonnement · Restitution claire</p>
</div>
</div>
<div class="offer-list reveal">
<div class="liquid detail" data-edit="offer_la_cause_la_plus_probable_formulee_clairement"><strong>La cause la plus probable</strong><span>Formulée clairement, à partir des indices et des preuves disponibles.</span></div>
<div class="liquid detail" data-edit="offer_les_points_de_friction_identifies_sur_votre_o"><strong>Les points de friction identifiés</strong><span>Sur votre offre, votre message, votre positionnement ou votre parcours.</span></div>
<div class="liquid detail" data-edit="offer_vos_3_priorites_concretes_dans_le_bon_ordre_a"><strong>Vos 3 priorités concrètes</strong><span>Dans le bon ordre, avec la logique derrière chaque choix.</span></div>
<div class="liquid detail" data-edit="offer_une_suite_seulement_si_utile_si_le_sujet_est_"><strong>Une suite seulement si utile</strong><span>Si le sujet est plus simple que prévu, inutile de vendre une usine à gaz. Concept audacieux, visiblement.</span></div>
</div>
</div>
</section>
<section class="about">
<div aria-label="Emplacement photo éditoriale" class="photo liquid reveal" data-image-edit="aboutImage"></div>
<div class="about-copy liquid reveal">
<p class="kicker" data-edit="about_a_propos">À propos</p>
<h2 data-edit="about_une_approche_construite_sur_une_observation_s">Une approche construite sur une observation simple.</h2>
<p data-edit="about_je_suis_victoria_dury_directrice_conseil_pend">Je suis Victoria Dury, Directrice Conseil. Pendant des années, j'ai travaillé sur des missions qui semblaient parler de site, de message ou de communication.</p>
<p data-edit="about_tres_souvent_le_vrai_sujet_etait_ailleurs_une">Très souvent, le vrai sujet était ailleurs : une offre devenue confuse, une hypothèse de marché jamais revalidée, une différence mal formulée.</p>
<p data-edit="about_j_ai_donc_recentre_mon_travail_sur_cette_etap"><strong>J'ai donc recentré mon travail sur cette étape-là : comprendre avant de corriger.</strong></p>
</div>
</section>
<section class="faq">
<p class="kicker reveal" data-edit="faq_questions">Questions</p>
<h2 class="reveal" data-edit="faq_faq">FAQ</h2>
<details class="reveal">
<summary data-edit="faq_pourquoi_commencer_par_un_test_de_clarte_grat">Pourquoi commencer par un test de clarté gratuit ?</summary>
<p data-edit="faq_parce_qu_avant_de_parler_d_offre_de_site_ou_d">Parce qu’avant de parler d’offre, de site ou de budget, il faut vérifier que le problème mérite bien un diagnostic. Le test de clarté sert à qualifier votre situation et à éviter de partir sur la mauvaise piste.</p>
</details>
<details class="reveal">
<summary data-edit="faq_que_se_passe_t_il_apres_le_quiz">Que se passe-t-il après le quiz ?</summary>
<p data-edit="faq_vous_voyez_un_resultat_personnalise_si_vous_v">Vous voyez un résultat personnalisé. Si vous voulez confirmer la cause probable et repartir avec vos priorités, vous pouvez réserver directement le Diagnostic Express à 290 €.</p>
</details>
<details class="reveal">
<summary data-edit="faq_faut_il_deja_avoir_un_site">Faut-il déjà avoir un site ?</summary>
<p data-edit="faq_non_le_point_de_depart_peut_etre_une_offre_un">Non. Le point de départ peut être une offre, un discours commercial, une page LinkedIn, une baisse de demandes ou une impression générale de flou.</p>
</details>
<details class="reveal">
<summary data-edit="faq_et_si_mon_probleme_est_plus_strategique_que_p">Et si mon problème est plus stratégique que prévu ?</summary>
<p data-edit="faq_je_vous_le_dirai_clairement_le_but_n_est_pas_">Je vous le dirai clairement. Le but n’est pas d’empiler des prestations, mais de comprendre quelle décision doit venir ensuite.</p>
</details>
</section>
<section class="final">
<div class="final-inner">
<h2 class="reveal" data-edit="finalTitle">Avant de refaire votre site, vérifiez que c'est bien <span class="highlight">le problème.</span></h2>
<p class="reveal" data-edit="finalText">Commencez par le test de clarté. En quelques questions, vous vérifiez si votre blocage vient plutôt de l’offre, du message, du positionnement ou du parcours.</p>
<a class="cta reveal" data-edit="finalCta" data-link-edit="finalCta" href="#">Réserver mon Diagnostic Express <span>→</span></a>
<p class="micro reveal" data-edit="final_3_minutes_gratuit_resultat_personnalise_puis_">3 minutes · Gratuit · Résultat personnalisé · puis paiement direct 290 €</p>
</div>
</section>
<section class="offer-comparison" id="comparatif-offres">
<div class="comparison-inner">
<div class="comparison-head">
<div class="reveal">
<p class="kicker" data-edit="comparison_les_trois_offres">Les trois offres</p>
<h2 data-edit="comparison_trois_niveaux_d_intervention_une_seule_logiqu">Trois niveaux d’intervention. Une seule logique : clarifier avant d’agir.</h2>
</div>
<p class="lede reveal" data-edit="comparison_le_quiz_reste_un_outil_d_entree_gratuit_les_o">
            Le quiz reste un outil d’entrée gratuit. Les offres payantes montent en profondeur :
            diagnostic rapide, diagnostic complet, puis formation de l’équipe. Simple. Presque suspect,
            tant c’est rare.
          </p>
</div>
<div class="comparison-table-wrap reveal">
<table aria-label="Comparatif des outils et livrables inclus dans les trois offres" class="comparison-table" data-offer-table="">
<thead>
<tr>
<th>Outils &amp; livrables</th>
<th>
<div class="offer-col" data-edit="comparison_offre_d_appel_diagnostic_express_290">
<small>Offre d’appel</small>
<strong>Diagnostic Express</strong>
<span>290 €</span>
</div>
</th>
<th>
<div class="offer-col" data-edit="comparison_offre_complete_diagnostic_de_croissance_990">
<small>Offre complète</small>
<strong>Diagnostic de Croissance</strong>
<span>990 €</span>
</div>
</th>
<th>
<div class="offer-col" data-edit="comparison_offre_premium_formation_clarte_4_990">
<small>Offre premium</small>
<strong>Formation Clarté</strong>
<span>4 990 €</span>
</div>
</th>
</tr>
</thead>
<tbody><tr><td class="tool-name">Positionnement</td><td data-bool="offerTool_0_0"><span class="check">✓</span></td><td data-bool="offerTool_0_1"><span class="check">✓</span></td><td data-bool="offerTool_0_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Différenciation</td><td data-bool="offerTool_1_0"><span class="check">✓</span></td><td data-bool="offerTool_1_1"><span class="check">✓</span></td><td data-bool="offerTool_1_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Message &amp; promesse</td><td data-bool="offerTool_2_0"><span class="check">✓</span></td><td data-bool="offerTool_2_1"><span class="check">✓</span></td><td data-bool="offerTool_2_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Analyse concurrentielle</td><td data-bool="offerTool_3_0"><span class="dash">×</span></td><td data-bool="offerTool_3_1"><span class="check">✓</span></td><td data-bool="offerTool_3_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">SWOT</td><td data-bool="offerTool_4_0"><span class="dash">×</span></td><td data-bool="offerTool_4_1"><span class="check">✓</span></td><td data-bool="offerTool_4_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Étude de marché légère</td><td data-bool="offerTool_5_0"><span class="dash">×</span></td><td data-bool="offerTool_5_1"><span class="check">✓</span></td><td data-bool="offerTool_5_2"><span class="dash">×</span></td></tr>
<tr><td class="tool-name">Rapport LinkedIn à mettre à jour</td><td data-bool="offerTool_6_0"><span class="dash">×</span></td><td data-bool="offerTool_6_1"><span class="check">✓</span></td><td data-bool="offerTool_6_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Rapport Google Business Profile à mettre à jour</td><td data-bool="offerTool_7_0"><span class="dash">×</span></td><td data-bool="offerTool_7_1"><span class="check">✓</span></td><td data-bool="offerTool_7_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Création d’une landing page statique</td><td data-bool="offerTool_8_0"><span class="dash">×</span></td><td data-bool="offerTool_8_1"><span class="check">✓</span></td><td data-bool="offerTool_8_2"><span class="dash">×</span></td></tr>
<tr><td class="tool-name">Rapport de clarté</td><td data-bool="offerTool_9_0"><span class="check">✓</span></td><td data-bool="offerTool_9_1"><span class="check">✓</span></td><td data-bool="offerTool_9_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Plan d’action priorisé</td><td data-bool="offerTool_10_0"><span class="check">✓</span></td><td data-bool="offerTool_10_1"><span class="check">✓</span></td><td data-bool="offerTool_10_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Restitution Loom ou PDF</td><td data-bool="offerTool_11_0"><span class="check">✓</span></td><td data-bool="offerTool_11_1"><span class="check">✓</span></td><td data-bool="offerTool_11_2"><span class="dash">×</span></td></tr>
<tr><td class="tool-name">Atelier équipe</td><td data-bool="offerTool_12_0"><span class="dash">×</span></td><td data-bool="offerTool_12_1"><span class="dash">×</span></td><td data-bool="offerTool_12_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Support de formation</td><td data-bool="offerTool_13_0"><span class="dash">×</span></td><td data-bool="offerTool_13_1"><span class="dash">×</span></td><td data-bool="offerTool_13_2"><span class="check">✓</span></td></tr>
<tr><td class="tool-name">Méthode transmise à l’équipe</td><td data-bool="offerTool_14_0"><span class="dash">×</span></td><td data-bool="offerTool_14_1"><span class="dash">×</span></td><td data-bool="offerTool_14_2"><span class="check">✓</span></td></tr></tbody>
</table>
</div>
<div class="comparison-cta reveal">
<p data-edit="comparison_le_bon_point_d_entree_reste_le_diagnostic_exp"><strong>Le bon point d’entrée reste le Diagnostic Express.</strong> Il confirme la cause probable avant de partir sur une offre plus large ou une formation.</p>
<a class="cta" data-edit="comparison_reserver_mon_diagnostic_express" data-link-edit="comparison_reserver_mon_diagnostic_express" href="#">Réserver mon Diagnostic Express <span>→</span></a>
</div>
</div>
</section>
<?php include __DIR__ . '/includes/site-footer.php'; ?>
</div>
<script type="module">
    import * as THREE from "https://unpkg.com/three@0.160.0/build/three.module.js";

    const canvas = document.getElementById("clarityCanvas");

    if (canvas) {
      const renderer = new THREE.WebGLRenderer({
        canvas,
        alpha:true,
        antialias:true
      });

      renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.45));

      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(45, 1, 0.1, 100);
      camera.position.z = 6.2;

      const group = new THREE.Group();
      scene.add(group);

      const textureLoader = new THREE.TextureLoader();
      const logoTexture = textureLoader.load("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAA4QAAAOECAYAAAD5Tv87AAEAAElEQVR4nOz9e3Rd53nneX6fd+99DgACBEESpG6WbJlWEtJ3ULbjOCFZKXc5Ll8rBqsqqVtmdcfzx6yke1XNrNXTUw2ip3tm1qxZ06unVneVU1WdrkpVLkQcy/K1K45FJo4j24JtOSJtSzQt6i6CJAjies7Z7/vMH/scEKRIiZJIAufw91mmRQKbB3sDIM7+ned9nwdEREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREREROQa2HqfgIiIiNw0N+x539v/PXSVj3GICaY4bqOcfsn7H2fBxm7UiV2DaeA+Bv1K75thhwMcY+ol7z8EftnFXPExRERERERERERENhxVCEVE5Gay611CMaqyzCGwPYzfsOe1UU7bjapknWTZAAZpGrt23YCPAAsnnvJRRtMMRx3GOcZp29Oufr0eo5y2GXb4OFPJbsEK2WHGs87vZzkZ3rBrNFx87wk4AQvUfJZ+v49B71Qcx5nyQ1xSZbzlPncisjEoEIqISMeNfk7QDW/vs4fYlw2xYFAtxeyoMZiNbGsVeRnyJS+tsOUE4KmWZf0hr6UyNDzd1PuS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E8Cw3Kt2GDl4CBau2xFqRIz8JRXGNY8Fawe9GkbCKb29kI6ioXSPHK/1WaSOcd7yfitNxxEiIpuc3shF5EesCXo+wcQrbrZ26OkwZwzge8zbCHCKJRugaQA/ZDA9w4AfAmY45g9UVcW2s8Cpy923RxnNgOwQh5rGRPrC0MjgHGF/MB9OTh6MPOChcGLNw3BhvCXA9YC7eW5OSBaaQCzd986k5m0Ro8DTy61u6ngAi+0SY2t4aXD3uhkZmocoXcLAk5PPO40MM3OeTZkvr/d+iYjIG6MDGRF5o+ylNbIjL3lvOVKN57y4jOgV9vE9e3p2z+2uz8fetBzOeU8qDIbJlhcbKWYDWcx7ambenu8UrUg5yYq81l8z76sBTavuRuluJW4R8xK3mtEXLAyYkyUjj0ZRYFusTDdivjM5jWo46488DCIdJ5gXwUNfMAtN96/n5cInDl84cRZWG9On9d5HERF5bRQIReSaWDP/jynGQvvydluMtdsO0LTn99xot7Z+fgK4FZg5PZOGGU5HgUPAFubtFHvT4Wrxm2vG3e1zO37iBuLyzryMjRrVOFWRThcspeUUGh499Fn92ZWZx35wuDUPuT23d733UUREXhsFQhHZqF7u/WnDHGw62FFG4/eY1/uodJWLqxJXKxKv796IiMgbpTmEIrJRvWz4e0kLiPZGNsXYywazc5wKI6/wB06xZAP7bvmxgW7XyZl0ir0JpjjOqB0CjnIsGSQ4VrzqvRDpWJff21REREREREREREQ2GA11EhF5dWvfK31tW4712R2R9XWk+ueyW8+IiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiIiGxy/38/OwdC+XF5RQAAAABJRU5ErkJggg==");
      logoTexture.colorSpace = THREE.SRGBColorSpace;
      logoTexture.anisotropy = 8;

      const logoMaterial = new THREE.MeshBasicMaterial({
        map: logoTexture,
        transparent: true,
        opacity: 0.105,
        depthWrite: false,
        depthTest: false
      });

      const logoGeometry = new THREE.PlaneGeometry(3.35, 3.35, 1, 1);
      const logoMesh = new THREE.Mesh(logoGeometry, logoMaterial);
      logoMesh.position.set(1.55, 0.05, -0.65);
      group.add(logoMesh);

      // Halo très discret derrière le logo : donne de la présence sans gêner la lecture.
      const haloGeometry = new THREE.PlaneGeometry(4.7, 4.7, 1, 1);
      const haloMaterial = new THREE.MeshBasicMaterial({
        color: 0xb11235,
        transparent: true,
        opacity: 0.018,
        depthWrite: false,
        depthTest: false
      });
      const halo = new THREE.Mesh(haloGeometry, haloMaterial);
      halo.position.set(1.55, 0.05, -0.82);
      group.add(halo);

      let mouseX = 0;
      let mouseY = 0;

      window.addEventListener("pointermove", (event) => {
        mouseX = (event.clientX / window.innerWidth - .5) * .28;
        mouseY = (event.clientY / window.innerHeight - .5) * .20;
      }, { passive:true });

      function resize(){
        const width = window.innerWidth;
        const height = window.innerHeight;
        renderer.setSize(width, height, false);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
      }

      window.addEventListener("resize", resize);
      resize();

      const clock = new THREE.Clock();

      function animate(){
        const time = clock.getElapsedTime();
        const maxScroll = document.body.scrollHeight - window.innerHeight;
        const scroll = maxScroll > 0 ? window.scrollY / maxScroll : 0;

        const scrollWaveX = Math.sin(scroll * Math.PI * 2) * .22;
        const scrollWaveY = Math.cos(scroll * Math.PI * 1.55) * .12;
        const breathing = 1 + Math.sin(time * .65) * .028;

        group.position.x = scrollWaveX;
        group.position.y = scrollWaveY;
        group.rotation.x = mouseY + Math.sin(time * .18) * .018;
        group.rotation.y = mouseX + Math.sin(time * .14) * .030;
        group.rotation.z = Math.sin(time * .11) * .018 + scroll * .10;

        logoMesh.rotation.z = Math.sin(time * .16) * .035 - scroll * .08;
        logoMesh.scale.setScalar(breathing + scroll * .10);
        logoMaterial.opacity = 0.078 + Math.sin(time * .55) * .009;

        halo.rotation.z = -logoMesh.rotation.z * .7;
        halo.scale.setScalar(1.03 + Math.sin(time * .48) * .035);
        haloMaterial.opacity = 0.012 + Math.sin(time * .42) * .004;

        renderer.render(scene, camera);
        requestAnimationFrame(animate);
      }

      animate();
    }
  </script>
<script>
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
        quizResult.innerHTML = `<strong>${label}</strong><br>${message}<br><br><span class="marker">Prochaine étape : vérifier cette hypothèse en paiement du Diagnostic Express à 290 €.</span>`;
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
  </script>
<button class="admin-toggle" data-edit="page_modifier" id="adminToggle" type="button">Modifier</button>
<aside aria-label="Panneau d’édition" class="admin-panel collapsed" id="adminPanel">
<div class="admin-head">
<div data-edit="page_mode_edition_modifiez_les_textes_liens_images">
<strong>Mode édition</strong>
<span>Modifiez les textes, liens, images et cases du tableau. Les changements publics passent par api.php et sont chargés depuis la BDD.</span>
</div>
<button class="admin-close" id="adminClose" type="button">×</button>
</div>
<div class="admin-tabs">
<button class="admin-tab active" data-admin-tab="texts" data-edit="page_textes" type="button">Textes</button>
<button class="admin-tab" data-admin-tab="links" data-edit="page_liens" type="button">Liens</button>
<button class="admin-tab" data-admin-tab="images" data-edit="page_images" type="button">Images</button>
<button class="admin-tab" data-admin-tab="booleans" data-edit="page_tableau" type="button">Tableau</button>
<button class="admin-tab" data-admin-tab="export" data-edit="page_export" type="button">Export</button>
</div>
<div class="admin-section active" data-admin-section="texts">
<div id="adminTextFields"></div>
</div>
<div class="admin-section" data-admin-section="links">
<div class="admin-field">
<label for="adminCheckout">Lien paiement Diagnostic Express</label>
<input id="adminCheckout" placeholder="https://buy.stripe.com/..." type="url">
</input></div>
<div class="admin-field">
<label for="adminHeroCtaLink">Lien CTA hero</label>
<input id="adminHeroCtaLink" placeholder="#prediagnostic" type="text">
</input></div>
</div>
<div class="admin-section" data-admin-section="images">
<div id="adminImageFields"></div>
</div>
<div class="admin-section" data-admin-section="booleans">
<p class="admin-help" data-edit="page_cochez_decochez_les_inclusions_du_tableau">Cochez / décochez les inclusions du tableau.</p>
<div class="admin-bool-grid" id="adminBoolFields"></div>
</div>
<div class="admin-section" data-admin-section="export">
<div class="admin-actions">
<button class="admin-btn carmine" data-edit="page_sauver_local" id="adminSave" type="button">Sauver local</button>
<button class="admin-btn secondary" data-edit="page_reinitialiser" id="adminReset" type="button">Réinitialiser</button>
<button class="admin-btn" data-edit="page_copier_json" id="adminCopyJson" type="button">Copier JSON</button>
<button class="admin-btn" data-edit="page_copier_url" id="adminCopyUrl" type="button">Copier URL</button>
</div>
<textarea class="admin-output" id="adminOutput" placeholder="Export JSON ou URL générée"></textarea>
<div class="admin-field">
<label for="adminImport">Importer JSON</label>
<textarea id="adminImport" placeholder='{"texts":{...},"links":{...},"images":{...},"booleans":{...}}'></textarea>
</div>
<button class="admin-btn carmine" data-edit="page_importer" id="adminApplyImport" type="button">Importer</button>
<p class="admin-help">Mode admin : <code>#admin</code> ou <code>?admin=1&amp;key=victoria</code>. Version partageable : <code>?data=...</code>.</p>
</div>
</aside>
<script>
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
  </script>
<script>
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
  </script>

<script>
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
        button.innerHTML = '<span aria-hidden="true">✎</span><em>Éditer</em>';
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
          button.style.display = "none";
          return;
        }
        const rect = target.getBoundingClientRect();
        button.style.display = "inline-flex";
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
      toast("Mode édition front actif.");
    }

    ready(init);
  })();
</script>

</body>
</html>
