<?php
interface Pago{
    public function procesarPago($monto);
}

class PagoTarjeta implements Pago{
    public function procesarPago($monto){
        echo "Porcesando pago ".$monto. " mediante tarjeta de credito<br>";
    }
}


class PagoPaypal implements Pago{
    public function procesarPago($monto){
        echo "Porcesando pago ".$monto. " mediante paypal<br>";
    }
}


class PagoBitcoin implements Pago{
    public function procesarPago($monto){
        echo "Porcesando pago ".$monto. " mediante criptomonedas<br>";
    }
}

$tarjeta= new PagoTarjeta();
$paypal= new PagoPaypal();
$bitcoin= new PagoBitcoin();

$tarjeta->procesarPago(200);
$paypal->procesarPago(100);
$bitcoin->procesarPago(300);
