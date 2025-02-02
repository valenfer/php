<?php
class Animal{
    protected $nombre;
    
    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    public function mover(){
        echo $this->nombre." se está moviendo</br>";
    }
}

class Pez extends Animal{
    public function mover(){
        echo $this->nombre." está nadando</br>";
    }
}

class Pajaro extends Animal{
    public function mover(){
        echo $this->nombre." está volando</br>";
    }
}

class Serpiente extends Animal{
    public function mover(){
        echo $this->nombre." está reptando</br>";
    }
}

$pez = new Pez("Nemo");
$pajaro = new Pajaro("Piolin");
$serpiente = new Serpiente("Kaa");

$pez->mover();
$pajaro->mover();
$serpiente->mover();




