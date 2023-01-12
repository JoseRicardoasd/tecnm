<?php
include ('../../app/config/config.php');
session_start();

if(isset($_SESSION['u_usuario']) && $_SESSION['u_privilegio']  == 0){
    //echo "existe sesión";
    //echo "bienvenido usuario";
$correo_sesion = $_SESSION['u_usuario'];
    $query_sesion = $pdo->prepare("SELECT * FROM tb_usuarios WHERE correo = '$correo_sesion' AND estado = '1' ");
    $query_sesion->execute();
    $sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
    foreach ($sesion_usuarios as $sesion_usuario){
        $id_sesion = $sesion_usuario['id'];
         $id_nombres = $sesion_usuario['nombres'];
        $id_ap_paterno = $sesion_usuario['ap_paterno'];
        $id_ap_materno = $sesion_usuario['ap_materno'];
         $id_sexo = $sesion_usuario['sexo'];
         $id_numero_control = $sesion_usuario['numero_control'];
         $id_carrera = $sesion_usuario['carrera'];
         $id_correo = $sesion_usuario['correo'];
         $id_estado_civil = $sesion_usuario['estado_civil'];
         $id_telefono = $sesion_usuario['telefono'];
         $id_ciudad = $sesion_usuario['ciudad'];
         $id_colonia = $sesion_usuario['colonia'];
         $id_calle = $sesion_usuario['calle'];
         $id_codigo_postal = $sesion_usuario['codigo_postal'];
         $id_curp = $sesion_usuario['curp'];
         $id_fecha_nacimiento = $sesion_usuario['fecha_nacimiento'];
         $id_nivel_escolar = $sesion_usuario['nivel_escolar'];
         $id_reticula = $sesion_usuario['reticula'];
         $id_entidad = $sesion_usuario['entidad'];
         $id_foto_perfil = $sesion_usuario['foto_perfil'];
       
    }

    if(!isset($_GET["id"])) exit();//preguntando si el metodo get tiene un valor, si no tiene uno sale del porceso
    $id = $_GET["id"];

    include('../php/extra/ciclo.php');

    $sql = "SELECT id,nombreActividad,idCategoria FROM extraescolar WHERE (id = ?) and (idCiclo = $idCiclo);";
    $req = $bdd->prepare($sql);
    $req->execute([$id]);
    $extraescolar = $req->fetch(PDO::FETCH_OBJ);

    $nombre = $extraescolar->nombreActividad;
    $categoria = $extraescolar->idCategoria;

    $sql = ("SELECT id,nombreCategoria FROM categorias WHERE id = $categoria;");
    $query = $bdd->prepare( $sql );
    $query->execute();
    $cate = $query->fetch(PDO::FETCH_LAZY);

    $idCategoria = $cate['id'];
    $nombreCategoria = $cate['nombreCategoria'];

    $sql = "SELECT tb_usuarios.id, tb_usuarios.nombres,tb_usuarios.ap_paterno,tb_usuarios.ap_materno,tb_usuarios.carrera,tb_usuarios.numero_control,tb_usuarios.telefono,extragrupo.observacion,extragrupo.acreditacion,extragrupo.idActividad FROM extragrupo INNER JOIN tb_usuarios ON extragrupo.matricula = tb_usuarios.numero_control WHERE extragrupo.idActividad = $id";
    $req = $bdd->prepare($sql);
    $req->execute();
    $alumnados = $req->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html>
<head>
  <?php include ('../../layout/extraescolar/head.php'); ?>
  <title>Listado de Alumnos Activos</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include ('../../layout/extraescolar/menu.php'); ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SISTEMA DE ACTIVIDADES
        <small>Listado de actividades extraescolares</small>
        <a href="lista_actividades.php?id=<?php echo $idCategoria?>" class="btn btn-primary" style="position: absolute; right: 10%;">Atras</a>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="panel panel-primary">
                    <div class="panel-heading">CATEGORIA <?php 
                    echo $nombreCategoria ?> DE ACTIVIDAD <?php echo $nombre;
                    ?></div>

                    <div class="panel-body">

                    <a class="btn btn-primary btn-lg" href="">
                        Imprimir Lista
                    </a>

                    <br><br>

                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
						        <th>Alumno</th>
                                <th>Matricula</th>
                                <th>Habilidades</th>
                                <th>Acreditacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($alumnados as $alumno) { ?>
                            <tr>
                                <td></td>
                                <td><?php echo $alumno['nombres'] ?></td>
                                <td><?php echo $alumno['numero_control'] ?></td>
                                <td><?php echo $alumno['habilidad'] ?></td>
                                <td><?php if ($alumno['calificacion'] == 1) {
                                    echo "acreditado";
                                } else {
                                    echo "No acrreditado";
                                }
                                ?></td>
                            </tr>
                            <?php } ?>

                            <?php
                                if (!empty($alumnados)) {
                                    foreach ($alumnados as $alumno) {
                                        echo"<tr>";
                                        echo"<td>".$i++."</td>";
                                        echo"<td>".$alumno['nombres']."</td>";
                                        echo"<td>".$alumno['numero_control']."</td>";
                                        echo"<td>".$alumno['observacion']."</td>";
                                        if ($alumno['acreditacion'] == 1) {
                                            echo "<td>ACREDITADO</td>";
                                        } else if($alumno['acreditacion'] == 2){
                                            echo "<td>NO ACREDITADO</td>";
                                        }
                                        echo"<tr>";
                                    }
                                } else if(empty($alumnados)){
                                    echo"<tr>";
                                    echo"<td> SIN REGISTROS DE ALUMNOS </td>";
                                    echo"<tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                        
                    </div>
                </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include ('../../layout/extraescolarfooter.php'); ?>
  <?php include ('../../layout/extraescolarfooter_links.php'); ?>




</body>
</html>
<script>
    function archivo(evt) {
        var files = evt.target.files; // FileList object
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="200px" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('file').addEventListener('change', archivo, false);
</script>
<?php
}else{
    echo "no existe sesión";
    header('Location:'.$URL.'/login');
}