<?php

namespace Controllers;

use lib\Pages;
use Model\Usuario;
use utils\utils;

class UsuarioController{
    private Pages $pages;
    public function __construct(){
        $this->pages=new Pages();
    }

    public function indetifica(){
        $this->pages->render("usuario/login");
    }
    public function login(){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            if ($_POST['data']){
                $login=$_POST['data'];

                $usuario= Usuario::fromArray($login);
                $identity=$usuario->login();

                if($identity && is_object($identity)){
                    $_SESSION['identity']=$identity;
                    if ($identity->rol == 'admin'){
                        $_SESSION['admin']=true;
                    }
                }
            }
        }else{
            $_SESSION['error_login']='identificacion fallida';
        }
        $usuario->desconecta();

        header("Location: " . BASE_URL);
    }
    public function registro(){
        if ($_SERVER['REQUEST_METHOD']==='POST'){
            if ($_POST['data']){
                $registro=$_POST['data'];
                $registro['password']=password_hash($registro['password'],PASSWORD_BCRYPT);

                $usuario=Usuario::fromArray($registro);
                $save=$usuario->save();
                if ($save){
                    $_SESSION["register"]="complete";
                }else{
                    $_SESSION["register"]="failed";
                }
            }else{
                $_SESSION["register"]="failed";
            }
        }
        $this->pages->render("usuario/registro");
    }

    public function logout(){
        utils::deleteSession('identity');
        header("Location: " . BASE_URL);
    }

}