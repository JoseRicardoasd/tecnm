<?php


include ('../app/config/config.php');

if (isset($_POST['motivo']) && isset($_POST['categoria']) && isset($_POST['prioridad']) && isset($_POST['id_alumno']) && isset($_POST['incidencia'])){
	
	$motivo=$_POST['motivo'];
    $categoria=$_POST['categoria'];
    $prioridad =$_POST['prioridad'];
    //$matricula =$_POST['matricula'];
	$id_alumno = $_POST['id_alumno'];
	$incidencia = $_POST['incidencia'];
    $actualiza = $_POST['motivoac'];


 $sql= "INSERT INTO tb_incidencia(id_alumno,motivo,categoria,prioridad,Estado,motivo_actualizacion) VALUES ('$id_alumno','$motivo','$categoria','$prioridad','$incidencia','$actualiza')";

	
	echo $sql;
	
	$query = $bdd->prepare($sql);
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
header('Location: incidencias.php');
