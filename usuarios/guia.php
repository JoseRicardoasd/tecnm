<?php
include('../app/config/config.php');
session_start();




if (isset($_SESSION['u_usuario'])) {
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

  $sentencia = $pdo->query("SELECT * FROM guia;");
  $actividades = $sentencia->fetchAll(PDO::FETCH_OBJ);
  //print_r($actividades);

?>

  <!DOCTYPE html>
  <html>

  <head>
    <?php include('../layout/head.php'); ?>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../app/templeates/AdminLTE-2.3.11/bootstrap/css/bootstrap.css">

    <title>Guia de actividades Complementarias</title>
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
            <small>Guia de Actividades Complementarias</small>
          </h1>
        </section>

        <br>

        <div>
          <button style="margin-left: 90px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertar" ?php echo>Añadir actividad</button>
        </div>
        <!--MODAL (nueva actividad)-->
        <div class="modal fade" id="insertar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Ingrese actividad complementaria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--formulario-->
                <form action="registrar.php" method="POST">
                  <div class="form-group">
                    <label for="">Nombre de la actividad</label>
                    <textarea class="form-control mb-3" name="actividad" placeholder="Actividad"></textarea>
                    <label for="">Decripción</label>
                    <textarea class="form-control mb-3" name="descripcion" placeholder="Descripción"></textarea>
                    <div class="row">
                      <div class="col">
                        <label for="">Crédito de actividad</label>
                        <input type="text" class="form-control mb-3" name="credito" placeholder="Crédito por actividad">
                      </div>
                      <div class="col">
                        <label for="">Máximo acomular</label>
                        <input type="text" class="form-control mb-3" name="maximo" placeholder="Máximo por acomular">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

              </div>

            </div>
          </div>
        </div>
      </div>
      <br>


      <!--CRUD-->


      <div class="container">
        <div class="panel panel-primary">
          <div class="panel-heading">Guia de Actividades Complementarias</div>

          <table class="table table-bordered table-hover table-condensed">
            <thead>
              <tr>
                <th scope="col">Actividad</th>
                <th scope="col">Descripción</th>
                <th scope="col">Crédito por actividad</th>
                <th scope="col">Máximo acomular</th>
              </tr>
            </thead>

            <tbody>
              <!--registros de la bd-->
              <?php
              $sql = "SELECT * FROM guia";

              $row = mysqli_query($conexion, $sql);

              while ($result = mysqli_fetch_assoc($row)) {
              ?>
                <tr>
                  <td><?php echo $result['actividad'] ?></td>
                  <td><?php echo $result['descripcion'] ?></td>
                  <td><?php echo $result['credito'] ?></td>
                  <td><?php echo $result['maximo'] ?></td>
                  <td><button type="button" class="btn btn-success editbtn" data-toggle="modal" data-target="#example<?php echo $result['id']; ?>">Editar</button></td>




        </div>

        <!--MODAL (editar actividad)-->
        <div class="modal fade" id="example<?php echo $result['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Editar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!--formulario-->
                <form action="editar.php" method="POST">
                  <input type="hidden" name="id_editar" value="<?php echo $result['id']; ?>">

                  <div class="form-group">
                    <label for="">Nombre de la actividad</label>
                    <textarea class="form-control mb-3" name="actividad" id="actividad" placeholder="Actividad"><?php echo $result['actividad'] ?></textarea>

                    <label for="">Decripción</label>
                    <textarea class="form-control mb-3" name="descripcion" id="descripcion" placeholder="Descripción"><?php echo $result['descripcion'] ?></textarea>

                    <div class="row">
                      <div class="col">
                        <label for="">Crédito de actividad</label>
                        <input type="text" class="form-control mb-3" name="credito" id="credito" placeholder="Crédito por actividad" value="<?php echo $result['credito'] ?>">
                      </div>
                      <div class="col">
                        <label for="">Máximo acomular</label>
                        <input type="text" class="form-control mb-3" name="maximo" id="maximo" placeholder="Máximo por acomular" value="  <?php echo $result['maximo'] ?>">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>

                </form>

              </div>

            </div>
            <td><a href="delete.php?id=<?php echo $result['id'] ?>" class="btn btn-danger">Eliminar</a></td>
          <?php
              }
          ?>
          </tr>
          </tbody>

          </table>
          </div>
        </div>
      </div>
      </table </div>
    </div>
    </section>



  </body>
  <?php include('../layout/footer.php'); ?>
  <?php include('../layout/footer_links.php'); ?>

  </html>
<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
