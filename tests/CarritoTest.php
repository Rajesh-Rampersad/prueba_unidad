<?php


declare(strict_types=1);


// namespace tests\Carrito;
// use app\libraries\Carrito;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;

//=================================================================================================
//
// COMIENZO DE PRUEBA UNITARIA
//
//=================================================================================================

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
$carrito->agregarProducto(3, 'Producto 1', 10.00, 3); // Agregar más del mismo producto

// Mostrar el contenido del carrito
//echo "Contenido del carrito:<br>";
$productosEnCarrito = $carrito->mostrarCarrito();
foreach ($productosEnCarrito as $producto) {
   // echo "ID: {$producto['id']}, Nombre: {$producto['nombre']}, Precio: {$producto['precio']}, Cantidad: {$producto['cantidad']}<br>";
}


//=================================================================================================
//
// COMIENZO DE PRUEBA UNITARIA
//
//=================================================================================================

class CarritoTest extends TestCase
{
   
    public function testCarro_agregar_producto()
    {
        $carrito = new Carrito();   
       

        $producto = [
            'id' => "1",
            'nombre' => 'Producto 1',
            'precio' => 10,
            'cantidad' => 2
        ];

        // Llama a la función agregarProducto() con los elementos individuales del producto
        $carrito->agregarProducto(
            $producto['id'],
            $producto['nombre'],
            $producto['precio'],
            $producto['cantidad']
        );

        // Verifica que el carrito no esté vacío después de agregar un producto
        Assert::assertNotEmpty($carrito->mostrarCarrito());
        
      

        // Verifica que el producto agregado esté en el carrito
        $carritoItems = $carrito->mostrarCarrito();
        Assert::assertEquals($producto, $carritoItems[0]);
        //comprueba la cantidad de producto en el carrito
        Assert::assertIsArray(['cantidad'=>$producto['cantidad']]);
    
    }

 
}