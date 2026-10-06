 <?php
session_start();

/* =========================
   INFORMACIÓN DE NEXORA
========================= */

$empresa = [
    "nombre" => "NEXORA STUDIO",
    "slogan" => "Creamos mundos, no solo juegos.",
    "descripcion" => "Estudio premium de videojuegos y experiencias interactivas que combina creatividad, tecnología y narrativa para crear mundos memorables.",
    "ubicacion" => "Ciudad de México, México",
    "telefono" => "+52 55 8000 2026",
    "correo" => "contacto@nexorastudio.mx"
];

/* =========================
   PRODUCTOS Y SERVICIOS
========================= */

$productos = [

    [
        "nombre" => "Nexora Realms",
        "categoria" => "Videojuego Premium",
        "precio" => 1299,
        "descripcion" => "RPG de aventura para PC y consola, con exploración, narrativa y un universo fantástico.",
        "icono" => "✦"
    ],

    [
        "nombre" => "Nexora Realms — Deluxe",
        "categoria" => "Edición Digital Premium",
        "precio" => 1999,
        "descripcion" => "Edición ampliada con contenido adicional, recompensas digitales y extras exclusivos.",
        "icono" => "◆"
    ],

    [
        "nombre" => "Collector Edition",
        "categoria" => "Edición de Colección",
        "precio" => 3499,
        "descripcion" => "Experiencia para coleccionistas con contenido especial y elementos premium.",
        "icono" => "♛"
    ],

    [
        "nombre" => "Nexora Arena",
        "categoria" => "Videojuego Competitivo",
        "precio" => 899,
        "descripcion" => "Experiencia competitiva de acción diseñada para partidas rápidas y comunidades activas.",
        "icono" => "⚔"
    ],

    [
        "nombre" => "Experiencias 3D para marcas",
        "categoria" => "Servicio B2B",
        "precio" => 450000,
        "descripcion" => "Experiencias inmersivas, activaciones digitales y mundos 3D personalizados para marcas.",
        "icono" => "◇"
    ],

    [
        "nombre" => "Desarrollo de videojuegos a medida",
        "categoria" => "Servicio Premium",
        "precio" => 1400000,
        "descripcion" => "Producción integral para empresas, publishers y proyectos con necesidades especiales.",
        "icono" => "∞"
    ]
];


/* =========================
   CARRITO
========================= */

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}


/* AGREGAR PRODUCTO */

if (isset($_GET["agregar"])) {

    $id = (int) $_GET["agregar"];

    if (isset($productos[$id])) {

        if (!isset($_SESSION["carrito"][$id])) {
            $_SESSION["carrito"][$id] = 0;
        }

        $_SESSION["carrito"][$id]++;

    }

    header("Location: index.php#productos");
    exit;
}


/* QUITAR PRODUCTO */

if (isset($_GET["quitar"])) {

    $id = (int) $_GET["quitar"];

    unset($_SESSION["carrito"][$id]);

    header("Location: index.php#carrito");
    exit;
}


/* CALCULAR CARRITO */

$totalCarrito = 0;
$itemsCarrito = 0;

foreach ($_SESSION["carrito"] as $id => $cantidad) {

    if (isset($productos[$id])) {

        $totalCarrito +=
            $productos[$id]["precio"] * $cantidad;

        $itemsCarrito += $cantidad;
    }
}


/* FORMATO DE DINERO */

function mxn($numero)
{
    return "$" .
        number_format($numero, 0, ".", ",") .
        " MXN";
}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<meta name="description"
      content="Nexora Studio - videojuegos y experiencias digitales premium.">

<title>
NEXORA STUDIO | Creamos mundos, no solo juegos
</title>


<style>

/* =====================================================
   PALETA DE COLORES NEXORA
===================================================== */

:root {

    --night: #081126;
    --night2: #0d1730;

    --purple: #6D28D9;
    --purple2: #8B5CF6;

    --blue: #2563EB;

    --cyan: #38BDF8;

    --gold: #F5C77A;

    --white: #F8FAFC;

    --muted: #AAB7D1;

    --line: rgba(148,163,184,.18);

    --glass: rgba(15,27,55,.72);
}


/* =====================================================
   GENERAL
===================================================== */

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}


html {
    scroll-behavior: smooth;
}


body {

    font-family:
        Inter,
        "Segoe UI",
        Arial,
        sans-serif;

    color: var(--white);

    background:

        radial-gradient(
            circle at 15% 10%,
            rgba(109,40,217,.20),
            transparent 28%
        ),

        radial-gradient(
            circle at 85% 15%,
            rgba(56,189,248,.14),
            transparent 24%
        ),

        var(--night);

    line-height: 1.6;

    overflow-x: hidden;
}


a {
    text-decoration: none;
    color: inherit;
}


.container {

    width: min(1180px, 92%);

    margin: auto;
}


.section {

    padding: 100px 0;
}


