<?php

$id = $_GET["id"];
if(!filter_var($id, FILTER_VALIDATE_INT)){
    die("Fuera mierda");
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
            Editar registro
            <small>llena el formulario para editar un Registro</small>
        </h1>

    </section>
    <div class="row">
        <div class="col-md-8">
            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Registro</h3>


                    </div>
                    <!-- default es get, post para obtener algo get para recivirlo (el get lo rembia al propio formulario)  -->
                    <!-- subir imagen en un archivo  -->
                    <div class="box-body">

                    <?php
                        $sql = "SELECT * FROM registrados WHERE ID_Registrados = {$id}";
                        $resultado = $conn->query($sql);
                        $registrado = $resultado->fetch_assoc();
                        ?>

                        <form class="editar-registrado" role="form" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-registro.php">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input value=" <?php echo $registrado["nombre_registrado"]?>" type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre completo">
                                </div>
                                <div class="form-group">
                                    <label for="apellido">Apellido</label>
                                    <input value=" <?php echo $registrado["apellido_registrado"]?>" type="text" class="form-control" id="apellido" name="apellido" placeholder="Tu apellido completo">
                                </div>
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input value=" <?php echo $registrado["email_registrado"]?>" type="email" class="form-control" id="email" name="email" placeholder="Tu mail completo">
                                </div>
                                <!-- fecha de registro por my sql  -->


                                <?php 
                                    $pedido = $registrado["pases_articulos"];
                                    $boletos = json_decode($pedido, true);
                                    

                                ?>
                                <div class="form-group">
                                    <div id="paquetes" class="paquetes">
                                        <h3>Elige el numero de boletos</h3>
                                        <ul class="lista-precios row">
                                            <!-- los li pueden contener cualquier elemento que valla en el body -->
                                            <li class="col-md-4">
                                                <div class="tabla-precio  text-center">
                                                    <h3>Pase por día (viernes)</h3>
                                                    <p class="numero">$30</p>
                                                    <ul>
                                                        <li>Bocadillos gratis</li>
                                                        <li>Todas las Conferencias</li>
                                                        <li>Todos los talleres</li>
                                                    </ul>
                                                    <div class="order">
                                                        <label for="pase_dia">Boletos deseados</label>
                                                        <input value="<?php echo $boletos["un_dia"]?>"  type="number" class="form-control" min="0" id="pase_dia" size="3" name="boletos[un_dia][cantidad]" placeholder="0">
                                                        <!-- generaremos un input hiden para  poner el precio pe, donde separraremos lo que se seleccione para separrarlos datos en los arreglos multiidimencionales  -->
                                                        <input  type="hidden" name="boletos[un_dia][precio]" value="30">

                                                    </div>
                                                </div>
                                            </li><!-- fin li -->
                                            <li class="col-md-4">
                                                <div class="tabla-precio text-center">
                                                    <h3>Todos los días</h3>
                                                    <p class="numero">$50</p>
                                                    <ul>
                                                        <li>Bocadillos gratis</li>
                                                        <li>Todas las Conferencias</li>
                                                        <li>Todos los talleres</li>
                                                    </ul>

                                                    <div class="order">
                                                        <label for="pase_completo">Boletos deseados</label>
                                                        <input  value="<?php echo $boletos["pase_completo"]?>" type="number" class="form-control" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0">
                                                        <!-- generaremos un input hiden para  poner el precio pe, donde separraremos lo que se seleccione para separrarlos datos en los arreglos multiidimencionales  -->
                                                        <input type="hidden" name="boletos[completo][precio]" value="50">
                                                    </div>

                                                </div>
                                            </li><!-- fin li -->

                                            <li class="col-md-4">
                                                <div class="tabla-precio text-center text-center">

                                                    <h3>Pase 2 días (viernes y sábado)</h3>
                                                    <p class="numero">$45</p>
                                                    <ul>
                                                        <li>Bocadillos gratis</li>
                                                        <li>Todas las Conferencias</li>
                                                        <li>Todos los talleres</li>
                                                    </ul>
                                                    <div class="order">
                                                        <label for="pase_dosdias">Boletos deseados</label>
                                                        <input value="<?php echo $boletos["pase_2dias"]?>" type="number" class="form-control" min="0" id="pase_dosdias" size="3" name="boletos[2dias][cantidad]" placeholder="0">
                                                        <!-- generaremos un input hiden para  poner el precio pe, donde separraremos lo que se seleccione para separrarlos datos en los arreglos multiidimencionales  -->
                                                        <input   type="hidden" name="boletos[2dias][precio]" value="45">
                                                    </div>
                                                </div>
                                            </li><!-- fin li -->
                                        </ul>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="box-header with-border">
                                        <div id="eventos" class="eventos ">
                                            <h3>Elige los talleres</h3>
                                            <div class="caja ">
                                                <?php
                                                    $eventos = $registrado["talleres_registrados"];
                                                    $id_eventos_registrados = json_decode($eventos, true);
                                                    


                                                try {

                                                    $sql = "SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado ";
                                                    $sql .= "FROM eventos ";
                                                    $sql .= "JOIN  categoria_evento ";
                                                    $sql .= "ON  (eventos.id_cat_evento=categoria_evento.id_categoria) ";
                                                    $sql .= "JOIN invitados ";
                                                    $sql .= "ON  (eventos.id_inv=invitados.invitado_id) ";
                                                    $sql .= "ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento";
                                                    $resultado = $conn->query($sql);
                                                } catch (Exception $e) {
                                                    echo $e->getMessage();
                                                }


                                                $eventos_dias = array();
                                                while ($eventos = $resultado->fetch_assoc()) {
                                                    $fecha = $eventos["fecha_evento"];
                                                    $diassemana = array(
                                                        "Fri" => "viernes",
                                                        "Sat" => "sabado",
                                                        "Sun" => "domingo",
                                                        "Wed" => "miercoles",
                                                        "Thu" => "jueves",
                                                        "Tue" => "martes",
                                                        "Mon" => "lunes"
                                                    );
                                                    $dia_semana_ingles = date("D", strtotime($fecha));
                                                    $dia_semana_arreglo = [];
                                                    foreach (array($dia_semana_ingles) as $llave => $dia) {
                                                        array_push($dia_semana_arreglo, $diassemana[$dia]);
                                                    }
                                                    //para tener algo como del curso web
                                                    $dia_semana = implode("", $dia_semana_arreglo);
                                                    $categoria = $eventos["cat_evento"];
                                                    $dia = array(
                                                        //se itera sobre cada elemento solito :D 
                                                        "nombre_evento" => $eventos["nombre_evento"],
                                                        "hora" => $eventos["hora_evento"],
                                                        "id" => $eventos["evento_id"],
                                                        "nombre_invitado" => $eventos["nombre_invitado"],
                                                        "apellido_invitado" => $eventos["apellido_invitado"]
                                                    );
                                                    //añadeolo siempre al final del arreglo -> aora los dias son los padres dendetro del arrelgo de evneto dia 
                                                    //agruopar por categoria 
                                                    $eventos_dias[$dia_semana]["eventos"][$categoria][] = $dia;
                                                }

                                                ?>
                                                <!-- contenido dia -->

                                                <?php foreach ($eventos_dias as $dia => $eventos) { ?>
                                                    <div id="<?php echo $dia ?>" class="contenido-dia  row">
                                                        <h4 class="text-center  nombre-dia"><?php echo $dia ?></h4>
                                                        <div class="contenedor-talleres">
                                                            <!-- abrre for ach  -->
                                                            <?php foreach ($eventos["eventos"] as $tipo => $evento_dia) : ?>
                                                                <div class="col-md-4 d-flex flex-column justify-content-start">
                                                                    <p><?php echo $tipo ?> </p>
                                                                    <!-- abrre for ach  -->

                                                                    <?php foreach ($evento_dia as $evento) :  ?>
                                                                        <label>
                                                                            <!-- siexiste el elemento -> habilitar el check -->

                                                                            <input <?php echo (in_array($evento["id"], $id_eventos_registrados["eventos"])? "checked ": " "); ?>type="checkbox" name="registro_evento[]" id="<?php echo $evento["id"] ?>" value="<?php echo $evento["id"]; ?>">
                                                                            <time><?php echo $evento["hora"]; ?> </time><?php echo $evento["nombre_evento"]; ?> <br>
                            
                                                                            <span class="autor"><?php echo $evento["nombre_invitado"] . " " . $evento["apellido_invitado"] ?> </span>

                                                                        </label>
                                                                        <br>
                                                                    <?php endforeach; ?>
                                                                    <!-- abrre for ach  -->
                                                                </div>

                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <!--.caja-->
                                        </div>
                                    </div>
                                </div>

                                <!-- /.box-body -->
                                <div id="resumen" class="resumen">
                                    <h3>Pago y Extras</h3>
                                    <div class="caja clearfix row">
                                        <div class="extras  col-md-6 ">
                                            <div class="orden">
                                                <label for="camisa_evento">Camisa del evento $10 <small>(promocion 7% dto.)</small></label>
                                                <input value="<?php echo (isset($boletos["camisas"]) ? $boletos["camisas"]: 0)?>" type="number"  class="form-control" min="0" id="camisa_evento" name="pedido_extra[camisas][cantidad]" size="3" placeholder="0">
                                                <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                                            </div>
                                            <!--.orden-->
                                            <div class="orden ">
                                                <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                                                <input  value="<?php echo (isset($boletos["etiquetas"]) ? $boletos["etiquetas"]: 0)?>" type="number"  class="form-control" min="0" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" size="3" placeholder="0">
                                                <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
                                            </div>
                                            <!--.orden-->
                                            <div class="orden ">
                                                <label for="regalo">Seleccione un regalo</label> <br>
                                         
                                                <select id="regalo" name="regalo" class="form-control"  required>
                                                    <option value="">- Seleccione un regalo --</option>
                                                    <option value="2" <?php echo ($registrado["regalo"])? "selected ": " ";?>>Etiquetas</option>
                                                    <option value="1" <?php echo ($registrado["regalo"])? "selected ": " ";?>>Pulsera</option>
                                                    <option value="3" <?php echo ($registrado["regalo"])? "selected ": " ";?>>Plumas</option>
                                                </select>
                                            </div>
                                            <!--.orden-->

                                            <input type="button" id="calcular" class="btn btn-success" value="Calcular">
                                        </div>
                                        <!--.extras-->

                                        <div class="total col-md-6">
                                            <p>Resumen:</p>
                                            <div id="lista-productos">
                                             <p>Total ya pagado: <?php echo (int) $registrado["total_pagado"]?> </p>                              
                                            </div>
                                            <p>Total:</p>
                                            <div id="suma-total">

                                            </div>
                                          
                                        </div>
                                        <!--.total-->
                                    </div>
                                    <!--.caja-->
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="total_pedido" id="total_pedido">
                                    <input type="hidden" name="total_descuento" id="total_descuento" value="total_descuento">
                                    <!-- inputrs invisibles, de esta ,amera no ha y necesidad de añadir naeme ni valor a el botoncito del sumint   -->
                                    <input type="hidden" name="registro" value="actualizar">
                                    <input type="hidden" name="fecha_registro" value="<?php echo $registrado["fecha_registro"]?>">
                                    <input type="hidden" name="id_registro" value="<?php echo $registrado["ID_Registrados"]?>">
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