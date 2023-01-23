<?php
include('../app/config/config.php');
$sentencia=$pdo->query("SELECT * FROM guia;");
$actividades=$sentencia->fetchAll(PDO::FETCH_OBJ);
//print_r($actividades);

session_start();
if (isset($_SESSION['u_usuario'])) {
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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../app/templeates/AdminLTE-2.3.11/bootstrap/css/bootstrap.css">

    <title>Guia de actividades Complementarias</title>
  </head>
  
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include('../layout/menu.php'); ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SISTEMA DE CREDITOS COMPLENTARIOS
            <small>Guia de Actividades Complementarias</small>
          </h1>
          <br>
          <form action="Docx_suscribirse.php" method="POST" target="_blank">
                  <div class="row">
                    <div id="content" class="col-lg-12">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-download"></i> Descargar PDF</button>
                    </div>
                  </div>
                </form>
        </section>
      
        <br>
        

        <!--CRUD-->
       
          
        <div class="container">
          <div class="panel panel-primary">
            <div class="panel-heading">Alumnos suscritos</div>
            
        <table class="table table-bordered table-hover table-condensed">
  <thead>
    <tr class="info">
      <th scope="col">Alumnos</th>
      <th scope="col">Matrícula</th>
      <th scope="col">Fecha y Hora de Suscripción</th>
    </tr>
  </thead>
  
  <tbody>
    <!--registros de la bd-->
    <?php
                    $sql="SELECT * FROM suscritos";
                    
                    $row = mysqli_query($conexion, $sql); 

                    while($result=mysqli_fetch_assoc($row)){
                    ?>
                        <tr>
                          <td><?php echo $result['nombre_alumn']?></td>
                          <td><?php echo $result['matricula_alumn']?></td>
                          <td><?php echo $result['fecha_suscripcion']?></td>
                        
    
  
                    
                          </div> 


            <?php
                 }
            ?>
            </tr>
            </tbody>
        
        </table>
        </div>
      </div>
    </div>
    </table
    </div>
    </div>
                </section>



  </body>
   <?php include('../layout/footer.php'); ?>
   <?php include('../layout/footer_links.php'); ?>
  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