.eyebrow {

    display: inline-flex;

    gap: 8px;

    align-items: center;

    color: var(--gold);

    text-transform: uppercase;

    letter-spacing: 3px;

    font-size: .75rem;

    font-weight: 800;

    margin-bottom: 14px;
}


.eyebrow::before {

    content: "✦";

    color: var(--cyan);
}


h1,
h2,
h3 {

    line-height: 1.1;
}


h2 {

    font-size:
        clamp(2rem, 4vw, 3.5rem);

    margin-bottom: 18px;
}


.lead {

    color: var(--muted);

    max-width: 720px;

    font-size: 1.08rem;
}


.gradient-text {

    background:

        linear-gradient(
            90deg,
            var(--white),
            #C4B5FD,
            var(--cyan),
            var(--gold)
        );

    -webkit-background-clip: text;

    background-clip: text;

    color: transparent;
}


/* =====================================================
   NAVBAR
===================================================== */

.nav-wrap {

    position: fixed;

    top: 0;

    left: 0;

    width: 100%;

    z-index: 1000;

    padding: 16px 0;
}


nav {

    width: min(1180px, 94%);

    margin: auto;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 12px 16px;

    border: 1px solid var(--line);

    background: rgba(8,17,38,.72);

    backdrop-filter: blur(18px);

    border-radius: 18px;

    box-shadow:
        0 24px 80px rgba(0,0,0,.35);
}


.brand {

    display: flex;

    align-items: center;

    gap: 11px;

    font-weight: 900;

    letter-spacing: 2px;
}


.brand-mark {

    width: 42px;

    height: 42px;

    border-radius: 13px;

    display: grid;

    place-items: center;

    font-size: 1.3rem;

    background:
        linear-gradient(
            135deg,
            var(--purple),
            var(--blue)
        );

    box-shadow:
        0 0 28px rgba(109,40,217,.55);
}


.nav-links {

    display: flex;

    gap: 24px;

    align-items: center;
}


.nav-links a {

    font-size: .9rem;

    color: #D9E2F2;

    transition: .25s;
}


.nav-links a:hover {

    color: var(--cyan);
}


.cart {

    padding: 9px 13px;

    border: 1px solid
        rgba(245,199,122,.35);

    border-radius: 12px;

    color: var(--gold) !important;
}


/* =====================================================
   HERO
===================================================== */

.hero {

    min-height: 100vh;

    display: grid;

    align-items: center;

    padding-top: 120px;
}


.hero-grid {

    display: grid;

    grid-template-columns:
        1.05fr .95fr;

    gap: 55px;

    align-items: center;
}


.hero h1 {

    font-size:
        clamp(3rem, 7vw, 6.4rem);

    letter-spacing: -3px;
}


.hero p {

    font-size: 1.15rem;

    color: var(--muted);

    max-width: 680px;

    margin: 25px 0 30px;
}


.actions {

    display: flex;

    gap: 14px;

    flex-wrap: wrap;
}


.btn {

    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 13px 20px;

    border-radius: 13px;

    border: 1px solid var(--line);

    font-weight: 800;

    transition: .25s;

    cursor: pointer;
}


.btn-primary {

    background:
        linear-gradient(
            135deg,
            var(--purple),
            var(--blue)
        );

    box-shadow:
        0 12px 35px
        rgba(37,99,235,.25);
}


.btn-primary:hover {

    transform: translateY(-3px);

    box-shadow:
        0 18px 45px
        rgba(109,40,217,.38);
}


.btn-ghost {

    background:
        rgba(255,255,255,.03);
}


.btn-ghost:hover {

    border-color: var(--cyan);

    color: var(--cyan);
}


/* =====================================================
   HERO CARD
===================================================== */

.hero-card {

    min-height: 510px;

    border: 1px solid var(--line);

    border-radius: 35px;

    background:

        radial-gradient(
            circle at 50% 25%,
            rgba(56,189,248,.20),
            transparent 22%
        ),

        radial-gradient(
            circle at 50% 65%,
            rgba(109,40,217,.40),
            transparent 45%
        ),

        linear-gradient(
            145deg,
            #111c3a,
            #080d1f
        );

    position: relative;

    overflow: hidden;

    box-shadow:
        0 24px 80px rgba(0,0,0,.35);

    display: grid;

    place-items: center;
}


.orbit {

    position: absolute;

    border:
        1px solid
        rgba(56,189,248,.4);

    border-radius: 50%;

    width: 72%;

    height: 72%;

    transform: rotate(-18deg);
}


.orbit::before {

    content: "";

    position: absolute;

    width: 86%;

    height: 55%;

    left: 7%;

    top: 23%;

    border:
        1px solid
        rgba(139,92,246,.5);

    border-radius: 50%;
}


.orbit::after {

    content: "";

    position: absolute;

    width: 55%;

    height: 86%;

    left: 23%;

    top: -7%;

    border:
        1px solid
        rgba(245,199,122,.4);

    border-radius: 50%;
}


