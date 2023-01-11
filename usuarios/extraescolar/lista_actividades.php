<?php
include ('../../app/config/config.php');
session_start();

if(!isset($_GET["id"])) exit();//preguntando si el metodo get tiene un valor, si no tiene uno sale del porceso
    $id = $_GET["id"];

    $sql = ("SELECT id FROM ciclo ORDER BY id DESC LIMIT 1;");
    $query = $bdd->prepare( $sql );
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_OBJ);

    $idCiclo = $resultado === false ? 1 : $resultado->id;

    $sql = "SELECT * FROM extraescolar WHERE (idCategoria = ?) and (idCiclo = $idCiclo);";
    $req = $bdd->prepare($sql);
    $req->execute([$id]);
    $actividades = $req->fetchAll();

    $sql = "SELECT id,nombreCategoria FROM categorias WHERE id = ?;";
    $red = $bdd->prepare($sql);
    $red->execute([$id]);
    $campitos = $red->fetch(PDO::FETCH_LAZY);


    $idCampos=$campitos['id'];
    $campos=$campitos['nombreCategoria'];

    

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

    $i = 1;

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
                        Actividades Extraescolares
                        <small>Listado de actividades extraescolares</small>
                        <a href="categorias.php" class="btn btn-primary" style="position: absolute; right: 10%;">Atras</a>
                    </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="panel panel-primary">
                        <div class="panel-heading">CATEGORIAS <?php echo "".$campos?></div>

                        <div class="panel-body">

                            <a class="btn btn-primary btn-lg" href="<?php echo "nueva_actividad.php?id=" . $idCampos?>">
                                Nueva Actividad
                            </a>

                            <br><br>

                            <table class="table table-light">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>ACTIVIDAD</th>
                                        <th>ACCION</th>
                                    </tr>
                                </thead>
                                <tbody class="thead-light">
                                    <form action="../php/extra/eliminarAct.php" method="POST">
                                        <?php
                                        if (!empty($actividades)) {
                                            foreach ($actividades as $actividad) {
                                                echo"<tr>";
                                                echo"<td>".$i++."</td>";
                                                echo"<td>".$actividad['nombreActividad']."</td>";
                                                echo"<td style='width: 25%;'>
                                                <a href='lista_alumno_actividad.php?id=".$actividad['id']."' class='btn btn-primary'>Listas</a>
                                                <input type='hidden' name='id' value='".$actividad['id']."'>
                                                <input type='submit' class='btn btn-danger' value='Eliminar'>
                                                <a href='editarAct.php?id=".$actividad['id']."' class='btn btn-primary'>Editar</a>";
                                                echo"<tr>";
                                            }
                                        } else if(empty($actividades)){
                                            echo"<tr>";
                                            echo"<td> SIN REGISTROS DE CICLOS </td>";
                                            echo"<tr>";
                                        }
                                        ?>
                                    </form>
                                </tbody>
                            </table>
                        
                    </div>
                </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include ('../../layout/extraescolar/footer.php'); ?>
  <?php include ('../../layout/extraescolar/footer_links.php'); ?>




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
