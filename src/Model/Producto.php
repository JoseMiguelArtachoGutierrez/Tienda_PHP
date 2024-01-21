<?php

namespace Model;

use lib\BaseDatos;

class Producto{
    private BaseDatos $db;
    private string|null $id;
    private string $categoria_id;
    private string $nombre;
    private string $descripcion;
    private string $precio;
    private string $stock;
    private string $oferta;
    private string $fecha;
    private string $imagen;
    private bool $enVenta;

    public static function fromArray(array $data): Producto {
        return new Producto(
            $data['id']?? null,
            $data['categoria_id']?? '',
            $data['nombre']?? '',
            $data['descripcion']?? '',
            $data['precio']?? '',
            $data['stock']?? '',
            $data['oferta']?? '',
            $data['fecha']?? '',
            $data['imagen']?? '',
            $data['enVenta']?? true
        );
    }

    /**
     * @param BaseDatos $db
     * @param string|null $id
     * @param string $categoria_id
     * @param string $nombre
     * @param string $descripcion
     * @param string $precio
     * @param string $stock
     * @param string $oferta
     * @param string $fecha
     * @param string $imagen
     * @param boolean $enVenta
     */
    public function __construct(string|null $id, string $categoria_id, string $nombre, string $descripcion, string $precio, string $stock, string $oferta, string $fecha, string $imagen, bool $enVenta)
    {
        $this->db = new BaseDatos();
        $this->id = $id;
        $this->categoria_id = $categoria_id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->oferta = $oferta;
        $this->fecha = $fecha;
        $this->imagen = $imagen;
        $this->enVenta = $enVenta;
    }
    public function create(){
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
            $hola=$this->db->prepara("insert into productos values(null,:categoria_id,:nombre,:descripcion,:precio,:stock,:oferta,:fecha,:imagen,:enVenta) ");
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
    public function getAll(){
        $this->db->consulta("select * from productos");
        $productos=$this->db->extraer_todos();
        $this->db->cierraConexion();
        return $productos;
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
    public function getCategoriaId(): string
    {
        return $this->categoria_id;
    }
    public function setCategoriaId(string $categoria_id): void
    {
        $this->categoria_id = $categoria_id;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }
    public function getPrecio(): string
    {
        return $this->precio;
    }
    public function setPrecio(string $precio): void
    {
        $this->precio = $precio;
    }
    public function getStock(): string
    {
        return $this->stock;
    }
    public function setStock(string $stock): void
    {
        $this->stock = $stock;
    }
    public function getOferta(): string
    {
        return $this->oferta;
    }
    public function setOferta(string $oferta): void
    {
        $this->oferta = $oferta;
    }
    public function getFecha(): string
    {
        return $this->fecha;
    }
    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }
    public function getImagen(): string
    {
        return $this->imagen;
    }
    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    public function isEnVenta(): bool
    {
        return $this->enVenta;
    }

    public function setEnVenta(bool $enVenta): void
    {
        $this->enVenta = $enVenta;
    }


}