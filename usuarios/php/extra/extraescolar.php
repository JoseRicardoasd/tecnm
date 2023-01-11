<?php

    $sql = ("SELECT id FROM ciclo ORDER BY id DESC LIMIT 1;");
    $query = $bdd->prepare( $sql );
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_OBJ);

    $idCiclo = $resultado === false ? 1 : $resultado->id;

    $sql = ("SELECT id, descripcion FROM ciclo ORDER BY id DESC LIMIT 1;");
    $query = $bdd->prepare( $sql );
    $query->execute();
    $ciclos = $query->fetch(PDO::FETCH_OBJ);

    $sql = "SELECT categorias.id, categorias.nombreCategoria, imagen.imagen FROM categorias INNER JOIN imagen ON categorias.idImagen = imagen.id WHERE idCiclo = $idCiclo;";
    $query = $bdd->prepare($sql);
    $query->execute();
    $campos = $query->fetchAll(PDO::FETCH_ASSOC);

?>