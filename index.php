<?php include_once("includes/templates/header.php"); ?>
<!-- contenido de seccion -->

<section class="seccion contenedor">
  <h2>La mejor conferencia de diseño web en español</h2>
  <p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. In, nobis voluptatem cum distinctio mollitia ab accusamus
    vitae ipsum numquam. Id praesentium eligendi ad sapiente quod fuga nobis fugit, dignissimos tempore.
  </p>
</section>

<!-- contenido de la programacion-->
<section class="programa">
  <div class="contenedor-video">
    <video autoplay muted loop poster="img/bg-talleres.jpg">
      <!-- souce es para imagens , videos, audio sirve para conteneido multimedia en varias paltaformas   -->
      <source src="video/video.mp4" type="video/mp4">
      <source src="video/video.webm" type="video/mp4">
      <source src="video/video.ogv" type="video/mp4">
    </video>
  </div> <!-- .contenedor-video -->
  <div class="contenido-programa">
    <div class="contenedor">
      <div class="programa-evento">
        <h2>Programa evento</h2>
        <!-- brindar informacion desde la base de datos -->
        <?php
        try {
          require_once("includes/funciones/bd_conexion.php");
          //consulta SQL
          //consulta SQL, solo traeeremos lo que necesitamos ojo el cat evento no es de la tabla es de su tabla padre  ponlo asi y eso esta bien RECUERDA  EL ESPACIO
          //cUANDO SE BUSCA OBTENER DATOS (QUE BIENEN COOMO NUMEROS APRTIR DE LA LALVE FORANEA  SE PONE EL NOMBRE LA COLUMANA QUE CONTENIENE LA INFORMACION QUE DESEAMOS )
          $sql = "SELECT * FROM categoria_evento ";
          $resultado = $conn->query($sql);
        } catch (\Throwable $e) {
          echo $e->getMessage();
        }
        ?>
        <nav class="menu-programa">
          <?php while ($cat =   $resultado->fetch_array(MYSQLI_ASSOC)): ?>
          <?php $categoria=$cat["cat_evento"] //nos entrega un arreglo asositivo con los datos ;?>
          <a href="#<?php echo strtolower($categoria)?>"><i class="fa-solid <?php echo $cat["icono"];?>"></i><?php echo $categoria;?></a>
          <?php endwhile;?>
        </nav>


        <?php try {
require_once("includes/funciones/bd_conexion.php");
$sql = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono , nombre_invitado, apellido_invitado ";
$sql .=  " FROM eventos "; 
$sql .= " INNER JOIN categoria_evento ";
$sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria "; //y asi se relaciona dos tablas 
$sql .= " INNER JOIN invitados ";
$sql .= " ON eventos.id_inv = invitados.invitado_id ";
$sql .= " AND eventos.id_cat_evento = 1  ";
$sql .= " ORDER BY evento_id LIMIT 2; ";


$sql .= " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono , nombre_invitado, apellido_invitado ";
$sql .=  " FROM eventos "; 
$sql .= " INNER JOIN categoria_evento ";
$sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria "; //y asi se relaciona dos tablas 
$sql .= " INNER JOIN invitados ";
$sql .= " ON eventos.id_inv = invitados.invitado_id ";
$sql .= " AND eventos.id_cat_evento = 2  ";
$sql .= " ORDER BY evento_id LIMIT 2; ";

$sql .= " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono , nombre_invitado, apellido_invitado ";
$sql .=  " FROM eventos "; 
$sql .= " INNER JOIN categoria_evento ";
$sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria "; //y asi se relaciona dos tablas 
$sql .= " INNER JOIN invitados ";
$sql .= " ON eventos.id_inv = invitados.invitado_id ";
$sql .= " AND eventos.id_cat_evento = 3  ";
$sql .= " ORDER BY evento_id LIMIT 2; ";





$resultado = $conn->query($sql);
} catch (\Throwable $e) {
//echo $e->getMessage(); mejor auqi lo desactivbamos porque por las webas 
}

?>

<!-- //multiquery cuando se realiza esta no olvides cerarla para que nos econsuma de mas la memoria -->
<?php $conn-> multi_query($sql)?>
<!-- ejecutar mis consultas las veces que sean necesarias  -->
<?php 
do {
  $resultado = $conn->store_result();
  $row=$resultado->fetch_all(MYSQLI_ASSOC);?>
  <?php $i=0;?>
  <?php foreach($row as $evento): ?>
    <?php if($i % 2==0){?>
    <div id="<?php echo strtolower($evento["cat_evento"])?>" class="info-curso ocultar clearfix">
    <?php } ?>
          <div class="detalle-evento">
            <h3><?php echo $evento["nombre_evento"]?></h3>
            <p><i class="fa-solid fa-clock"></i><?php echo $evento["hora_evento"]?></p>
            <p><i class="fa-solid fa-calendar"></i><?php echo $evento["fecha_evento"]?></p>
            <!-- recuerda que estmos hacendo referencia a otra clase  -->
            <p><i class="fa-solid fa-user"></i><?php echo $evento["nombre_invitado"]. " ". $evento["apellido_invitado"];?></p>
          </div>
  
        <!-- este cierra en los pares  -->
        <?php if($i % 2==1):?>
          <a href="calendario.php" class="button float-right">Ver todos</a>
         </div>
    <?php endif; ?>
        <?php $i++ ?>
    <?php endforeach; ?>

<?php  $resultado->free()?> 

  <?php  } while ($conn->more_results() && $conn->next_result() );?>



      
        
        <!--tarlleres  -->
        
        <!--tarlleres  -->
      </div>
      <!--progrma evento   -->
    </div><!-- contenedor  -->
  </div><!-- contenido programa  -->
