<?php

include ('../app/config/config.php');

if(!isset($_GET["id"]) && !isset($_GET["extra"]) ) exit();
    $id = $_GET["id"];
    $extra = $_GET["extra"];

    $sql = ("SELECT numero_control FROM tb_usuarios WHERE id = $id");
    $query = $bdd->prepare($sql);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_LAZY);

    $matricula = $usuario['numero_control'];


	$sql = "INSERT INTO extragrupo(idActividad,matricula,observacion,acreditacion) VALUES ($extra, $matricula, NULL, NULL)";

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

	$valor = 1;

    header('Location: actividadesEncargado.php?id='.$extra.'&'.'valor='.$valor);
?>
