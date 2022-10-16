<?php
include('../app/config/config.php');
session_start();
if (isset($_SESSION['u_usuario']) && $_SESSION['u_privilegio']  == 0) {
  //echo "existe sesión";) {
  $correo_sesion = $_SESSION['u_usuario'];
  $query_sesion = $pdo->prepare("SELECT * FROM tb_usuarios WHERE correo = '$correo_sesion' AND estado = '1' ");
  $query_sesion->execute();
  $sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
  foreach ($sesion_usuarios as $sesion_usuario) {
    $id_sesion = $sesion_usuario['id'];
    $id_nombres = $sesion_usuario['nombres'];
    $id_ap_paterno = $sesion_usuario['ap_paterno'];
    $id_ap_materno = $sesion_usuario['ap_materno'];
    $id_sexo = $sesion_usuario['sexo'];
    $id_numero_control = $sesion_usuario['numero_control'];
    $id_carrera = $sesion_usuario['carrera'];
    $id_correo = $sesion_usuario['correo'];
    $id_estado_civil = $sesion_usuario['estado_civil'];
    $id_telefono = $sesion_usuario['telefono'];
    $id_ciudad = $sesion_usuario['ciudad'];
    $id_colonia = $sesion_usuario['colonia'];
    $id_calle = $sesion_usuario['calle'];
    $id_codigo_postal = $sesion_usuario['codigo_postal'];
    $id_curp = $sesion_usuario['curp'];
    $id_fecha_nacimiento = $sesion_usuario['fecha_nacimiento'];
    $id_nivel_escolar = $sesion_usuario['nivel_escolar'];
    $id_reticula = $sesion_usuario['reticula'];
    $id_entidad = $sesion_usuario['entidad'];
    $id_foto_perfil = $sesion_usuario['foto_perfil'];
  }

?>

  <!DOCTYPE html>

  <html>

  <head>
    <?php include('../layout/head.php'); ?>
    <title>Constancias</title>
    <link rel="stylesheet" href="css/estilo_parrafo.css">
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include('../layout/menu.php'); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            CONSTANCIAS DE CREDITOS COMPLEMENTARIOS
            <small>Capturar los datos</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="panel panel-primary">
            <div class="panel-heading">Capatura de Datos Para la Constancia</div>
            <div class="panel-body">
              <!-- <table class="table table-bordered table-hover table-condensed">

                <body>
                  <div class="container">
                    <br>
                    <div class="row">
                      <form action="cntrlconstancia.php" method="POST">
                    </div>


              </table> -->

              <form action="cntrlconstancia.php" method="POST">
                <h2> CONSTANCIA DE CUMPLIMIENTO DE ACTIVIDAD COMPLEMENTARIA.</h2>
                <br>


                DRA. ELOINA GUADALUPE GONZÁLEZ LARA
                <br>

                Jefe(a) del Departamento de Servicios Escolares o su equivalente en los Institutos Tecnológicos Descentralizados

                <br>
                PRESENTE.
                <br>
                <br>
                <br>
                <p class="parrafo_inputs">
                  El que se suscribe <input type="text" name="suscribe" maxlength="100" class="input_border input_largo">, por
                  este medio se permite hacer de su conocimiento que
                  <br> el estudiante <input type="text" name="alumno" maxlength="100" class="input_border input_largo">
                  con número de control <input type="text" name="matricula" maxlength="100" class="input_border input_corto"><br>
                  de la carrera de <input type="text" name="carrera" maxlength="100" class="input_border input_largo">
                  ha cumplido su actividad complementaria con el nivel de desempeño<br> <input type="text" name="desempe" maxlength="100" class="input_border">
                  y un valor numérico de <input type="text" name="valor" maxlength="100" class="input_border input_corto">,
                  durante el periodo escolar <input type="text" name="ciclo" maxlength="100" class="input_border input_corto">
                  con un valor curricular de <input type="text" name="valorcurri" maxlength="100" class="input_border input_corto">
                  créditos.
                </p>
                <br>
                Se extiende la presente en el poblado de Chiná a los
                <?php
                setlocale(LC_ALL, "es_ES");
                $dias = date("d");
                $mes = date("F");
                $anio = date("Y");

                echo   $dias . " dias de  " . $mes . " de " . $anio; ?>

                
                <input type="text" name="dias" value="<?php echo '$dias' ?>" style="display: none;">
                <input type="text" name="mes" value="<?php echo '$mes' ?>" style="display: none;">
                <input type="text" name="anio" value="<?php echo '$anio' ?>" style="display: none;">
                <center>
                  <td colspan="6"><input type="submit" class="btn btn-succes btn-lg" value="Guardar"></td>
                </center>
              </form>
              <div id="content" class="col-lg-12">

              </div>


            </div>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
          <?php include('../layout/footer.php'); ?>
          <?php include('../layout/footer_links.php'); ?>
      </div>

  </body>

  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