.wizard {

    position: relative;

    z-index: 2;

    text-align: center;

    animation:
        float 5s ease-in-out infinite;
}


.wizard .hat {

    font-size: 8rem;

    filter:
        drop-shadow(
            0 15px 35px
            rgba(109,40,217,.6)
        );
}


.wizard .star {

    font-size: 4.5rem;

    color: var(--cyan);

    display: block;

    text-shadow:
        0 0 30px var(--cyan);
}


.wizard small {

    color: var(--gold);

    letter-spacing: 5px;

    font-weight: 800;
}


@keyframes float {

    50% {

        transform:
            translateY(-15px);
    }
}


/* =====================================================
   CARDS
===================================================== */

.cards {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 18px;

    margin-top: 42px;
}


.card {

    border: 1px solid var(--line);

    border-radius: 22px;

    background: var(--glass);

    padding: 26px;

    box-shadow:
        0 15px 45px rgba(0,0,0,.18);

    transition: .3s;

    position: relative;

    overflow: hidden;
}


.card:hover {

    transform:
        translateY(-7px);

    border-color:
        rgba(56,189,248,.35);
}


.icon {

    font-size: 2rem;

    color: var(--gold);

    margin-bottom: 15px;
}


.card h3 {

    font-size: 1.3rem;

    margin-bottom: 9px;
}


.card p {

    color: var(--muted);

    font-size: .95rem;
}


/* =====================================================
   ABOUT
===================================================== */

.about {

    display: grid;

    grid-template-columns:
        .85fr 1.15fr;

    gap: 50px;

    align-items: center;
}


.panel {

    padding: 32px;

    border-radius: 26px;

    border: 1px solid var(--line);

    background:
        linear-gradient(
            145deg,
            rgba(109,40,217,.12),
            rgba(37,99,235,.07)
        );
}


.stats {

    display: grid;

    grid-template-columns:
        repeat(2,1fr);

    gap: 14px;

    margin-top: 20px;
}


.stat strong {

    font-size: 2rem;

    color: var(--cyan);

    display: block;
}


.stat span {

    color: var(--muted);

    font-size: .88rem;
}


.values {

    display: flex;

    flex-wrap: wrap;

    gap: 10px;

    margin-top: 20px;
}


.pill {

    border:
        1px solid
        rgba(56,189,248,.25);

    padding: 8px 12px;

    border-radius: 99px;

    color: #DCE9FF;

    background:
        rgba(56,189,248,.05);
}


/* =====================================================
   PRODUCTOS
===================================================== */

.product-top {

    display: flex;

    justify-content: space-between;

    gap: 20px;

    align-items: end;
}


.product-card {

    display: flex;

    flex-direction: column;
}


.product-card .btn {

    margin-top: auto;
}


.badge {

    display: inline-block;

    padding: 5px 9px;

    border-radius: 8px;

    background:
        rgba(109,40,217,.18);

    color: #C4B5FD;

    font-size: .72rem;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: 1px;
}


.price {

    font-size: 1.4rem;

    font-weight: 900;

    color: var(--gold);

    margin: 18px 0;
}


/* =====================================================
   GALERÍA
===================================================== */

.gallery {

    display: grid;

    grid-template-columns:
        repeat(4,1fr);

    gap: 15px;

    margin-top: 35px;
}


.gallery-item {

    height: 290px;

    border-radius: 22px;

    border: 1px solid var(--line);

    overflow: hidden;

    padding: 20px;

    display: flex;

    align-items: end;

    position: relative;

    background:

        radial-gradient(
            circle at 65% 30%,
            rgba(56,189,248,.45),
            transparent 18%
        ),

        radial-gradient(
            circle at 35% 65%,
            rgba(109,40,217,.55),
            transparent 30%
        ),

        linear-gradient(
            145deg,
            #111b3b,
            #060b18
        );
}


.gallery-item:nth-child(even) {

    background:

        radial-gradient(
            circle at 25% 30%,
            rgba(245,199,122,.35),
            transparent 15%
        ),

        radial-gradient(
            circle at 65% 65%,
            rgba(37,99,235,.5),
            transparent 30%
        ),

        linear-gradient(
            145deg,
            #171044,
            #060b18
        );
}


.gallery-content {

    position: relative;

    z-index: 2;
}


.gallery-content h3 {

    font-size: 1.2rem;
}


.gallery-content p {

    color: #CBD5E1;

    font-size: .84rem;
}


/* =====================================================
   FODA
===================================================== */

.foda {

    display: grid;

    grid-template-columns:
        repeat(4,1fr);

    gap: 15px;

    margin-top: 35px;
}


.foda .card {

    min-height: 235px;
}


.foda h3 {

    color: var(--gold);

    margin-bottom: 12px;
}


/* =====================================================
   CARRITO
===================================================== */

.cart-box {

    margin-top: 30px;

    border: 1px solid var(--line);

    border-radius: 22px;

    padding: 25px;

    background:
        rgba(255,255,255,.025);
}


