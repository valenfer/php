<?php
$email="asd.es";
if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
    echo $email;
}else{
    echo "email no valido";
}

$nombre="<script>alert('Estas siendo hackeado')</script>";
echo htmlspecialchars($nombre);

//cifrado de contraseñas

$contraseña = "1234qwerty";
$cifrada = password_hash($contraseña, PASSWORD_BCRYPT);
echo "Contraseña cifrada: " . $cifrada . "<br>";

// Verificar la contraseña
$contraseña_a_verificar = "1234qwerty";
if (password_verify($contraseña_a_verificar, $cifrada)) {
    echo "La contraseña es correcta.";
} else {
    echo "La contraseña es incorrecta.";
}
