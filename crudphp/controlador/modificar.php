<?php
if(!empty($_POST["btnModificar"])){
    
    if(!empty($_POST['nombre']) and !empty($_POST['apellidos']) and !empty($_POST['dni']) and !empty($_POST['fecha']) and !empty($_POST['correo'])){
        $id=$_POST['id'];
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $dni=$_POST['dni'];
        $fecha=$_POST['fecha'];
        $correo=$_POST['correo'];
        $sql=$conexion->query("update personas set nombre='$nombre', apellidos='$apellidos', dni='$dni', fecha_nac='$fecha', correo='$correo' where id='$id'");
        if($sql==1){
            header("Location:index.php");
        }else{
            echo "<div class='alert alert-danger'>No se ha podido modificar</div>";
        }
    }
}else{
    echo "<div class='alert alert-warning'>No pueden haber campos vacíos</div>";
}

?>