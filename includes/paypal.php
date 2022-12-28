<?php 

//url aquispe

//! De debera modificar para que se oyeda pasar los datos como se debe 
//* llos arreglos deben de sertipo mmultidimencional
define('URL_SITIO', 'http://localhost/gdlwebcamp');

require 'paypal/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'ATx016VoKbe8PoPxKLZMZZe5ic43vFU1TeauQ06FYvf4jmDy6PaD7ca63cDBGUbpN2SKpBxI2kc4VDf1',     // ClientID
        'EKGwXES3ghq2NUnumUyRpOtwElO0XjCljeOCqteE8W35ZYO9pgDEuT6vQscJEuofZt9zP_Byls9LKS8F'      // ClientSecret
    )
);

