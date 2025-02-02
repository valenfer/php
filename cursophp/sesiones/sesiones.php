<?php
// Iniciar la sesión
session_start();

// Almacenar datos en la sesión
$_SESSION['usuario'] = 'Juan';
$_SESSION['email'] = 'juan@example.com';
echo "Datos de sesión almacenados.<br>";

// Acceder a los datos de la sesión
echo "Usuario: " . $_SESSION['usuario'] . "<br>";
echo "Email: " . $_SESSION['email'] . "<br>";

// Modificar datos de la sesión
$_SESSION['usuario'] = 'Pedro';
echo "Usuario actualizado: " . $_SESSION['usuario'] . "<br>";

// Eliminar un dato de la sesión
unset($_SESSION['usuario']);
echo "Dato de sesión eliminado.<br>";

// Destruir la sesión
session_destroy();
echo "Sesión destruida.";
?>

