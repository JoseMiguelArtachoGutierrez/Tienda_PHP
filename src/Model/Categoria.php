<?php

namespace Model;

use lib\BaseDatos;

class Categoria{
    private string|null $id;
    private string $nombre;
    private bool $descatalogado;
    private BaseDatos $db;

    /**
     * @param string|null $id
     * @param string $nombre
     * @param bool $descatalogado
     */
    public function __construct(string|null $id, string $nombre, bool $descatalogado){
        $this->db= new BaseDatos();
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descatalogado = $descatalogado;
    }
    public static function fromArray(array $data): Categoria {
        return new Categoria(
            $data['id']?? null,
            $data['nombre']?? '',
            $data['descatalogado']?? false
        );
    }
    public function create(){
        $nombre=$this->getNombre();
        try {
            $hola=$this->db->prepara("insert into categorias values(null,:nombre,false) ");
            $hola->bindValue(":nombre",$nombre);
            $hola->execute();
            $resultado=true;
        }catch (\PDOException $e){
            $resultado=false;
        }
        return $resultado;
    }
    public function update(){
        $id=$this->getId();
        $nombre=$this->getNombre();
        $descatalogado=$this->isDescatalogado();
        try{
            $ins=$this->db->prepara("update categorias set nombre=:nombre, descatalogado=:descatalogado where id=:id");
            $ins->bindValue(':id',$id);
            $ins->bindValue(':nombre',$nombre);
            $ins->bindValue(':descatalogado',$descatalogado);
            $ins->execute();
            $result=true;
        }catch (PDOException $err){
            $result=false;
        }
        return $result;
    }

    public static function getAll(){
        $categoria=new Categoria("","","");
        $categoria->db->consulta("select * from categorias order by id desc ;");
        $categorias=$categoria->db->extraer_todos();
        $categoria->db->cierraConexion();
        return $categorias;
    }

    /* GETTERS Y SETTERS */

    public function getId(): ?string
    {
        return $this->id;
    }
    public function setId(?string $id): void
    {
        $this->id = $id;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function isDescatalogado(): bool
    {
        return $this->descatalogado;
    }

    public function setDescatalogado(bool $descatalogado): void
    {
        $this->descatalogado = $descatalogado;
    }


}