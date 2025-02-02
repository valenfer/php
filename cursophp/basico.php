<?php

//Almacenamiento
$variable= "valor";
$lista = array("elemnto1", "elemento2", "elmento3");
$objeto = new Objeto();

//Condicionales
$edad=17;
if($edad >= 18){
    echo "Mayor de edad";
}else {
    echo "Menor de edad";
}
//Iteracciones
$lista = array(1,2,3,4,5,6);
foreach($lista as $elemento){
    echo ($elemento*3)."\n";
}

//Funciones
function funcion($parámetro){
    return $parámetro;
}
echo funcion("parámetro");

//el mensaje con el id correspondiente. La función array_filter aplica una 
//función de callback a cada elemento del array y devuelve un nuevo array con los elementos que cumplen la condición.
$filtered = array_filter($messages, function($msg){
    return $msg['id'] == $_GET['id'];
});

//Manipulación de cadenas
$cadena= "Hola mundo del PHP";

echo strlen($cadena); //Longitud de la cadena
echo strtoupper($cadena); //Convierte a mayusculas
echo strtolower($cadena); //Convierte a minusculas
echo str_replace("mundo", "universo", $cadena);//Reemplazar partes de cadena
$lista=explode(",", $cadena);//Dividir caden en lista
echo implode("-",$lista); //Unir elemento de lista en cadena

//Arreglos indexados
$lista= array("elem1", "elem2", "elem3", "elem4", "elem5");
echo $lista[0];
echo $lista[3];
//añadir elemento
$lista[]="elem6"; //añade al final

//Arreglos asociativos
$asociativo = array(
    "clave1" => "valor1",
    "clave2" => "valor2",
    "clave3" => "valor3",
    "clave4" => "valor4"
);
echo $asociativo["clave1"]; //Muestra valor
$asociativo["clave5"]="valor5"; //añade nueva clave y valor

//Funciones para arreglos
echo count($lista); //Elementos del arreglo
echo sort($lista); //Ordena ascendente
echo in_array("elem2", $lista);//Verifica si existe un valor
array_push($lista,"elem7");//Añadir elemento
array_pop($lista);//Borrar ultimo elemento


?>