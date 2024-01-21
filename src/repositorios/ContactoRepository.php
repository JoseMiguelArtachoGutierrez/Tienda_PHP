<?php

namespace repositorios;

use lib\BaseDeDatos;
use Model\Contacto;

class ContactoRepository
{
    private BaseDeDatos $conexion;

    function __construct(){
        $this->conexion=new BaseDeDatos();
    }
    public function findAll():?array{
        $this->conexion->consulta("select * from contactos");
        return $this->extractAll();
    }
    public function extractAll():?array{
        $contactos=[];
        $contactosData=$this->conexion->extraer_todos();
        foreach ($contactosData as $contactoData){
            $contactos[]=Contacto::fromArray($contactoData);
        }
        return $contactos;
    }
    private function extraer_registro():? Contacto{
        return ($Contacto=$this->conexion->extraer_registro())?Contacto::fromArray($Contacto):null;
    }
    public function  read(int $id):?Contacto{
        $consulta="SELECT id,nombre,apellidos FROM contactos WHERE id= :id";
        $stmt=$this->conexion->prepara($consulta);
        $stmt->bindValue(':id',$id,\PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $stmt=null;
         return  $this->extraer_registro();
    }
    public function filasAfectadas(): int{
        return $this->conexion->filasAfectadas();
    }
    public function save(array $contacto):void{

        /*
         * Este metodo comprueba si ese contacto ya existe en la base de datos
         * si existe ejecuta un update($contacto)
         * Si no existe lo inserta en la base de datos con create($contacto)
         * Recuerda que los campos telefono y correo con Unique
         * Por lo tanto, si existe el telefono o el correo solo podemos modificar el resto de datos
         */
    }
    public function create(array $datos):string|int{
        try {
            $stmt=$this->conexion->prepara("insert into contactos(id,nombre,apellidos,correo,direccion,telefono,fecha_nacimiento) values (:id,:nombre,:apellidos,:correo,:direccion,:telefono,:fecha_nacimiento)");

            $stmt->bindValue(':id',null);
            $stmt->bindValue(':nombre',$datos['nombre'],null);
            $stmt->bindValue(':apellidos',$datos['apellidos'],\PDO::PARAM_STR);
            $stmt->bindValue(':correo',$datos['correo'],\PDO::PARAM_STR);
            $stmt->bindValue(':direccion',$datos['direccion'],\PDO::PARAM_STR);
            $stmt->bindValue(':telefono',$datos['telefono'],\PDO::PARAM_STR);
            $stmt->bindValue(':fecha_nacimiento',$datos['fecha_nacimiento'],\PDO::PARAM_STR);
            $stmt->execute();
            $result=$stmt->rowCount();
            // falta mas cosas
        }catch (\PDOException $err){
            echo $err;
        }
    }
}