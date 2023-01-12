<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        $sq = "SELECT * FROM departamento 
       ";

            $result = mysqli_query($conexion, $sq);
        
            ?>
</head>
<body>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Nuevo Departamento
                    </button>

                    <form action="departamentoCreate.php" method="post" enctype="multipart/form-data">
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel">Alta de Departamento</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                    <div class="row">

<div class="col">
<div class="form-group" class="col-sm2 control-label">

</select>
</div>
</div>
<div class="col">
<div class="form-group" class="col-sm2 control-label">

</div>

                                        </div>
                                        
                                     


                                         
                                        </div>


<div class="row">
    <div class="col">
    <div class="form-group">
                                                    <label for="id_alumno" class="col-sm2 control-label">Departamento</label>
                                                    <div class="">
                                                        <input type="text" name="departamento" id="" class="form-control" placeholder="Departamento" style="text-transform:uppercase;" required tabindex="11">
                                                    </div>
                                                </div>
    </div>
</div>


                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" value="Registrar">Guardar</button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>
</body>
</html>
