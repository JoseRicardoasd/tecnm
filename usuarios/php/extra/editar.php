<?php

if(isset ($_POST['enviar'])){
    $id=$_POST['id'];
    $nombres=strtoupper($_POST['nombre']);
    $imagen = addslashes(file_get_contents($_FILES['imagenCampo']['tmp_name']));

    $sql = ("SELECT idImagen FROM categorias WHERE categorias.id = $id");
    $query = $bdd->prepare( $sql );
	$query->execute();
	$resultado = $query->fetch(PDO::FETCH_OBJ);

	$idimagen = $resultado->idImagen;

    $sql = "UPDATE `imagen` SET `imagen` = '$imagen' WHERE imagen.id = '$idimagen'";
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

    $sql = "UPDATE `categorias` SET `nombreCategoria` = '$nombres' WHERE `categorias`.`id` = $id";
    $resultado=mysqli_query($conexion,$sql);
    echo "<script languaje='JavaScript'>
    alert('Los datos se actualizaron correctamente');
    location.assign('../extraescolar/categorias.php')
    </script>";

   }else{
    $id=$_GET['id'];
    $sql="SELECT nombreCategoria,imagen FROM categorias INNER JOIN imagen ON categorias.idImagen = imagen.id where categorias.id='".$id."'";
    $resultado=mysqli_query($conexion,$sql);

    $campo=mysqli_fetch_assoc($resultado);
    $nombre=$campo["nombreCategoria"];
    $imagen=$campo["imagen"];

    mysqli_close($conexion);
   }

?>