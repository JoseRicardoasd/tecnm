<?php

include ('../../../app/config/config.php');

include('ciclo.php');

$lunes=(isset($_POST['lunes']))?$_POST['lunes']:"";
$martes=(isset($_POST['martes']))?$_POST['martes']:"";
$miercoles=(isset($_POST['miercoles']))?$_POST['miercoles']:"";
$jueves=(isset($_POST['jueves']))?$_POST['jueves']:"";
$viernes=(isset($_POST['viernes']))?$_POST['viernes']:"";

if (isset($_POST['nombreActividad']) && isset($_POST['horaActividad']) && isset($_POST['horaHacer']) && isset($_POST['encargadoActividad']) && isset($_POST['lugarActividad']) && isset($_POST['idCampo'])){
	
			$nombres=strtoupper($_POST['nombreActividad']);
			$ap_paterno=$_POST['horaActividad'];
			$numero_control=$_POST['horaHacer'];
			$carrera=$_POST['encargadoActividad'];
			$estado=strtoupper($_POST['lugarActividad']);
			$semestre=$_POST['idCampo'];
		
			$dias = $lunes.' '.$martes.' '.$miercoles.' '.$jueves.' '.$viernes;
		
			$sql = "INSERT INTO extraescolar(nombreActividad, horaActividad, diaActividad, horaHacer, encargadoActividad, lugarActividad, idCategoria, idCiclo) values ('$nombres','$ap_paterno', '$dias', '$numero_control', '$carrera', '$estado', '$semestre','$idCiclo')";
			
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
		
		header('Location: ../../extraescolar/lista_actividades.php?id='.$semestre);
		break;
?>
