<?php
function calcularArea($ancho, $alto){
    return $ancho*$alto;
}

function testCalcularArea(){
    assert(calcularArea(5,10)==50);
    echo "Test 1 passed<br>";
    assert(calcularArea(10,10)==100);//QUe el resultado devuelto es el esperado
    echo "Test 1 passed<br>";
}

testCalcularArea();