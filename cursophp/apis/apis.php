<?php
header('Content-Type: applicaton/json');
//Simulamos los datos en un array (puede venir de una bbdd)
$messages=  [
    ["id" => 1, "menssage" => "Lenguaje PHP"],
    ["id" => 2, "menssage" => "Lenguaje Java"],
    ["id" => 3, "menssage" => "Lenguaje C++"]
];

//Verificar si se solicita mensajes especificos
if(isset($_GET['id'])){
    //Si se ha pasado un id, se filtra el array $messages para encontrar 
    //el mensaje con el id correspondiente. La función array_filter aplica una 
    //función de callback a cada elemento del array y devuelve un nuevo array con los elementos que cumplen la condición.
    $filtered = array_filter($messages, function($msg){
        return $msg['id'] == $_GET['id'];
    });
    if(count($filtered)>0){
        echo json_encode(array_shift($filtered));
    }else{
        echo json_encode(["error"=>"Mensaje no encontrado"]);
    }
}else{
    echo json_encode($messages);
}
//