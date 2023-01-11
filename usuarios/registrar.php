<?php
include('../app/config/config.php');

$actividad=$_POST['actividad'];
$descripcion=$_POST['descripcion'];
$credito=$_POST['credito'];
$maximo=$_POST['maximo'];


$sql="INSERT INTO guia (actividad,descripcion,credito,maximo) VALUES ('$actividad','$descripcion','$credito','$maximo')";
$row = mysqli_query($conexion, $sql); 

if($row){
    Header("Location: guia.php");
}else{

}


?>