.cart-row {

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 15px;

    padding: 12px 0;

    border-bottom:
        1px solid var(--line);
}


.cart-row:last-child {

    border-bottom: 0;
}


.cart-empty {

    color: var(--muted);
}


/* =====================================================
   CONTACTO
===================================================== */

.contact-cta {

    display: grid;

    grid-template-columns:
        1fr .8fr;

    gap: 30px;

    align-items: center;

    padding: 45px;

    border-radius: 30px;

    border:
        1px solid
        rgba(56,189,248,.18);

    background:

        linear-gradient(
            120deg,
            rgba(109,40,217,.22),
            rgba(37,99,235,.12)
        );
}


/* =====================================================
   FOOTER
===================================================== */

footer {

    padding: 45px 0;

    border-top:
        1px solid var(--line);

    background: #050b19;
}


.footer-grid {

    display: grid;

    grid-template-columns:
        1.3fr 1fr 1fr;

    gap: 35px;
}


.footer-grid h3 {

    margin-bottom: 12px;
}


footer p,
footer a {

    color: var(--muted);

    font-size: .9rem;
}


.copyright {

    border-top:
        1px solid var(--line);

    margin-top: 35px;

    padding-top: 18px;

    color: #72819D;

    font-size: .8rem;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:900px) {

    .nav-links {
        display: none;
    }

    .hero-grid,
    .about,
    .contact-cta {
        grid-template-columns: 1fr;
    }

    .hero-card {
        min-height: 400px;
    }

    .cards {
        grid-template-columns:
            repeat(2,1fr);
    }

    .gallery {
        grid-template-columns:
            repeat(2,1fr);
    }

    .foda {
        grid-template-columns:
            repeat(2,1fr);
    }
}


@media(max-width:600px) {

    .section {
        padding: 75px 0;
    }

    .hero h1 {
        font-size: 3.4rem;
    }

    .cards,
    .gallery,
    .foda,
    .stats,
    .footer-grid {
        grid-template-columns: 1fr;
    }

    .hero-card {
        min-height: 340px;
    }

    .wizard .hat {
        font-size: 5rem;
    }

    .contact-cta {
        padding: 30px 22px;
    }

    .cart-row {
        flex-direction: column;
        align-items: flex-start;
    }
}

</style>

</head>


<body>


<!-- =====================================================
     NAVBAR
===================================================== -->

<header class="nav-wrap">

<nav>

    <a href="#inicio" class="brand">

        <span class="brand-mark">
            ✦
        </span>

        <span>
            NEXORA
        </span>

    </a>


    <div class="nav-links">

        <a href="#inicio">
            Inicio
        </a>

        <a href="#nosotros">
            Nosotros
        </a>

        <a href="#productos">
            Productos
        </a>

        <a href="#foda">
            FODA
        </a>

        <a href="#carrito" class="cart">
            🛒 <?= $itemsCarrito ?>
        </a>

        <a href="contacto.php">
            Contacto
        </a>

    </div>

</nav>

</header>



<main>


<!-- =====================================================
     INICIO
===================================================== -->

<section id="inicio" class="hero">

<div class="container hero-grid">


<div>

<span class="eyebrow">
    NEXORA STUDIO
</span>


<h1>

    Creamos

    <span class="gradient-text">
        mundos,
    </span>

    no solo juegos.

</h1>


<p>

    <?= htmlspecialchars(
        $empresa["descripcion"]
    ) ?>

</p>


<div class="actions">

<a
    href="#productos"
    class="btn btn-primary"
>
    Explorar proyectos →
</a>


<a
    href="contacto.php"
    class="btn btn-ghost"
>
    Hablar con Nexora
</a>

</div>

</div>



<div class="hero-card">

<div class="orbit"></div>


<div class="wizard">

<div class="hat">
    🧙‍♂️
</div>

<span class="star">
    ✦
</span>

<small>
    NEXORA STUDIO
</small>

</div>

</div>


</div>

</section>



<!-- =====================================================
     PROPUESTA DE VALOR
===================================================== -->

<section class="section">

<div class="container">


<span class="eyebrow">
    Propuesta de valor
</span>


<h2>

    Tecnología con

    <span class="gradient-text">
        imaginación.
    </span>

</h2>


<p class="lead">

    Nexora desarrolla experiencias digitales
    que combinan tecnología, narrativa,
    diseño y creatividad para crear
    productos memorables.

</p>


<div class="cards">


<article class="card">

<div class="icon">
    ✦
</div>
</article>



<article class="card">

<div class="icon">
    ◈
</div>

<h3>
    Experiencia
</h3>

<p>
    Diseñamos mundos digitales
    pensando en la experiencia
    completa del usuario.
</p>

</article>



<article class="card">

<div class="icon">
    ∞
</div>

<h3>
    Creatividad
</h3>

<p>
    Convertimos ideas originales
    en productos digitales con
    identidad propia.
</p>

</article>


</div>

</div>

