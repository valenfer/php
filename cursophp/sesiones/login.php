<?php
session_start();
$usuarios = array(
    'user1' => 'pass1',
    'user2' => 'pass2'
);

function verificarInicioSesion($usuario, $password, $usuarios)
{
    return isset($usuarios[$usuario]) && $usuarios[$usuario] === $password;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['usuario']) && isset($_POST['password'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        if (verificarInicioSesion($usuario, $password, $usuarios)) {
            echo "Sesion iniciada";
            $_SESSION['usuario'] = $usuario;
            header('Location: ss.php');
            exit;
        } else {
            $error = "nombre de usuario y contraseña incorrectos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>iniciar sesión</h2>
    <form action="" method="POST">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <input type="submit" value="Iniciar sesión">
    </form>
</body>

</html>