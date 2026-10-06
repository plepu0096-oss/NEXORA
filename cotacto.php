<?php

session_start();


/* =========================
   INFORMACIÓN DE NEXORA
========================= */

$empresa = [

    "nombre" => "NEXORA STUDIO",

    "slogan" =>
        "Creamos mundos, no solo juegos.",

    "ubicacion" =>
        "Ciudad de México, México",

    "telefono" =>
        "+52 55 8000 2026",

    "correo" =>
        "contacto@nexorastudio.mx"

];


/* =========================
   VARIABLES
========================= */

$enviado = false;

$error = "";

$nombre = "";
$correo = "";
$telefono = "";
$empresaCliente = "";
$servicio = "";
$presupuesto = "";
$mensaje = "";


/* =========================
   PROCESAR FORMULARIO
========================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre =
        trim($_POST["nombre"] ?? "");

    $correo =
        trim($_POST["correo"] ?? "");

    $telefono =
        trim($_POST["telefono"] ?? "");

    $empresaCliente =
        trim($_POST["empresa"] ?? "");

    $servicio =
        trim($_POST["servicio"] ?? "");

    $presupuesto =
        trim($_POST["presupuesto"] ?? "");

    $mensaje =
        trim($_POST["mensaje"] ?? "");


    /* VALIDACIONES */

    if (
        $nombre === "" ||
        $correo === "" ||
        $servicio === "" ||
        $mensaje === ""
    ) {

        $error =
            "Completa los campos obligatorios antes de enviar el formulario.";

    }


    elseif (
        !filter_var(
            $correo,
            FILTER_VALIDATE_EMAIL
        )
    ) {

        $error =
            "Ingresa un correo electrónico válido.";

    }


    else {

        /*
        Guardamos temporalmente
        la información en la sesión.

        Posteriormente puedes conectarlo
        con MySQL.
        */

        $_SESSION["ultimo_contacto"] = [

            "nombre" =>
                $nombre,

            "correo" =>
                $correo,

            "telefono" =>
                $telefono,

            "empresa" =>
                $empresaCliente,

            "servicio" =>
                $servicio,

            "presupuesto" =>
                $presupuesto,

            "mensaje" =>
                $mensaje,

            "fecha" =>
                date("Y-m-d H:i:s")

        ];


        $enviado = true;
    }
}


/* =========================
   SEGURIDAD HTML
========================= */

function e($texto)
{

    return htmlspecialchars(
        $texto,
        ENT_QUOTES,
        "UTF-8"
    );

}

?>


<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">


<meta
name="viewport"
content="width=device-width, initial-scale=1.0"
>


<meta
name="description"
content="Contacto de Nexora Studio."
>


<title>
Contacto | NEXORA STUDIO
</title>


<style>

/* =====================================================
   PALETA NEXORA
===================================================== */

:root {

    --night: #081126;

    --purple: #6D28D9;

    --blue: #2563EB;

    --cyan: #38BDF8;

    --gold: #F5C77A;

    --white: #F8FAFC;

    --muted: #AAB7D1;

    --line: rgba(148,163,184,.18);
}


/* =====================================================
   GENERAL
===================================================== */

* {

    box-sizing: border-box;

    margin: 0;

    padding: 0;
}


body {

    font-family:
        Inter,
        "Segoe UI",
        Arial,
        sans-serif;

    color: var(--white);

    min-height: 100vh;

    background:

        radial-gradient(
            circle at 15% 10%,
            rgba(109,40,217,.20),
            transparent 28%
        ),

        radial-gradient(
            circle at 85% 20%,
            rgba(56,189,248,.13),
            transparent 25%
        ),

        var(--night);

    line-height: 1.6;
}


a {

    text-decoration: none;

    color: inherit;
}


.container {

    width: min(1100px, 92%);

    margin: auto;
}


/* =====================================================
   NAV
===================================================== */

.top {

    padding: 22px 0;
}


.nav {

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 12px 16px;

    border:
        1px solid var(--line);

    border-radius: 18px;

    background:
        rgba(8,17,38,.75);

    backdrop-filter:
        blur(18px);
}


