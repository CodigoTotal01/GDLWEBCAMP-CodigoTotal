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
    Listado de eventos
      <small>Aqui podras editar o borrar los eventos</small>

    </h1>

  </section>

  <!-- Main content -->
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Maneja los usuarios en esta seccion </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="registros" class="table table-bordered table-hover">
            
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoria</th>
                  <th>Invitado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <!-- //* cuerpo de la tala -->
              <tbody>
                <?php
                //! Consulta no preparada 
                try {
                  //todo: OJO aqui tta qchido para el inner join desde hora son otros 
                  //! No te olvides que las columnas que llames deben tener el mismo nombre que sus padres
                  $sql = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, nombre_invitado, apellido_invitado "; //?OK, ten cuidao que continua 
                  $sql .= " FROM eventos "; //? (hijo)
                   //! UNIR (primero decimos que tigan los datos y lyego dle decimos de donde yposterior e)
                  $sql .= " INNER JOIN categoria_evento ";//? Indicamos la segunda tabla donde obtendremos los datos apartir de su llave primaria 
                  $sql .= " ON  eventos.id_cat_evento = categoria_evento.id_categoria "; //? ON para decir donde se realizara el join (1-> hijo 2->padre) con su comulanda de id 
                  $sql .= " INNER JOIN invitados ";
                  $sql .= " ON eventos.id_inv=invitados.invitado_id ";

                  //* ordenar
                  $sql .= " ORDER BY evento_id ";
                  
                  
                  
                  $resultado = $conn->query($sql); //? Listo 😋

                } catch (Exception $e) {
                  echo $e->getMessage();
                }
                //? recuerda solo un igual y lo tienenes en la forma si nprepare statement usualmente usados para mostrar datos en pantalla 
                //! Dale id par eliminar y editar
                while ($evento = $resultado->fetch_assoc()) { ?> 
     
               <tr>
                    <td><?php echo $evento["nombre_evento"]?></td>
                    <td><?php echo $evento["fecha_evento"]?></td>
                    <td><?php echo $evento["hora_evento"]?></td>
                    <td><?php echo $evento["cat_evento"]?></td>
                    <td><?php echo $evento["nombre_invitado"]." ". $evento["apellido_invitado"] ?></td>
                    <td>
                        <a href="editar-evento.php?id=<?php echo $evento["evento_id"]; ?>"  class="btn  bg-orange btn-flat margin">
                        <i class="fa fa-pencil"></i>
                        <!-- No recuero bien pero ya veremos para que sirva mas que nada ser especificos  -->
                        <a href="#"  data-id="<?php echo $evento["evento_id"]; ?>" data-tipo="evento"  class="btn border bg-maroon btn-flat margin borrar-registro">
                        <i class="fa fa-times"></i>
                      </a>
                    </td> 
              </tr>
              <?php }  ?>

              </tbody>
              <tfoot>
                <tr>
                <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoria</th>
                  <th>Invitado</th>
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