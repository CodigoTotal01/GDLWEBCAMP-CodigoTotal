<?php include_once("includes/templates/header.php"); ?>


<section class="seccion contenedor">
    <h2>Calendario de eventos</h2>
    <?php
    try {
        require_once("includes/funciones/bd_conexion.php");
        //consulta SQL
        //consulta SQL, solo traeeremos lo que necesitamos ojo el cat evento no es de la tabla es de su tabla padre  ponlo asi y eso esta bien RECUERDA  EL ESPACIO
        //cUANDO SE BUSCA OBTENER DATOS (QUE BIENEN COOMO NUMEROS APRTIR DE LA LALVE FORANEA  SE PONE EL NOMBRE LA COLUMANA QUE CONTENIENE LA INFORMACION QUE DESEAMOS )
        $sql = "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono , nombre_invitado, apellido_invitado ";
        $sql .=  " FROM eventos "; // traer los datos de las columnas de eventos y leugo hacer el join simplement e relacionaremos lo de ambas tablas el dato que debe ser igual
        //tabla (padre del dato)en la que vamos hacer join 
        $sql .= " INNER JOIN categoria_evento ";
        //que dato sera en ambas tablas(seleciona la tabla que hereda los datos y su tabla con el punto)) 
        //query ufuncion para hacer la conslta  = a la otra tabla y la columna
        $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria "; //y asi se relaciona dos tablas 


        //relacionando los datos de la otra tabla 
        $sql .= " INNER JOIN invitados ";

        $sql .= " ON eventos.id_inv = invitados.invitado_id ";
        //POR ULTIMO DAMOS UN ORDEN 
        $sql .= " ORDER BY evento_id ";

        $resultado = $conn->query($sql);
    } catch (\Throwable $e) {
        echo $e->getMessage();
    }



    ?>

    <div class="calendario">

        <!-- //fech asoc es la forma en como se imprime es el mas usado definitivamente  permitira traerlo en un array asociativo, recuerda que debemos iterar sobre este y emplear lo de no me acuerdo c  -->
        <?php

        //!formatearemso neustro arreglo de la base de datos para tener mayor control  sobre todos los datos de las tablas 

        //hay array pero no es good, fech all imprime todo el contenido por array pero mucho mejorcitpero asoc te permite usar lasos array asociativos 

        $calendario = array();

        while ($eventos = $resultado->fetch_assoc()) {

            //fecha del evento 
            $fecha = $eventos["fecha_evento"];
            //Otro arrego que almacenara los datos 
            $evento = array(
                "titulo" => $eventos["nombre_evento"],
                "fecha" => $eventos["fecha_evento"],
                "hora" => $eventos["hora_evento"],
                "categoria" => $eventos["cat_evento"],
                "icono" =>$eventos["icono"],
                "invitado" => $eventos["nombre_invitado"] . " " . $eventos["apellido_invitado"],


            );




            //Separar los datos por catergorias, va a agrupar lso objetos que cntengan la misma fecha  
            //En este caso agrupa por fecha (pero solo las qaue son iguales a esta es myyt raro )
            $calendario[$fecha][] = $evento;
        ?>



        <?php  } //while de fech assoc
        ?>
        <?php
        //si es solo dia me entrgre a todo el contendo de las tres fechas pero si 
        //DIA KEY
        foreach ($calendario as $dia => $lista_eventos) { ?>
            <h3 class="comodin">
                <i class=" fa fa-calendar"> </i>
                <?php //formato de fecha a españaol , dependera tambien del servidor
                setlocale(LC_TIME, "spanish");
                //para dar formato dde fecha , esta funcion convierte un string a formato fecha en php
               //esta funcion no hacepta camvios en la
               echo date(" F j, Y", strtotime($dia)); ?>
            </h3>

            <?php 
                        //*Otro for each para ver el contenido de nuestros eventos 

                foreach($lista_eventos as $evento){ ?>

                    <div class="dia">
                        <p class="titulo"><?php echo $evento["titulo"]?></p>
                        <p class="hora">
                      
                            <i class="fa-solid fa-clock" aria-hidden="true"></i>
                            <?php echo $evento["fecha"]. " " . $evento["hora"]?>
                        </p>
                        <p><i class="fa-solid <?php echo $evento["icono"];  ?> "aria-hidden="true"></i>
                        <?php echo $evento["categoria"];  ?>
                    
                    </p>
                        <p><i class="fa-solid fa-circle-user"aria-hidden="true"></i> <?php echo $evento["invitado"]?></p>
                    </div>
              


                <?php }  ?>
        <?php  } ?>
        



    </div>

    <!-- //Cerrar conexion base de datos  -->
    <?php
    $conn->close();
    ?>
</section>


<?php include_once("includes/templates/footer.php"); ?>