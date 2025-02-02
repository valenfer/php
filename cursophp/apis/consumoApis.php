<?php
// https://reqres.in/ Se le da el endpoint y te indica la respuesta que recibes
$url="https://reqres.in/api/users?page=2";
//Iniciamos sesion CURL
$ch=curl_init($url);
//Configura CIURL para visualizar datos
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
//Ejecutar la sesion
$response=curl_exec($ch);
//Cerrar sesion
curl_close($ch);
//Decodificamos json a arreglo
$data=json_decode($response,true);

//Mostramos contenido
foreach($data["data"] as $user){
    echo "ID: ".$user['id']."<br>";
    echo "NOMBRE: ".$user['first_name']." ".$user['last_name']."<br>";
    echo "CORREO: ".$user['email']."<br><br>";
}