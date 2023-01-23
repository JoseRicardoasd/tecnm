<?php
include('../app/config/config.php');

$id_evento = $_POST['id'];
$responsable = $_POST['responsable'];
$matricula = $_POST['matricula'];
$nombre_alumno = $_POST['nombre_alumno'];
$apPaterno = $_POST['ap_paterno'];
$apMaterno = $_POST['ap_materno'];
$inicio = " ";
$fin = " ";

$nombre_completo = $nombre_alumno . " " . $apPaterno . " " . $apMaterno;

$fecha = mysqli_query($conexion, "SELECT start, end FROM events WHERE id = $id_evento");


while ($consultaFecha = mysqli_fetch_array($fecha)) {
  $inicio = $consultaFecha['start'];
  $fin = $consultaFecha['end'];
}





$sql = "INSERT INTO suscritos(id_evento, id_respons, matricula_alumn, nombre_alumno, inicio, fin) values ('$id_evento','$responsable', '$matricula', '$nombre_completo', '$inicio', '$fin')";

$query = $bdd->prepare($sql);

$sth = $query->execute();

if (!$sth) {
  echo "error al guardar";
} else {
  header('Location: calendariovista.php');
}
mysqli_close($conexion);
