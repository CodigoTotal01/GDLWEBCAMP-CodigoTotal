<?php include_once("includes/templates/header.php"); ?>

<!-- seccion de registro  -->
<section class="seccion contenedor">
    <h2>Registro de Usuarios</h2>
    <!-- El atributo action indica la página a la que se envían los datos del formulario. si esta vacio redirigue lso datos a la misma pagina   -->
    <!-- Creamos otro registro, archivo donde insetaremos la base de datos   -->
    <form action="pagar.php" id="registo" class="registro" method="post">
        <div id="datos_usurio" class="registro">
            <div class="campo_registro">
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Tu nombre">
                </div>
                <div class="campo">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Tu apellido">
                </div>
                <div class="campo">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Tu email">
                </div>
            </div>

            <div id="error"></div>
        </div>

        <div id="paquetes" class="paquetes">
            <h3>Elige el numero de boletos</h3>
            <ul class="lista-precios">
                <!-- los li pueden contener cualquier elemento que valla en el body -->
                <li>
                    <div class="tabla-precio">
                        <h3>Pase por día (viernes)</h3>
                        <p class="numero">$30</p>
                        <ul>
                            <li>Bocadillos gratis</li>
                            <li>Todas las Conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <div class="order">
                            <label for="pase_dia">Boletos deseados</label>
                            <input type="number" min="0" id="pase_dia" size="3" name="boletos[un_dia][cantidad]" placeholder="0">
                            <!-- generaremos un input hiden para  poner el precio pe, donde separraremos lo que se seleccione para separrarlos datos en los arreglos multiidimencionales  -->
                            <input type="hiden" name="boletos[un_dia][precio]" value="30">

                        </div>
                    </div>
                </li><!-- fin li -->
                <li>
                    <div class="tabla-precio">
                        <h3>Todos los días</h3>
                        <p class="numero">$50</p>
                        <ul>
                            <li>Bocadillos gratis</li>
                            <li>Todas las Conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>

                        <div class="order">
                            <label for="pase_completo">Boletos deseados</label>
                            <input type="number" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0">
                            <!-- generaremos un input hiden para  poner el precio pe, donde separraremos lo que se seleccione para separrarlos datos en los arreglos multiidimencionales  -->
                            <input type="hiden" name="boletos[completo][precio]" value="50">
                        </div>

                    </div>
                </li><!-- fin li -->

                <li>
                    <div class="tabla-precio">

                        <h3>Pase 2 días (viernes y sábado)</h3>
                        <p class="numero">$45</p>
                        <ul>
                            <li>Bocadillos gratis</li>
                            <li>Todas las Conferencias</li>
                            <li>Todos los talleres</li>
                        </ul>
                        <div class="order">
                            <label for="pase_dosdias">Boletos deseados</label>
                            <input type="number" min="0" id="pase_dosdias" size="3" name="boletos[2dias][cantidad]" placeholder="0">
                            <!-- generaremos un input hiden para  poner el precio pe, donde separraremos lo que se seleccione para separrarlos datos en los arreglos multiidimencionales  -->
                            <input type="hiden" name="boletos[2dias][precio]" value="45">
                        </div>
                    </div>
                </li><!-- fin li -->
            </ul>
            </div>
            <div id="eventos" class="eventos ">
                <h3>Elige tus talleres</h3>
                <div class="caja">

                    <?php
                    try {
                        require_once("includes/funciones/bd_conexion.php");
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
                        <div id="<?php echo $dia ?>" class="contenido-dia">
                            <h4><?php echo $dia ?></h4>
                            <div class="contenedor-talleres">
                                <!-- abrre for ach  -->
                            <?php foreach ($eventos["eventos"] as $tipo => $evento_dia) : ?>
                                    <div>
                                        <p><?php echo $tipo ?> </p>
                                         <!-- abrre for ach  -->

                                        <?php foreach ($evento_dia as $evento) :  ?> 
                                            <label>
                                                <input type="checkbox" name="registro[]" id="<?php echo $evento["id"]?>" value="<?php echo $evento["id"];?>">
                                                <time><?php echo $evento["hora"];?> </time><?php echo $evento["nombre_evento"];?> <br>
                                                <br>
                                                <span class="autor"><?php echo $evento["nombre_invitado"] . " ". $evento["apellido_invitado"] ?> </span>
                                            </label>
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
            <!--#eventos-->
       
         </div>
        <!--!el contenido de los array como los enviamso se enciaran deacuerdo al valor que contengan si esots no tienen nada no podemos esperar a que suseda algo good  -->
        <div id="resumen" class="resumen">
            <h3>Pago y Extras</h3>
            <div class="caja clearfix">
                <div class="extras">
                    <div class="orden">
                        <label for="camisa_evento">Camisa del evento $10 <small>(promocion 7% dto.)</small></label>
                        <input type="number" min="0" id="camisa_evento" name="pedido_extra[camisas][cantidad]" size="3" placeholder="0">
                        <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                    </div>
                    <!--.orden-->
                    <div class="orden">
                        <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small></label>
                        <input type="number" min="0" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" size="3" placeholder="0">
                        <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
                    </div>
                    <!--.orden-->
                    <div class="orden">
                        <label for="regalo">Seleccione un regalo</label> <br>
                        <select id="regalo" name="regalo" required>
                            <option value="">- Seleccione un regalo --</option>
                            <option value="2">Etiquetas</option>
                            <option value="1">Pulsera</option>
                            <option value="3">Plumas</option>
                        </select>
                    </div>
                    <!--.orden-->

                    <input type="button" id="calcular" class="button" value="Calcular">
                </div>
                <!--.extras-->

                <div class="total">
                    <p>Resumen:</p>
                    <div id="lista-productos">

                    </div>
                    <p>Total:</p>
                    <div id="suma-total">

                    </div>
                    <input type="hidden" name="total_pedido" id="total_pedido">
                    <input type="hidden" name="total_descuento" id="total_descuento" value="total_descuento">
                    <input id="btnRegistro" type="submit" name="submit" class="button" value="Pagar">
                </div>
                <!--.total-->
            </div>
            <!--.caja-->
        </div>
        <!--#resumen-->

    </form>
</section>

<?php include_once 'includes/templates/footer.php'; ?>