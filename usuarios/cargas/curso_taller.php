<?php

include('../../app/config/config.php');

$nombre = $_FILES['archivo']['name'];
$guardado = $_FILES['archivo']['tmp_name'];

$id_act = $_POST['evento'];

$num_control = $_POST['numero_control'];

$credito = $_POST['credit'];


//$responsable = $_POST['responsable'];

$apellido = $_POST['ap_paterno'];

date_default_timezone_set("America/Monterrey");

$fechaHora = date('Y-m-d h:i:s');

if (!file_exists('Curso o curso taller')) {
  mkdir('Curso o curso taller', 0777, true);
  if (file_exists('Curso o curso taller')) {
    if (file_exists('Curso o curso taller/' . $num_control . '-' . $apellido . '-' . $id_act . '.pdf')) {
      echo '<script language="javascript">alert("El archivo ya existe");window.location.href="../agregar-credito-user.php"</script>';
    } else {
      if (move_uploaded_file($guardado, 'Curso o curso taller/' . $num_control . '-' . $apellido . '-' . $id_act . '.pdf')) {

        $inserta = "INSERT INTO evidencia(numero_control, id_evento, subido, ruta_doc, credito, fecha_evidencia) VALUES ('$num_control', '$id_act', 1, 'Curso o curso taller/$num_control-$apellido-$id_act.pdf', '$credito', '$fechaHora')";
        $resultado = mysqli_query($conexion, $inserta);
        if (!$resultado) {
          echo 'Error al insertar archivo';
        } else {
          echo '<script language="javascript">window.location.href="../agregar-credito-user.php"</script>';
        }
        mysqli_close($conexion);
      } else {
        echo '<script language="javascript">alert("Archivo no guardado");window.location.href="../agregar-credito-user.php"</script>';
      }
    }
  }
} else {

  if (file_exists('Curso o curso taller/' . $num_control . '-' . $apellido . '-' . $id_act . '.pdf')) {
    echo '<script language="javascript">alert("El archivo ya existe");window.location.href="../agregar-credito-user.php"</script>';
  } else {
    if (move_uploaded_file($guardado, 'Curso o curso taller/' . $num_control . '-' . $apellido . '-' . $id_act . '.pdf')) {

      $inserta = "INSERT INTO evidencia(numero_control, id_evento, subido, ruta_doc, credito, fecha_evidencia) VALUES ('$num_control', '$id_act', 1, 'Curso o curso taller/$num_control-$apellido-$id_act.pdf', '$credito', '$fechaHora')";
      $resultado = mysqli_query($conexion, $inserta);
      if (!$resultado) {
        echo 'Error al insertar archivo';
      } else {
        echo '<script language="javascript">window.location.href="../agregar-credito-user.php"</script>';
      }
      mysqli_close($conexion);
    } else {
      echo '<script language="javascript">alert("Archivo no guardado");window.location.href="../agregar-credito-user.php"</script>';
    }
  }
}
