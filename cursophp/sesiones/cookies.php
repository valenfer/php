<?php
// Crear una cookie
setcookie("usuario", "Juan", time() + (86400 * 30), "/");

// Leer la cookie
if(isset($_COOKIE["usuario"])) {
    echo "Usuario: " . $_COOKIE["usuario"] . "<br>";
} else {
    echo "La cookie 'usuario' no está establecida.<br>";
}

// Modificar la cookie
setcookie("usuario", "Pedro", time() + (86400 * 30), "/");

// Leer la cookie modificada
if(isset($_COOKIE["usuario"])) {
    echo "Usuario modificado: " . $_COOKIE["usuario"] . "<br>";
} else {
    echo "La cookie 'usuario' no está establecida.<br>";
}

// Eliminar la cookie
setcookie("usuario", "", time() - 3600, "/");

// Intentar leer la cookie eliminada
if(isset($_COOKIE["usuario"])) {
    echo "Usuario después de eliminar: " . $_COOKIE["usuario"] . "<br>";
} else {
    echo "La cookie 'usuario' ha sido eliminada.<br>";
}
?>
