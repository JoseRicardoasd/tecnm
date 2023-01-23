<?php

include ('../../../../app/config/config.php');

$lunes=(isset($_POST['lunes']))?$_POST['lunes']:0;//preguntando si recibimos valor, de lo contrario se almacena con valor vacio
$martes=(isset($_POST['martes']))?$_POST['martes']:0;//preguntando si recibimos valor, de lo contrario se almacena con valor vacio
$miercoles=(isset($_POST['miercoles']))?$_POST['miercoles']:0;//preguntando si recibimos valor, de lo contrario se almacena con valor vacio
$jueves=(isset($_POST['jueves']))?$_POST['jueves']:0;//preguntando si recibimos valor, de lo contrario se almacena con valor vacio
$viernes=(isset($_POST['viernes']))?$_POST['viernes']:0;//preguntando si recibimos valor, de lo contrario se almacena con valor vacio

if ($lunes == "1") {$lunes = 1;}
if ($martes == "1") {$martes = 1;}
if ($miercoles == "1") {$miercoles = 1;}
if ($jueves == "1") {$jueves = 1;}
if ($viernes == "1") {$viernes = 1;}

$dias = $lunes.$martes.$miercoles.$jueves.$viernes;

echo $dias;

$id=$_POST['id'];//id de categoria
$idActividad=$_POST['idActividad'];//id de actividad
$nombreActividad=strtoupper($_POST['nombreActividad']);
$horaActividad=$_POST['horaActividad'];
$horaHacer = $_POST['horaHacer'];
$lugarActividad=$_POST ['lugarActividad'];
$encargado=$_POST ['encargado'];

echo $id;
echo $idActividad;
echo $nombreActividad;
echo $horaActividad;
echo $horaHacer;
echo $lugarActividad;
echo $encargado;

if (isset($_POST['nombreActividad']) && isset($_POST['horaActividad']) && isset($_POST['horaHacer']) && isset($_POST['lugarActividad']) && isset($_POST['id']) && isset($_POST['idActividad']) && isset($_POST['encargado']) ){//preguntando por todos los datos que se reciben

    $id=$_POST['id'];//id de categoria
    $idActividad=$_POST['idActividad'];//id de actividad
    $nombreActividad=strtoupper($_POST['nombreActividad']);
    $horaActividad=$_POST['horaActividad'];
    $horaHacer = $_POST['horaHacer'];
    $lugarActividad=$_POST ['lugarActividad'];
    $encargado=$_POST ['encargado'];
    
    $sql="UPDATE extraescolar set nombreActividad = $nombreActividad , horaActividad = $horaActividad , horaHacer = $horaHacer , lugarActividad = $lugarActividad, diaActividad = $dias WHERE id = $idActividad";
    $req = $bdd->prepare($sql);
    $req->execute();

    //Seleccionando los campos de la tabla estraescolar para tomar uso de ello
    $sql = "SELECT extraescolar.id, extraescolar.nombreActividad, extraescolar.horaActividad, extraescolar.encargadoActividad, tb_usuarios.nombres FROM extraescolar LEFT JOIN tb_usuarios ON extraescolar.encargadoActividad = tb_usuarios.id WHERE (idCategoria = ?) and (idCiclo = $idCiclo);";
    $req = $bdd->prepare($sql);
    $req->execute([$id]);
    $actividades = $req->fetchAll();

    //Seleccionando los campos de la tabla categoria buscada por el idCategoria que recibimos con el metodo POST
    $sql = "SELECT id,nombreCategoria FROM categorias WHERE id = ?;";
    $red = $bdd->prepare($sql);
    $red->execute([$id]);
    $campitos = $red->fetch(PDO::FETCH_LAZY);

    //Almacenando valores en variables para hacer su llamado y ser vistas por el usuario
    $idCampos=$campitos['id'];
    $campos=$campitos['nombreCategoria'];
}

?>