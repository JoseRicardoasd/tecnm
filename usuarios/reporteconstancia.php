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

$sentenciaSQL = $pdo->prepare("SELECT * FROM constancias WHERE matricula = '$id_numero_control'");
$sentenciaSQL->execute();
$datos_alumno = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div>
  <img src="../public/images/avatar_hombre.png">
</div>
<br>
<br>
<p style="text-align: center;">CONSTANCIA DE CUMPLIMIENTO DE ACTIVIDAD COMPLEMENTARIA
</p>
<br>

<?php foreach ($datos_alumno as $opciones) : ?>
<b>C. <?php echo $opciones['jefe'] ?></b>
<br>

Jefe(a) del Departamento de Servicios Escolares o su equivalente en los Institutos Tecnológicos Descentralizados

<br>
PRESENTE.
<p style="text-align: justify; line-height: 22px;">
    El que se suscribe <b><?php echo $opciones['suscribe'] ?></b>, por
    este medio se permite hacer de su conocimiento que el estudiante <b><?php echo $opciones['alumno'] ?></b>
    con numero de control <b><?php echo $opciones['matricula'] ?></b>
    de la carrera de <b><?php echo $opciones['carrera'] ?></b>
    ha cumplido su actividad complementaria con el nivel de desempeño <b><?php echo $opciones['desempe'] ?></b>
    y un valor numérico de <b><?php echo $opciones['valor'] ?></b>
    durante el periodo escolar <b><?php echo $opciones['ciclo'] ?></b>
    con un valor curricular de <b><?php echo $opciones['valorcurri'] ?></b>
    créditos.
  </p>
<br>
<p style="text-align: right;">
    Se extiende la presente en la
    fecha <?php echo $opciones['fecha'] ?>
  </p>
<br>
<br>
<br>
<br>
<p>
  ATENTAMENTE
</p>
<br>
  <br>
  <br>
  <br>
  <br>
  <div>
    <b>_____________________________________ <span style="color: white;">-------------</span> _____________________________________</b>
    <p><b>NOMBRE Y FIRMA DEL DOCENTE <br> RESPONSABLE </b> <span style="color: white;">------------------------------------------------</span> Jefa de Departamento de Area Académica
    </p>
  </div>
  <br>
  <br>

  <p style="font-size: 14px;">c.c.p. Mirsha Gabriela Magaña Cruz, Jefe de Departamento de Ciencias Básicas</p>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div>
    <img src="../public/images/avatar_hombre.png">
  </div>
<?php endforeach ?>

</div>

</body>

</html>
//<?php
//require_once 'dompdf/autoload.inc.php';

//use Dompdf\Dompdf;

//$dompdf = new DOMPDF();
//$dompdf->load_html(ob_get_clean());
//$dompdf->render();
//$pdf = $dompdf->output();
//$filename = "constancia.pdf";
//file_put_contents($filename, $pdf);
//$dompdf->stream($filename);
//?>

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
