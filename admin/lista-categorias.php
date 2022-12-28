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
    Listado de Categorias
      <small>Aqui podras editar o borrar las categorias</small>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Maneja las categorias en esta seccion </h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="registros" class="table table-bordered table-hover">
            
              <thead>
                <tr>
                  <th>Nombre </th>
                  <th>Icono</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                try {
                  $sql = "SELECT * FROM categoria_evento";
                  $resultado = $conn->query($sql); //? Listo 😋
                } catch (Exception $e) {
                  echo $e->getMessage();
                }
                # Obtener una fila de resultado como un array asociativo -> my sql
                while ($evento = $resultado->fetch_assoc()) { ?> 
     
               <tr>
                    <td><?php echo $evento["cat_evento"]?></td>
                    <td> <i class=" fa <?php echo $evento["icono"]?>"></td>

                   

                    <td>
                        <a href="editar-categoria.php?id=<?php echo $evento["id_categoria"]; ?>"  class="btn  bg-orange btn-flat margin">
                        <i class="fa fa-pencil"></i>
<!-- No recuero bien pero ya veremos para que sirva mas que nada ser especificos  -->
                        <a href="#"  data-id="<?php echo $evento["id_categoria"]; ?>" data-tipo="categoria"  class="btn border bg-maroon btn-flat margin borrar-registro">
                        <i class="fa fa-times"></i>
                      </a>
                    </td> 
              </tr>
              
              
      
              <?php }  ?>

              </tbody>
              <tfoot>
                <tr>
                <th>Nombre</th>
                  <th>Icono</th>
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