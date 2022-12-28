<?php 

if (isset($_POST["login-admin"])) {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];
    try {
        include_once "funciones/funciones.php";
        //! SELECCIONAR 
        $stmt = $conn->prepare("SELECT * FROM admins WHERE usuario=?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();

        //SIEMPRE QUE HAY RESULTADOS (OBTENEMOS ALGO LO TENEMOS QUE ILTRAR ) BIEND RESULT -> solo cuando obtenemos un valor devuelta 
        //retorna valor y nostros hace os lo que queremaos con lo que nos debuelve, se regresadsrn en orden asi que cuidao
        //* cuidado cque se revuelva con la s variables de arrigva 

        //! BRO MUCHO CUIDADO CUANDO EXCTRAES DATOS TIENE QUE TENER LA  MISMA CANTIDAD DE LAS COLUMNAS , SI TE FALTA UNO DARTIA ERROR
        $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin, $editado, $nivel);
        //si se realizo algo en la base de datos ->fech imprimer los resultados 
        if ($stmt->affected_rows) { // pal caldo para defrende xd 
            $existe = $stmt->fetch(); //retorna boleano true si se logra iterar sobre este , aunque realmente llega con null cuando no itera sorbre nada 
            //si peude iterar sore si mismo ahora si terorna true :D 
            //si hay contenido 
            if ($existe) {
                //* si existe entonces veremos si la contraseña es correcta -> esta funcion hcae la misma conversion y compara si son iguales o no  
                //se le pasa el string contraseña y leugo se le psasa el encriptado

                if (password_verify($password, $password_admin)) {
                    //! estableciendo una secion 
                    session_start(); //* esto inicia sesion, simpre debe estar donde se deba emplear la sesion :D  per omejor usa funciones
                    //todo: faciles :D 
                    $_SESSION["usuario"] = $usuario_admin;
                    $_SESSION["nombre"] = $nombre_admin;
                    //? Consultando el nivel del administrador
                    $_SESSION["nivel"] = $nivel;
                    $_SESSION["id"] = $id_admin;
                    $respuesta = array(
                        'respuesta' => 'exitoso',
                        'usuario' => $nombre_admin
                    );
                } else {
                    $respuesta = array(
                        'respuesta' => 'Password_incorrecto',
                        //desde contraseña incorrectya 
                    );
                }
            } else {
                $respuesta = array(
                    'respuesta' => 'Usuario_password_ncorrecto',
                    //desde contraseña u user  incorrectya 

                );
            }
        }
        //! SIMPRE OBLIGATORIO SE Q UEDARAN LAS CONEECIONES ABIERTAS  HASTA QUE EL SERVIDOR DESITADA MATAR  LAS CONEECIONES POR INACTIVIDAD 
        $stmt->close();
        $conn->close();
    } catch (\Throwable $th) {
        $respuesta = array(
            'respuesta' => 'error',
        );
    }
    die(json_encode($respuesta));
}