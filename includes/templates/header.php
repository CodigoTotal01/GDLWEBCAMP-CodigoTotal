<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="UTF-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">

  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Oswald&family=PT+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
  <meta name="theme-color" content="#fafafa">
</head>




  <!--!Palacios Tarrillo Christian  -->

  <header class="site-header">
    <div class="hero">
      <!-- se incluira la imagen via css -->
      <div class="contenido-header">
        <nav class="redes-sociales">
          <!-- navegacion -->
          <a href="#"><i class="fa-brands fa-facebook"></i></a>
          <a href="#"><i class="fa-brands fa-twitter"></i></a>
          <a href="#"><i class="fa-brands fa-pinterest"></i></a>
          <a href="#"><i class="fa-brands fa-youtube"></i></a>
          <a href="#"><i class="fa-brands fa-instagram-square"></i></a>
        </nav>
        <div class="informacion-evento">
          <!-- informacion -->
          <!-- clearfix ya l otiene el html5 bot -->
          <div class="clearfix">
            <p class="fecha"><i class="fa-solid fa-calendar"></i>10-12 Dic</p>
            <p class="ciudad"><i class="fa-solid fa-location-dot"></i>Lima</p>
          </div>

          <!-- Us de font awesome -->
          <h1 class="nombre-sitio">GdlWebcamp</h1>
          <p class="slogan">La mejor conferencia de <span>diseño web</span></p>
        </div>

      </div>
    </div>
  </header>

  <!-- contenedor gris  -->

  <div class="barra">
    <!-- para que no se valla a las orillas  -->
    <div class="contenedor clearfix">
     <a href="index.php">
     <div class="logo">
        <!-- svg es un vector, usan calculo matematico asi que no se distrorccioanan -->
        <img src="img/logo.svg" alt="logo gdlwebcamp">
      </div>
     </a>
 

      <div class="menu-movil">
        <!-- simular menu -->
        <span></span>
        <span></span>
        <span></span>

      </div>

      <nav class="navegacion-principal clearfix">
        <a  href="conferencia.php">Conferencia</a>
        <a href="calendario.php">Calendario</a>
        <a href="invitados.php">Invitados</a>
        <a href="registro.php">Reservaciones</a>
      </nav>
    </div>
    <!--.contenedor -->
  </div>
  <!--.barra -->