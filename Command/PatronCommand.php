<?php
interface Command {
    public function execute();
}

// Cambia la clase 'stock' a 'Stock' para que coincida con la referencia en las otras clases
class Stock{
    private $nombre;
    private $cantidad;

    public function __construct($nombre, $cantidad) {
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
    }

    public function comprar() {
        echo "Stock [ Nombre: " . $this->nombre . ", Cantidad: " . $this->cantidad . " ] comprada<br>";
    }

    public function vender() {
        echo "Stock [ Nombre: " . $this->nombre . ", Cantidad: " . $this->cantidad . " ] vendida<br>";
    }
}

// Asegúrate de que todas las clases de órdenes implementan la interfaz Command
class ComprarStock implements Command {
    private $miStock;
    public function __construct(Stock $miStock) {
        $this->miStock = $miStock;
    }
    public function execute() {
        $this->miStock->comprar();
    }
}

class VenderStock implements Command {
    private $miStock;
    public function __construct(Stock $miStock) {
        $this->miStock = $miStock;
    }
    public function execute() {
        $this->miStock->vender();
    }
}

// Cambia el tipo de 'Orden' a 'Command' para que coincida con la interfaz implementada
class Broker {
    private $listadoOrdenes = [];

    public function tomarOrden(Command $orden) {
        $this->listadoOrdenes[] = $orden;
    }

    public function realizarPedidoOrdenes() {
        foreach ($this->listadoOrdenes as $orden) {
            $orden->execute();
        }
        $this->listadoOrdenes = [];
    }
}

// Implementación del patrón de comando
$stock1 = new Stock("AMZN", 10);
$stock2 = new Stock("GOOGL",13);

$ordenStockCompra = new ComprarStock($stock1);
$ordenStockVenta = new VenderStock($stock2);

$broker = new Broker();
$broker->tomarOrden($ordenStockCompra);
$broker->tomarOrden($ordenStockVenta);

$broker->realizarPedidoOrdenes();
