<?php

$id = $_GET["id"];

if (!filter_var($id, FILTER_VALIDATE_INT)) {
    //si no es un numero que chingue a su madre 
    die("chinga tu madre");
}

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
            Editar Categoria
            <small>llena el formulario para editar una categoria</small>
        </h1>

    </section>
    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Categoria</h3>


                    </div>
                    <!-- default es get, post para obtener algo get para recivirlo (el get lo rembia al propio formulario)  -->
                    <div class="box-body">
                    <?php
                        $sql = "SELECT * FROM categoria_evento WHERE id_categoria = {$id}";
                        $resultado = $conn->query($sql);
                        $categoria_evento = $resultado->fetch_assoc();
                        ?>
                        
                        <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-categoria.php">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="nombre_categoria" name="nombre_categoria">Nombre</label>

                                    <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Categoria" value="<?php echo $categoria_evento["cat_evento"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="icono">Icon (Font-Awesome)</label>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                 <i class="<?php echo $categoria_evento["icono"] ?>"></i>
                                            </div>
                                            <input placeholver= "fa-icon"type="text" name="icono" id="icono" class="form-control pull-right">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <!-- inputrs invisibles, de esta ,amera no ha y necesidad de añadir naeme ni valor a el botoncito del sumint   -->
                                <input type="hidden" name="registro" value="actualizar">
                                <input type="hidden" name="id_registro" value="<?php echo $id?>">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
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