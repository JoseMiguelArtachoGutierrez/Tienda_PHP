<?php

namespace Controllers;

use lib\Pages;

class CarritoController{
    private Pages $pages;

    private array $cesta;

    /**
     * @param array $cesta
     */
    public function __construct(){
        $this->pages= new Pages();
        $this->cesta = [];
    }

    public function verCarrito(){
        $this->pages->render("carrito/cesta");
    }
    public function añadirCarrito($id){
        $productos=ProductoController::todosLosProductos();
        $productoIDstock=null;
        for ($i=0;$i<count($productos);$i++){
            if ($id==$productos[$i]['id']){
                $productoIDstock=$productos[$i]['stock'];
            }
        }
        if (isset($_SESSION['carrito'])){
            $existe=false;
            print_r($_SESSION['carrito']);
            for ($i=0;$i<count($_SESSION['carrito']);$i++){
                $carrito=$_SESSION['carrito'][$i];
                if ($carrito['id']==$id){
                    if ($carrito['cantidad']<$productoIDstock){
                        $carrito['cantidad']++;
                    }
                    $existe=true;
                }
                $_SESSION['carrito'][$i]=$carrito;
            }
            if (!$existe){
                array_push($_SESSION['carrito'],["id"=>$id,"cantidad"=>1]);
            }

        }else{
            $_SESSION['carrito']=[["id"=>$id,"cantidad"=>1]];
        }
        header("Location: ".BASE_URL);
        $this->pages->render('producto/productos');
    }
    public function quitarProductoDelCarrito($id){
        for ($i=0;$i<count($_SESSION['carrito']);$i++){
            $carrito=$_SESSION['carrito'][$i];
            if ($carrito['id']==$id){
                if ($carrito['cantidad']==1){
                    array_splice($_SESSION['carrito'], $i, 1);
                }else{
                    $carrito['cantidad']--;
                    $_SESSION['carrito'][$i]=$carrito;
                }
            }
        }
        if (!isset($_SESSION['carrito'][0])){
            $this->pages->render('producto/productos');
        }else{
            header("Location: /tienda/Carrito/verCarrito/");
        }

    }
    public function añadirProductoDelCarrito($id){
        $productos=ProductoController::todosLosProductos();
        $productoIDstock=null;
        $message=null;
        for ($i=0;$i<count($productos);$i++){
            if ($id==$productos[$i]['id']){
                $productoIDstock=$productos[$i]['stock'];
            }
        }
        for ($i=0;$i<count($_SESSION['carrito']);$i++){
            $carrito=$_SESSION['carrito'][$i];
            if ($carrito['id']==$id){
                if ($carrito['cantidad']==$productoIDstock){
                    $message="No hay mas Stock de este Producto";
                }else{
                    $carrito['cantidad']++;
                    $_SESSION['carrito'][$i]=$carrito;
                }
            }
        }
        header("Location: /tienda/Carrito/verCarrito/");
    }
    public  function eliminarProductoDelCarrito($id){
        for ($i=0;$i<count($_SESSION['carrito']);$i++){
            $carrito=$_SESSION['carrito'][$i];
            if ($carrito['id']==$id){
                unset($_SESSION['carrito'][$i]);
            }
        }
        if (!isset($_SESSION['carrito'][0])){
            $this->pages->render('producto/productos');
        }else{
            header("Location: /tienda/Carrito/verCarrito/");
        }
    }
    public function eliminarCarrito(){
        unset($_SESSION['carrito']);
        $this->pages->render('producto/productos');
    }
}