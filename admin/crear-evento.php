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
            Crear Evento
            <small>llena el formulario para crear un evento</small>
        </h1>

    </section>
    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Evento</h3>


                    </div>
                    <!-- default es get, post para obtener algo get para recivirlo (el get lo rembia al propio formulario)  -->
                    <div class="box-body">
                        <form role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-evento.php">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="titulo_evento">Titulo evento: </label>
                                    <input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Titulo del evento">
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
                                            $sql = "SELECT * FROM categoria_evento";
                                            $resultado = $conn->query($sql);
                                            //? entrega masiva de resultados 
                                            while ($cat_evento = $resultado->fetch_assoc()) { ?>
                                                //use option in select
                                                <option value="<?php echo $cat_evento["id_categoria"]; ?>">
                                                    <?php echo $cat_evento["cat_evento"]; ?>
                                                </option>
                                        <?php }
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

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="fecha" name="fecha_evento">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!--  Hora-->
                                <div class="bootstrap-timepicker">
                                    <div class="form-group">
                                        <label>Hora:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control timepicker" name="hora">

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
                                            $sql = "SELECT invitado_id, nombre_invitado, apellido_invitado FROM invitados";
                                            $resultado = $conn->query($sql);
                                            //? entrega masiva de resultados 
                                            while ($invitado = $resultado->fetch_assoc()) { ?>
                                                <option value="<?php echo $invitado["invitado_id"]; ?>">
                                                    <?php echo $invitado["nombre_invitado"] . " " .  $invitado["apellido_invitado"]; ?>
                                                </option>
                                        <?php }
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
                                <input type="hidden" name="registro" value="nuevo">
                                <button type="submit" class="btn btn-primary" >Guardar</button>
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