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
            Editar Evento
            <small>llena el formulario para editar su evento</small>
        </h1>

    </section>
    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Evento</h3>
                    </div>
                    <!-- default es get, post para obtener algo get para recivirlo (el get lo rembia al propio formulario)  -->
                    <div class="box-body">
                    <!-- consulta rapida  -->
                        <?php
                        $sql = "SELECT * FROM eventos WHERE evento_id = {$id}";
                        $resultado = $conn->query($sql);
                        $evento = $resultado->fetch_assoc();
                        ?>

                        <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-evento.php">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="titulo_evento">Titulo evento: </label>
                                    <!-- par adefenir valor emplear value  -->
                                    <input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Titulo del evento" value="<?php echo $evento["nombre_evento"] ?>">
                                </div>

                                <!-- Seleccionar 
                             -->
                                <div class="form-group enderec">
                                    <la bel for="nombre">Categoria: </la>
                                    <!-- usando select peudes ver algunos modelos ten en cuenta nsus nombres  -->
                                    <select name="categoria_evento" class="form-control seleccionar">

                                        <option value="0">--Seleccione--</option>
                                        <!-- dentro va la consulta y l odemas  -->
                                        <?php
                                        try {
                                            //llenar y seleccion 
                                            $categoria_actual = $evento["id_cat_evento"];
                                            $sql = "SELECT * FROM categoria_evento";
                                            $resultado = $conn->query($sql);
                                            //? entrega masiva de resultados 
                                            while ($cat_evento = $resultado->fetch_assoc()) {
                                                //use option in select
                                                if ($cat_evento["id_categoria"] !=  $categoria_actual) { ?>
                                                    <option value="<?php echo $cat_evento["id_categoria"]; ?>">
                                                        <?php echo $cat_evento["cat_evento"]; ?>
                                                    </option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $cat_evento["id_categoria"]; ?>" selected>
                                                        <?php echo $cat_evento["cat_evento"]; ?>
                                                    </option>
                                        <?php }
                                            }
                                        } catch (\Throwable $th) {

                                            echo "ERROR_ " . $th->getMessage();
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- Dia -->
                                <div class="form-group">
                                    <la bel for="datepicker">Fecha evento: </la>
                                    <!-- usa  componentes de bootrap  -->
                                    <?php
                                    $fecha = $evento["fecha_evento"];
                                    //castear para que se vea mas bonito 
                                    $fecha_formato = date("m/d/Y", strtotime($fecha));


                                    ?>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="fecha" name="fecha_evento" value="<?php echo $fecha_formato ?>">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!--  Hora-->
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>Hora:</label>

                                        <?php
                                        $hora = $evento["hora_evento"];
                                        //castear para que se vea mas bonito 
                                        $hora_formato = date("h:i a", strtotime($hora));


                                        ?>
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker" name="hora" value="<?php echo $hora_formato ?>">

                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </div>

                                <!-- para ver al ponente  -->
                                <div class="form-group">
                                    <la bel for="nombre">Invitado o Ponente: </la>
                                    <!-- usando select peudes ver algunos modelos ten en cuenta nsus nombres  -->
                                    <select name="invitado" class="form-control seleccionar">

                                        <option value="0">--Seleccione--</option>
                                        <!-- dentro va la consulta y l odemas  -->
                                        <?php
                                        try {
                                            $invitado_actual = $evento["id_inv"];

                                            $sql = "SELECT invitado_id, nombre_invitado, apellido_invitado FROM invitados";
                                            $resultado = $conn->query($sql);
                                            //? entrega masiva de resultados 
                                            while ($invitado = $resultado->fetch_assoc()) {
                                                if ($invitado["invitado_id"] != $invitado_actual) : ?>
                                                    <option value="<?php echo $invitado["invitado_id"]; ?>">
                                                        <?php echo $invitado["nombre_invitado"] . " " .  $invitado["apellido_invitado"]; ?>
                                                    </option>
                                                <?php else : ?>
                                                    <option value="<?php echo $invitado["invitado_id"]; ?> " selected>
                                                        <?php echo $invitado["nombre_invitado"] . " " .  $invitado["apellido_invitado"]; ?>
                                                    </option>
                                        <?php endif;
                                            }
                                        } catch (\Throwable $th) {

                                            echo "ERROR_ " . $th->getMessage();
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- validadndo neuvamente la contraseña  -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <!-- inputrs invisibles, de esta ,amera no ha y necesidad de añadir naeme ni valor a el botoncito del sumint   -->
                                <input type="hidden" name="registro" value="actualizar">
                                <input type="hidden" name="id_registro" value="<?php echo $id ?>">
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