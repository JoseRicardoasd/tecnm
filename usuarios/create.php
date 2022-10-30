<?php
include ('../app/config/config.php');
session_start();



if (isset($_SESSION['u_usuario']) && $_SESSION['u_privilegio']  == 0) {
  //echo "existe sesión";
  //echo "bienvenido usuario";
  $correo_sesion = $_SESSION['u_usuario'];
  $query_sesion = $pdo->prepare("SELECT * FROM tb_usuarios WHERE correo = '$correo_sesion' AND estado = '1' ");
  $query_sesion->execute();
  $sesion_usuarios = $query_sesion->fetchAll(PDO::FETCH_ASSOC);
  foreach ($sesion_usuarios as $sesion_usuario) {
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
?>

  <!DOCTYPE html>
  <html>

  <head>
    <?php include('../layout/head.php'); ?>
    <title>Agregar usuario</title>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <?php include('../layout/menu.php'); ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SISTEMA DE CREDITOS COMPLENTARIOS
            <small>Agregar usuario</small>
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Agregar Alumno</h3>
                </div>

                <form action="controlador_create.php" method="post" enctype="multipart/form-data">
                  <div class="panel-body">
                    <div class="row">


                      <div class="col-md-6">
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-user"></i> Nombres</label>
                          <input type="text" class="form-control" name="nombres" required tabindex="1" style="text-transform:uppercase;" maxlength="30">
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-user"></i> Apellido Materno</label>
                          <input type="text" class="form-control" name="ap_materno" required tabindex="3" style="text-transform:uppercase;" maxlength="20">
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-check"></i> Numero de Control</label>
                          <input type="number" class="form-control" name="numero_control" required tabindex="5" maxlength="8">
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-envelope"></i> Correo Institucional</label>
                          <input type="email" class="form-control" name="correo" required tabindex="7" maxlength="30">
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-calendar"></i> Fecha de nacimiento</label>
                          <input type="date" class="form-control" name="fecha_nacimiento" required tabindex="9">
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-phone"></i> Telefono</label>
                          <input type="number" class="form-control" name="telefono" required tabindex="11" maxlength="10">
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-map-marker"></i> colonia</label>
                          <input type="text" class="form-control" name="colonia" required tabindex="13" style="text-transform:uppercase;">
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-map-marker"></i> Entidad Federativa</label>
                          <select name="ciudad" id="" class="form-control" required tabindex="15" style="text-transform:uppercase;">
                            <option value="elegir">Elegir una Opcion</option>
                            <option value="Aguascalientes">Aguascalientes</option>
                            <option value="Baja California">Baja California</option>
                            <option value="Baja California Sur">Baja California Sur</option>
                            <option value="Campeche">Campeche</option>
                            <option value="Chiapas">Chiapas</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="CDMX">Ciudad de México</option>
                            <option value="Coahuila">Coahuila</option>
                            <option value="Colima">Colima</option>
                            <option value="Durango">Durango</option>
                            <option value="Estado de México">Estado de México</option>
                            <option value="Guanajuato">Guanajuato</option>
                            <option value="Guerrero">Guerrero</option>
                            <option value="Hidalgo">Hidalgo</option>
                            <option value="Jalisco">Jalisco</option>
                            <option value="Michoacán">Michoacán</option>
                            <option value="Morelos">Morelos</option>
                            <option value="Nayarit">Nayarit</option>
                            <option value="Nuevo León">Nuevo León</option>
                            <option value="Oaxaca">Oaxaca</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Querétaro">Querétaro</option>
                            <option value="Quintana Roo">Quintana Roo</option>
                            <option value="San Luis Potosí">San Luis Potosí</option>
                            <option value="Sinaloa">Sinaloa</option>
                            <option value="Sonora">Sonora</option>
                            <option value="Tabasco">Tabasco</option>
                            <option value="Tamaulipas">Tamaulipas</option>
                            <option value="Tlaxcala">Tlaxcala</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Yucatán">Yucatán</option>
                            <option value="Zacatecas">Zacatecas</option>
                          </select>
                        </div>

                        <!-- <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-equalizer"></i> Entidad</label>
                          <input type="text" class="form-control" name="entidad" required tabindex="17">
                        </div> -->
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-picture"></i> Foto de Perfil</label>
                          <input type="file" class="form-control" id="file" name="file" tabindex="20">
                          <center>
                            <br>
                            <output id="list" style="margin-top: 0px"></output>
                          </center>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-user"></i> Apellido Paterno</label>
                          <input type="text" class="form-control" name="ap_paterno" required tabindex="2" style="text-transform:uppercase;" maxlength="20">
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-user"></i> Sexo</label>
                          <select name="sexo" id="" class="form-control" tabindex="4" style="text-transform:uppercase;">
                            <option value="elegir">Elegir una Opcion</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                            <option value="Mujer">Otro</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-book"></i> Carrera</label>
                          <select name="carrera" id="" class="form-control" required tabindex="6" style="text-transform:uppercase;">
                            <!-- <option value="elegir"><?php echo $sesion_usuario['carrera']; ?></option> -->
                            <option value="Ingeneria en Agronomia">Ingeneria en Agronomia</option>
                            <option value="Ingeneria Forestal">Ingeneria Forestal</option>
                            <option value="Infeneria en Industrias Alimentarias">Infeneria en Industrias Alimentarias</option>
                            <option value="Licenciatura en Biologia">Licenciatura en Biologia</option>
                            <option value="Ingeneria Informatica">Ingeneria Informatica</option>
                            <option value="Ingeneria en Administracion">Ingeneria en Administracion </option>
                            <option value="Infeneria en Gestion Empresarial">Infeneria en Gestion Empresarial</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-modal-window"></i> Estado Civil</label>
                          <select name="estado_civil" id="" class="form-control" required tabindex="8" style="text-transform:uppercase;">
                            <option value="elegir"><?php echo $sesion_usuario['estado_civil']; ?></option>
                            <option value="Soltero/a">Soltero/a</option>
                            <option value="Casado/a">Casado/a</option>
                            <option value="Unión libre">Unión libre</option>
                            <option value="Separado/a">Separado/a</option>
                            <option value="Divorciado/a">Divorciado/a</option>
                            <option value="Viudo/a">Viudo/a</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-link"></i> CURP</label>
                          <input type="text" class="form-control" name="curp" required tabindex="10" style="text-transform:uppercase;" maxlength="18">
                        </div>
                      </div>
                      <div class="col-md-6">

                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-map-marker"></i> Calle</label>
                          <input type="text" class="form-control" name="calle" required tabindex="12" style="text-transform:uppercase;">
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-equalizer"></i> Codigo Postal</label>
                          <input type="number" class="form-control" name="codigo_postal" required tabindex="14" maxlength="5">
                        </div>
                        <!-- <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-link"></i> Reticula</label>
                          <input type="text" class="form-control" name="reticula" required tabindex="16">
                        </div> -->
                        <!-- <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-education"></i> Nivel Escolar</label>
                          <input type="text" class="form-control" name="nivel_escolar" required>
                        </div> -->
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-lock"></i> Contraseña</label>
                          <input type="password" class="form-control" name="contraseña" required tabindex="16" maxlength="15">
                        </div>
                        <div class="form-group">
                          <label for=""><i class="glyphicon glyphicon-eye-close"></i> Confirmar Contraseña</label>
                          <input type="password" class="form-control" required tabindex="17" maxlength="15">
                        </div>
                        <br>
                        <div class="form-group">
                          <center>
                            <a href="" class="btn btn-danger btn-lg">Cancelar</a>
                            <input type="submit" class="btn btn-primary btn-lg" value="Registrar">
                          </center>
                        </div>
                      </div>
                    </div>

                  </div>
                </form>

              </div>
            </div>
          </div>

        </section>
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include('../layout/footer.php'); ?>
    <?php include('../layout/footer_links.php'); ?>




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
        reader.onload = (function(theFile) {
          return function(e) {
            // Insertamos la imagen
            document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e.target.result, '" width="200px" title="', escape(theFile.name), '"/>'].join('');
          };
        })(f);
        reader.readAsDataURL(f);
      }
    }
    document.getElementById('file').addEventListener('change', archivo, false);
  </script>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
