<?php
if (isset($_POST["registro"])) {
    include_once "funciones/funciones.php";

    if (isset($_POST["titulo_evento"])) {
        $titulo = $_POST["titulo_evento"];
    }
    if (isset($_POST["categoria_evento"])) {
        $categoria_id = $_POST["categoria_evento"];
    }
    if (isset($_POST["invitado"])) {
        $invitado_id = $_POST["invitado"];
    }
    if (isset($_POST["hora"])) {
        $horaPost = $_POST["hora"];
        $hora =  date("H:i:s", strtotime($horaPost));
    }
    //cuida el formato de tu bd y normal 
    if (isset($_POST["fecha_evento"])) {
        $fecha = $_POST["fecha_evento"];
        //? formateo de la fecha  -> funcion especial apra este tipo de casos  ->textual en Inglés a una fecha Unix
        $fecha_formateada = date("Y-m-d", strtotime($fecha)); // ahora si esta para enviar como para la base de datos 

    }
    //* Reutiliza codigo cada que puedas 
    if (isset($_POST["id_registro"])) {
        $id_registro = $_POST["id_registro"];
    }
    
    //? Acciones importantes
    if ($_POST["registro"] == "nuevo") {
        try {
            $stmt = $conn->prepare("INSERT INTO eventos ( nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv) VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssii", $titulo, $fecha_formateada, $hora, $categoria_id, $invitado_id);
            $stmt->execute();
            //? sugerencia debajo desoues de ejecutar 
            $id_insertado = $stmt->insert_id;
            //*si se inserto algo o se modifico o se interactuo con la tabla 
            if ($stmt->affected_rows) {
                $respuesta = array(
                    "respuesta" => "exito",
                    "id_insertado" => $id_insertado,
                    "hora " =>  $hora
                );
            } else {
                $respuesta = array(
                    "respuesta" => "error",
                    "hora " =>  $hora
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
            $stmt = $conn->prepare("UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_cat_evento=?, id_inv=?, editado=NOW() WHERE evento_id=?");
            $stmt->bind_param("sssiii", $titulo, $fecha_formateada, $hora, $categoria_id, $invitado_id, $id_registro);
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
  
        $id_borrar = $_POST["id"];
        try {
            $stmt = $conn->prepare("DELETE FROM eventos WHERE evento_id = ?");
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
