<?php

include('../../app/config/config.php');

$nombre = $_FILES['archivo']['name'];
$guardado = $_FILES['archivo']['tmp_name'];

$id_act = $_POST['evento'];

$num_control = $_POST['numero_control'];

//$responsable = $_POST['responsable'];

$apellido = $_POST['ap_paterno'];

if (!file_exists('Diseño de Prototipos')) {
  mkdir('Diseño de Prototipos', 0777, true);
  if (file_exists('Diseño de Prototipos')) {
    if (file_exists('Diseño de Prototipos/' . $num_control . '-' . $apellido . '-' . $id_act . '.pdf')) {
      echo '<script language="javascript">alert("El archivo ya existe");window.location.href="../agregar-credito-user.php"</script>';
    } else {
      if (move_uploaded_file($guardado, 'Diseño de Prototipos/' . $num_control . '-' . $apellido . '-' . $id_act . '.pdf')) {
        //insertar datos en la tabla
        $inserta = "INSERT INTO evidencia(numero_control, id_evento, subido, ruta_doc) VALUES ('$num_control', '$id_act', 1, 'Diseño de Prototipos/$num_control-$apellido-$id_act.pdf')";
        $resultado = mysqli_query($conexion, $inserta);
        if (!$resultado) {
          echo 'Error al insertar archivo';
        } else {
          echo '<script language="javascript">alert("Archivo guardado");window.location.href="../agregar-credito-user.php"</script>';
        }
        mysqli_close($conexion);
      } else {
        echo '<script language="javascript">alert("Archivo no guardado");window.location.href="../agregar-credito-user.php"</script>';
      }
    }
  }
} else {
  if (file_exists('Diseño de Prototipos/' . $num_control . '-' . $apellido . '-' . $id_act . '.pdf')) {
    echo '<script language="javascript">alert("El archivo ya existe");window.location.href="../agregar-credito-user.php"</script>';
  } else {
    if (move_uploaded_file($guardado, 'Diseño de Prototipos/' . $num_control . '-' . $apellido . '-' . $id_act . '.pdf')) {
      //insertar datos en la tabla
      $inserta = "INSERT INTO evidencia(numero_control, id_evento, subido, ruta_doc) VALUES ('$num_control', '$id_act', 1, 'Diseño de Prototipos/$num_control-$apellido-$id_act.pdf')";
      $resultado = mysqli_query($conexion, $inserta);
      if (!$resultado) {
        echo 'Error al insertar archivo';
      } else {
        echo '<script language="javascript">alert("Archivo guardado");window.location.href="../agregar-credito-user.php"</script>';
      }
      mysqli_close($conexion);
    } else {
      echo '<script language="javascript">alert("Archivo no guardado");window.location.href="../agregar-credito-user.php"</script>';
    }
  }
}