.brand {

    display: flex;

    align-items: center;

    gap: 10px;

    font-weight: 900;

    letter-spacing: 2px;
}


.mark {

    width: 42px;

    height: 42px;

    display: grid;

    place-items: center;

    border-radius: 13px;

    background:
        linear-gradient(
            135deg,
            var(--purple),
            var(--blue)
        );

    box-shadow:
        0 0 28px
        rgba(109,40,217,.45);
}


.back {

    color: var(--cyan);

    font-weight: 800;
}


/* =====================================================
   CONTENIDO
===================================================== */

main {

    padding:
        60px 0 100px;
}


.grid {

    display: grid;

    grid-template-columns:
        .75fr 1.25fr;

    gap: 30px;

    align-items: start;
}


.eyebrow {

    color: var(--gold);

    text-transform: uppercase;

    letter-spacing: 3px;

    font-size: .75rem;

    font-weight: 800;
}


h1 {

    font-size:
        clamp(2.7rem, 6vw, 5rem);

    line-height: 1.02;

    margin:
        14px 0 20px;
}


.gradient {

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


.lead {

    color: var(--muted);

    font-size: 1.05rem;
}


/* =====================================================
   INFORMACIÓN
===================================================== */

.info {

    margin-top: 30px;

    display: grid;

    gap: 12px;
}


.info-card {

    border:
        1px solid var(--line);

    border-radius: 25px;

    background:
        rgba(15,27,55,.72);

    padding: 28px;

    box-shadow:
        0 25px 70px
        rgba(0,0,0,.25);
}


.info-card strong {

    display: block;

    color: var(--gold);

    margin-bottom: 3px;
}


/* =====================================================
   FORMULARIO
===================================================== */

.form {

    border:
        1px solid var(--line);

    border-radius: 25px;

    background:
        rgba(15,27,55,.72);

    padding: 28px;

    box-shadow:
        0 25px 70px
        rgba(0,0,0,.25);
}


form {

    display: grid;

    gap: 16px;
}


.row {

    display: grid;

    grid-template-columns:
        1fr 1fr;

    gap: 15px;
}


label {

    font-weight: 800;

    font-size: .88rem;

    display: block;

    margin-bottom: 7px;
}


input,
textarea,
select {

    width: 100%;

    border:
        1px solid var(--line);

    border-radius: 12px;

    background: #080f22;

    color: var(--white);

    padding: 13px;

    outline: none;
}


input:focus,
textarea:focus,
select:focus {

    border-color: var(--cyan);

    box-shadow:
        0 0 0 3px
        rgba(56,189,248,.08);
}


textarea {

    min-height: 150px;

    resize: vertical;
}


/* =====================================================
   BOTÓN
===================================================== */

.btn {

    border: 0;

    border-radius: 13px;

    padding: 14px 20px;

    cursor: pointer;

    color: white;

    font-weight: 900;

    background:

        linear-gradient(
            135deg,
            var(--purple),
            var(--blue)
        );

    box-shadow:
        0 12px 35px
        rgba(37,99,235,.22);
}


/* =====================================================
   MENSAJES
===================================================== */

.success,
.error {

    border-radius: 14px;

    padding: 14px 16px;

    margin-bottom: 18px;
}


.success {

    background:
        rgba(22,163,74,.13);

    border:
        1px solid
        rgba(34,197,94,.35);

    color: #BBF7D0;
}


.error {

    background:
        rgba(220,38,38,.12);

    border:
        1px solid
        rgba(248,113,113,.35);

    color: #FECACA;
}


/* =====================================================
   FOOTER
===================================================== */

footer {

    border-top:
        1px solid var(--line);

    padding: 25px 0;

    color: var(--muted);

    font-size: .85rem;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:800px) {

    .grid,
    .row {

        grid-template-columns: 1fr;
    }

}

</style>

</head>


<body>


<!-- =====================================================
     ENCABEZADO
===================================================== -->

<header class="top">

<div class="container">

<div class="nav">


<a
href="index.php"
class="brand"
>

<span class="mark">
    ✦
</span>

<span>
    NEXORA
</span>

</a>


<a
href="index.php"
class="back"
>

← Regresar al sitio

</a>


</div>

</div>

</header>



<!-- =====================================================
     CONTENIDO
===================================================== -->

<main>

<div class="container grid">


<!-- INFORMACIÓN -->

<section>


<span class="eyebrow">

NEXORA STUDIO • CONTACTO

</span>


<h1>

Hablemos de tu próximo

<span class="gradient">
    mundo.
</span>

</h1>


<p class="lead">

Cuéntanos sobre tu proyecto,
videojuego, experiencia 3D
o colaboración.

El equipo de Nexora analizará
tu solicitud y preparará
una propuesta.

</p>



<div class="info">


<div class="info-card">

<strong>
    Dirección
</strong>

<?= e(
    $empresa["ubicacion"]
) ?>

</div>



<div class="info-card">

<strong>
    Teléfono
</strong>

<?= e(
    $empresa["telefono"]
) ?>

</div>



<div class="info-card">

<strong>
    Correo
</strong>

<?= e(
    $empresa["correo"]
) ?>

</div>



<div class="info-card">

<strong>
    Redes sociales
</strong>

Instagram • TikTok • YouTube • LinkedIn

</div>


</div>


</section>



<!-- FORMULARIO -->

<section class="form">


<?php if ($enviado): ?>

<div class="success">

<strong>
    Solicitud recibida.
</strong>

<br>

Gracias,
<?= e($nombre) ?>.

Tu mensaje quedó registrado
correctamente.

</div>

<?php endif; ?>



<?php if ($error !== ""): ?>

<div class="error">

<?= e($error) ?>

</div>

<?php endif; ?>



<form
method="POST"
action="contacto.php"
>


<!-- NOMBRE / CORREO -->

<div class="row">


<div>

<label for="nombre">
    Nombre *
</label>


<input

id="nombre"

name="nombre"

type="text"

required

value="<?= e($nombre) ?>"

placeholder="Tu nombre"

>

</div>



<div>

<label for="correo">
    Correo electrónico *
</label>


<input

id="correo"

name="correo"

type="email"

required

value="<?= e($correo) ?>"

placeholder="nombre@correo.com"

>

</div>


</div>



<!-- TELÉFONO / EMPRESA -->

<div class="row">


<div>

<label for="telefono">
    Teléfono
</label>


<input

id="telefono"

name="telefono"

type="tel"

value="<?= e($telefono) ?>"

placeholder="+52"

>

</div>



<div>

<label for="empresa">
    Empresa / organización
</label>


<input

id="empresa"

name="empresa"

type="text"

value="<?= e($empresaCliente) ?>"

placeholder="Nombre de empresa"

>

</div>


</div>



<!-- SERVICIO / PRESUPUESTO -->

<div class="row">


<div>

<label for="servicio">

¿Qué necesitas? *

</label>


<select
id="servicio"
name="servicio"
required
>

<option value="">
    Selecciona una opción
</option>

<option>
    Videojuego
</option>

<option>
    Experiencia 3D
</option>

<option>
    Desarrollo a medida
</option>

<option>
    Colaboración / alianza
</option>

<option>
    Otro
</option>

</select>

</div>



<div>

<label for="presupuesto">

Presupuesto aproximado

</label>


<select
id="presupuesto"
name="presupuesto"
>

<option value="">
    Selecciona un rango
</option>

<option>
    Hasta $100,000 MXN
</option>

<option>
    $100,000 - $500,000 MXN
</option>

<option>
    $500,000 - $1,000,000 MXN
</option>

<option>
    +$1,000,000 MXN
</option>

</select>

</div>


</div>



<!-- MENSAJE -->

<div>

<label for="mensaje">

Cuéntanos tu proyecto *

</label>


<textarea

id="mensaje"

name="mensaje"

required

placeholder="Describe brevemente tu idea, objetivos y necesidades..."

><?= e($mensaje) ?></textarea>

</div>



<!-- BOTÓN -->

<button
class="btn"
type="submit"
>

Enviar solicitud ✦

</button>


</form>


</section>


</div>

</main>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer>

<div class="container">

© <?= date("Y") ?>

NEXORA STUDIO

•

<?= e(
    $empresa["slogan"]
) ?>

</div>

</footer>


</body>

</html>