<?php



if (isset($_POST["registro"])) {
    include_once "funciones/funciones.php";
    if (isset($_POST["usuario"])) {
        $usuario = $_POST["usuario"];
    }
    if (isset($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
    }
    if (isset($_POST["password"])) {
        $password = $_POST["password"];
    }
    if (isset($_POST["id_registro"])) {
        $id_admin = $_POST["id_registro"];
    }





    if ($_POST["registro"] == "actualizar") {



        try {
            //revisa uqe la variable contenga algo, retorna un booleano 
            if (empty($_POST["password"])) { //si esta vacio es true, si no es false 
                //ejecutar un update
                //?actualamops todo menos la contraseña si es que no nos la pasen 
                //! TOMA LA HORA ACTUAL DE EL SERVIDOR --> CUIDADO -> CON DONDE ESTA ALOJADO, p
                $stmt = $conn->prepare("UPDATE admins SET usuario=?, nombre=?, editado=NOW() WHERE id_admin=?");
                $stmt->bind_param("ssi", $usuario, $nombre, $id_admin);
                //! para lidiar los problemas feos se guardara registros 
                //? no devuelve respuesta 

            } else {
                $opciones = array(
                    "cost" => 12
                );

                //? antes de actualizaar debemos jashear el pasword 
                $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);

                //mas seguridad pero mucha iteracion 
                $stmt = $conn->prepare("UPDATE admins SET usuario=?, nombre=?,password=? WHERE id_admin=?");
                $stmt->bind_param("sssi", $usuario, $nombre, $hash_password, $id_admin);
                //no recivimos datos 
            }


            $stmt->execute();
            //si hubo algun cambio 
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => "exito",
                    'id_actualizado' => $stmt->insert_id, //reucenrda que retorna el id del utlimo elementomodificado 

                );
            } else {

                $respuesta = array(
                    'respuesta' => "error",

                );
            }

            //! CIERRA TODO 
            $stmt->close();
            $conn->close();
        } catch (\Throwable $th) {
            $respuesta = array(
                'respuesta' =>  $th->getMessage()
            );
        }

        die(json_encode($respuesta));
    }

    if ($_POST["registro"] == "nuevo") {

        //!costo default 10, reliiza iteraciones es mas trabajo en el servidor 
        $opciones = array(
            "cost" => 12
        );
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
        /*;*/

        try {
            include_once 'funciones/funciones.php';
            $stmt = $conn->prepare("INSERT INTO admins (usuario, nombre, password) VALUES (?,?,?)");
            $stmt->bind_param("sss", $usuario, $nombre,  $password_hashed);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if ($id_registro > 0) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_admin' => $id_registro,
                    "administrador" => $usuario,
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error',
                    "administrador" => $usuario,
                );
            }
            $stmt->close();
            $conn->close();
        } catch (\Throwable $th) {
            $respuesta = array(
                'respuesta' => 'error',

            );
        }
        die(json_encode($respuesta));
    }

    if ($_POST["registro"] == "eliminar") {
        $id_borrar = $_POST["id"];
        try {
            $stmt = $conn->prepare("DELETE FROM admins WHERE id_admin=?");
             $stmt->bind_param("i",  $id_borrar);
                //! para lidiar los problemas feos se guardara registros 
                $stmt->execute();
                //si algo camio dentro de neustra tabla 
                if($stmt->affected_rows){
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'id_eliminado' =>  $id_borrar
                    );
                }else{
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

