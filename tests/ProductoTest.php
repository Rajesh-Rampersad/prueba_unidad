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
        return $this->id;
    }

    /**
     * Devuelve el nombre del producto.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Devuelve el precio del producto.
     *
     * @return float
     */
    public function getPrecio()
    {
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
        if (!is_int($cantidad_agregada) || $cantidad_agregada <= 0) {
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
    }
}