<?php
include_once "funciones/funciones.php";


if (isset($_POST["nombre_categoria"])) {
    $nombre_categoria = $_POST["nombre_categoria"];
}


if (isset($_POST["icono"])) {
    $icono = $_POST["icono"];}

if (isset($_POST["id_registro"])) {
    $id_registro = $_POST["id_registro"];
}







if ($_POST["registro"] == "nuevo") {
  
    try {
        $stmt = $conn->prepare("INSERT INTO categoria_evento (cat_evento, icono) VALUES (?,?) ");
        $stmt->bind_param("ss", $nombre_categoria, $icono);
        $stmt->execute();
     
        $id_insertado = $stmt->insert_id;
        if ($stmt->affected_rows) {
            $respuesta = array(
                "respuesta" => "exito",
                "id_insertado" => $id_insertado,
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
            "hora " =>  $hora
        );
    }
    die(json_encode($respuesta));
}

if ($_POST["registro"] == "actualizar") {

    try {
        $stmt = $conn->prepare("UPDATE categoria_evento SET cat_evento = ?, icono = ?, editado=NOW() WHERE id_categoria=?");
        $stmt->bind_param("ssi", $nombre_categoria, $icono, $id_registro);
        $stmt->execute();
        //! No puedes implear el inset_id en un uptdate 
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' =>  "exito", 
                '$id_insertado' =>$id_registro,
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

    try {
        $stmt = $conn->prepare("DELETE FROM categoria_evento WHERE id_categoria=?");
        $stmt->bind_param("i",  $_POST["id"]);
        $stmt->execute();
        //si algo camio dentro  neustra tabla 
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

