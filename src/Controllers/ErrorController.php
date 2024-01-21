<?php

namespace Controllers;

use lib\Pages;

class ErrorController{
    private Pages $pages;

    public function __construct(){
        $this->pages= new Pages();
    }

    public function show_error404(){
        $this->pages->render('error/error',['titulo'=>'Pagina no encontrada']);
    }
}