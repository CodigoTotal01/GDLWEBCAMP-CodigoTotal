<?php

include_once "funciones/sesiones.php";
include_once "templates/header.php";
require_once "funciones/funciones.php";
//? aqui se nos pasa desde lista de administradores el id a editar 
$id = $_GET["id"];

//todo: COn que tenga forma de nuemero le vasta  se recomienda validar py/o  sanitizar (lo que quiero valicdar, como lo validare )
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    //si no es un numero que chingue a su madre 
    die("chinga tu madre");
}
include_once "templates/barra.php";
include_once "templates/navegacion.php";


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Administrador
            <small>llena el formulario para editar el registro un administrador</small>
        </h1>

    </section>
    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Administrador</h3>


                    </div>
                    <!-- default es get, post para obtener algo get para recivirlo (el get lo rembia al propio formulario)  -->
                    <div class="box-body">
                        <?php
                        //consultas rapiditas, da igual si entre comullas o no 
                        $sql = "SELECT * FROM admins WHERE id_admin = $id";
                        $resultado = $conn->query($sql);
                        //como solo traemos un dato no hace falta iterar 
                        $admin = $resultado->fetch_assoc();  // para msotrar y vert los resutltados 
                        //?desde aqui ya tenemos todos los datos de la consulta LISTOS PARA LLENAR 

                        ?>

                        <form role="form" id="guardar-registro" action="modelo-admin.php" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $admin["usuario"] ?>">
                                </div>
                                <div class="form-group">
                                    <la bel for="nombre">Tu nombre</la>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre completo" value="<?php echo $admin["nombre"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password para iniciar Sesion">
                                </div>


                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <!-- inputrs invisibles, de esta ,amera no ha y necesidad de añadir naeme ni valor a el botoncito del sumint   -->
                                <input type="hidden" name="registro" value="actualizar">
                                <!--todo: en los casos de editar siempre se reqerira del id  -->

                                <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->

                    <!-- /.box-footer-->
                </div>
                <!-- /.box -->

            </section>
        </div>
    </div>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once "templates/footer.php" ?>