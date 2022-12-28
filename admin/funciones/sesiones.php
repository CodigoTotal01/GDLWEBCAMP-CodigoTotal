<?php 

function usuario_autenticado(){
    //si el usuario no existe si es verdaddero existe si no es verdadero no existe 
    if(!revisar_usuario()){
        header("Location: login.php");
        exit;
    }
}
//peudes probar con los valores que desees 
function revisar_usuario(): bool{
    //isset te dice si una variable existe o no 
    return isset($_SESSION["usuario"]); // retorna true o false 
}
//* iniciamos sesion 
session_start();
//consultamos 
usuario_autenticado();