<?php

namespace Controllers;

use lib\Pages;
use Model\Lineas_pedido;

class Lineas_pedidoController{
    private Pages $pages;
    public function __construct(){
        $this->pages= new Pages();
    }
    public static function crearLineas_pedido($carrito,$pedidoId){
        $error=true;
        foreach ($carrito as $producto){
            $data=[
                "id"=>null,
                "pedido_id"=>$pedidoId,
                "producto_id"=>$producto['id'],
                "unidades"=>$producto['cantidad']
            ];
            $linea_pedido=Lineas_pedido::fromArray($data);
            if ($linea_pedido->create()){
                $_SESSION['linea_pedido_creado']="Linea_pedido Creado Perfectamente ";
            }else{
                $error=false;
                $_SESSION['linea_pedido_creado']="La linea_pedido no se a podido crear ";
            }
        }
        return $error;
    }
    public static function eliminarLineas_pedido($idPedido){
        $error=true;
        $todas=Lineas_pedidoController::todosLasLineas_pedido();
        foreach ($todas as $linea_pedido){
            if ($linea_pedido['pedido_id']==$idPedido){
                $linea_pedido=Lineas_pedido::fromArray($linea_pedido);
                if ($linea_pedido->delete()){
                    $_SESSION['linea_pedido_eliminado']="La linea_pedido se ha eliminado Perfectamente ";
                }else{
                    $error=false;
                    $_SESSION['linea_pedido_eliminado']="La linea_pedido no se a podido eliminar ";
                }
            }
        }
        return $error;
    }
    public static function todosLasLineas_pedido(){
        $linea_pedido=Lineas_pedido::fromArray([]);
        return $linea_pedido->getAll();
    }

}