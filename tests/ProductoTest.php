<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;


class Producto
{
    private $id;
    private $nombre;
    private $precio;
    private $cantidad;

    public function __construct($id, $nombre, $precio, $cantidad)
    {
        // Validación de datos de entrada
        if (!is_int($id) || $id <= 0 || !is_numeric($precio) || $precio < 0 || !is_numeric($cantidad) || $cantidad < 0) {
            throw new InvalidArgumentException('Los datos de entrada no son válidos');
        }

        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    /**
     * Devuelve el ID del producto.
     *
     * @return int
     */
    public function getId()
    {
        if  (!is_int($this->id) || empty($this->id)) {
            throw new Exception("El id del producto es inválido");
            
            }
        
            return $this->id;
        }

    /**
     * Devuelve el nombre del producto.
     *
     * @return string
     */
    public function getNombre()
    {
        if(empty($this->nombre)){
            throw new Exception("No se ha asignado un nombre al producto");
        }
        return $this->nombre;
    }

    /**
     * Devuelve el precio del producto.
     *
     * @return float
     */
    public function getPrecio()
    {
        if (!is_numeric($this->precio) || $this->precio <= 0) {
            throw new InvalidArgumentException('El precio debe ser un número positivo');
        }
        
        return $this->precio;
    }
    

    /**
     * Establece la cantidad del producto.
     *
     * @param int $cantidad La nueva cantidad del producto.
     * @return void
     * @throws InvalidArgumentException Si la cantidad no es un entero positivo.
     */
    public function getCantidad()
    {
        // Validación de cantidad
        // if (!is_int(cantidad) || cantidad < 0) {
        //     throw new InvalidArgumentException('La cantidad debe ser un entero positivo');
        // }

        return $this->cantidad;
    }

    /**
     * Incrementa la cantidad del producto.
     *
     * @param int $cantidad_agregada La cantidad a sumar.
     * @return void
     * @throws InvalidArgumentException Si la cantidad agregada no es un entero positivo.
     */
    public function sumarCantidad($cantidad_agregada)
    {
        // Validación de cantidad
        if (!is_int($cantidad_agregada) || $cantidad_agregada <= 0 || $cantidad_agregada === null) {
            throw new InvalidArgumentException('La cantidad agregada debe ser un entero positivo');
        }

        $this->cantidad += $cantidad_agregada;
    }
}

//=============================================================================
//
// COMIENZO DE PHPUNIT
//
//=============================================================================

class ProductoTest extends TestCase
{
    public function testCrearProducto(): void
    {
        $producto = new Producto(10, 'Producto 1', 10.00, 2);

        // Verificar que los atributos del producto se hayan configurado correctamente
        Assert::assertEquals(10, $producto->getId());
        Assert::assertEquals('Producto 1', $producto->getNombre());
        Assert::assertEquals(10.00, $producto->getPrecio());
        Assert::assertEquals(2, $producto->getCantidad());
        Assert::assertIsFloat($producto->getPrecio());
        Assert:: assertIsInt($producto->getId());
        
       
        }
}