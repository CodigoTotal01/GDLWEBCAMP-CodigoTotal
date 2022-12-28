<?php
$id = $_GET["id"];
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die("Jijihuha");
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
            Edita el Invitado
            <small>llena el formulario para editar un invitado</small>
        </h1>

    </section>
    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Invitado</h3>
                    </div>
                    <!-- default es get, post para obtener algo get para recivirlo (el get lo rembia al propio formulario)  -->
                    <!-- subir imagen en un archivo  -->
                    <div class="box-body">

                    <?php
                        $sql = "SELECT * FROM invitados WHERE invitado_id = {$id}";
                        $resultado = $conn->query($sql);
                        $invitado = $resultado->fetch_assoc();
                        ?>


                        <form role="form" name="guardar-registro-archivo" id="guardar-registro-archivo" method="POST" action="modelo-invitado.php" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="nombre_invitado">Nombre</label>
                                    <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Tu nombre completo" value="<?php echo $invitado["nombre_invitado"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="apellido_invitado">Apellido</label>
                                    <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Tu apellido completo" value="<?php echo $invitado["apellido_invitado"] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="biografia_invitado">Descripcion</label>
                                    <textarea class="form-control" id="biografia_invitado" name="biografia_invitado" placeholder="Añada su descripcion" rows="8"><?php echo $invitado["descripcion"] ?></textarea>
                                </div>

                                <!-- mostrar ingormacion -->
                                <div class="form-group">
                                    <label for="imagen_actual">Imagen Actual:</label>
                                    <br>
                     
                                    <img width="200px" src="../img/invitados/<?php  echo $invitado["url_imagen"]?>" alt="imagen-invitado">
                                  

                                <div class="form-group">
                                    <label for="imagen_invitado">Invitado:</label>
                                    <input class="form-control" type="file" name="archivo_imagen" id="imagen_invitado">
                                    <p>Coloque la imagen de su invitado aqui</p>
                                </div>
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <!-- inputrs invisibles, de esta ,amera no ha y necesidad de añadir naeme ni valor a el botoncito del sumint   -->
                                <input type="hidden" name="registro" value="actualizar">
                                <!-- simpre colocar el id al actualizar o eliminar -->
                                <input type="hidden" name="id_registro" value="<?php  echo $invitado["invitado_id"]?>">
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