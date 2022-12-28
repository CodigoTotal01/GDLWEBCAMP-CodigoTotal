<?php

//para cuando nso madan a cerarr la funcion 
session_start();

$cerrar_sesion = $_GET["cerrar_sesion"];
if ($cerrar_sesion == true) {
  //cerrar sesion 
  session_destroy();
}
require_once "funciones/funciones.php";
include_once "templates/header.php";

?>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../index.php"><b>GDL</b>WebCamp</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Inicia Sesion</p>
      <!-- fa fa-unlock-alt,fa fa-user-circle  -->
      <form name="login-admin-form" id="login-admin" method="POST" action="login-admin.php">
        <div class="form-group has-feedback">
          <!-- oki, no e que itera sobre los input si no pobre los name  -->
          <input type="text" class="form-control" name="usuario" placeholder="Usuario">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">

          <div class="col-xs-12 ">
            <input type="hidden" name="login-admin" value="1">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once "templates/footer.php" ?>