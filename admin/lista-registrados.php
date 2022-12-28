<?php
//para que la redireccion de php se de no debe haber nada antes de el 
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
            Listado de Personas
            <small>Aqui podras editar o borrar los registros</small>

        </h1>

    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Maneja los registros en esta seccion</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <table id="registros" class="table table-bordered table-hover">

                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>E-mail</th>
                                    <th>Fecha</th>
                                    <th>Pases</th>
                                    <th>Talleres</th>
                                    <th>Regalo</th>
                                    <th>Total</th>

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    $sql = "SELECT registrados.*, regalos.nombre_regalo FROM registrados ";
                                    $sql .= "JOIN regalos ON (registrados.regalo = regalos.ID_regalo) ";


                                    $resultado = $conn->query($sql); //? Listo 😋
                                    #para ver poqeu no se ejecuta mandalo a la pnatalla con un eco 
                                } catch (Exception $e) {
                                    echo $e->getMessage();
                                }

                                while ($registrado = $resultado->fetch_assoc()) { ?>

                                    <tr>
                                        <td>
                                            <?php echo $registrado["nombre_registrado"] . " " .  $registrado["apellido_registrado"];
                                            $pagado = $registrado["pagado"];
                                            if ($pagado) {
                                                echo "<br> <span class='badge bg-green'>Pagado</span>";
                                            } else {
                                                echo "<br> <span class='badge bg-red'>No pagado :c</span>";
                                            }

                                            ?>
                                        </td>
                                        <td><?php echo $registrado["email_registrado"] ?></td>
                                        <td><?php echo $registrado["fecha_registro"] ?></td>
                                        <td>
                                            <?php
                                            //json a arreglo de php -> lo conbierte en un arreglo con true si no seria un objeto -> 
                                            $articulos = json_decode($registrado["pases_articulos"], true);
                                            $arreglo_articulo = array(
                                                "un_dia" => "Pase 1 dia",
                                                "pase_2dias" => "Pase 2 dias",
                                                "pase_completo" => "Pase Completo",
                                                "camisas" => "Camisas",
                                                "etiquetas" => "Etiquetas"
                                            );
                                            //for each -> genial el crear otro arrayu para mostrar un contenido distinto
                                            foreach ( $articulos as $llave => $articulo) {
                                                if(is_array($articulo) && array_key_exists("cantidad",$articulo)){
                                                    echo $articulo["cantidad"]  . " " . $arreglo_articulo[$llave] . "<br>";
                                                }else{
                                                    echo $articulo  . " " . $arreglo_articulo[$llave] . "<br>";
                                                }

                    
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $eventos_resultado= $registrado["talleres_registrados"]; 
                                                $talleres = json_decode($eventos_resultado, true);
                                                //todos los valores de un arreglo lo coloca en una cadena 
                                                $talleres = implode("','", $talleres["eventos"]);
                                                //var_dump($talleres); -> consultar a la base de datos 

                                                #no simpre necesitas multiples seect o wiles 
                                                $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE evento_id IN ('$talleres')"; 
                                          
                                                $resultado_talleres = $conn->query($sql_talleres);

                                                while($eventos = $resultado_talleres->fetch_assoc()){
                                                    echo $eventos["nombre_evento"]. " " .$eventos["fecha_evento"] . " ". $eventos["hora_evento"];
                                                    echo "<br>";
                                                    echo "<hr>";
                                                
                                                  
                                                }

                                              
                                            ?>
                                        </td>
                                        <td><?php echo $registrado["nombre_regalo"] ?></td>
                                        <td>$ <?php echo $registrado["total_pagado"] ?></td>

                                        <td>
                                            <a href="editar-registro.php?id=<?php echo $registrado["ID_Registrados"]; ?>" class="btn  bg-orange btn-flat margin">
                                                <i class="fa fa-pencil"></i>
                                                <a href="#" data-id="<?php echo $registrado["ID_Registrados"]; ?>" data-tipo="registro" class="btn border bg-maroon btn-flat margin borrar-registro">
                                                <i class="fa fa-times"></i>
                                                </a>
                                        </td>
                                    </tr>



                                <?php }  ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>E-mail</th>
                                    <th>Fecha</th>
                                    <th>Pases</th>
                                    <th>Talleres</th>
                                    <th>Regalo</th>
                                    <th>Total</th>

                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once "templates/footer.php" ?>