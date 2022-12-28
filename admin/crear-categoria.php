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
            Crear Categoria
            <small>llena el formulario para crear una categoria</small>
        </h1>

    </section>
    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Categoria</h3>


                    </div>
                    <!-- default es get, post para obtener algo get para recivirlo (el get lo rembia al propio formulario)  -->
                    <div class="box-body">
                        <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-categoria.php">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="nombre_categoria" name="nombre_categoria">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Categoria">
                                </div>
                                <div class="form-group">
                                    <label for="icono">Icon (Font-Awesome)</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                 <i class="fa fa-address-book"></i>
                                            </div>
                                            <input placeholver= "fa-icon"type="text" name="icono" id="icono" class="form-control pull-right">
                                        </div>
                                    </div>
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