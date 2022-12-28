<section class="seccion contenedor">
    <h2>Invitados</h2>
    <?php
    try {
        require_once("includes/funciones/bd_conexion.php");
        //todo biene desde una sola tabla 
        $sql = "SELECT * FROM invitados";

        $resultado = $conn->query($sql);
    } catch (\Throwable $e) {
        echo $e->getMessage();
    }
    ?>
    <section class="invitados contenedor  seccion">

        <ul class="lista-invitados ">

            <div class="invitados">

                <?php while ($invitados = $resultado->fetch_assoc()) { ?>
                    <li>
                        <div class="invitado">
                            <a class="invitado-info"  href="#invitado<?php echo $invitados["invitado_id"];?>">

                            <img src="img/invitados/<?php echo $invitados["url_imagen"];?>" alt="imagen invitado">
                            <p><?php echo $invitados["nombre_invitado"] . " " . $invitados["apellido_invitado"]; ?></p>
                            </a>
                        </div>

                    </li> <!-- fiin nvitado -->


                    <div style="display: none;">
                        <div class="invitado-info" id="invitado<?php echo $invitados["invitado_id"];?>">
                            <h2><?php echo $invitados["nombre_invitado"] . " " . $invitados["apellido_invitado"]; ?></h2>
                            <img src="img/invitados/<?php echo $invitados["url_imagen"];?>" alt="imagen invitado">

                            <p><?php echo $invitados["descripcion"]; ?></p>
                        </div>
                    </div>
                    
                <?php  }  ?>

                <!-- color box es goosd porque ermite usar htlml y mostrar este miosmo  -->

        </ul>
    </section>
    </div>
    <?php $conn->close(); ?>



</section>