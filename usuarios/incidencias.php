<?php
include('../app/config/config.php');
session_start();
if (isset($_SESSION['u_usuario'])) {
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
    <title>Incidencias</title>
    <link rel="stylesheet" href="../usuarios/css/estilos.css">



  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include('../layout/menu.php'); ?>

      <?php
      $sql = "SELECT * FROM `tb_incidencia`INNER JOIN tb_tutorias ON tb_tutorias.id=tb_incidencia.id_alumno where tb_incidencia.Estado = 0; ";
      $resultado = mysqli_query($conexion, $sql);

      //pausada
      $sqli = "SELECT * FROM `tb_incidencia` where Estado = 2";
      $resultadoo = mysqli_query($conexion, $sqli);

      $numeroo = mysqli_num_rows($resultadoo);

      //proceso
      $sqlii = "SELECT * FROM `tb_incidencia` where Estado = 1";
      $proceso = mysqli_query($conexion, $sqlii);

      $numero_proceso = mysqli_num_rows($proceso);
      ?>





      <div class="content-wrapper">

        <section class="content-header">
          <h1>Modulo de Tutorias-Incidencias inciadas</h1>
        </section>

        <div class="container">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Nueva Incidencia</button>

        </div>


        <section class="content">

          <a href="historial_detenido.php"> <button type="button" class="btn btn-danger">INCIDENCIA PAUSADA: <?php echo $numeroo ?></button></a>

          <a href="historial_proceso.php"> <button type="button" class="btn btn-warning">INCIDENCIA PROCESO: <?php echo $numero_proceso ?></button></a>

          <a href="historial_actualizacion.php"> <button type="button" class="btn btn-primary">INCIDENCIA FINALIZADA</button></a>

          <form action="incidencia_create.php" method="post" enctype="multipart/form-data" class="eliminar">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel" class="custom">Nueva incidencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                      <button>
                  </div>
                  <div class="modal-body">

                    <div class="row">

                      <div class="col">

                        <div class="form-group" class="col-sm2 control-label">

                          <label for="prioridad">Seleccionar prioridad</label>

                          <select name="prioridad" id="" class="form-control" required>

                            <option value="">Elegir una Opcion</option>

                            <option value="0" <?= (isset($end_status) && $end_status == 0) ? 'selected' : '' ?>>Urgente</option>

                            <option value="1" <?= (isset($end_status) && $end_status == 1) ? 'selected' : '' ?>>Medio</option>

                            <option value="2" <?= (isset($end_status) && $end_status == 2) ? 'selected' : '' ?>>Bajo</option>

                          </select>
                        </div>
                      </div>

                      <div class="col">
                        <div class="form-group" class="col-sm2 control-label">

                          <label for="categoria">Seleccionar categoría</label>

                          <select name="categoria" id="" class="form-control" required>

                            <option value="">Elegir una Opcion</option>

                            <option value="Academicas">Académicas</option>

                            <option value="Psicologicas">Psicológicas</option>

                            <option value="Asesorias">Asesorías</option>

                            <option value="Otras">Otras</option>
                          </select>
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col">
                        <div class="form-group" class="col-sm2 control-label">
                          <label for="incidencia">Status</label>
                          <select name="incidencia" id="" class="form-control" required>

                            <option value="0">Iniciada</option>

                          </select>
                        </div>

                      </div>


                      <div class="col">

                        <label class="form-label">Matricula del alumno</label>
                        <input onkeyup="buscar_ahora($('#buscar_1').val());" type="text" class="form-control" id="buscar_1" name="id_alumno" required>


                      </div>
                    </div>


                    <div class="col" class="form-group" id="datos_buscador">




                    </div>




                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label for="motivo">Motivo</label>
                          <div class="">
                            <textarea name="motivo" id="" class="form-control" placeholder="Motivo de incidencia" required>
                            </textarea>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" value="Registrar">Guardar</button>
                  </div>


                </div>
              </div>
            </div>


          </form>

          <br>


          <!-- Listado de incidencias -->

          <div class="panel panel-primary">


            <div class="panel-heading">Listado de incidencia</div>
            <div class="panel-body">
              <table class="table table-bordered table-hover table-condensed">

                <th>Motivo</th>
                <th>Categoria</th>
                <th>Prioridad</th>
                <th>Matricula</th>
                <th>Estado de inicidencia</th>
                <th>Fecha y hora de incidencia</th>
                <th>Acciones</th>



                <?php
                while ($filas = mysqli_fetch_assoc($resultado)) {
                ?>

                  <tr>

                    <td><?php echo $filas['motivo'] ?></td>
                    <td><?php echo $filas['categoria'] ?></td>

                    <td class="px-2 py-1 align-middle text-center">
                      <?php
                      switch ($filas['prioridad']) {
                        case '0':
                          echo '<span class="rounded-pill badge badgedefault bg-maroon px-3">Urgente</span>';
                          break;
                        case '1':
                          echo '<span class="rounded-pill badge badge-warning bg-yellow px-3">Medio</span>';
                          break;
                        case '2':
                          echo '<span class="rounded-pill badge badge-info bg-aqua px-3">Bajo</span>';
                          break;
                      }
                      ?>
                    </td>
                    <td> <span id="id<?php echo $filas['id']; ?>"><?php echo $filas['id_alumno'] ?></span></td>

                    <td class="px-2 py-1 align-middle text-center">
                      <?php
                      switch ($filas['Estado']) {
                        case '0':
                          echo '<span class="rounded-pill badge badgedefault bg-green px-3">Iniciada</span>';
                          break;
                        case '1':
                          echo '<span class="rounded-pill badge badge-warning bg-yellow px-3">En proceso</span>';
                          break;
                        case '2':
                          echo '<span class="rounded-pill badge badge-info bg-maroon px-3">Stop</span>';
                          break;

                        case '3':
                          echo '<span class="rounded-pill badge badge-info bg-primary px-3">Finalizado</span>';
                          break;
                      }
                      ?>
                    </td>
                    <td><?php echo $filas['timestamp'] ?></td>




                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#example<?php echo $filas['id_incidencia']; ?>">
                        Actualizar estado de la incidencia
                      </button></td>





                    <div class="modal fade" id="example<?php echo $filas['id_incidencia']; ?>" tabindex="-1" aria-labelledby="example" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="example">Actualización de Incidencia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>

                          </div>


                          <form method="post" action="actualizar_incidencia.php" class="actualizar_incidencia">
                            <input type="hidden" name="id" value="<?php echo $filas['id_incidencia']; ?>">

                            <div class="modal-body" id="">
                              <div class="row">
                                <div class="col">
                                  <div class="form-group">
                                    <label>Numero de incidencia: </label>
                                    <?php echo $filas['id_incidencia']; ?>
                                  </div>
                                </div>

                                <div class="col">
                                  <div class="form-group">
                                    <label>Matrícula:</label>
                                    <?php echo $filas['id_alumno']; ?>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col">

                                  <div class="form-group">
                                    <label>Nombre completo:</label>
                                    <?php echo $filas['nombres']; ?>
                                    <?php echo $filas['ap_paterno']; ?>
                                    <?php echo $filas['ap_materno']; ?>

                                  </div>
                                </div>

                                <div class="col">
                                  <div class="form-group">
                                    <label>Carrera:</label>
                                    <?php echo $filas['carrera']; ?>
                                  </div>
                                </div>
                              </div>


                              <div class="form-group">
                                <label>Semestre:</label>
                                <?php echo $filas['semestre']; ?>
                              </div>


                              <div class="form-group" class="col-sm2 control-label">
                                <label for="status">Seleccionar Status de incidencia</label>
                                <select name="status" id="status" class="form-control" value="<?php echo $filas['id_incidencia']; ?>">
                                  <option value="">Elegir una Opcion</option>
                                  <option value="1" <?= (isset($incidencia) && $incidencia == 1) ? 'selected' : '' ?>>En proceso</option>
                                  <option value="2" <?= (isset($incidencia) && $incidencia == 2) ? 'selected' : '' ?>>Pausa</option>
                                  <option value="3" <?= (isset($incidencia) && $incidencia == 3) ? 'selected' : '' ?>>Finalizada</option>



                                </select>

                                <div class="form-group">
                                  <label for="motivo">Motivo</label>
                                  <div class="">
                                    <textarea name="motivoacc" id="" class="form-control" placeholder="Motivo de actualizacion" required>
                            </textarea>
                                  </div>






                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success btn_btn" value="Actualizar">Guardar</button>
                                  </div>


                                </div>
                          </form>
                        </div>
                      </div>
                    </div>
            </div>
          </div>

          <div>



            </tr>
          <?php

                }


          ?>


          </table>
          </div>
      </div>
      </section>

    </div>


    <script type="text/javascript">
      function buscar_ahora(buscar) {
        var parametros = {
          "buscar": buscar
        };
        $.ajax({
          data: parametros,
          type: 'POST',
          url: 'buscarformulario.php',
          success: function(data) {
            document.getElementById("datos_buscador").innerHTML = data;
          }
        });
      }
      // buscar_ahora();
    </script>



    <script>
      $('.eliminar').submit(function(e) {
        e.preventDefault();
        Swal.fire({
          title: '¿ESTAS SEGURO QUE DESEAS GUARDAR?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'SI, DESEO GUARDAR'
        }).then((result) => {
          if (result.isConfirmed) {
            this.submit();
          }
        })

      });
    </script>


    <script>
      $('.actualizar_incidencia').submit(function(e) {
        e.preventDefault();
        Swal.fire({
          title: '¿ESTAS SEGURO QUE DESEAS ACTUALIZAR LA INCIDENCIA?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'SI, DESEO GUARDAR'
        }).then((result) => {
          if (result.isConfirmed) {
            this.submit();
          }
        })

      });
    </script>








    <!-- /.content-wrapper -->
    <?php include('../layout/footer.php'); ?>
    <?php include('../layout/footer_links.php'); ?>
    <!-- hhh -->


  </body>

  </html>

<?php
} else {
  echo "no existe sesión";
  header('Location:' . $URL . '/login');
}
