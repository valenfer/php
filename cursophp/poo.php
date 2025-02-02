<?php
//Definicion de clase
class Automovil{
    //Atributos
    public $marca;
    public $modelo;
    public $color;
    public $estado=false;

    //metodo constructor
    function __construct($marca, $modelo, $color){
        $this->marca=$marca;
        $this->modelo=$modelo;
        $this->color=$color;
    }
    function arrancar(){
        if(!$this->estado) $this->estado=true;
        else echo "</br>"."El auto ya esta arrancado"."</br>";
    }
    function apagar(){
        if($this->estado) $this->estado=false;
        else echo "</br>"."El auto ya esta apagado"."</br>";
    }
    //metodos propios
    function mostrar(){
        echo "</br>"."Marca: ".$this->marca."</br>";
        echo "Modelo: ".$this->modelo."</br>";
        echo "Color: ".$this->color."</br>";
        $enmarcha = ($this->estado) ? "arrancado" : "apagado";
        echo "El coche está ".$enmarcha."</br>";
    }
}
//Creacion de objetos
$miAuto = new Automovil("Toyota", "Corola", "Blanco");

$miAuto->mostrar();
echo "Arrancando";
$miAuto->arrancar();
$miAuto->mostrar();
echo "intentando arrancar otra vez";
$miAuto->arrancar();
$miAuto->mostrar();
echo "Apagando";
$miAuto->apagar();
$miAuto->mostrar();
echo "intentando apagar otra vez";
$miAuto->apagar();





?>