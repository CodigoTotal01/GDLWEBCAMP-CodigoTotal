<?php

//invitado 
include_once "funciones/funciones.php";

if (isset($_POST["registro"])) {

    if(isset($_POST["nombre_invitado"])){
        $nombre_invitado = $_POST["nombre_invitado"];
    }


    if(isset($_POST["apellido_invitado"])){
        $apellido_invitado = $_POST["apellido_invitado"];

    }
    if(isset($_POST["biografia_invitado"])){
        $biografia_invitado = $_POST["biografia_invitado"];

    }
    if(isset($_POST["id_registro"])){
        $id_registro = $_POST["id_registro"];

    }

    //agregando
    if ($_POST["registro"] == "nuevo") {
        //die(json_encode($respuesta));
        $directorio = "../img/invitados/";
        #php corre en un servidor acceso a directorios 
        if (!is_dir($directorio)) {
            //directorios -> archivos permisos -> servidor -> -> brinda acceso -> write or not write
            mkdir($directorio, 0755, true);
            //recursividad -> evitar dar permisos cada uno 
        }
        //funcion php que permite pasar de la ruta temporal a alguna parte de neustro servirosr 
        if (move_uploaded_file($_FILES["archivo_imagen"]["tmp_name"], $directorio . $_FILES["archivo_imagen"]["name"])) {
            $imagen_url = $_FILES["archivo_imagen"]["name"];
            $imagen_resultado = "se subio correctamente";
        } else {
            $respuesta = array(
                #tre ultimo error
                "respuesta" => error_get_last(),
            );
        }

        try {
            $stmt = $conn->prepare("INSERT INTO invitados ( nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $nombre_invitado, $apellido_invitado, $biografia_invitado, $imagen_url);
            $stmt->execute();
            $id_insertado = $stmt->insert_id;
            if ($stmt->affected_rows) {
                $respuesta = array(
                    "respuesta" => "exito",
                    "id_insertado" => $id_insertado,
                    "resultado imagen " => $imagen_resultado
                );
            } else {
                $respuesta = array(
                    "respuesta" => "error",
                );
            }
            $stmt->close();
            $conn->close();
        } catch (\Throwable $th) {
            $respuesta = array(
                "respuesta" => "error query:" . $th->getMessage(),
            );
        }


        die(json_encode($respuesta));
    }
    if ($_POST["registro"] == "actualizar") {
        $directorio = "../img/invitados/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }
        if (move_uploaded_file($_FILES["archivo_imagen"]["tmp_name"], $directorio . $_FILES["archivo_imagen"]["name"])) {
            $imagen_url = $_FILES["archivo_imagen"]["name"];
            $imagen_resultado = "se subio correctamente";
        } else {
            $respuesta = array(
                "respuesta" => error_get_last(),
            );
        }
            try {
                #quiere decir que subio algo :D 
                if ($_FILES["archivo_imagen"]["size"] > 0) {
                    //con imagen -> 
                    $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen=?, editado=NOW() WHERE invitado_id=?");
                    $stmt->bind_param("ssssi", $nombre_invitado, $apellido_invitado, $biografia_invitado, $imagen_url, $id_registro);
                } else {
                    //sin imagen o cuando no se cambia
                    $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, editado=NOW() WHERE invitado_id=?");
                    $stmt->bind_param("sssi", $nombre_invitado, $apellido_invitado, $biografia_invitado, $id_registro);
                }

                $stmt->execute();
                $registros = $stmt->affected_rows;
                //que se halla cambiado alemnnos algo deneustra vase de datos 
                if ($registros) {
                    $respuesta = array(
                        'respuesta' =>  "exito",
                        '$id_insertado' => $id_registro,
                    );
                } else {
                    $respuesta = array(
                        'respuesta' =>  "error"
                    );
                }
                $stmt->close();
                $conn->close();
            } catch (\Throwable $th) {
                $respuesta = array(
                    'respuesta' =>  $th->getMessage()
                );
            }
       
        die(json_encode($respuesta));
    }
    if ($_POST["registro"] == "eliminar") {

        $id_borrar = $_POST["id"];
        try {
            $stmt = $conn->prepare("DELETE FROM invitados WHERE invitado_id = ?");
            $stmt->bind_param("i",  $id_borrar);
            //! para lidiar los problemas feos se guardara registros 
            $stmt->execute();
            //si algo camio dentro de neustra tabla 
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_eliminado' =>  $id_borrar
                );
            } else {
                $respuesta = array(
                    'respuesta ' => 'error',
                );
            }
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta ' => $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
}



//WTF... ahora si funciona -> hace todo lo que debe 