</section>



<!-- =====================================================
     NOSOTROS
===================================================== -->

<section id="nosotros" class="section">

<div class="container about">


<div class="panel">

<span class="eyebrow">
    Nosotros
</span>

<h2>
    Nacimos para
    <span class="gradient-text">
        crear.
    </span>
</h2>

<p class="lead">

    Nexora Studio es una empresa
    dedicada al desarrollo de videojuegos,
    experiencias interactivas y soluciones
    digitales.

</p>


<div class="stats">

<div class="stat">

<strong>
    2026
</strong>

<span>
    Año de fundación
</span>

</div>


<div class="stat">

<strong>
    6+
</strong>

<span>
    Líneas de producto
</span>

</div>


<div class="stat">

<strong>
    3D
</strong>

<span>
    Experiencias inmersivas
</span>

</div>


<div class="stat">

<strong>
    ∞
</strong>

<span>
    Ideas por desarrollar
</span>

</div>

</div>

</div>



<div>

<span class="eyebrow">
    Filosofía empresarial
</span>

<h2>
    Nuestra identidad
</h2>


<p class="lead">

    En Nexora creemos que un videojuego
    puede ser mucho más que entretenimiento:
    puede ser una experiencia, una historia
    y un universo completo.

</p>


<div class="values">

<span class="pill">
    Innovación
</span>

<span class="pill">
    Creatividad
</span>

<span class="pill">
    Calidad
</span>

<span class="pill">
    Tecnología
</span>

<span class="pill">
    Experiencia
</span>

<span class="pill">
    Compromiso
</span>

</div>

</div>


</div>

</section>



<!-- =====================================================
     MISIÓN / VISIÓN / VALORES
===================================================== -->

<section class="section">

<div class="container">

<span class="eyebrow">
    Identidad corporativa
</span>

<h2>
    Misión, visión y valores
</h2>


<div class="cards">


<article class="card">

<div class="icon">
    ◇
</div>

<h3>
    Misión
</h3>

<p>

    Crear videojuegos y experiencias
    digitales innovadoras que conecten
    tecnología, entretenimiento y
    creatividad.

</p>

</article>



<article class="card">

<div class="icon">
    ✧
</div>

<h3>
    Visión
</h3>

<p>

    Convertir a Nexora en un estudio
    reconocido por desarrollar mundos
    digitales de alta calidad y
    experiencias memorables.

</p>

</article>



<article class="card">

<div class="icon">
    ♛
</div>

<h3>
    Valores
</h3>

<p>

    Innovación, creatividad, calidad,
    responsabilidad, colaboración,
    pasión y orientación al usuario.

</p>

</article>


</div>

</div>

</section>



<!-- =====================================================
     PRODUCTOS
===================================================== -->

<section id="productos" class="section">

<div class="container">


<div class="product-top">

<div>

<span class="eyebrow">
    Catálogo
</span>

<h2>
    Productos y servicios
</h2>

<p class="lead">

    Soluciones premium diseñadas
    para jugadores, empresas y marcas.

</p>

</div>

</div>



<div class="cards">


<?php foreach ($productos as $id => $producto): ?>

<article class="card product-card">


<div class="icon">

<?= $producto["icono"] ?>

</div>


<span class="badge">

<?= htmlspecialchars(
    $producto["categoria"]
) ?>

</span>


<h3>

<?= htmlspecialchars(
    $producto["nombre"]
) ?>

</h3>


<p>

<?= htmlspecialchars(
    $producto["descripcion"]
) ?>

</p>


<div class="price">

<?= mxn(
    $producto["precio"]
) ?>

</div>


<a
    href="?agregar=<?= $id ?>"
    class="btn btn-primary"
>

Agregar al carrito

</a>


</article>

<?php endforeach; ?>


</div>

</div>

</section>



<!-- =====================================================
     GALERÍA
===================================================== -->

<section class="section">

<div class="container">


<span class="eyebrow">
    Experiencias
</span>


<h2>

    El universo

    <span class="gradient-text">
        Nexora.
    </span>

</h2>


<div class="gallery">


<div class="gallery-item">

<div class="gallery-content">

<h3>
    Nexora Realms
</h3>

<p>
    Fantasía • RPG • Aventura
</p>

</div>

</div>



<div class="gallery-item">

<div class="gallery-content">

<h3>
    Nexora Arena
</h3>

<p>
    Acción • Competitivo
</p>

</div>

</div>



<div class="gallery-item">

<div class="gallery-content">

<h3>
    Experiencias 3D
</h3>

<p>
    Tecnología • Inmersión
</p>

</div>

</div>



<div class="gallery-item">

<div class="gallery-content">

<h3>
    Nexora Future
</h3>

<p>
    Innovación • Tecnología
</p>

</div>

</div>


</div>

</div>

</section>



<!-- =====================================================
     FODA
===================================================== -->

<section id="foda" class="section">

<div class="container">


<span class="eyebrow">
    Planeación estratégica
