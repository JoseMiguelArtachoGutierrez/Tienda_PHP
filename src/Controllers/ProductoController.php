<?php

namespace Controllers;

use lib\Pages;
use Model\Producto;

class ProductoController{
    private Pages $pages;


    public function __construct(){
        $this->pages =new Pages();
    }
    public function verProductos(){
        $this->pages->render("producto/productos");
    }
    public function gestionarProducto(){
        $productos= self::todosLosProductos();
        $this->pages->render('producto/gestinarProductos',["productos"=>$productos]);
    }
    public function crearProducto(){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $producto=Producto::fromArray($_POST['data']);
            if ($producto->create()){
                $_SESSION['producto_creado']="Producto Creado Perfectamente ";
            }else{
                $_SESSION['producto_creado']="El Producto no se a podido crear ";
            }
            header("Location: /tienda/Producto/gestionarProducto/");
        }
    }

    public function modificarProducto($id=null){
        if ($_SERVER['REQUEST_METHOD']=="POST"){

            $producto=Producto::fromArray($_POST['data']);
            if ($producto->update()){
                $_SESSION['producto_modificada']="Producto ha sido Modificado Perfectamente ";
            }else{
                $_SESSION['producto_modificada']="El producto no se a podido Modificar ";
            }
            header("Location: /tienda/Producto/gestionarProducto/");
        }elseif ($_SERVER['REQUEST_METHOD']=="GET"){
            $productos= self::todosLosProductos();
            $this->pages->render('producto/gestinarProductos',["id"=>$id,"productos"=>$productos]);
        }
    }
    public function eliminarProducto($id){
        $categorias=CategoriaController::obtenerCategorias();
        $categoriaPrueba=null;
        print_r($categorias);
        foreach ($categorias as $categoria){
            if ($categoria['id']==$id){
                $categoriaPrueba=$categoria;
            }
        }
        $categoriaPrueba=Categoria::fromArray($categoriaPrueba);
        $categoriaPrueba->setDescatalogado(!$categoriaPrueba->isDescatalogado());
        if ($categoriaPrueba->update()){
            $_SESSION['categoria_descatalogado']="Categoria se ha descatalogado Perfectamente ";
        }else{
            $_SESSION['categoria_descatalogado']="La Categoria no se a podido descatalogar ";
        }
        header("Location: /tienda/Categoria/gestionarCategoria/");
    }
    public function quitarDeLaVenta($id){
        $productos=self::todosLosProductos();
        $productoPrueba=null;
        foreach ($productos as $producto){
            if ($producto['id']==$id){
                $productoPrueba=$producto;
            }
        }
        $productoPrueba=Producto::fromArray($productoPrueba);
        $productoPrueba->setEnVenta(!$productoPrueba->isEnVenta());
        if ($productoPrueba->update()){
            $_SESSION['producto_enventa']="El producto se ha cambiado su estado de venta Perfectamente ";
        }else{
            $_SESSION['producto_enventa']="El producto no a podido cambiar su estado de venta ";
        }
        header("Location: /tienda/Producto/gestionarProducto/");
    }
    public static function todosLosProductos(){
        $producto=Producto::fromArray([]);
        return $producto->getAll();
    }

}