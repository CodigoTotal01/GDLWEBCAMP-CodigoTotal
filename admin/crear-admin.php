<?php
include_once "funciones/sesiones.php";
require_once "funciones/funciones.php";
include_once "templates/header.php";
include_once "templates/barra.php";
include_once "templates/navegacion.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Crear Administrador
            <small>llena el formulario para crear un administrador</small>
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
                        <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-admin.php">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                                </div>
                                <div class="form-group">
                                    <la bel for="nombre">Tu nombre</la>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre completo">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                                <!-- validadndo neuvamente la contraseña  -->
                                <div class="form-group">
                                    <label for="repetir_password">Repetir Password</label>
                                    <input type="password" class="form-control" id="repetir_password" name="repetir_password" placeholder="Repetir Password">
                                    <!-- INDICANDO SI ES O NO ES IGUAL LAS CONTRASEÑAS  -->
                                    <span id="resultado_password" class="help-block"></span>
                                </div>


                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <!-- inputrs invisibles, de esta ,amera no ha y necesidad de añadir naeme ni valor a el botoncito del sumint   -->
                                <input type="hidden" name="registro" value="nuevo">
                                <button type="submit" class="btn btn-primary">Añadir</button>
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