</span>


<h2>
    Análisis FODA
</h2>


<div class="foda">


<article class="card">

<h3>
    Fortalezas
</h3>

<p>

    Identidad visual diferenciada,
    creatividad, enfoque tecnológico,
    propuesta premium y capacidad
    de desarrollar experiencias
    interactivas.

</p>

</article>



<article class="card">

<h3>
    Oportunidades
</h3>

<p>

    Crecimiento de la industria
    de videojuegos, experiencias
    3D, realidad virtual y
    servicios digitales para marcas.

</p>

</article>



<article class="card">

<h3>
    Debilidades
</h3>

<p>

    Inversión inicial elevada,
    necesidad de talento especializado
    y ciclos de desarrollo largos.

</p>

</article>



<article class="card">

<h3>
    Amenazas
</h3>

<p>

    Competencia internacional,
    cambios tecnológicos,
    sobrecostos y cambios
    en plataformas digitales.

</p>

</article>


</div>

</div>

</section>



<!-- =====================================================
     CARRITO
===================================================== -->

<section id="carrito" class="section">

<div class="container">


<span class="eyebrow">
    Sistema de compras
</span>


<h2>

    Tu carrito
    <span class="gradient-text">
        Nexora.
    </span>

</h2>


<div class="cart-box">


<?php if (!$itemsCarrito): ?>


<p class="cart-empty">

    Tu carrito está vacío.

    Explora nuestro catálogo
    y agrega un producto.

</p>


<?php else: ?>


<?php foreach (
    $_SESSION["carrito"]
    as $id => $cantidad
): ?>


<?php if (isset($productos[$id])): ?>


<div class="cart-row">


<div>

<strong>

<?= htmlspecialchars(
    $productos[$id]["nombre"]
) ?>

</strong>


<br>


<small
style="color:var(--muted)"
>

Cantidad:
<?= $cantidad ?>

</small>

</div>


<strong>

<?= mxn(
    $productos[$id]["precio"]
    * $cantidad
) ?>

</strong>


<a
href="?quitar=<?= $id ?>"
class="btn btn-ghost"
>

Quitar

</a>


</div>


<?php endif; ?>


<?php endforeach; ?>


<div
style="
display:flex;
justify-content:space-between;
margin-top:22px;
align-items:center;
"
>

<strong>
    Total
</strong>


<strong
class="price"
style="margin:0"
>

<?= mxn($totalCarrito) ?>

</strong>

</div>


<p
style="
color:var(--muted);
margin-top:12px;
"
>

Para solicitar compra, cotización
o reserva, utiliza nuestro formulario
de contacto.

</p>


<?php endif; ?>


</div>

</div>

</section>



<!-- =====================================================
     CONTACTO
===================================================== -->

<section class="section">

<div class="container">


<div class="contact-cta">


<div>

<span class="eyebrow">
    Contacto
</span>


<h2>

    ¿Creamos el siguiente

    <span class="gradient-text">
        mundo?
    </span>

</h2>


<p class="lead">

    Cuéntanos tu idea.
    Nuestro equipo puede convertirla
    en una experiencia interactiva premium.

</p>

</div>


<div class="actions">


<a
href="contacto.php"
class="btn btn-primary"
>

Abrir formulario →

</a>


<a
href="mailto:<?= $empresa["correo"] ?>"
class="btn btn-ghost"
>

Enviar correo

</a>


</div>


</div>

</div>

</section>


</main>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer>


<div class="container footer-grid">


<div>

<div class="brand">

<span class="brand-mark">
    ✦
</span>

<span>
    NEXORA STUDIO
</span>

</div>


<p style="margin-top:15px">

<?= htmlspecialchars(
    $empresa["slogan"]
) ?>

</p>

</div>



<div>

<h3>
    Empresa
</h3>

<a href="#nosotros">
    Nosotros
</a>

<br>

<a href="#productos">
    Productos
</a>

<br>

<a href="#foda">
    FODA
</a>

<br>

<a href="contacto.php">
    Contacto
</a>

</div>



<div>

<h3>
    Información empresarial
</h3>

<p>
<?= htmlspecialchars(
    $empresa["ubicacion"]
) ?>
</p>

<p>
<?= htmlspecialchars(
    $empresa["telefono"]
) ?>
</p>

<p>
<?= htmlspecialchars(
    $empresa["correo"]
) ?>
</p>

<p style="margin-top:8px">
    Instagram • TikTok • YouTube • LinkedIn
</p>

</div>


</div>


<div class="container copyright">

© <?= date("Y") ?>

NEXORA STUDIO.

Todos los derechos reservados.

Proyecto académico.

</div>


</footer>


</body>

</html>

<h3>
    Innovación
</h3>

<p>
    Utilizamos herramientas modernas
    </article>



<article class="card">

<div class="icon">
    ◈
</div>

<h3>
    Experiencia
</h3>

<p>
    Diseñamos mundos digitales
    pensando en la experiencia
    completa del usuario.
