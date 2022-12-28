<?php
/*
echo '<pre>';
var_dump($_POST);
echo '</pre>';
exit;
*/
if(!isset($_POST['submit'])) {
      exit("Hubo un error");
}

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'includes/paypal.php';


if(isset($_POST['submit'])): 
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $regalo = $_POST['regalo'];
  $total = $_POST['total_pedido'];
  
  $fecha = date('Y-m-d H:i:s');
  // Pedidos
  $boletos = $_POST['boletos'];
  $numero_boletos = $boletos;
  
  $pedidoExtra = $_POST['pedido_extra'];
  $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
  $precioCamisa = $_POST['pedido_extra']['camisas']['precio'];
  $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
  $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];
  include_once 'includes/funciones/funciones.php';
  $pedido = productos_json($boletos, $camisas, $etiquetas);
  $eventos = $_POST['registro'];
  $registro = eventos_json($eventos);
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
      //nos regresa el id de la ultima consulta sobre este
      $ID_registro = $stmt->insert_id;
      //cerrar el statement
   
      $stmt->close();
      //cerrar conecicon
      $conn->close();
   
      //este rredicrecciona la coas es que no se debeenviar o mostrar nada en el navegador por esta misma razon
      //! UNA MANERA SENCILLA DE MATAR! los datos :D
      //header("Location: validar-registro.php?exitoso=1");
    } catch (\Throwable $e) {
      echo $e->getMessage();
    }
  
endif;

$compra = new Payer();
$compra->setPaymentMethod('paypal');
$arreglo_pedido = array();
$i=0;
foreach($numero_boletos as $key => $value) {
      if(  $value['cantidad'] > 0 ) {
            
            ${"articulo$i"} = new Item();
            $arreglo_pedido[] = ${"articulo$i"};
            ${"articulo$i"}->setName('Pase: ' . $key)
                          ->setCurrency('USD')
                          ->setQuantity( (int) $value['cantidad'] )
                          ->setPrice( (int) $value['precio'] );
            $i++;
      }
}

foreach($pedidoExtra as $key => $value) {
      if( (int) $value['cantidad'] > 0 ) {
            if($key == 'camisas') {
                $precio = (float) $value['precio'] * .93;
            } else {
                $precio = (int) $value['precio'];
            }
            ${"articulo$i"} = new Item();
            $arreglo_pedido[] = ${"articulo$i"};
            ${"articulo$i"}->setName('Extras: ' . $key)
                           ->setCurrency('USD')
                           ->setQuantity( (int) $value['cantidad'] )
                           ->setPrice( $precio );
            $i++;
      }
}




$listaArticulos = new ItemList();
$listaArticulos->setItems($arreglo_pedido);




$cantidad = new Amount();
$cantidad->setCurrency('USD')
         ->setTotal($total);
         

$transaccion =  new Transaction();
$transaccion->setAmount($cantidad)
            ->setItemList($listaArticulos)
            ->setDescription('Pago GDLWEBCAMP ')
            ->setInvoiceNumber($ID_registro);
            
$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO . "/pago_finalizado.php?&id_pago={$ID_registro}")
              ->setCancelUrl(URL_SITIO . "/pago_finalizado.php?&id_pago={$ID_registro}");
          

$pago = new Payment();
$pago->setIntent("sale")
     ->setPayer($compra)
     ->setRedirectUrls($redireccionar)
     ->setTransactions(array($transaccion));

try {
    $pago->create($apiContext);
} catch (PayPal\Exception\PayPalConnectionException $pce) {
 
    print_r(json_decode($pce->getData()));
    exit;

}
    
$aprobado = $pago->getApprovalLink();

header("Location: {$aprobado}");

/*nada de html para las redirecciones */


