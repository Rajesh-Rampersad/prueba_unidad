<?php
declare(strict_types=1);

namespace app\libraries;


class Carrito {
    public array $productos;

    public function __construct() {
        // Inicializar el carrito como un array vacío
        $this->productos = [];
    }

    public function agregarProducto($id, $nombre, $precio, $cantidad) {
        // Verificar si el producto ya está en el carrito
        if (array_key_exists($id, $this->productos)) {
            // Si ya existe, actualizar la cantidad
            $this->productos[$id]['cantidad'] += $cantidad;
        } else {
            // Si no existe, agregar el producto al carrito
            $this->productos[$id] = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad
            ];
        }
    }

    public function mostrarCarrito() {
        $productos = [];

        // Construir un array de productos
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

// Crear un objeto de la clase Carrito
$carrito = new Carrito();

// Agregar algunos productos al carrito
$carrito->agregarProducto(1, 'Producto 1', 10.00, 2);
$carrito->agregarProducto(2, 'Producto 2', 20.00, 1);
$carrito->agregarProducto(1, 'Producto 1', 10.00, 3); // Agregar más del mismo producto

// Mostrar el contenido del carrito
echo "Contenido del carrito:<br>";
$productosEnCarrito = $carrito->mostrarCarrito();
foreach ($productosEnCarrito as $producto) {
    echo "ID: {$producto['id']}, Nombre: {$producto['nombre']}, Precio: {$producto['precio']}, Cantidad: {$producto['cantidad']}<br>";
}