</p>

</article>



<article class="card">

<div class="icon">
    ∞
</div>

<h3>
    Creatividad
</h3>

<p>
    Convertimos ideas originales
    en productos digitales con
    identidad propia.
</p>

</article>


</div>

</div>

</section>



<!-- =====================================================
     NOSOTROS
===================================================== -->

<section id="nosotros" class="section">

<div class="container about">


<div class="panel">

<span class="eyebrow">
    Nosotros
</span>

<h2>
    Nacimos para
    <span class="gradient-text">
        crear.
    </span>
</h2>

<p class="lead">

    Nexora Studio es una empresa
    dedicada al desarrollo de videojuegos,
    experiencias interactivas y soluciones
    digitales.

</p>


<div class="stats">

<div class="stat">

<strong>
    2026
</strong>

<span>
    Año de fundación
</span>

</div>


<div class="stat">

<strong>
    6+
</strong>

<span>
    Líneas de producto
</span>

</div>


<div class="stat">

<strong>
    3D
</strong>

<span>
    Experiencias inmersivas
</span>

</div>


<div class="stat">

<strong>
    ∞
</strong>

<span>
    Ideas por desarrollar
</span>

</div>

</div>

</div>



<div>

<span class="eyebrow">
    Filosofía empresarial
</span>

<h2>
    Nuestra identidad
</h2>


<p class="lead">

    En Nexora creemos que un videojuego
    puede ser mucho más que entretenimiento:
    puede ser una experiencia, una historia
    y un universo completo.

</p>


<div class="values">

<span class="pill">
    Innovación
</span>

<span class="pill">
    Creatividad
</span>

<span class="pill">
    Calidad
</span>

<span class="pill">
    Tecnología
</span>

<span class="pill">
    Experiencia
</span>

<span class="pill">
    Compromiso
</span>

</div>

</div>


</div>

</section>



<!-- =====================================================
     MISIÓN / VISIÓN / VALORES
===================================================== -->

<section class="section">

<div class="container">

<span class="eyebrow">
    Identidad corporativa
</span>

<h2>
    Misión, visión y valores
</h2>


<div class="cards">


<article class="card">

<div class="icon">
    ◇
</div>

<h3>
    Misión
</h3>

<p>

    Crear videojuegos y experiencias
    digitales innovadoras que conecten
    tecnología, entretenimiento y
    creatividad.

</p>

</article>



<article class="card">

<div class="icon">
    ✧
</div>

<h3>
    Visión
</h3>

<p>

    Convertir a Nexora en un estudio
    reconocido por desarrollar mundos
    digitales de alta calidad y
    experiencias memorables.

</p>

</article>



<article class="card">

<div class="icon">
    ♛
</div>

<h3>
    Valores
</h3>

<p>

    Innovación, creatividad, calidad,
    responsabilidad, colaboración,
    pasión y orientación al usuario.

</p>

</article>


</div>

</div>

</section>



<!-- =====================================================
     PRODUCTOS
===================================================== -->

<section id="productos" class="section">

<div class="container">


<div class="product-top">

<div>

<span class="eyebrow">
    Catálogo
</span>

<h2>
    Productos y servicios
</h2>

<p class="lead">

    Soluciones premium diseñadas
    para jugadores, empresas y marcas.

</p>

</div>

</div>



<div class="cards">


<?php foreach ($productos as $id => $producto): ?>

<article class="card product-card">


<div class="icon">

<?= $producto["icono"] ?>

</div>


<span class="badge">

<?= htmlspecialchars(
    $producto["categoria"]
) ?>

</span>


<h3>

<?= htmlspecialchars(
    $producto["nombre"]
) ?>

</h3>


<p>

<?= htmlspecialchars(
    $producto["descripcion"]
) ?>

</p>


<div class="price">

<?= mxn(
    $producto["precio"]
) ?>

</div>


<a
    href="?agregar=<?= $id ?>"
    class="btn btn-primary"
>

Agregar al carrito

</a>


</article>

<?php endforeach; ?>


</div>

</div>

</section>



<!-- =====================================================
     GALERÍA
===================================================== -->

<section class="section">

<div class="container">


<span class="eyebrow">
    Experiencias
</span>


<h2>

    El universo

    <span class="gradient-text">
        Nexora.
    </span>

</h2>


<div class="gallery">


<div class="gallery-item">

<div class="gallery-content">

<h3>
    Nexora Realms
</h3>

<p>
    Fantasía • RPG • Aventura
</p>

</div>

</div>



<div class="gallery-item">

<div class="gallery-content">

<h3>
    Nexora Arena
</h3>

<p>
    Acción • Competitivo
</p>

</div>

</div>



<div class="gallery-item">

<div class="gallery-content">

<h3>
    Experiencias 3D
</h3>

<p>
    Tecnología • Inmersión
</p>

</div>

</div>



<div class="gallery-item">

<div class="gallery-content">

<h3>
    Nexora Future
