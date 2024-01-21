<?php

namespace Model;



use lib\BaseDatos;

class Pedido{
    private int|null $id;
    private int $usuario_id;
    private string $provincia;
    private string $localidad;
    private string $direccion;
    private int $coste;
    private string $estado;
    private string $fecha;
    private string $hora;
    private BaseDatos $db;
    /**
     * @param int|null $id
     * @param int $usuario_id
     * @param string $provincia
     * @param string $localidad
     * @param string $direccion
     * @param int $coste
     * @param string $estado
     * @param string $fecha
     * @param string $time
     */
    public function __construct(int|null $id, int $usuario_id, string $provincia, string $localidad, string $direccion, int $coste, string $estado, string $fecha, string $hora){
        $this->db= new BaseDatos();
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->provincia = $provincia;
        $this->localidad = $localidad;
        $this->direccion = $direccion;
        $this->coste = $coste;
        $this->estado = $estado;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }
    public static function fromArray(array $data): Pedido {
        return new Pedido(
            $data['id']?? null,
            $data['usuario_id']?? 0,
            $data['provincia']?? '',
            $data['localidad']?? '',
            $data['direccion']?? '',
            $data['coste']?? 0,
            $data['estado']?? 'En almacen',
            $data['fecha']?? '',
            $data['hora']?? '',
        );
    }
    public function create(){
        $usuario_id=$this->getUsuarioId();
        $provincia=$this->getProvincia();
        $localidad=$this->getLocalidad();
        $direccion=$this->getDireccion();
        $coste=$this->getCoste();
        $estado=$this->getEstado();
        $fecha=$this->getFecha();
        $hora= $this->getHora();

        try {
            $hola=$this->db->prepara("insert into pedidos values(null,:usuario_id,:provincia,:localidad,:direccion,:coste,:estado,:fecha,:hora) ");
            $hola->bindValue(":usuario_id",$usuario_id);
            $hola->bindValue(":provincia",$provincia);
            $hola->bindValue(":localidad",$localidad);
            $hola->bindValue(":direccion",$direccion);
            $hola->bindValue(":coste",$coste);
            $hola->bindValue(":estado",$estado);
            $hola->bindValue(":fecha",$fecha);
            $hola->bindValue(":hora",$hora);
            $hola->execute();
            $resultado=true;
        }catch (\PDOException $e){
            $resultado=false;
        }
        return $resultado;
    }
    public function createLineasPedido(){
        $usuario_id=$this->getUsuarioId();
        $provincia=$this->getProvincia();
        $localidad=$this->getLocalidad();
        $direccion=$this->getDireccion();
        $coste=$this->getCoste();
        $estado=$this->getEstado();
        $fecha=$this->getFecha();
        $hora= $this->getHora();

        try {
            $hola=$this->db->prepara("insert into pedidos values(null,:usuario_id,:provincia,:localidad,:direccion,:coste,:estado,:fecha,:hora) ");
            $hola->bindValue(":usuario_id",$usuario_id);
            $hola->bindValue(":provincia",$provincia);
            $hola->bindValue(":localidad",$localidad);
            $hola->bindValue(":direccion",$direccion);
            $hola->bindValue(":coste",$coste);
            $hola->bindValue(":estado",$estado);
            $hola->bindValue(":fecha",$fecha);
            $hola->bindValue(":hora",$hora);
            $hola->execute();
            $resultado=true;
        }catch (\PDOException $e){
            $resultado=false;
        }
        return $resultado;
    }
    public function update(){
        $id=$this->getId();
        $categoria_id=$this->getCategoriaId();
        $nombre=$this->getNombre();
        $descripcion=$this->getDescripcion();
        $precio=$this->getPrecio();
        $stock=$this->getStock();
        $oferta=$this->getOferta();
        $fecha=$this->getFecha();
        $imagen=$this->getImagen();
        $enVenta= $this->isEnVenta();
        try {
            $hola=$this->db->prepara("update productos set categoria_id=:categoria_id,
                     nombre=:nombre,descripcion=:descripcion,precio=:precio,stock=:stock,oferta=:oferta
                     ,fecha=:fecha,imagen=:imagen, enVenta=:enVenta 
                  where id=:id ");
            $hola->bindValue(":id",$id);
            $hola->bindValue(":categoria_id",$categoria_id);
            $hola->bindValue(":nombre",$nombre);
            $hola->bindValue(":descripcion",$descripcion);
            $hola->bindValue(":precio",$precio);
            $hola->bindValue(":stock",$stock);
            $hola->bindValue(":oferta",$oferta);
            $hola->bindValue(":fecha",$fecha);
            $hola->bindValue(":imagen",$imagen);
            $hola->bindValue(":enVenta",$enVenta);
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
            $hola=$this->db->prepara("DELETE FROM pedidos WHERE id =:id");
            $hola->bindValue(":id",$id);
            $hola->execute();
            $resultado=true;
        }catch (\PDOException $e){
            $resultado=false;
        }
        return $resultado;
    }
    public function getAll(){
        $this->db->consulta("select * from pedidos");
        $pedidos=$this->db->extraer_todos();
        $this->db->cierraConexion();
        return $pedidos;
    }

    /* GETTERS Y SETTERS */
    public function getId(): ?int{
        return $this->id;
    }
    public function setId(?int $id): void{
        $this->id = $id;
    }
    public function getUsuarioId(): int{
        return $this->usuario_id;
    }
    public function setUsuarioId(int $usuario_id): void{
        $this->usuario_id = $usuario_id;
    }
    public function getProvincia(): string{
        return $this->provincia;
    }
    public function setProvincia(string $provincia): void{
        $this->provincia = $provincia;
    }
    public function getLocalidad(): string{
        return $this->localidad;
    }
    public function setLocalidad(string $localidad): void{
        $this->localidad = $localidad;
    }
    public function getDireccion(): string{
        return $this->direccion;
    }
    public function setDireccion(string $direccion): void{
        $this->direccion = $direccion;
    }
    public function getCoste(): int{
        return $this->coste;
    }
    public function setCoste(int $coste): void{
        $this->coste = $coste;
    }
    public function getEstado(): string{
        return $this->estado;
    }
    public function setEstado(string $estado): void{
        $this->estado = $estado;
    }
    public function getFecha(): string{
        return $this->fecha;
    }
    public function setFecha(string $fecha): void{
        $this->fecha = $fecha;
    }
    public function getHora(): string{
        return $this->hora;
    }
    public function setHora(string $hora): void{
        $this->hora = $hora;
    }



}