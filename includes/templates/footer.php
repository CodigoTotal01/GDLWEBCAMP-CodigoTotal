
  <footer class="site-footer">
    <div class="contenedor">
      <div class="footer-informacion">
        <h3>Sobre <span>gdlwebcamp</span></h3>
        <p>Praesent rutrum efficitur pharetra. Vivamus scelerisque pretium velit, id tempor turpis pulvinar et. Ut
          bibendum finibus massa non molestie. Curabitur urna metus, placerat gravida lacus ut, lacinia congue orci.
          Maecenas luctus mi at ex blandit vehicula. Morbi porttitor tempus euismod.</p>

      </div>
      <div class="ultimos-tweets">
        <h3>Últimos <span>tweets</span></h3>
        <a class="twitter-timeline" data-height="250" data-theme="dark" href="https://twitter.com/01_binario?ref_src=twsrc%5Etfw">Tweets by 01_binario</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>       </div>
      <div class="menu">
        <h3>Redes <span>sociales</span></h3>

        <nav class="redes-sociales">
          <!-- navegacion -->
          <a href="#"><i class="fa-brands fa-facebook"></i></a>
          <a href="#"><i class="fa-brands fa-twitter"></i></a>
          <a href="#"><i class="fa-brands fa-pinterest"></i></a>
          <a href="#"><i class="fa-brands fa-youtube"></i></a>
          <a href="#"><i class="fa-brands fa-instagram-square"></i></a>
        </nav>

      </div>
    </div>

    <p class="copyright">
      © Todos los derechos Reservados GDLWEBCAMP 2022
    </p>

  </footer>


  <!-- codigo que no se para que sirve -->
  <script src="js/vendor/modernizr-3.8.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.lettering.js"></script>
  

  
  <?php 
//obtneienodo el nombre del archivo y su extencion
$archivo = basename($_SERVER["PHP_SELF"]);
//quitar ese .php

$pagina =str_replace(".php","",$archivo);
if($pagina=="invitado" || $pagina=="index" ){
  echo '<script src="js/jquery.colorbox-min.js"></script>';
}else if($pagina=="conferencia"){
  echo '<script src="js/lightbox.js"></script>';

}

?>
  <script src="js/main.js"></script>
  <script src="js/cotizador.js"></script>
  <!-- mapa de leaflet -->

  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set', 'transport', 'beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
  <script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>

</html>