<?php

namespace Model;

use lib\BaseDatos;

class Lineas_pedido{
    private string|null $id;
    private int $pedido_id;
    private int $producto_id;
    private int $unidades;
    private BaseDatos $db;

    /**
     * @param string|null $id
     * @param int $pedido_id
     * @param int $producto_id
     * @param int $unidades
     */
    public function __construct(?string $id, int $pedido_id, int $producto_id, int $unidades){
        $this->db= new BaseDatos();
        $this->id = $id;
        $this->pedido_id = $pedido_id;
        $this->producto_id = $producto_id;
        $this->unidades = $unidades;
    }

    public static function fromArray(array $data): Lineas_pedido {
        return new Lineas_pedido(
            $data['id']?? null,
            $data['pedido_id']?? 0,
            $data['producto_id']?? 0,
            $data['unidades']?? 0
        );
    }
    public function create(){
        $id=null;
        $pedido_id=$this->getPedidoId();
        $producto_id=$this->getProductoId();
        $unidades=$this->getUnidades();

        try {
            $hola=$this->db->prepara("insert into lineas_pedidos values(:id,:pedido_id,:producto_id,:unidades) ");
            $hola->bindValue(":id",$id);
            $hola->bindValue(":pedido_id",$pedido_id);
            $hola->bindValue(":producto_id",$producto_id);
            $hola->bindValue(":unidades",$unidades);
            $hola->execute();
            $resultado=true;
        }catch (\PDOException $e){
            $resultado=false;
        }
        return $resultado;
    }
    public function delete(){
        $id= $this->getId();
        try {

            $hola=$this->db->prepara("DELETE FROM lineas_pedidos WHERE id =:id");
            $hola->bindValue(":id",$id);
            $hola->execute();
            $resultado=true;
        }catch (\PDOException $e){
            $resultado=false;
        }
        return $resultado;
    }
    public function getAll(){
        $this->db->consulta("select * from lineas_pedidos");
        $lineas_pedido=$this->db->extraer_todos();
        $this->db->cierraConexion();
        return $lineas_pedido;
    }
    /* GETTERS Y SETTERS */
    public function getId(): ?string{
        return $this->id;
    }
    public function setId(?string $id): void{
        $this->id = $id;
    }
    public function getPedidoId(): int{
        return $this->pedido_id;
    }
    public function setPedidoId(int $pedido_id): void{
        $this->pedido_id = $pedido_id;
    }
    public function getProductoId(): int{
        return $this->producto_id;
    }
    public function setProductoId(int $producto_id): void{
        $this->producto_id = $producto_id;
    }
    public function getUnidades(): int{
        return $this->unidades;
    }
    public function setUnidades(int $unidades): void{
        $this->unidades = $unidades;
    }




}