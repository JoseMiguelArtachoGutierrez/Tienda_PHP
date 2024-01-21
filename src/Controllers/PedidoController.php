<?php

namespace Controllers;

use lib\Pages;
use Model\Lineas_pedido;
use Model\Pedido;

class PedidoController{
    private Pages $pages;
    public function __construct(){
        $this->pages= new Pages();
    }
    public function gestionarPedido(){
        $pedidos=PedidoController::todosLosPedidos();
        $this->pages->render('pedido/mostrarPedido',["todosLosPedidos"=>$pedidos]);
    }
    public function verPedidos($id){
        $pedidos= PedidoController::todosLosPedidos();
        $pedidosUsuario=[];
        foreach ($pedidos as $pedido){
            if ($pedido['usuario_id']==$id){
                array_push($pedidosUsuario,$pedido);
            }
        }
        $this->pages->render("pedido/verMisPedidos",["misPedidos"=>$pedidosUsuario]);
    }
    public function comprar(){
        if (isset($_SESSION['identity'])){
            $this->pages->render('pedido/formularioPedido');
        }else{
            $this->pages->render('usuario/login');
        }
    }
    public function crearPedido(){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $pedido=Pedido::fromArray($_POST['data']);
            if ($pedido->create()){
                $pedidos=PedidoController::todosLosPedidos();
                $pedidoId=0;
                for ($i=0;$i<count($pedidos);$i++){
                    if ($i==count($pedidos)-1){
                        $pedidoId=$pedidos[$i]['id'];
                    }
                }
                if (Lineas_pedidoController::crearLineas_pedido($_SESSION['carrito'],$pedidoId)){
                    unset($_SESSION['carrito']);
                }
                $_SESSION['pedido_creado']="Pedido Creado Perfectamente ";
            }else{
                $_SESSION['pedido_creado']="El Pedido no se a podido crear ";
            }
            header("Location: /tienda/Pedido/verPedidos/".$_SESSION['identity']->id);
        }
    }
    public function modificarPedido($id=null){
        if ($_SERVER['REQUEST_METHOD']=="POST"){
            $pedido=Pedido::fromArray($_POST['data']);
            if ($pedido->update()){
                $_SESSION['pedido_modificada']="Categoria Modificada Perfectamente ";
            }else{
                $_SESSION['pedido_modificada']="La Categoria no se a podido Modificar ";
            }
            header("Location: /tienda/Pedido/gestionarPedido/");
        }elseif ($_SERVER['REQUEST_METHOD']=="GET"){
            $pedidos=PedidoController::todosLosPedidos();
            $this->pages->render('pedido/mostrarPedido',["todosLosPedidos"=>$pedidos,"id"=>$id]);
        }
    }
    public function eliminarPedido($id){
        if (Lineas_pedidoController::eliminarLineas_pedido($id)){
            $pedidoPrueba=Pedido::fromArray(["id"=>$id]);
            if ($pedidoPrueba->delete()){
                $_SESSION['pedido_eliminado']="El Pedido se ha eliminado Perfectamente ";
            }else{
                $_SESSION['pedido_eliminado']="El Pedido no se a podido eliminar ";
            }
        }
        header("Location: /tienda/Pedido/gestionarPedido/");
    }
    public function enviarPedido($id){
        $usuarios=UsuarioController::todosLosUsuarios();
        $pedidos=PedidoController::todosLosPedidos();

        $emailUsu=null;
        foreach ($usuarios as $usuario){
            foreach ($pedidos as $pedidoPrueba){
                if ($pedidoPrueba['id']==$id){
                    $emailUsu=$usuario['email'];
                }
            }

        }

        $pedido=Pedido::fromArray(['estado'=>"enviado","id"=>$id]);
        if ($pedido->update()){
            EmailController::enviarCorreo($emailUsu);
            $_SESSION['pedido_enviado']="Pedido enviado ";
        }else{
            $_SESSION['pedido_enviado']="Pedido no enviado ";
        }

    }
    public static function todosLosPedidos(){
        $pedido=Pedido::fromArray([]);
        return $pedido->getAll();
    }

}