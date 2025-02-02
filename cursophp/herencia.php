<?php
class Animal{
    public $nombre;
    public $edad;

    public function __construct($nombre, $edad)
    {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    public function comer(){
        echo $this->nombre." Está comiento</br>";
    }
}

class Ave extends Animal{
    public $tipoPluma;

    public function __construct($nombre, $edad, $tipoPluma)
    {
        parent::__construct($nombre, $edad);
        $this->tipoPluma = $tipoPluma;
    }
    public function volar(){
        echo $this->nombre. " está volando</br>";
    }
}

$perico = new Ave("Perico",2, "Cortas");
$perico->comer();
$perico->volar();