</h3>

<p>
    Innovación • Tecnología
</p>

</div>

</div>


</div>

</div>

</section>



<!-- =====================================================
     FODA
===================================================== -->

<section id="foda" class="section">

<div class="container">


<span class="eyebrow">
    Planeación estratégica
</span>


<h2>
    Análisis FODA
</h2>


<div class="foda">


<article class="card">

<h3>
    Fortalezas
</h3>

<p>

    Identidad visual diferenciada,
    creatividad, enfoque tecnológico,
    propuesta premium y capacidad
    de desarrollar experiencias
    interactivas.

</p>

</article>



<article class="card">

<h3>
    Oportunidades
</h3>

<p>

    Crecimiento de la industria
    de videojuegos, experiencias
    3D, realidad virtual y
    servicios digitales para marcas.

</p>

</article>



<article class="card">

<h3>
    Debilidades
</h3>

<p>

    Inversión inicial elevada,
    necesidad de talento especializado
    y ciclos de desarrollo largos.

</p>

</article>



<article class="card">

<h3>
    Amenazas
</h3>

<p>

    Competencia internacional,
    cambios tecnológicos,
    sobrecostos y cambios
    en plataformas digitales.

</p>

</article>


</div>

</div>

</section>



<!-- =====================================================
     CARRITO
===================================================== -->

<section id="carrito" class="section">

<div class="container">


<span class="eyebrow">
    Sistema de compras
</span>


<h2>

    Tu carrito
    <span class="gradient-text">
        Nexora.
    </span>

</h2>


<div class="cart-box">


<?php if (!$itemsCarrito): ?>


<p class="cart-empty">

    Tu carrito está vacío.

    Explora nuestro catálogo
    y agrega un producto.

</p>


<?php else: ?>


<?php foreach (
    $_SESSION["carrito"]
    as $id => $cantidad
): ?>


<?php if (isset($productos[$id])): ?>


<div class="cart-row">


<div>

<strong>

<?= htmlspecialchars(
    $productos[$id]["nombre"]
) ?>

</strong>


<br>


<small
style="color:var(--muted)"
>

Cantidad:
<?= $cantidad ?>

</small>

</div>


<strong>

<?= mxn(
    $productos[$id]["precio"]
    * $cantidad
) ?>

</strong>


<a
href="?quitar=<?= $id ?>"
class="btn btn-ghost"
>

Quitar

</a>


</div>


<?php endif; ?>


<?php endforeach; ?>


<div
style="
display:flex;
justify-content:space-between;
margin-top:22px;
align-items:center;
"
>

<strong>
    Total
</strong>


<strong
class="price"
style="margin:0"
>

<?= mxn($totalCarrito) ?>

</strong>

</div>


<p
style="
color:var(--muted);
margin-top:12px;
"
>

Para solicitar compra, cotización
o reserva, utiliza nuestro formulario
de contacto.

</p>


<?php endif; ?>


</div>

</div>

</section>



<!-- =====================================================
     CONTACTO
===================================================== -->

<section class="section">

<div class="container">


<div class="contact-cta">


<div>

<span class="eyebrow">
    Contacto
</span>


<h2>

    ¿Creamos el siguiente

    <span class="gradient-text">
        mundo?
    </span>

</h2>


<p class="lead">

    Cuéntanos tu idea.
    Nuestro equipo puede convertirla
    en una experiencia interactiva premium.

</p>

</div>


<div class="actions">


<a
href="contacto.php"
class="btn btn-primary"
>

Abrir formulario →

</a>


<a
href="mailto:<?= $empresa["correo"] ?>"
class="btn btn-ghost"
>

Enviar correo

</a>


</div>


</div>

</div>

</section>


</main>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer>


<div class="container footer-grid">


<div>

<div class="brand">

<span class="brand-mark">
    ✦
</span>

<span>
    NEXORA STUDIO
</span>

</div>


<p style="margin-top:15px">

<?= htmlspecialchars(
    $empresa["slogan"]
) ?>

</p>

</div>



<div>

<h3>
    Empresa
</h3>

<a href="#nosotros">
    Nosotros
</a>

<br>

<a href="#productos">
    Productos
</a>

<br>

<a href="#foda">
    FODA
</a>

<br>

<a href="contacto.php">
    Contacto
</a>

</div>



<div>

<h3>
    Información empresarial
</h3>

<p>
<?= htmlspecialchars(
    $empresa["ubicacion"]
) ?>
</p>

<p>
<?= htmlspecialchars(
    $empresa["telefono"]
) ?>
</p>

<p>
<?= htmlspecialchars(
    $empresa["correo"]
) ?>
</p>

<p style="margin-top:8px">
    Instagram • TikTok • YouTube • LinkedIn
</p>

</div>


</div>


<div class="container copyright">

© <?= date("Y") ?>

NEXORA STUDIO.

Todos los derechos reservados.

Proyecto académico.

</div>


</footer>


</body>

</html>