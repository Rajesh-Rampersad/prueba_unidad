<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

class Carrito
{
    public array $productos;

    public function __construct()
    {
        $this->productos = [];
    }

    /**
     * Agrega un producto al carrito.
     *
     * @param string $id       El ID del producto.
     * @param string $nombre   El nombre del producto.
     * @param float  $precio   El precio del producto.
     * @param int    $cantidad La cantidad del producto.
     *
     * @throws \InvalidArgumentException Si los parámetros no son válidos.
     */
    public function agregarProducto(string $id, string $nombre, float $precio, int $cantidad): void
    {
        if (empty($id) || empty($nombre) || empty($precio) || empty($cantidad)) {
            throw new \InvalidArgumentException('Los parámetros no son válidos.');
        }

        if (array_key_exists($id, $this->productos)) {
            $this->productos[$id]['cantidad'] += $cantidad;
        } else {
            $this->productos[$id] = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad
            ];
        }
    }

    /**
     * Elimina un producto del carrito.
     *
     * @param string $id El ID del producto.
     *
     * @throws \InvalidArgumentException Si el ID del producto no existe en el carrito.
     */
    public function eliminarProducto(string $id): void
    {
        if (!array_key_exists($id, $this->productos)) {
            throw new \InvalidArgumentException('El ID del producto no existe en el carrito.');
        }

        unset($this->productos[$id]);
    }

    /**
     * Actualiza la cantidad de un producto en el carrito.
     *
     * @param string $id       El ID del producto.
     * @param int    $cantidad La nueva cantidad del producto.
     *
     * @throws \InvalidArgumentException Si el ID del producto no existe en el carrito o si la cantidad es menor o igual a cero.
     */
    public function actualizarCantidadProducto(string $id, int $cantidad): void
    {
        if (!array_key_exists($id, $this->productos)) {
            throw new \InvalidArgumentException('El ID del producto no existe en el carrito.');
        }

        if ($cantidad <= 0) {
            throw new \InvalidArgumentException('La cantidad debe ser mayor a cero.');
        }

        $this->productos[$id]['cantidad'] = $cantidad;
    }

    /**
     * Calcula el precio total del carrito.
     *
     * @return float El precio total del carrito.
     */
    public function calcularPrecioTotal(): float
    {
        $precioTotal = 0;

        foreach ($this->productos as $producto) {
            $precioTotal += $producto['precio'] * $producto['cantidad'];
        }

        return $precioTotal;
    }

    /**
     * Limpia el carrito.
     */
    public function limpiarCarrito(): void
    {
        $this->productos = [];
    }

    /**
     * Muestra el contenido del carrito.
     *
     * @return array El contenido del carrito.
     */
    public function mostrarCarrito(): array
    {
        $productos = [];

        foreach ($this->productos as $id => $producto) {
            $productos[] = [
                'id' => $id,
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => $producto['cantidad']
            ];
        }

        return $productos;
    }
}

//=============================================================================
//
// COMIENZO DE PHPUNIT
//
//=============================================================================

class CarritoTest extends TestCase
{

    public function testCarro_agregar_producto()
    {
        $carrito = new Carrito();

        $producto1 = [
            'id' => "1",
            'nombre' => 'Producto 1',
            'precio' => 10,
            'cantidad' => 2
        ];

        $carrito->agregarProducto(
            $producto1['id'],
            $producto1['nombre'],
            $producto1['precio'],
            $producto1['cantidad']
        );

        $producto2 = [
            'id' => "2",
            'nombre' => 'Producto 2',
            'precio' => 20,
            'cantidad' => 1
        ];

        $carrito->agregarProducto(
            $producto2['id'],
            $producto2['nombre'],
            $producto2['precio'],
            $producto2['cantidad']
        );

        $producto3 = [
            'id' => "3",
            'nombre' => 'Producto 3',
            'precio' => 30,
            'cantidad' => 3
        ];

        $carrito->agregarProducto(
            $producto3['id'],
            $producto3['nombre'],
            $producto3['precio'],
            $producto3['cantidad']
        );

        // Verifica que el carrito no esté vacío después de agregar productos
        Assert::assertNotEmpty($carrito->productos);
        Assert::AssertIsArray($carrito->productos);

        // Verifica que la cantidad de productos en el carrito sea la correcta
        Assert::assertEquals(3, count($carrito->productos));

        // Verifica que la cantidad de un producto específico sea la correcta
        Assert::assertEquals(1, $carrito->productos['2']['cantidad']);
    }
}