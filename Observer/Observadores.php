<?php 

interface Observador{
    public function update($data);
}
class Observable{
    private $observers = [];
    public function attach(Observador $observador){
        $this->observadores[] = $observador;
    }
    public function detach(Observador $observador){
        $key = array_search($observador, $this->observadores, true);
        if($key !== false){
            unset($this->observadores[$key]);
        }
    }
    public function notify($data){
        foreach($this->observadores as $observador){
            $observador->update($data);
        }
    }
}
class ConcreteObserver implements Observador {
    public function update($data) {
        echo "Received update: $data\n";
    }
}
//uso del patron Observer

$sensorTemperatura = new Observable();
$sensorHumedad = new Observable();

$estacionCentral = new ConcreteObserver();
$sensorTemperatura->attach($estacionCentral);
$sensorHumedad->attach($estacionCentral);

$sensorTemperatura->notify("Iniciando sensor temperatura! <BR>");
sleep(1);
$sensorTemperatura->notify("Hora:" . date("Y-m-d H:i:s") ."temperatura 20 grados!<BR>");
sleep(1);
$sensorTemperatura->notify("Hora:" . date("Y-m-d H:i:s") ."temperatura 18 grados!<BR>");

$sensorHumedad->notify("Iniciando sensor humedad! <BR>");
sleep(1);
$sensorHumedad->notify("Hora:" . date("Y-m-d H:i:s") ."humedad 67% grados!<BR>");
sleep(1);
$sensorHumedad->notify("Hora:" . date("Y-m-d H:i:s") ."temperatura 79% grados!<BR>");

$sensorHumedad->notify("Adios! <BR>");
$sensorHumedad->detach($estacionCentral);
