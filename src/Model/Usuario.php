<?php

namespace Model;

use PDO;
use PDOException;
use lib\BaseDatos;

class Usuario{
    private string|null $id;
    private string $nombre;
    private string $apellidos;
    private string $email;
    private string $password;
    private string $rol;

    private BaseDatos $db;
    public function __construct(string|null $id,string $nombre,string $apellidos,string $email,string $password,string $rol){
        $this->db=new BaseDatos();
        $this->id=$id;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->email=$email;
        $this->password=$password;
        $this->rol=$rol;
    }


    public function save(){
        if ($this->getId()){
            return $this->update();
        }else{
            return $this->create();
        }
    }

    public static function fromArray(array $data): Usuario {
        return new Usuario(
            $data['id']?? null,
            $data['nombre']?? '',
            $data['apellidos']?? '',
            $data['email']?? '',
            $data['password']?? '',
            $data['rol']?? '',
        );
    }

    public function desconecta(){
        $this->db->cierraConexion();
    }
    public function create(){
        $id=null;
        $nombre=$this->getNombre();
        $apellidos=$this->getApellidos();
        $email=$this->getEmail();
        $password=$this->getPassword();
        $rol='user';
        try {
            $hola=$this->db->prepara("insert into usuarios (id,nombre,apellidos,email,password,rol)values(:id,:nombre,:apellidos,:email,:password,:rol) ");
            $hola->bindValue(":id",$id);
            $hola->bindValue(":nombre",$nombre);
            $hola->bindValue(":apellidos",$apellidos);
            $hola->bindValue(":email",$email);
            $hola->bindValue(":password",$password);
            $hola->bindValue(":rol",$rol);
            $hola->execute();
            $abuelo=true;
        }catch (\PDOException $e){
            $abuelo=false;
        }
        return $abuelo;
    }

    public function obtenerPassword($email){
        $select= $this->db->prepara("SELECT * FROM usuarios WHERE email = :email");
        $select->bindValue(':email', $email);
        $select->execute();
        return $resultados = $select->fetch(PDO::FETCH_ASSOC);
    }

    public function login(){
        $result=false;
        $email = $this->getEmail();
        $password=$this->getPassword();
        $usuario=$this->buscaMail($email);
        if ($usuario !==false){
            $verify=password_verify($password,$usuario->password);
            if ($verify){
                return $usuario;
            }
        }
    }
    public function buscaMail($email){
        $cons=$this->db->prepara("SELECT * FROM usuarios WHERE email=:email");
        $cons->bindValue(':email',$email,PDO::PARAM_STR);
        try{
            $cons->execute();
            if ($cons && $cons->rowCount()==1){
                $result=$cons->fetch(PDO::FETCH_OBJ);
            }
        }catch (PDOException $err){
            $result=false;
        }
        return $result;
    }

    /* GETTERS Y SETTERS */
    public function getId(): string|null
    {
        return $this->id;
    }
    public function setId(string $id): void
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
    public function getApellidos(): string
    {
        return $this->apellidos;
    }
    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function getRol(): string
    {
        return $this->rol;
    }
    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }


}