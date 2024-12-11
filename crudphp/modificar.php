<?php
    include "./modelo/conexion.php";
    $id = $_GET['id'];
    $sql=$conexion->query("select * from personas where id=$id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Modificar personas</title>
</head>
<body>
        <form class="col-4 p-3 m-auto" method="POST">
            <h3 class="text-center text-secondary">Modificar personas</h3>
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            <?php 
            include "./controlador/modificar.php";
            while($datos=$sql->fetch_object()){ ?>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" value="<?=$datos->nombre?>">
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" value="<?=$datos->apellidos?>">
                </div>
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="dni" value="<?=$datos->dni?>">
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" name="fecha" value="<?=$datos->fecha_nac?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="correo" value="<?=$datos->correo?>">
                </div>
            <?php }
            ?>
            
            <button type="submit" class="btn btn-primary" name="btnModificar" value="ok">Modificar</button>
        </form>
</body>
</html>