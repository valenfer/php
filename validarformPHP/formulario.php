<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            background-color: white;
            padding: 10px;
            margin: 100px auto;
            width: 400px;
        }

        input[type=text], input[type=password]{
            padding: 10px;
            width: 380px;
        }

        input[type="submit"]{
            border: 0;
            background-color: #ed8824;
            padding: 10px 20px;
        }

        .error{
            background-color: #ff9185;
            font-size: 12px;
            padding: 10px;
        }

        .correcto{
            background-color: #a0dea7;
            font-size: 12px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <form action="formulario.php" method="POST">
        <?php
            /** Declaramos vairables globales para que mantenga los valores en las casillas tras ver errores */
            $nombre="";
            $password="";
            $mail="";
            $pais="";
            $nivel="";
            $lenguajes=array();
            if(isset($_POST["nombre"])){
                $nombre=$_POST['nombre'];
                $password=$_POST['password'];
                $mail=$_POST['email'];
                $pais=$_POST['pais'];
                if(isset($_POST['nivel'])){
                    $nivel=$_POST['nivel'];
                }else{
                    $nivel="";
                }
                if(isset($_POST['lenguajes'])){
                    $lenguajes=$_POST['lenguajes'];
                }else{
                    $lenguajes=[];
                }
                $campos=array();

                if($nombre==""){
                    array_push($campos, "El campo nombre no purde estar vacío");
                }
                if($password=="" || strlen($password)<6){
                    array_push($campos, "El password debe tener al menos 6 caracteres");
                }
                if($mail=="" || strpos($mail, "@")===false){
                    array_push($campos, "El email no es valido");
                }
                if($pais==""){
                    array_push($campos, "Selecciona un país");
                }
                if($nivel==""){
                    array_push($campos, "Selecciona un nivel");
                }
                if($lenguajes == [] || count($lenguajes)<2){
                    array_push($campos, "Selecciona al menos 2 lenguajes");
                }
                if (count($campos) > 0){
                    echo "<div class='error'>";
                    for($i=0; $i<count($campos); $i++){
                        echo "<li>".$campos[$i]."</li>";
                    }                    
                }else{
                    echo "<div class='correcto'>
                    Datos correctos";
                }
                echo "</div>";
            };
        ?>
        <p>
            Nombre: <br>
            <input type="text" name="nombre" id="" value="<?php echo $nombre?>">
        </p>
        <p>
            Password: <br>
            <input type="password" name="password" id="" value="<?php echo $password?>">
        </p>
        <p>
            Email: <br>
            <input type="text" name="email" id="" value="<?php echo $mail?>">
        </p>
        <p>
            País de origen: <br>
            <select name="pais" id="">
                <option value="">Selecciona un país</option>
                <option value="mx" <?php if($pais=="mx") echo "selected"?>>México</option>
                <option value="eu" <?php if($pais=="eu") echo "selected"?>>Estados Unidos</option>
                <option value="es"<?php if($pais=="es") echo "selected"?>>España</option>
                <option value="ar"<?php if($pais=="ar") echo "selected"?>>Argentina</option>
                <option value="ch"<?php if($pais=="ch") echo "selected"?>>China</option>
            </select>
        </p>
        <p>
            Nivel de desarrollo:<br>
            <input type="radio" name="nivel" id="" value="principiante" <?php if($nivel=="principiante") echo "checked"?>>Principiante
            <input type="radio" name="nivel" id="" value="intermedio" <?php if($nivel=="intermedio") echo "checked"?>>Intermedio
            <input type="radio" name="nivel" id="" value="avanzado" <?php if($nivel=="avanzado") echo "checked"?>>Avanzado
        </p>
        <p>
            lenguajes de programación:<br>
            <input type="checkbox" name="lenguajes[]" id="" value="php" <?php if(in_array("php", $lenguajes)) echo "checked";?>>PHP <br>
            <input type="checkbox" name="lenguajes[]" id="" value="js" <?php if(in_array("js", $lenguajes)) echo "checked";?>>Javascript<br>
            <input type="checkbox" name="lenguajes[]" id="" value="java" <?php if(in_array("java", $lenguajes)) echo "checked";?>>Java<br>
            <input type="checkbox" name="lenguajes[]" id="" value="swift" <?php if(in_array("swift", $lenguajes)) echo "checked"?>>Swift<br>
            <input type="checkbox" name="lenguajes[]" id="" value="py" <?php if(in_array("py", $lenguajes)) echo "checked";?>>Python<br>

        </p>
        <p><input type="submit" value="enviar datos"></p>
    </form>
</body>
</html>