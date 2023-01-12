
<?php
include('../app/config/config.php');
// obtenemos el valor y el resultado
$resultado = 0;
$valor = null;
$idRegistros = $_REQUEST['id'];
$control = $_REQUEST['control'];
$actividad = $_REQUEST['actividad'];
$habilidad = $_REQUEST['habilidad'];
$tiempo = $_POST['tiempo'];
$equipo = $_POST['equipo'];
$liderazgo = $_POST['liderazgo'];
$organiza = $_POST['organiza'];
$interpreta = $_POST['interpreta'];
$realiza = $_POST['realiza'];
$iniciativa = $_POST['iniciativa'];

$resultado = ($tiempo + $equipo + $liderazgo + $organiza + $interpreta + $realiza + $iniciativa) / 7;
if ($resultado <= 4) {
  $valor = 'Excelente';
  $calificacion = 'Acreditado';
}
if ($resultado <= 3) {
  $valor = 'Notable';
  $calificacion = 'Acreditado';
}
if ($resultado <= 2) {
  $valor = 'Bueno';
  $calificacion = 'Acreditado';
}
if ($resultado <= 1) {
  $valor = 'Suficiente';
  $calificacion = 'NO Acreditado';
}
if ($resultado <= 0) {
  $valor = 'Insuficiente';
  $calificacion = 'NO Acreditado';
};

$update = ("UPDATE extragrupo 
	SET 
	observacion  ='" .$habilidad. "',
	valor  ='" .$resultado. "',
	desempeño  ='" .$valor. "',
	acreditacion  ='" .$calificacion. "'

WHERE matricula='" .$control. "' AND idActividad='".$actividad."'
");
$result_update = mysqli_query($por, $update);

header('Location: alumnosListado.php?id='.$actividad);

?>
