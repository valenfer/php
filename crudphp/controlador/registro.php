<?php
    if(!empty($_POST['btnRegistrar'])){
        if(!empty($_POST['nombre']) and !empty($_POST['apellidos']) and !empty($_POST['dni']) and !empty($_POST['fecha']) and !empty($_POST['correo'])){
            $nombre=$_POST['nombre'];
            $apellidos=$_POST['apellidos'];
            $dni=$_POST['dni'];
            $fecha=$_POST['fecha'];
            $correo=$_POST['correo'];

            $sql=$conexion->query("insert into personas(nombre,apellidos,dni,fecha_nac,correo) values ('$nombre', '$apellidos','$dni','$fecha','$correo')");
            if ($sql==1){
                echo '<div class="alert alert-success">Persona registrada con éxito</div>';
            }else{
                echo '<div class="alert alert-danger">Error al registrar</div>';
            }
        }else{
            echo '<div class="alert alert-warning">debes rellenar todos los campos</div>';

        }
    }

?>