</section> <!-- programa  -->
<?php include_once("includes/templates/invitados.php"); ?>


<div class="contador parallax">
  <div class="contenedor">
    <ul class="resumen-evento clearfix">
      <li>
        <p class="numero"></p>Invitados
      </li>
      <li>
        <p class="numero"></p>Talleres
      </li>
      <li>
        <p class="numero"></p>Días
      </li>
      <li>
        <p class="numero"></p>Conferencias
      </li>
    </ul>
  </div>
</div> <!--  .contador -->

<!-- precios -->
<section class="precios seccion">
  <h2>Precios</h2>
  <div class="contenedor ">
    <ul class="lista-precios">
      <!-- los li pueden contener cualquier elemento que valla en el body -->
      <li>
        <div class="tabla-precio">
          <h3>Pase por día</h3>
          <p class="numero">$30</p>
          <ul>
            <li>Bocadillos gratis</li>
            <li>Todas las Conferencias</li>
            <li>Todos los talleres</li>
          </ul>
          <a href="#" class="button hollow">Comprar</a>
        </div>
      </li><!-- fin li -->
      <li>
        <div class="tabla-precio">
          <h3>Todos los días</h3>
          <p class="numero">$50</p>
          <ul>
            <li>Bocadillos gratis</li>
            <li>Todas las Conferencias</li>
            <li>Todos los talleres</li>
          </ul>
          <a href="#" class="button">Comprar</a>
        </div>
      </li><!-- fin li -->

      <li>
        <div class="tabla-precio">

          <h3>Pase 2 días</h3>
          <p class="numero">$45</p>
          <ul>
            <li>Bocadillos gratis</li>
            <li>Todas las Conferencias</li>
            <li>Todos los talleres</li>
          </ul>
          <a href="#" class="button hollow">Comprar</a>
        </div>
      </li><!-- fin li -->
    </ul>

  </div>
</section>
<!-- .precios -->
<!-- mapa (debe ser sii o si un div como solicita la aplicacion)-->
<div id="mapa" class="mapa"></div>



<!-- testimoniales -->
<section class="seccion">
  <h2>Testimoniales</h2>
  <div class="testimoniales contenedor">
    <div class="testimonial">
      <!-- para los testimniales simpre se usa esta secion -->
      <blockquote>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam optio sint corrupti molestiae quos quas eos
          temporibus, culpa laudantium repudiandae voluptatum eaque, sequi saepe. Dolor distinctio repellat totam ut
          molestias!</p>
        <!-- va aqui tambien el footer y demas  -->
        <footer class="info-testimonial">
          <img src="img/testimonial.jpg" alt="iamge testimonial">
          <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
        </footer>
      </blockquote> <!-- fin testimonio -->
      <blockquote>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam optio sint corrupti molestiae quos quas eos
          temporibus, culpa laudantium repudiandae voluptatum eaque, sequi saepe. Dolor distinctio repellat totam ut
          molestias!</p>
        <!-- va aqui tambien el footer y demas  -->
        <footer class="info-testimonial">
          <img src="img/testimonial.jpg" alt="iamge testimonial">
          <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
        </footer>
      </blockquote> <!-- fin testimonio -->
      <blockquote>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam optio sint corrupti molestiae quos quas eos
          temporibus, culpa laudantium repudiandae voluptatum eaque, sequi saepe. Dolor distinctio repellat totam ut
          molestias!</p>
        <!-- va aqui tambien el footer y demas  -->
        <footer class="info-testimonial">
          <img src="img/testimonial.jpg" alt="iamge testimonial">
          <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
        </footer>
      </blockquote> <!-- fin testimonio -->

    </div>
  </div>
</section>
<!-- /testimoniales -->


<!-- neweletter -->
<div class="newsletter parallax">
  <div class="contenedor contenido">
    <p>Registrate al Newsletter:</p>
    <h3>GdlWebCamp</h3>
    <a href="#" class="button transparente">Registro</a>

  </div>
</div>

<!-- cuenta regresiva -->
<section class="seccion">
  <h2>Faltan</h2>
  <div class="cuenta-regresiva contenedor">
    <ul class="clearfix">
      <li>
        <p id="dias" class="numero"></p>Dias
      </li>
      <li>
        <p id="horas" class="numero"></p>Horas
      </li>
      <li>
        <p id="minutos" class="numero"></p>Minutos
      </li>
      <li>
        <p id="segundos" class="numero"></p>Segundos
      </li>
    </ul>
  </div>
</section>
<!-- contenido de seccion -->
<?php include_once("includes/templates/footer.php"); ?>