<?php

//Esdtable ce coneccion con la base de datos 
$conn = new mysqli("localhost", "root", "root", "gdlwebcamp");
$conn->set_charset("utf8");
//si ves el contenido esta en NULL o sea no hay eror
if($conn->connect_error){
echo $error->$conn->connect_error;
}
?>