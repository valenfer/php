<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nombre=$_POST["nombre"];
    $email=$_POST["email"];
}else{
    echo "MEtodo no permitido";
}
echo "Nombre: $nombre<br>";
echo "Email: $email<br>";