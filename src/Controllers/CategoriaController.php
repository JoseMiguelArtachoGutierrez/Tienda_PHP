<?php

namespace Controllers;

use lib\BaseDatos;
use lib\Pages;
use Model\Categoria;
use utils\ValidarYSanear;

class CategoriaController{
    private BaseDatos $db;
    private Pages $pages;

    public function __construct(){
        $this->db = new BaseDatos();
        $this->pages= new Pages();
    }
    public function gestionarCategoria(){
        $categorias= self::obtenerCategorias();
        $this->pages->render('categoria/categoria',["categorias"=>$categorias]);
    }
    public function crearCategoria(){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $categoria=Categoria::fromArray($_POST['data']);
            $categoria->setNombre(ValidarYSanear::validarYSanearString($categoria->getNombre()));
            if ($categoria->create()){
                $_SESSION['categoria_creada']="Categoria Creada Perfectamente ";
            }else{
                $_SESSION['categoria_creada']="La Categoria no se a podido crear ";
            }
            header("Location: /tienda/Categoria/gestionarCategoria/");
        }
    }

    public function modificarCategoria($id=null){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $categoria=Categoria::fromArray($_POST['data']);
            $categoria->setNombre(ValidarYSanear::validarYSanearString($categoria->getNombre()));
            if ($categoria->update()){
                $_SESSION['categoria_modificada']="Categoria Modificada Perfectamente ";
            }else{
                $_SESSION['categoria_modificada']="La Categoria no se a podido Modificar ";
            }
            header("Location: /tienda/Categoria/gestionarCategoria/");
        }elseif ($_SERVER['REQUEST_METHOD']=="GET"){
            $categorias= self::obtenerCategorias();
            $this->pages->render('categoria/categoria',["id"=>$id,"categorias"=>$categorias]);
        }
    }
    public function descatalogarCategoria($id){
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
    public function mostrarProductosUnaCategoria($idCategoria){
        $categorias=CategoriaController::obtenerCategorias();
        $productos=ProductoController::todosLosProductos();
        $existeProducto=false;
        $existe=false;
        foreach ($productos as $producto){
            if ($idCategoria==$producto['categoria_id']){
                $existeProducto=true;
            }
        }
        foreach ($categorias as $categoria){
            if ($categoria['id']==$idCategoria){
                $existe=true;
            }
        }
        if ($existe && $existeProducto){
            $this->pages->render('producto/productos',["mostrarEstaCategoria"=>$idCategoria]);
        }else{
            if (!$existeProducto){
                $this->pages->render('producto/productos',["mostrarEstaCategoria"=>$idCategoria,"mensajeProducto"=>"No existen productos de esta categoria"]);
            }else{
                $this->pages->render('producto/productos',["mostrarEstaCategoria"=>"Esta Categoria no existe"]);
            }
        }
    }
    public static function obtenerCategorias():?array{
        return Categoria::getAll();
    }
}