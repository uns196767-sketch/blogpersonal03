<?php
  include("secciones/perfil.php");
  include("secciones/trayectoria.php");
  include("secciones/proyectos.php");
  include("secciones/campus.php");
  include("secciones/contacto.php");

  $meses = ["enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre"];
  date_default_timezone_set("America/Lima");
  $hoy = date("j") . " de " . $meses[(int)date("n") - 1] . " de " . date("Y");

  function e($t) { return htmlspecialchars($t, ENT_QUOTES, "UTF-8"); }
  function foto($url, $alt, $respaldo) {
    return '<img src="' . e($url) . '" alt="' . e($alt) . '" loading="lazy" referrerpolicy="no-referrer"' .
           ' onerror="this.onerror=null;this.src=\'' . e($respaldo) . '\';">';
  }
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Blog personal de <?php echo e($perfil["nombre"]." ".$perfil["apellido"]); ?> — 5 años de Ingeniería de Sistemas e Informática en la Universidad Nacional del Santa.">
    <meta name="author" content="<?php echo e($perfil["nombre"]." ".$perfil["apellido"]); ?>">
    <title><?php echo e($perfil["nombre"]." ".$perfil["apellido"]); ?> | Bitácora v5.0</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,800;1,9..144,400;1,9..144,600&family=IBM+Plex+Sans:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
      :root {
        --paper: #f5f0e8;
        --paper-2: #ece5d8;
        --ink: #16233d;
        --ink-2: #2e3c58;
        --muted: #6b7080;
        --sunset: #d65a3e;
        --sunset-dark: #b0452d;
        --sunset-soft: #f2b193;
        --sea: #2b7d78;
        --line: #ddd3c2;
      }
      /* Mini-grid propio (sin dependencias externas) */
      *, *::before, *::after { box-sizing: border-box; }
      body { margin: 0; line-height: 1.5; }
      h1,h2,h3,h4,p { margin-top: 0; }
      img { max-width: 100%; }
      .container { width: 100%; max-width: 1180px; margin: 0 auto; padding: 0 20px; }
      .row { display: flex; flex-wrap: wrap; margin: 0 -10px; }
      .row.no-gutters { margin: 0; }
      [class*="col-"] { position: relative; width: 100%; padding: 0 10px; }
      .no-gutters > [class*="col-"] { padding: 0; }
      .col-6 { width: 50%; }
      @media (min-width: 576px) { .col-sm-6 { width: 50%; } }
      @media (min-width: 768px) { .col-md-3 { width: 25%; } .col-md-6 { width: 50%; } .d-md-block { display: block !important; } }
      @media (min-width: 992px) { .col-lg-3 { width: 25%; } .col-lg-4 { width: 33.333%; } .col-lg-5 { width: 41.666%; } .col-lg-6 { width: 50%; } .col-lg-7 { width: 58.333%; } }
      @media (min-width: 1200px) { .col-xl-3 { width: 25%; } }
      .align-items-center { align-items: center; }
      .d-flex { display: flex; } .d-none { display: none; }
      .justify-content-between { justify-content: space-between; }
      .position-relative { position: relative; }
      .text-center { text-align: center; } .small { font-size: .8rem; }
      .mb-1 { margin-bottom: .25rem; } .mb-2 { margin-bottom: .5rem; } .mb-3 { margin-bottom: 1rem; } .mb-4 { margin-bottom: 1.5rem; } .mr-2 { margin-right: .5rem; } .pt-3 { padding-top: 1rem; }
      .btn { display: inline-block; text-decoration: none; transition: all .2s; }
      .hero .status { display: flex; width: fit-content; max-width: 100%; flex-wrap: wrap; }

      html { scroll-behavior: smooth; }
      body {
        font-family: 'IBM Plex Sans', sans-serif;
        background: var(--paper);
        color: var(--ink);
        -webkit-font-smoothing: antialiased;
      }
      .mono { font-family: 'IBM Plex Mono', monospace; }
      a { color: var(--sunset-dark); text-decoration: none; }
      a:hover { color: var(--ink); text-decoration: none; }
      ::selection { background: var(--sunset); color: #fff; }

      /* Barra superior */
      .top-bar {
        background: var(--ink); color: #c9cfdb;
        font-family: 'IBM Plex Mono', monospace; font-size: .74rem;
        padding: 7px 0; letter-spacing: .3px;
      }
      .dot { display:inline-block; width:8px; height:8px; border-radius:50%; background:#5fcf9f; margin-right:8px; box-shadow:0 0 0 0 rgba(95,207,159,.6); animation: ping 2s infinite; }
      @keyframes ping { 0%{box-shadow:0 0 0 0 rgba(95,207,159,.6)} 70%{box-shadow:0 0 0 8px rgba(95,207,159,0)} 100%{box-shadow:0 0 0 0 rgba(95,207,159,0)} }

      /* Navegación */
      .nav-main {
        position: sticky; top: 0; z-index: 50;
        background: rgba(245,240,232,.88); backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--line);
      }
      .nav-inner { display:flex; align-items:center; justify-content:space-between; flex-wrap: wrap; }
      .brand { display:flex; align-items:center; gap:10px; color: var(--ink) !important; padding: .55rem 0; text-decoration:none; }
      .brand-mark {
        width: 38px; height: 38px; border-radius: 10px; background: var(--ink); color: var(--paper);
        display:grid; place-items:center; font-family:'Fraunces',serif; font-weight:800; font-style: italic; font-size: 1.05rem;
      }
      .brand-text { font-family:'IBM Plex Mono',monospace; font-size:.85rem; line-height:1.15; }
      .brand-text small { color: var(--muted); }
      .nav-links { list-style:none; margin:0; padding:0; display:flex; }
      .nav-main .nav-link {
        display:block; text-decoration:none;
        font-family:'IBM Plex Mono',monospace; font-size:.8rem; color: var(--ink-2) !important;
        padding: .9rem .8rem !important; position: relative;
      }
      .nav-main .nav-link span { color: var(--sunset); }
      .nav-main .nav-link:hover { color: var(--sunset-dark) !important; }
      .navbar-toggler { display:none; background: transparent; border: 1px solid var(--ink); border-radius: 8px; padding: 6px 12px; cursor:pointer; font-family:'IBM Plex Mono',monospace; font-size:.8rem; color: var(--ink); }
      @media (max-width: 991px) {
        .navbar-toggler { display:block; }
        .nav-links { display:none; width:100%; flex-direction:column; padding-bottom:.6rem; }
        .nav-links.open { display:flex; }
        .nav-main .nav-link { padding: .55rem 0 !important; border-top: 1px solid var(--line); }
      }

      /* Hero */
      .hero { position: relative; padding: 4.5rem 0 3.5rem; overflow: hidden; }
      .hero::before {
        content:""; position:absolute; inset:0;
        background-image: linear-gradient(var(--line) 1px, transparent 1px), linear-gradient(90deg, var(--line) 1px, transparent 1px);
        background-size: 32px 32px; opacity:.45;
        -webkit-mask-image: radial-gradient(ellipse at 30% 40%, #000 30%, transparent 75%);
                mask-image: radial-gradient(ellipse at 30% 40%, #000 30%, transparent 75%);
      }
      .hero-years {
        position:absolute; right:-2rem; bottom:-3.5rem; font-family:'Fraunces',serif; font-weight:800;
        font-size: clamp(6rem, 16vw, 15rem); line-height:1; color: transparent; -webkit-text-stroke: 1.5px rgba(22,35,61,.08);
        pointer-events:none; white-space:nowrap;
      }
      .kicker {
        display:inline-flex; align-items:center; gap:8px; font-family:'IBM Plex Mono',monospace; font-size:.75rem;
        text-transform:uppercase; letter-spacing:1.5px; color: var(--sunset-dark);
        border:1px solid var(--sunset); padding:5px 12px; border-radius: 999px; background: rgba(214,90,62,.06);
      }
      .hero h1 {
        font-family:'Fraunces',serif; font-weight:800; font-size: clamp(3.2rem, 8vw, 6.4rem);
        line-height:.92; letter-spacing:-2px; margin: 1.2rem 0 1rem;
      }
      .hero h1 em { font-weight:400; font-style: italic; color: var(--sunset); }
      .hero .role { font-size: 1.15rem; color: var(--ink-2); font-weight: 500; }
      .hero .bio { font-size: 1.05rem; color: #3b4458; max-width: 34rem; line-height:1.65; margin: 1rem 0 1.6rem; }
      .status {
        display:inline-flex; align-items:center; font-family:'IBM Plex Mono',monospace; font-size:.8rem;
        background: var(--ink); color: #e9edf5; padding: 8px 14px; border-radius: 8px;
      }
      .status .caret { display:inline-block; width:8px; height:15px; background: var(--sunset); margin-left:8px; animation: blink 1s steps(1) infinite; }
      @keyframes blink { 50% { opacity: 0; } }
      .btn-ink { background: var(--ink); color: var(--paper); border-radius: 999px; padding: .65rem 1.4rem; font-weight:600; border:2px solid var(--ink); }
      .btn-ink:hover { background: var(--sunset); border-color: var(--sunset); color:#fff; }
      .btn-line { border:2px solid var(--ink); color: var(--ink); border-radius:999px; padding:.65rem 1.4rem; font-weight:600; }
      .btn-line:hover { background: var(--ink); color: var(--paper); }

      /* Credencial con foto */
      .badge-wrap { position: relative; display:flex; justify-content:center; padding-top: 2rem; perspective: 900px; }
      .lanyard { position:absolute; top:-4.5rem; left:50%; width: 26px; height: 7rem; transform: translateX(-50%);
        background: repeating-linear-gradient(45deg, var(--sunset) 0 8px, var(--sunset-dark) 8px 16px); border-radius: 3px; }
      .id-card {
        position: relative; width: 300px; background: #fffdf8; border-radius: 18px; padding: 18px 18px 16px;
        box-shadow: 0 30px 60px -20px rgba(22,35,61,.45), 0 0 0 1px var(--line);
        transform: rotate(3deg); transition: transform .5s cubic-bezier(.2,.8,.2,1);
      }
      .id-card:hover { transform: rotate(0deg) translateY(-6px); }
      .id-card::before { content:""; position:absolute; top:10px; left:50%; width:54px; height:9px; transform:translateX(-50%); background: var(--paper-2); border-radius: 6px; box-shadow: inset 0 1px 2px rgba(0,0,0,.15); }
      .id-head { display:flex; justify-content:space-between; align-items:center; margin: 14px 0 12px; font-family:'IBM Plex Mono',monospace; font-size:.68rem; color: var(--muted); }
      .id-head b { color: var(--ink); font-weight:600; }
      .id-photo { position:relative; border-radius: 12px; overflow:hidden; aspect-ratio: 4/5; background: var(--paper-2); }
      .id-photo img { width:100%; height:100%; object-fit: cover; object-position: center 30%; display:block; }
      .id-photo::after { content:""; position:absolute; inset:0; background: linear-gradient(180deg, transparent 60%, rgba(22,35,61,.35)); }
      .id-name { font-family:'Fraunces',serif; font-weight:800; font-size: 1.45rem; line-height:1.05; margin-top: 12px; }
      .id-name em { font-weight:400; color: var(--sunset); }
      .id-rows { font-family:'IBM Plex Mono',monospace; font-size:.7rem; color: var(--ink-2); margin-top: 8px; }
      .id-rows div { display:flex; justify-content:space-between; border-top: 1px dashed var(--line); padding: 5px 0; }
      .id-rows span:first-child { color: var(--muted); }
      .barcode { height: 30px; margin-top: 8px; background: repeating-linear-gradient(90deg, var(--ink) 0 2px, transparent 2px 4px, var(--ink) 4px 5px, transparent 5px 9px, var(--ink) 9px 12px, transparent 12px 13px); opacity:.85; }
      .sticker {
        position:absolute; right:-22px; top: 70px; width: 88px; height: 88px; border-radius: 50%;
        background: var(--sea); color: #fff; display:grid; place-items:center; text-align:center;
        font-family:'IBM Plex Mono',monospace; font-size:.62rem; line-height:1.2; transform: rotate(-12deg);
        box-shadow: 0 10px 20px -8px rgba(0,0,0,.35);
      }
      .sticker b { display:block; font-family:'Fraunces',serif; font-size: 1.6rem; font-weight:800; }

      /* Cifras */
      .stats { border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); background: var(--paper-2); }
      .stats .stat { padding: 1.5rem 1rem; border-right: 1px solid var(--line); }
      .stat:last-child { border-right: none; }
      .stat .num { font-family:'Fraunces',serif; font-weight:800; font-size: 2.6rem; line-height:1; }
      .stat .num::after { content:"."; color: var(--sunset); }
      .stat .lbl { font-family:'IBM Plex Mono',monospace; font-size:.75rem; color: var(--muted); text-transform: uppercase; letter-spacing: 1px; margin-top: 6px; }

      /* Encabezados de sección */
      section.block { padding: 5rem 0 2rem; }
      .sec-head { display:flex; align-items:flex-end; gap: 1rem; margin-bottom: 2.2rem; flex-wrap: wrap; }
      .sec-num { font-family:'IBM Plex Mono',monospace; font-size:.8rem; color: var(--sunset); border:1px solid var(--sunset); border-radius: 6px; padding: 3px 8px; }
      .sec-title { font-family:'Fraunces',serif; font-weight:800; font-size: clamp(2rem, 4vw, 2.8rem); letter-spacing: -1px; margin:0; line-height:1; }
      .sec-title em { font-weight:400; color: var(--sunset); }
      .sec-desc { color: var(--muted); max-width: 30rem; margin: 0 0 0 auto; font-size: .95rem; }

      /* Sobre mí */
      .about-tile {
        background: #fffdf8; border: 1px solid var(--line); border-radius: 14px; padding: 1.2rem 1.3rem; height: 100%;
        transition: transform .2s, border-color .2s;
      }
      .about-tile:hover { transform: translateY(-3px); border-color: var(--ink); }
      .about-tile .ic { width: 38px; height: 38px; border-radius: 10px; background: var(--paper-2); display:grid; place-items:center; font-size: 1.1rem; margin-bottom: .8rem; }
      .about-tile .lb { font-family:'IBM Plex Mono',monospace; font-size:.7rem; text-transform:uppercase; letter-spacing:1px; color: var(--muted); }
      .about-tile .vl { font-weight: 600; font-size: 1.02rem; margin-top: 2px; }

      /* Idiomas y hobbies */
      .about-more { margin-top: 1.2rem; }
      .panel { background:#fffdf8; border:1px solid var(--line); border-radius: 16px; padding: 1.4rem 1.5rem; height: 100%; }
      .panel-head { display:flex; justify-content:space-between; align-items:baseline; gap: 10px; margin-bottom: 1rem; flex-wrap: wrap; }
      .panel-head h3 { font-family:'Fraunces',serif; font-weight:600; font-size: 1.5rem; margin:0; }
      .panel-head span { font-family:'IBM Plex Mono',monospace; font-size:.72rem; color: var(--muted); }
      .langs { list-style:none; margin:0; padding:0; }
      .lang { display:grid; grid-template-columns: 96px 1fr auto; align-items:center; gap: 14px; padding: .7rem 0; border-top: 1px dashed var(--line); }
      .lang:first-child { border-top: none; }
      .lang-native { font-family:'Fraunces',serif; font-size: 1.35rem; font-weight: 600; color: var(--ink); }
      .lang-name { color: var(--ink-2); font-weight: 500; }
      .lang-state { font-family:'IBM Plex Mono',monospace; font-size:.72rem; color: var(--sea); white-space: nowrap; }
      .lang.learning .lang-native { color: var(--sunset); }
      .lang.learning .lang-state { color: var(--sunset-dark); }
      .panel-dark { background: var(--ink); border-color: var(--ink); color: #eef1f6; }
      .panel-dark .panel-head span { color: #8f99ad; }
      .hobbies { display:grid; grid-template-columns: repeat(2, minmax(0,1fr)); gap: 12px; }
      .hobby { display:flex; gap: 12px; align-items:flex-start; background: rgba(255,255,255,.05); border: 1px solid #2c3a57; border-radius: 12px; padding: .9rem; transition: border-color .2s, transform .2s; }
      .hobby:hover { border-color: var(--sunset); transform: translateY(-2px); }
      .hobby-ic { width: 40px; height: 40px; flex: none; border-radius: 10px; background: var(--sunset); color:#fff; display:grid; place-items:center; font-size: 1.15rem; }
      .hobby b { display:block; font-weight:600; }
      .hobby small { display:block; color:#aeb7c8; font-size:.8rem; line-height:1.4; margin-top: 2px; }
      @media (max-width: 520px) { .hobbies { grid-template-columns: 1fr; } .lang { grid-template-columns: 76px 1fr; } .lang-state { grid-column: 2; } }

      /* Trayectoria tipo changelog */
      .timeline { position: relative; }
      .timeline::before { content:""; position:absolute; left: 118px; top: 8px; bottom: 8px; width: 2px; background: repeating-linear-gradient(var(--ink) 0 6px, transparent 6px 12px); opacity:.25; }
      .release { display:grid; grid-template-columns: 100px 1fr; gap: 38px; margin-bottom: 2.4rem; position: relative; }
      .release-side { text-align:right; padding-top: 1rem; }
      .release-side .yr { font-family:'Fraunces',serif; font-weight:800; font-size: 2rem; line-height:1; }
      .release-side .vr { font-family:'IBM Plex Mono',monospace; font-size:.78rem; color: var(--sunset); }
      .release::after { content:""; position:absolute; left: 112px; top: 1.35rem; width: 14px; height: 14px; border-radius: 50%; background: var(--paper); border: 3px solid var(--ink); }
      .release.current::after { background: var(--sunset); border-color: var(--sunset); box-shadow: 0 0 0 6px rgba(214,90,62,.2); }
      .release-card { background: #fffdf8; border:1px solid var(--line); border-radius: 16px; overflow:hidden; }
      .release-top { display:flex; flex-wrap:wrap; gap: 6px 14px; align-items:center; padding: .7rem 1.3rem; border-bottom: 1px solid var(--line); font-family:'IBM Plex Mono',monospace; font-size:.74rem; color: var(--muted); background: var(--paper-2); }
      .release-top .hash { color: var(--sea); }
      .release-top .tag-now { background: var(--sunset); color:#fff; padding: 1px 8px; border-radius: 999px; }
      .release-body { padding: 1.3rem 1.3rem 1.1rem; }
      .release-body h3 { font-family:'Fraunces',serif; font-weight:600; font-size: 1.6rem; margin-bottom: .5rem; }
      .release-body p { color: #3b4458; line-height: 1.7; }
      .diff { font-family:'IBM Plex Mono',monospace; font-size:.8rem; background: var(--ink); color: #dfe5ef; border-radius: 10px; padding: .8rem 1rem; margin: 1rem 0; }
      .diff div { padding: 1px 0; }
      .diff .add { color: #8fd8b8; }
      .diff .cm { color: #8892a6; }
      details.cursos summary { cursor:pointer; font-family:'IBM Plex Mono',monospace; font-size:.8rem; color: var(--ink-2); list-style:none; }
      details.cursos summary::-webkit-details-marker { display:none; }
      details.cursos summary::before { content:"▸ "; color: var(--sunset); }
      details.cursos[open] summary::before { content:"▾ "; }
      .chips { display:flex; flex-wrap:wrap; gap: 6px; margin-top: .8rem; }
      .chip { font-size:.78rem; border:1px solid var(--line); border-radius: 999px; padding: 3px 10px; background: var(--paper); }

      /* Campus (fotos reales) */
      .campus { position: relative; margin-top: 4rem; min-height: 560px; display:flex; align-items:flex-end; overflow:hidden; background: var(--ink); }
      .campus > img { position:absolute; inset:0; width:100%; height:100%; object-fit: cover; object-position: center 45%; filter: saturate(.88) contrast(1.04); }
      .campus::after { content:""; position:absolute; inset:0; background: linear-gradient(180deg, rgba(22,35,61,.12) 0%, rgba(22,35,61,.28) 40%, rgba(22,35,61,.92) 100%), linear-gradient(90deg, rgba(214,90,62,.16), transparent 55%); }
      .campus-inner { position: relative; z-index:2; color: #fff; padding: 3rem 0; width:100%; }
      .campus-tag { font-family:'IBM Plex Mono',monospace; font-size:.75rem; letter-spacing:1.5px; text-transform: uppercase; opacity:.85; }
      .campus h2 { font-family:'Fraunces',serif; font-weight:800; font-size: clamp(3rem, 8vw, 6rem); line-height: .9; letter-spacing:-2px; margin: .4rem 0; }
      .campus h2 em { font-weight: 400; color: var(--sunset-soft); }
      .campus blockquote { font-family:'Fraunces',serif; font-style: italic; font-size: 1.25rem; max-width: 36rem; border-left: 3px solid var(--sunset); padding-left: 1rem; margin: 1rem 0 0; color: #f1ece2; }
      .campus-cap { position:absolute; right: 20px; bottom: 16px; z-index: 2; font-family:'IBM Plex Mono',monospace; font-size:.7rem; color:#fff; opacity:.7; }
      .gallery { background: var(--ink); padding: 0 0 2.4rem; }
      .gallery-grid { display:grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 14px; }
      .gallery figure { margin:0; border-radius: 12px; overflow:hidden; background: var(--ink-2); position: relative; }
      .gallery figure img { width:100%; height: 220px; object-fit: cover; display:block; filter: saturate(.88) contrast(1.04); transition: transform .6s ease; }
      .gallery figure:hover img { transform: scale(1.04); }
      .gallery figcaption { position:absolute; left: 0; right: 0; bottom: 0; padding: 1.6rem .9rem .7rem; background: linear-gradient(180deg, transparent, rgba(22,35,61,.85)); color:#fff; font-size:.85rem; font-weight: 500; }
      .gallery-credit { color: #8f99ad; font-family:'IBM Plex Mono',monospace; font-size:.7rem; margin-top: 1rem; }
      .gallery-credit a { color: var(--sunset-soft); }
      @media (max-width: 767px) { .gallery-grid { grid-template-columns: 1fr; } .gallery figure img { height: 200px; } }

      /* Proyectos */
      .project {
        background:#fffdf8; border:1px solid var(--line); border-radius: 16px; padding: 1.4rem; height:100%;
        display:flex; flex-direction:column; transition: transform .2s, box-shadow .2s;
      }
      .project:hover { transform: translateY(-4px); box-shadow: 0 18px 30px -18px rgba(22,35,61,.45); }
      .project.featured { background: var(--ink); color: #eef1f6; border-color: var(--ink); }
      .project.featured .ptype { color: var(--sunset-soft); }
      .project.featured p { color: #c3cad8; }
      .project.featured .stk { border-color: #3b4a6b; color:#dfe5ef; }
      .ptype { font-family:'IBM Plex Mono',monospace; font-size:.72rem; text-transform: uppercase; letter-spacing:1px; color: var(--sunset-dark); }
      .project h3 { font-family:'Fraunces',serif; font-weight:600; font-size: 1.35rem; margin: .4rem 0 .6rem; }
      .project p { color: #4a5266; font-size: .93rem; line-height:1.6; flex:1; }
      .stk { display:inline-block; font-family:'IBM Plex Mono',monospace; font-size:.7rem; border:1px solid var(--line); border-radius: 6px; padding: 2px 8px; margin: 0 4px 4px 0; }

      /* Contacto */
      .contact { display:grid; grid-template-columns: 1fr 1fr; gap: 2.5rem; background: var(--paper-2); border:1px solid var(--line); border-radius: 22px; padding: clamp(1.6rem, 4vw, 3rem); position: relative; overflow:hidden; }
      .contact::after { content:"@"; position:absolute; right: -1rem; bottom: -5rem; font-family:'Fraunces',serif; font-size: 18rem; line-height:1; color: rgba(22,35,61,.05); pointer-events:none; }
      .contact h2 { font-family:'Fraunces',serif; font-weight:800; font-size: clamp(2.6rem, 6vw, 4.4rem); letter-spacing:-2px; line-height:1; margin: 1rem 0; }
      .contact h2 em { color: var(--sunset); font-style: normal; }
      .contact p { color: #3b4458; font-size: 1.05rem; line-height:1.65; max-width: 28rem; }
      .contact-loc { font-family:'IBM Plex Mono',monospace; font-size:.8rem; color: var(--muted); margin-top: 1rem; }
      .contact-right { display:flex; flex-direction:column; gap: 10px; position: relative; z-index: 1; }
      .channel { display:flex; align-items:center; gap: 14px; background:#fffdf8; border:1px solid var(--line); border-radius: 14px; padding: .85rem 1rem; color: var(--ink); transition: all .2s; }
      .channel:hover { border-color: var(--ink); transform: translateX(4px); color: var(--ink); }
      .ch-ic { width: 42px; height: 42px; flex:none; border-radius: 10px; background: var(--ink); color: var(--paper); display:grid; place-items:center; font-family:'IBM Plex Mono',monospace; font-size:.85rem; font-weight:500; }
      .ch-tx { flex:1; min-width:0; }
      .ch-tx small { display:block; font-family:'IBM Plex Mono',monospace; font-size:.68rem; text-transform:uppercase; letter-spacing:1px; color: var(--muted); }
      .ch-tx b { display:block; font-weight:600; overflow:hidden; text-overflow: ellipsis; white-space: nowrap; }
      .ch-go { color: var(--sunset); font-size: 1.1rem; }
      .copy-mail { align-self:flex-start; margin-top: 6px; background: var(--sunset); color:#fff; border: none; border-radius: 999px; padding: .65rem 1.3rem; font-weight:600; font-family: inherit; font-size: .95rem; cursor:pointer; transition: background .2s; }
      .copy-mail:hover { background: var(--sunset-dark); }
      @media (max-width: 860px) { .contact { grid-template-columns: 1fr; gap: 1.5rem; } }

      /* Footer terminal */
      .site-footer { background: var(--ink); color: #aab3c5; margin-top: 5rem; padding: 3.5rem 0 2rem; border-top: 4px solid var(--sunset); }
      .term { font-family:'IBM Plex Mono',monospace; font-size: .86rem; background: #0f1a2e; border-radius: 12px; padding: 1.2rem 1.4rem; border: 1px solid #263452; }
      .term .bar { display:flex; gap:6px; margin-bottom: .9rem; }
      .term .bar i { width:11px; height:11px; border-radius:50%; background:#e66a5a; } .term .bar i:nth-child(2){background:#e6b34f} .term .bar i:nth-child(3){background:#5fbf86}
      .term .p { color: #8fd8b8; } .term .o { color: #e9edf5; } .term .c { color: #6c7894; }
      .site-footer h4 { font-family:'Fraunces',serif; color:#fff; font-weight:800; font-size: 2rem; }
      .site-footer h4 em { color: var(--sunset); font-weight: 400; }
      .site-footer a { color: var(--sunset-soft); }

      /* Aparición al hacer scroll */
      .reveal { opacity: 0; transform: translateY(18px); transition: opacity .7s ease, transform .7s ease; }
      .reveal.in { opacity: 1; transform: none; }
      @media (prefers-reduced-motion: reduce) { .reveal { opacity:1; transform:none; } * { animation: none !important; transition: none !important; } }

      @media (max-width: 767px) {
        .timeline::before { left: 10px; }
        .release { grid-template-columns: 1fr; gap: 10px; padding-left: 34px; }
        .release::after { left: 4px; top: .4rem; }
        .release-side { text-align:left; padding-top: 0; display:flex; gap: 12px; align-items: baseline; }
        .stats .stat { border-right: none; border-bottom: 1px solid var(--line); }
        .sec-desc { margin-left: 0; }
        .badge-wrap { margin-top: 1.5rem; }
        .lanyard { display:none; }
        .campus-cap { display:none; }
      }
    </style>
  </head>

  <body>
    <!-- Barra superior -->
    <div class="top-bar">
      <div class="container d-flex justify-content-between align-items-center">
        <div><span class="dot"></span>EN LÍNEA &bull; bitácora v5.0 &bull; <?php echo e($hoy); ?></div>
        <div class="d-none d-md-block">Nuevo Chimbote &bull; Perú &bull; siempre compilando</div>
      </div>
    </div>

    <!-- Navegación -->
    <nav class="nav-main">
      <div class="container nav-inner">
        <a class="brand" href="#inicio">
          <span class="brand-mark"><?php echo e(mb_substr($perfil["nombre"],0,1).mb_substr($perfil["apellido"],0,1)); ?></span>
          <span class="brand-text"><?php echo e(mb_strtolower($perfil["nombre"]).".".mb_strtolower($perfil["apellido"])); ?><br><small>/bitácora</small></span>
        </a>
        <button class="navbar-toggler" type="button" aria-controls="navMenu" aria-expanded="false" aria-label="Menú">menú</button>
        <ul class="nav-links" id="navMenu">
          <li><a class="nav-link" href="#sobre-mi"><span>01</span> sobre_mí</a></li>
          <li><a class="nav-link" href="#trayectoria"><span>02</span> trayectoria</a></li>
          <li><a class="nav-link" href="#el-santa"><span>03</span> el_santa</a></li>
          <li><a class="nav-link" href="#proyectos"><span>04</span> proyectos</a></li>
          <li><a class="nav-link" href="#contacto"><span>05</span> contacto</a></li>
        </ul>
      </div>
    </nav>

    <!-- Hero -->
    <header class="hero" id="inicio">
      <div class="hero-years"><?php echo e($perfil["promocion"]); ?></div>
      <div class="container position-relative">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <span class="kicker">● Blog personal &middot; EPISI–UNS</span>
            <h1><?php echo e($perfil["nombre"]); ?><br><em><?php echo e($perfil["apellido"]); ?></em></h1>
            <div class="role"><?php echo e($perfil["titulo"]); ?> &mdash; <?php echo e($perfil["ciclo"]); ?></div>
            <p class="bio"><?php echo e($perfil["bio"]); ?></p>
            <div class="status" style="margin-bottom:1.6rem">$ estado: <?php echo e($perfil["estado"]); ?><span class="caret"></span></div>
            <div>
              <a href="#trayectoria" class="btn btn-ink mr-2 mb-2">Ver mis 5 años →</a>
              <a href="#contacto" class="btn btn-line mb-2">Contáctame</a>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="badge-wrap">
              <div class="lanyard"></div>
              <div class="id-card">
                <div class="id-head"><b>UNS · EPISI</b><span>PROMO 2022</span></div>
                <div class="id-photo"><img src="<?php echo e($perfil["foto"]); ?>" alt="Foto de <?php echo e($perfil["nombre"]." ".$perfil["apellido"]); ?>"></div>
                <div class="id-name"><?php echo e($perfil["nombre"]); ?> <em><?php echo e($perfil["apellido"]); ?></em></div>
                <div class="id-rows">
                  <div><span>carrera</span><span>Ing. Sistemas</span></div>
                  <div><span>ciclo</span><span><?php echo e($perfil["ciclo"]); ?></span></div>
                  <div><span>idiomas</span><span>ES · PT · EN</span></div>
                </div>
                <div class="barcode"></div>
                <div class="sticker"><div><b>X</b>ciclo<br>final</div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Cifras -->
    <div class="stats">
      <div class="container">
        <div class="row no-gutters">
          <?php foreach ($cifras as $c): ?>
          <div class="col-6 col-md-3 stat">
            <div class="num" data-count="<?php echo e($c["numero"]); ?>"><?php echo e($c["numero"]); ?></div>
            <div class="lbl"><?php echo e($c["texto"]); ?></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <main>
      <!-- 01 Sobre mí -->
      <section class="block" id="sobre-mi">
        <div class="container">
          <div class="sec-head reveal">
            <span class="sec-num">01</span>
            <h2 class="sec-title">Sobre <em>mí</em></h2>
            <p class="sec-desc">De dónde soy, qué me mueve, los idiomas que hablo y lo que hago cuando no estoy programando.</p>
          </div>
          <div class="row">
            <?php foreach ($sobre_mi as $s): ?>
            <div class="col-sm-6 col-lg-3 mb-3 reveal">
              <div class="about-tile">
                <div class="ic"><?php echo $s["icono"]; ?></div>
                <div class="lb"><?php echo e($s["etiqueta"]); ?></div>
                <div class="vl"><?php echo e($s["valor"]); ?></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>

          <div class="row about-more">
            <div class="col-lg-6 mb-4 reveal">
              <div class="panel">
                <div class="panel-head"><h3>Idiomas</h3><span>3 que hablo · 2 en camino</span></div>
                <ul class="langs">
                  <?php foreach ($idiomas as $i): $ap = $i["estado"] === "aprende"; ?>
                  <li class="lang <?php echo $ap ? 'learning' : ''; ?>">
                    <span class="lang-native"><?php echo e($i["nativo"]); ?></span>
                    <span class="lang-name"><?php echo e($i["idioma"]); ?></span>
                    <span class="lang-state"><?php echo $ap ? '◐ ' : '● '; ?><?php echo e($i["nota"]); ?></span>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 mb-4 reveal">
              <div class="panel panel-dark">
                <div class="panel-head"><h3>Fuera del teclado</h3><span>hobbies</span></div>
                <div class="hobbies">
                  <?php foreach ($hobbies as $h): ?>
                  <div class="hobby">
                    <div class="hobby-ic"><?php echo $h["icono"]; ?></div>
                    <div><b><?php echo e($h["nombre"]); ?></b><small><?php echo e($h["detalle"]); ?></small></div>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- 02 Trayectoria -->
      <section class="block" id="trayectoria">
        <div class="container">
          <div class="sec-head reveal">
            <span class="sec-num">02</span>
            <h2 class="sec-title">Cinco años, <em>cinco releases</em></h2>
            <p class="sec-desc">Mi paso por el Santa contado como un changelog: cada año una versión, cada ciclo un conjunto de commits.</p>
          </div>
          <div class="timeline">
            <?php foreach ($trayectoria as $r): $now = !empty($r["en_curso"]); ?>
            <article class="release reveal <?php echo $now ? 'current' : ''; ?>">
              <div class="release-side">
                <div class="yr"><?php echo e($r["anio"]); ?></div>
                <div class="vr"><?php echo e($r["version"]); ?></div>
              </div>
              <div class="release-card">
                <div class="release-top">
                  <span>commit <span class="hash"><?php echo e($r["hash"]); ?></span></span>
                  <span><?php echo e($r["ciclos"]); ?></span>
                  <?php if ($now): ?><span class="tag-now">en curso</span><?php else: ?><span>✓ completado</span><?php endif; ?>
                </div>
                <div class="release-body">
                  <h3><?php echo e($r["nombre"]); ?></h3>
                  <p><?php echo e($r["relato"]); ?></p>
                  <div class="diff">
                    <div class="cm"># habilidades agregadas en <?php echo e($r["version"]); ?></div>
                    <?php foreach ($r["agregado"] as $a): ?><div class="add">+ <?php echo e($a); ?></div><?php endforeach; ?>
                  </div>
                  <details class="cursos">
                    <summary>ver los <?php echo count($r["cursos"]); ?> cursos de este año</summary>
                    <div class="chips"><?php foreach ($r["cursos"] as $c): ?><span class="chip"><?php echo e($c); ?></span><?php endforeach; ?></div>
                  </details>
                </div>
              </div>
            </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- 03 El Santa (fotos reales) -->
      <section class="campus" id="el-santa">
        <?php echo foto($campus["principal"]["url"], $campus["subtitulo"] . " — " . $campus["principal"]["pie"], $campus["respaldo"]); ?>
        <div class="campus-inner">
          <div class="container">
            <div class="campus-tag">03 &middot; <?php echo e($campus["subtitulo"]); ?> &middot; <?php echo e($campus["direccion"]); ?></div>
            <h2>El <em>Santa</em></h2>
            <blockquote><?php echo e($campus["cita"]); ?></blockquote>
          </div>
        </div>
        <div class="campus-cap"><?php echo e($campus["principal"]["pie"]); ?></div>
      </section>
      <div class="gallery">
        <div class="container">
          <div class="gallery-grid">
            <?php foreach ($campus["galeria"] as $g): ?>
            <figure><?php echo foto($g["url"], $g["pie"], $campus["respaldo"]); ?><figcaption><?php echo e($g["pie"]); ?></figcaption></figure>
            <?php endforeach; ?>
          </div>
          <div class="gallery-credit">Fotos: Wikimedia Commons (licencia libre) —
            <a href="<?php echo e($campus["principal"]["fuente"]); ?>" target="_blank" rel="noopener"><?php echo e($campus["principal"]["pie"]); ?></a><?php foreach ($campus["galeria"] as $g): ?>, <a href="<?php echo e($g["fuente"]); ?>" target="_blank" rel="noopener"><?php echo e($g["pie"]); ?></a><?php endforeach; ?>.
          </div>
        </div>
      </div>

      <!-- 04 Proyectos -->
      <section class="block" id="proyectos">
        <div class="container">
          <div class="sec-head reveal">
            <span class="sec-num">04</span>
            <h2 class="sec-title">Lo que <em>construí</em></h2>
            <p class="sec-desc">Proyectos de curso, de equipo y los dos que cierran la carrera: bachiller y tesis.</p>
          </div>
          <div class="row">
            <?php foreach ($proyectos as $p): $f = !empty($p["destacado"]); ?>
            <div class="<?php echo $f ? 'col-lg-6' : 'col-md-6 col-lg-6 col-xl-3'; ?> mb-4 reveal">
              <div class="project <?php echo $f ? 'featured' : ''; ?>">
                <div class="ptype"><?php echo e($p["tipo"]); ?></div>
                <h3><?php echo e($p["nombre"]); ?></h3>
                <p><?php echo e($p["resumen"]); ?></p>
                <div><?php foreach ($p["stack"] as $s): ?><span class="stk"><?php echo e($s); ?></span><?php endforeach; ?></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

      <!-- 05 Contacto -->
      <section class="block" id="contacto">
        <div class="container">
          <div class="contact reveal">
            <div class="contact-left">
              <span class="sec-num">05</span>
              <h2><?php echo e($contacto["titulo"]); ?><em>.</em></h2>
              <p><?php echo e($contacto["mensaje"]); ?></p>
              <div class="contact-loc">◎ <?php echo e($contacto["ubicacion"]); ?></div>
            </div>
            <div class="contact-right">
              <?php foreach ($contacto["canales"] as $c): if ($c["url"] === "") continue; ?>
              <a class="channel" href="<?php echo e($c["url"]); ?>" target="_blank" rel="noopener">
                <span class="ch-ic"><?php echo e($c["icono"]); ?></span>
                <span class="ch-tx"><small><?php echo e($c["nombre"]); ?></small><b><?php echo e($c["valor"]); ?></b></span>
                <span class="ch-go">↗</span>
              </a>
              <?php endforeach; ?>
              <button class="copy-mail" type="button" data-mail="<?php echo e($contacto["canales"][0]["valor"]); ?>">Copiar correo</button>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 mb-4">
            <h4><?php echo e($perfil["nombre"]); ?> <em><?php echo e($perfil["apellido"]); ?></em></h4>
            <p class="mb-1"><?php echo e($perfil["titulo"]); ?></p>
            <p class="mb-3"><?php echo e($perfil["universidad"]); ?> &mdash; <?php echo e($perfil["ciudad"]); ?></p>
            <a href="#inicio">Volver arriba &uarr;</a>
          </div>
          <div class="col-lg-7 mb-4">
            <div class="term">
              <div class="bar"><i></i><i></i><i></i></div>
              <div><span class="p">ayrton@uns:~$</span> <span class="o">git log --oneline --reverse</span></div>
              <?php foreach ($trayectoria as $r): ?>
              <div><span class="c"><?php echo e($r["hash"]); ?></span> <span class="o"><?php echo e($r["version"]." (".$r["anio"].") ".$r["nombre"]); ?></span></div>
              <?php endforeach; ?>
              <div><span class="p">ayrton@uns:~$</span> <span class="o">echo $SIGUIENTE</span></div>
              <div class="o">→ Ingeniero de Sistemas e Informática<span class="caret" style="display:inline-block;width:8px;height:14px;background:#d65a3e;margin-left:6px;animation:blink 1s steps(1) infinite;vertical-align:-2px"></span></div>
            </div>
          </div>
        </div>
        <div class="text-center mono small pt-3" style="border-top:1px solid #263452;color:#6c7894">© <?php echo date("Y"); ?> <?php echo e($perfil["nombre"]." ".$perfil["apellido"]); ?> &bull; Bitácora v5.0 &bull; Hecho en Nuevo Chimbote</div>
      </div>
    </footer>

    <script>
      (function () {
        // Aparición al hacer scroll
        var io = 'IntersectionObserver' in window ? new IntersectionObserver(function (entries) {
          entries.forEach(function (en) { if (en.isIntersecting) { en.target.classList.add('in'); io.unobserve(en.target); } });
        }, { threshold: 0.12 }) : null;
        document.querySelectorAll('.reveal').forEach(function (el) { io ? io.observe(el) : el.classList.add('in'); });

        // Contadores animados
        document.querySelectorAll('[data-count]').forEach(function (el) {
          var end = parseInt(el.dataset.count, 10), t0 = null;
          function step(ts) { if (!t0) t0 = ts; var p = Math.min((ts - t0) / 1200, 1); el.textContent = Math.round(end * (1 - Math.pow(1 - p, 3))); if (p < 1) requestAnimationFrame(step); }
          requestAnimationFrame(step);
        });

        // Copiar correo
        var cm = document.querySelector('.copy-mail');
        if (cm) cm.addEventListener('click', function () {
          var t = cm.dataset.mail;
          try { navigator.clipboard.writeText(t).then(function () { cm.textContent = '¡Copiado!'; }, function () { cm.textContent = t; }); }
          catch (err) { cm.textContent = t; }
          setTimeout(function () { cm.textContent = 'Copiar correo'; }, 2200);
        });

        // Menú móvil
        var tg = document.querySelector('.navbar-toggler'), menu = document.getElementById('navMenu');
        tg.addEventListener('click', function () { var o = menu.classList.toggle('open'); tg.setAttribute('aria-expanded', o); });
        menu.querySelectorAll('a').forEach(function (l) { l.addEventListener('click', function () { menu.classList.remove('open'); tg.setAttribute('aria-expanded', false); }); });
      })();
    </script>
  </body>
</html>
