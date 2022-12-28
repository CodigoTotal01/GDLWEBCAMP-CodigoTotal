<?php include_once("includes/templates/header.php");
//cuando termina el pago le mandamos una peticion a l sercisdor de paypal
use PayPal\Rest\ApiContext; //* permite conectaros al servidor
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payment;

//! importar ep apicontext
require "includes/paypal.php";
?>

<section class="seccion contenedor">
  <h2>Resumen Registro</h2>
  <?php

  $paymentId = $_GET['paymentId'];
  //*id del usuario
  $id_pago=(int)$_GET["id_pago"];

  //* Oeticion a la rest apiusar sus metodos estadticos con :: 
  //* le pasamsos el id que queremos revisar -> se inyecta directamenteen la url -> leugo elcontext
$pago = Payment::get($paymentId, $apiContext);
//!pyament execution -> se le pasa el id que se le da  la paersona 
$execution = new PaymentExecution();
$execution->setPayerId($_GET["PayerID"]);
//! importaente 

$resultado = $pago->execute($execution, $apiContext); //* enviando la consulta -> almacena toda la informacion de la transaccion 

//* Muy largo per o necesario 

$respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;
//var_dump($respuesta);
//* Importa el related_resorsources y el state si es complete entones ta bien 

  if ($respuesta == "completed") {
    echo '<div class="resultado correcto">';
    echo "El pago se realizo correctamente! ";
    echo "El id es {$paymentId} ";
    echo '</div>';
    //! traer coneccion co n la vvase de datos 
    require_once("includes/funciones/bd_conexion.php");
    //registrar un nuevo campo 
    //evniar n delete o un update o un create 
    //!ACtualizacion - o agregar nueva tabla 
    $stmt = $conn->prepare("UPDATE registrados SET pagado=? WHERE ID_Registrados=?");
    //PARA DETERMINAR SI PAGO O NO 
    $pagado = 1;
    $stmt->bind_param("ii",$pagado, $id_pago);
    $stmt->execute();
    $stmt->close();
    $conn->close();
  }else{
    echo '<div class="resultado error">';
    echo "Cancelaste el pago :C ! ";
    echo '</div>';
  }

  ?>

</section>

<?php include_once("includes/templates/footer.php"); ?>