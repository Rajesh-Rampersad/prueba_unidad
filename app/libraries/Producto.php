<?php
declare(strict_types=1);

namespace app\libraries;
class Producto {
    private $id;
    private $nombre;
    private $precio;
    private $cantidad;

    public function __construct($id, $nombre, $precio, $cantidad) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    public function getId() {
        return $this->id;
    }

    public function setNombre() {
        return $this->nombre;
    }

    public function getPrecio() {
        return $this->precio;
    }
    public function getCantidad($nueva_cantidad){
        $this->cantidad=$nueva_cantidad;
    }
    public function sumarCantidad($cantidad_agregada){
        $this->cantidad+=$cantidad_agregada;
    }
}