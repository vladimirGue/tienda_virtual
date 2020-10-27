<?php
ob_start();
session_start();
header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate');
include_once 'app/config/Parameters.php';
include_once 'Autoload.php';
include_once 'app/helpers/Utils.php';
include_once 'app/config/Base.php';
include ruta_app.'/views/layouts/Header.php';
//require_once 'app/views/layouts/Slide.php';

function show_error(){
    $error = new ErrorController();
    $error->Index();
}

if (isset($_GET['controller'])) {
    $nom_controlador = $_GET['controller'].'Controller';
}elseif (!isset($_GET['controller'])&&!isset($_GET['action'])) {
    $nom_controlador = controller_default;
}else{
    show_error();
    exit();
}

if (class_exists($nom_controlador)) {
    $controlador = new $nom_controlador();

    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    }elseif (!isset($_GET['controller'])&&!isset($_GET['action'])) {
        $action_default = action_default;
        $controlador->$action_default();
    } else {
        show_error();
    }
    
} else {
    show_error();
}

include ruta_app.'/views/layouts/footer.php';
?>