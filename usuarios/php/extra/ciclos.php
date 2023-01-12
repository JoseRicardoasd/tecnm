<?php

$sql = ('SELECT cicloInicio , cicloFin, descripcion FROM ciclo');
$query = $bdd->prepare($sql);
$query->execute();
$ciclos = $query->fetchAll(PDO::FETCH_ASSOC);



?>