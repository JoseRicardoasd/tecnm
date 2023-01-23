<?php

$conexion = mysqli_connect("localhost", "root", "", "prueba");
?>


<?php

define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('PASSWOD', '');
define('BD', 'prueba');

$URL = 'mysql://root:@localhost/prueba';

$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR;

try {
  $pdo = new PDO($servidor, USUARIO, PASSWOD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
  // echo "<script>alert('La conexión a la base de datos fue exitosa.')</script>";
} catch (PDOException $e) {
  echo "<script>alert('Error a la conexión con la base de datos')</script>";
}
?>

<?php

$server = "localhost";
$user = "root";
$pass = "";
$bd = "prueba";

$conect = new mysqli($server, $user, $pass, $bd);
?>
<?php
$database = "prueba";
$user = 'root';
$password = '';


try {

  $con = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password);
} catch (PDOException $e) {
  echo "Error" . $e->getMessage();
}
?>
<?php

try {
  $bdd = new PDO('mysql:host=localhost;dbname=prueba;charset=utf8', 'root', '');
} catch (Exception $e) {
  die('Error : ' . $e->getMessage());
}
