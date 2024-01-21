<?php

namespace services;

use repositorios\ContactoRepository;

class ContactoService{
    private ContactoRepository $repository;
    function __construct(){
        $this->repository= new ContactoRepository();
    }
    public function findAll():?array{
        return $this->repository->findAll();
    }
    public function save(array $contacto){
        return $this->repository->save($contacto);
    }
    public function read(int $id){
        return $this->repository->read($id);
    }
    public function delete(int $id):void{
        $this->repository->delete($id);
    }
    public function filasAfectadas():int{
        return $this->repository->filasAfectadas();
    }

}