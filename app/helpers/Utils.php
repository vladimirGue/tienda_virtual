<?php
class Utils{

    public static function deleteSession($name){
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
        
    }
    public static function isAdmin(){
        if (!isset($_SESSION['admin'])) {
            header('Location:'.base_url);
        } else {
            return true;
        }
        
    }
    public static function isIdentity(){
        if (!isset($_SESSION['identidad'])) {
            header('Location:'.base_url);
        } else {
            return true;
        }
        
    }
    public static function showCategoria(){
        include_once 'app/models/Categoria.php';
        $categoria = new Categoria();
        $result = $categoria->getAll();
        return $result;
    }
    public static function statsCarrito(){
        $stats = array(
            'count'=>0,
            'total'=>0
        );
        if (isset($_SESSION['carrito'])) {
            $stats['count'] = count($_SESSION['carrito']);

            foreach ($_SESSION['carrito'] as $prod) {
                $stats['total'] += $prod['precio'] * $prod['unidades'];
            }
        }
        return $stats;
    }
    public static function showEstado($estado){
        $value = 'pendiente';
        if ($estado=='confirmado') {
            $value = 'pendiente';
        }elseif ($estado=='En preparacion') {
            $value = 'En preparacion';
        }elseif ($estado=='Preparado para enviar') {
            $value = 'Preparado para enviar';
        }elseif ($estado == 'enviado') {
            $value = 'enviado';
        }
        return $value;
    }
}
?>