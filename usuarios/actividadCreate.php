<?php

include ('../app/config/config.php');

$sql = ("SELECT id FROM ciclo ORDER BY id DESC LIMIT 1;");
$query = $bdd->prepare( $sql );
$query->execute();
$resultado = $query->fetch(PDO::FETCH_OBJ);

$idCiclo = $resultado === false ? 1 : $resultado->id;

if (isset($_POST['nombreActividad']) && isset($_POST['horaActividad']) && isset($_POST['diaActividad']) && isset($_POST['horaHacer']) && isset($_POST['encargadoActividad']) && isset($_POST['lugarActividad']) && isset($_POST['idCampo'])){
	
	$nombres=$_POST['nombreActividad'];
    $ap_paterno=$_POST['horaActividad'];
    $ap_materno=$_POST['diaActividad'];
    $numero_control=$_POST['horaHacer'];
    $carrera=$_POST['encargadoActividad'];
    $estado=$_POST['lugarActividad'];
    $semestre=$_POST['idCampo'];

	$prioridad = 1;
	$habilitar = 1;

	$sql = "INSERT INTO extraescolar(nombreActividad, horaActividad, diaActividad, horaHacer, encargadoActividad, lugarActividad, prioridad, habilitar, idCategoria, idCiclo) values ('$nombres','$ap_paterno', '$ap_materno', '$numero_control', '$carrera', '$estado','$prioridad','$habilitar', '$semestre','$idCiclo')";
	
	echo $sql;
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}

	header("Location: actividadesCampo.php?id=".$semestre);
?>