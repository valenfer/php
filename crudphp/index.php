<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8ddfb2fdec.js" crossorigin="anonymous"></script>
    <title>Práctica CRUD</title>
</head>
<body>
    <script>
        function eliminar(){
            var respuesta=confirm("Estas seguro que quieres ekimnar este registro?");
            return respuesta;
        }
    </script>
    <h1 class="text-center p3">Práctica CRUD PHP+MySQL</h1>
    <?php 
        include "./modelo/conexion.php";
        include "./controlador/eliminar.php";
    ?>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="POST">
            <h3 class="text-center text-secondary">Registro de personas</h3>
            <?php
                include "./controlador/registro.php";
            ?>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos">
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" class="form-control" name="dni">
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="correo">
            </div>
            <button type="submit" class="btn btn-primary" name="btnRegistrar" value="ok">Registrar</button>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead class="bg-info">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">APELLIDOS</th>
                    <th scope="col">DNI</th>
                    <th scope="col">FECHA NACIMIENTO</th>
                    <th scope="col">CORREO</th>
                    <th scope="col">ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "./modelo/conexion.php";
                    $sql=$conexion->query("select * from personas");
                    while($datos=$sql->fetch_object()){ ?>
                        <tr>
                            <td><?= $datos->id?></td>
                            <td><?= $datos->nombre?></td>
                            <td><?= $datos->apellidos?></td>
                            <td><?= $datos->dni?></td>
                            <td><?= $datos->fecha_nac?></td>
                            <td><?= $datos->correo?></td>
                            <td>
                                <a href="modificar.php?id=<?= $datos->id ?>"><i class="fa-solid fa-pen-to-square btn btn-small btn-warning"></i></a>
                                <a onclick="return eliminar()" href="index.php?id=<?= $datos->id ?>"><i class="fa-solid fa-trash btn btn-small btn-danger"></i></a>
                            </td>
                        </tr>
                        <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>