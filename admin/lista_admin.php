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
    Listado de Administradores
      <small>Aqui podras editar o borrar los administradores</small>

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
                   <th>Usuario</th>
                  <th>Nombre</th>
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
                  $sql = "SELECT id_admin, usuario, nombre FROM admins";
                  $resultado = $conn->query($sql); //? Listo 😋

                } catch (Exception $e) {
                  echo $e->getMessage();
                }

                while ($admin = $resultado->fetch_assoc()) { ?> 
     
               <tr>
                    <td><?php echo $admin["usuario"]?></td>
                    <td><?php echo $admin["nombre"]?></td>

                   

                    <td>
                        <a href="editar-admin.php?id=<?php echo $admin["id_admin"]; ?>"  class="btn  bg-orange btn-flat margin">
                        <i class="fa fa-pencil"></i>
<!-- No recuero bien pero ya veremos para que sirva mas que nada ser especificos  -->
                        <a href="#"  data-id="<?php echo $admin["id_admin"]; ?>" data-tipo="admin"  class="btn border bg-maroon btn-flat margin borrar-registro">
                        <i class="fa fa-times"></i>
                      </a>
                    </td> 
              </tr>
              
              
      
              <?php }  ?>

              </tbody>
              <tfoot>
                <tr>
                <th>Usuario</th>
                  <th>Nombre</th>
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