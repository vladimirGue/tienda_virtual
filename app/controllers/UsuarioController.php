<?php
include_once 'app/models/Usuario.php';
class UsuarioController{

    public function Index(){
        //echo 'Pagina de usuario';
    }
    public function Registro(){
        require 'app/views/usuario/Registro.php';
    }
    public function Save(){
        if (isset($_POST)) {
            $nom = isset($_POST['Nombre']) ? $_POST['Nombre']:false;
            $ape = isset($_POST['Apellidos']) ? $_POST['Apellidos']:false;
            $email = isset($_POST['Email']) ? $_POST['Email']:false;
            $pass = isset($_POST['Contraseña']) ? $_POST['Contraseña']:false;
            if ($nom && $ape && $email && $pass) {
                $usuario = new Usuario();
                $usuario->setNombre($nom);
                $usuario->setApellidos($ape);
                $usuario->setEmail($email);
                $usuario->setPassword($pass);
                
                $save = $usuario->Save();
                if ($save) {
                    $_SESSION['Register'] = 'completed';
                } else {
                    $_SESSION['Register'] = 'failed';
                }
            } else {
                $_SESSION['Register'] = 'failed';
            }
            
        }else{
            $_SESSION['Register'] = 'failed';
        }
        header("Location:".base_url.'Usuario/Registro');
    }
    public function Login(){
        if (isset($_POST)) {
            $login = new Usuario();
            $login->setPassword($_POST['contraseñaSesion']);
            $login->setEmail($_POST['emailSesion']);
            $indentidad = $login->Login();
            if ($indentidad && is_object($indentidad)) {
                $_SESSION['identidad'] = $indentidad;
                if ($indentidad->rol === 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'identificación fallida';
            }
            
        }
        header('Location: '.base_url);
    }
    public function Logout(){
        if (isset($_SESSION['identidad'])) {
            unset($_SESSION['identidad']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        unset($_SESSION['carrito']);
        header('Location: '.base_url);
    }
}
?>