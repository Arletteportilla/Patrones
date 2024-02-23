<?php
//Interfaz mediador
interface Mediador{
    public function enviarMensaje($messaje, $collague);
}
//clase mediadorConcreto

class mediadorConcreto implements Mediador{
    private $colega1;
    private $colega2;

    public function setColega1($colega){
        $this->colega1 = $colega;
    }
    public function setColega2($colega){
        $this->colega2 = $colega;
    }
    public function enviarMensaje($mensaje, $colega){
        if($colega == $this->colega1){
            $this->colega2->recibirMensaje($mensaje);
    }elseif ($colega == $this->colega2){
        $this->colega1->recibirMensaje($mensaje);
    }
}

}
class Colega{
    protected $mediador;
    protected $nombre;

    public function __construct($nombre,$mediador){
        $this->nombre = $nombre;
        $this->mediador = $mediador;
    }
    public function enviar($mensaje){
        $this->mediador->enviarMensaje($mensaje, $this);
    }
    public function recibirMensaje($mensaje){
        echo "Prompt de " . $this->nombre .": Mensaje recibido:". $mensaje . "\n";
    }

}

//uso del patron mediador

$mediador = new mediadorConcreto();

$colega1 = new Colega("Juanito", $mediador);
$colega2 = new Colega("Rigoberto",$mediador);

$mediador->setColega1($colega1);
$mediador->setColega2($colega2);

$colega1->enviar("Hola, soy Juanito<BR>");
$colega2->enviar("Hola, soy Rigoberto <BR>");

