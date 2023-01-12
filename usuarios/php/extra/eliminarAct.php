<?php

$id=$_POST['id'];

include ('../../../app/config/config.php');

//consulta a la tabla eliminar

$sql = "DELETE FROM extraescolar WHERE id='$id'";

$resultado = mysqli_query($conexion,$sql);

if($resultado){
    echo "<script languaje='JavaScript'>
    alert('Los datos se eliminaron correctamente');
    location.assign('../../extraescolar/categorias.php')
    </script>";
}else{
    echo "<script languaje='JavaScript'>
    alert('Los datos no se eliminaron correctamente');
    location.assign('../../extraescolar/categorias.php')
    </script>";
}

?>