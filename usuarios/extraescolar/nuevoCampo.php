<?php
include ('../../app/config/config.php');
session_start();



if(isset($_SESSION['u_usuario'])){
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
       

         include('../php/extra/controlador_categorias.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include ('../../layout/extraescolar/head.php'); ?>
  <title>Agregar Tutoriado</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include ('../../layout/extraescolar/menu.php'); ?>


  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            SISTEMA DE CAMPOS
            <small>Agregar Campos Extraescolares</small>
        </h1>
        
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Agregar Campos Extraescolares</h3>
                            </div>
                            <div class="panel-body">
                                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" class="alerta">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><i class="glyphicon glyphicon-user"></i> Nombre del campo extraescolar</label> 
                                                <input type="text" class="form-control" value="<?php if (!empty($nombre)) {
                                                    echo $nombre;
                                                } ?>" name="nombreCampo" required style="text-transform:uppercase;">
                                                <input type="hidden" name="id" value="<?php if (!empty($id)) {
                                                    echo $id;
                                                } ?>">
                                            </div>
                                            <?php if (!empty($imagen)) {
                                                echo "<div class='form-group'>";
                                                echo "<label for=''><i class='glyphicon glyphicon-user'></i>Imagen Anterior</label>";
                                                echo "<br>";
                                                echo "<img src='data:image/jpg;base64,". base64_encode($imagen)."' width = '150px' alt='...'>";
                                                echo "</div>";
                                            } ?>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""><i class="glyphicon glyphicon-user"></i> Imagen portada de campo</label>
                                                <input type="file" class="form-control" name="imagenCampo" required>
                                            </div>
                                    
                                        <div class="col-md-6">
                                        <br>
                                        <div class="form-group">
                                            <center>
                                            <a href="registro_categoria.php" class="btn btn-danger btn-lg">Cancelar</a>
                                            <?php
                                            if (!empty($nombre)) {
                                                echo "<input type='submit' name='categoria' class='btn btn-primary btn-lg' value='Actualizar'>";
                                            } elseif (empty($nombre)) {
                                                echo "<button type='submit' name='categoria' class='btn btn-primary btn-lg' value='Registrar'>Registrar</button>";
                                            }
                                            ?>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </section>
    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
  <?php include ('../../layout/extraescolar/footer.php'); ?>
  <?php include ('../../layout/extraescolar/footer_links.php'); ?>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/alerta.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>
       //alerta guardar----------------
    $('.alerta').submit(function(e) {
      e.preventDefault();
      Swal.fire({
        title: '¿DESEAS GUARDAR LOS DATOS?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, DESEO GUARDAR'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: 'DATOS GUARDADOS CORRECTAMENTE',
            icon: 'success',
            showConfirmButton: false,
          })
          setTimeout(() => {
            this.submit();
          }, "1000")

        }

      })

    });
    </script>


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