<?php
//Reutilizacion de codigo
trait Logger{
    public function log($mensaje){
        echo date("Y-m-d H:i:s"). ":". $mensaje."<br>"; 
    }
}

class Libro{
    use Logger;
    public function crear($titulo){
        $this->log("Libro creado: $titulo");
    }
}
$libro = new Libro();
$libro->crear("1984");


