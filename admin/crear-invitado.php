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
            Crear Invitado
            <small>llena el formulario para crear un invitado</small>
        </h1>

    </section>
    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Invitado</h3>


                    </div>
                    <!-- default es get, post para obtener algo get para recivirlo (el get lo rembia al propio formulario)  -->
                    <!-- subir imagen en un archivo  -->
                    <div class="box-body">
                        <form role="form" name="guardar-registro-archivo" id="guardar-registro-archivo" method="POST" action="modelo-invitado.php" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="nombre_invitado">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Tu nombre completo">
                                </div>
                                <div class="form-group">
                                    <label for="apellido_invitado">Apellido</label>
                                    <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Tu apellido completo">
                                </div>
                                <div class="form-group">
                                    <label for="biografia_invitado">Descripcion</label>
                                    <textarea class="form-control" id="biografia_invitado" name="biografia_invitado" placeholder="Añada su descripcion" rows="8"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="imagen_invitado">Invitado:</label>
                                    <input class="form-control" type="file" name="archivo_imagen" id="imagen_invitado">
                                    <p>Coloque la imagen de su invitado aqui</p>
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