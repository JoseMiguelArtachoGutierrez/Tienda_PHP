<?php

namespace Routes;

use Controllers\CarritoController;
use Controllers\CategoriaController;
use Controllers\ErrorController;
use Controllers\PedidoController;
use Controllers\ProductoController;
use  Controllers\UsuarioController;
use lib\Router;

class Routes
{
    public static function index(){
        Router::add('GET','/',function (){
            return (new ProductoController())->verProductos();
        });
        /* USUARIO */
        Router::add('GET','/Usuario/indetifica',function (){
            return (new UsuarioController())->indetifica();
        });
        Router::add('POST','/Usuario/login',function (){
            return (new UsuarioController())->login();
        });
        Router::add('GET','/Usuario/logout',function (){
            return (new UsuarioController())->logout();
        });
        Router::add('GET','/Usuario/registro',function (){
            return (new UsuarioController())->registro();
        });
        Router::add('POST','/Usuario/registro',function (){
            return (new UsuarioController())->registro();
        });
        /* PRODUCTOS */
        Router::add('GET','/Producto/gestionarProducto',function (){
            return (new ProductoController())->gestionarProducto();
        });
        Router::add('POST','/Producto/modificarProducto',function (){
            return (new ProductoController())->modificarProducto();
        });
        Router::add('GET','/Producto/modificarProducto/:id',function ($id){
            return (new ProductoController())->modificarProducto($id);
        });
        Router::add('POST','/Producto/crearProducto',function (){
            return (new ProductoController())->crearProducto();
        });
        Router::add('GET','/Producto/quitarDeLaVenta/:id',function ($id){
            return (new ProductoController())->quitarDeLaVenta($id);
        });
        /* PEDIDOS */
        Router::add('GET','/Pedido/comprar',function (){
            return (new PedidoController())->comprar();
        });
        Router::add('POST','/Pedido/crearPedido',function (){
            return (new PedidoController())->crearPedido();
        });
        Router::add('GET','/Pedido/gestionarPedido',function (){
            return (new PedidoController())->gestionarPedido();
        });
        Router::add('GET','/Pedido/verPedidos/:id',function ($id){
            return (new PedidoController())->verPedidos($id);
        });
        Router::add('GET','/Pedido/eliminarPedido/:id',function ($id){
            return (new PedidoController())->eliminarPedido($id);
        });
        /* CATEGORIAS */
        Router::add('GET','/Categoria/mostrarProductosUnaCategoria/:id',function ($id){
            return (new CategoriaController())->mostrarProductosUnaCategoria($id);
        });
        Router::add('GET','/Categoria/gestionarCategoria',function (){
            return (new CategoriaController())->gestionarCategoria();
        });

        Router::add('POST','/Categoria/crearCategoria',function (){
            return (new CategoriaController())->crearCategoria();
        });
        Router::add('POST','/Categoria/modificarCategoria',function (){
            return (new CategoriaController())->modificarCategoria();
        });
        Router::add('GET','/Categoria/modificarCategoria/:id',function ($id){
            return (new CategoriaController())->modificarCategoria($id);
        });
        Router::add('GET','/Categoria/descatalogarCategoria/:id',function ($id){
            return (new CategoriaController())->descatalogarCategoria($id);
        });


        /* CARRITO */
        Router::add('GET','/Carrito/anadirCarrito/:id',function ($id){
            return (new CarritoController())->añadirCarrito($id);
        });
        Router::add('GET','/Carrito/verCarrito',function (){
            return (new CarritoController())->verCarrito();
        });
        Router::add('GET','/Carrito/anadirProductoDelCarrito/:id',function ($id){
            return (new CarritoController())->añadirProductoDelCarrito($id);
        });
        Router::add('GET','/Carrito/quitarProductoDelCarrito/:id',function ($id){
            return (new CarritoController())->quitarProductoDelCarrito($id);
        });
        Router::add('GET','/Carrito/eliminarCarrito',function (){
            return (new CarritoController())->eliminarCarrito();
        });


        /* ERROR */
        Router::add('GET','/Error/error', function (){
            return (new ErrorController())->show_error404();
        });
        Router::dispatch();
    }
}