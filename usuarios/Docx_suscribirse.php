<?php ob_start();
include('../app/config/config.php');
session_start();
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


<?php foreach ($row as $opcion) : ?>
  <div style="opacity: 70%; width: 100%;">
    <img style="width: 100%; margin-top:-10px; margin-bottom: -20px;" src="data:imagen/png;base64,<?php echo base64_encode($opcion['encabezado']) ?>">
    <!-- <img src="tecnm/images/avatar.jpg"> -->
  <?php endforeach ?>
  </div>

  <table class="table table-bordered table-hover table-condensed">
    <thead>
      <tr>
        <th scope="col">Alumnos</th>
        <th scope="col">Matrícula</th>
        <th scope="col">Fecha y Hora de Suscripción</th>
      </tr>
    </thead>

    <tbody>
      <!--registros de la bd-->
      <?php
      $sql = "SELECT * FROM suscritos";

      $row = mysqli_query($conexion, $sql);

      while ($result = mysqli_fetch_assoc($row)) {
      ?>
        <tr>
          <td><?php echo $result['nombre_alumno'] ?></td>
          <td><?php echo $result['matricula_alumn'] ?></td>
          <td><?php echo $result['inicio'] ?></td>

          </div>
        <?php } ?>
        </tr>
    </tbody>

  </table>
  </div>
  </div>
  </div>
  </table </div>
  </div>
  </section>

  <br>
  <br>
  <br>
  <br>
  <br>
  <!-- imagen de pie de pagina -->
  <!-- imagen de pie de pagina -->
  <?php foreach ($row as $opcion) : ?>
    <div style="opacity: 70%;">
      <img style="width: 100%; margin-top: -36px;" src="data:imagen/png;base64,<?php echo base64_encode($opcion['pie_pagina']) ?>">

    </div>
  <?php endforeach ?>


  </div>

  </body>

  </html>


  <?php
  $html = ob_get_clean();
  require_once './libreria/dompdf/autoload.inc.php';

  use Dompdf\Dompdf;

  $dompdf = new Dompdf;

  $options = $dompdf->getOptions();
  $options->set(array('isRemoteEnabled' => true));

  $dompdf->setOptions($options);

  $dompdf->loadHtml($html);
  $dompdf->setPaper('letter');

  $dompdf->render();
  $dompdf->stream("archivo_.pdf", array("Attachment" => false));

  ?>
