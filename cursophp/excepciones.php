<?php
function registrarUsuarios($edad, $nombre)
{
    if ($edad < 18) {
        throw new Exception("Registro fallido: Usuario menos de 18 años<br>");
    } else echo "Usuario: $nombre es registrado con éxito<br>";
}
try {
    registrarUsuarios(17, "Juan");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}
