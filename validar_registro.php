<?php if (isset($_POST["submit"])) :
    //Alamacenando valireables 
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $regalo =  $_POST["regalo"];
    $total = $_POST["total_pedido"];
    //convertir un array a json
    $fecha = date("Y-m-d H:i:s");


    //pédidos
    $boletos = $_POST["boletos"];
    $camisas = $_POST["pedido_camisas"];

    require("includes/funciones/funciones.php");
    //si la funcoiin retorna valor se almacena en una variable 
    //y asi tenemos un json, no hay pedo aunque la variable sea de php no hay culo son lla ve y valor 
    $pedido = productos_json($boletos, $camisas, $etiquetas);


    //Eventos 

    $eventos = $_POST["registro"];

    $registro = eventos_json($eventos);
    //si se reicinia varias veces la agina nlos datos se segiran guardando y comulando dentor denuestra ta bla , para ello redirigiremos yse perdera los datos de la pagina previamente usados , y lo ponemos de manera global ya que la uncion que usemos lo requiere 
    try {
        require_once("includes/funciones/bd_conexion.php"); //preparestatemen
        //le demcimos a la base de datos que se prepare par ala consultaest ase envia por otro medio
        $stmt = $conn->prepare("INSERT INTO registrados
             (nombre_registrado,apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo,total_pagado )
            VALUES (?,?,?,?,?,?,?,?)
            ");

        //AQUI ES DONDE SE VAN A AINSERTAR LOS DATOS, en las cadenas de texto va con una s string(cadenas de texto) y entertos i los y luegooo vvan los nombres de las vbvariables 
        //qeu datos 
        $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);
        //ejecuta
        $stmt->execute();
        //cerrar el statement 

        $stmt->close();
        //cerrar conecicon
        $conn->close();

        //este rredicrecciona la coas es que no se debeenviar o mostrar nada en el navegador por esta misma razon 
        //! UNA MANERA SENCILLA DE MATAR! los datos :D 
        header("Location: validar_registro.php?exitoso=1");
    } catch (\Throwable $e) {
        echo $e->getMessage();
    }

?>
<?php endif; ?>




<?php include_once("includes/templates/header.php"); //todo debe estar dentro de un sumibt , isset revisa si la variable exite, debemos eztraer la varibles  
?>

<section class="seccion contenedor">
    <h2>Resumen Registro</h2>
    <?php if (isset($_GET["exitoso"])):
        if ($_GET["exitoso"] == "1") {
            echo "Me exito";
        }

    endif;?>


</section>

<?php include_once("includes/templates/footer.php"); ?>