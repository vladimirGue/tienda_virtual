<?php
include_once 'app/models/Producto.php';
class CarritoController{

    public function Index(){
        if (isset($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito'];
        }
        include_once 'app/views/carrito/Index.php';
    }

    public function Add(){
        if (isset($_POST['idCarr'])) {
            $prodId = $_POST['idCarr'];
        } else {
            header('Location:'.base_url);
        }
        
        if (isset($_SESSION['carrito'])) {
            $cont=0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['prodId'] == $prodId) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $cont++;
                }
            }
        }
        if (!isset($cont) || $cont == 0) {
            //Conseguir productos
            $prod = new Producto();
            $prod->setID($prodId);
            $producto = $prod->getOne();

            //añadir al carrito
            if (is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    'prodId' => $producto->id,
                    'precio' => $producto->precio,
                    'unidades' => 1,
                    'producto' => $producto);
            }
        }
        header('Location:'.base_url.'Carrito/Index');
    }
    public function Remove(){
        $count_Indices = count($_SESSION['carrito']);
        if ($count_Indices == 1) {
            //cuando solo halla un producto en carrito borramos todo
            unset($_SESSION['carrito']);
        } else {
            if (isset($_POST)) {
                $indice = $_POST['producto_id'];

                //cuando halla mas de un producto en carrito borramos un producto
                unset($_SESSION['carrito'][$indice]);
            }
        }
        header('Location:'.base_url.'Carrito/Index');
    }
    public function Delete(){
        unset($_SESSION['carrito']);
        header('Location:'.base_url.'Carrito/Index');
    }
    //sumar y restar productos al carrito directamente
    public function Up(){
        if (isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito'][$indice]['unidades']++;
        }
        header('Location:'.base_url.'Carrito/Index');
    }
    public function Down(){
        if (isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito'][$indice]['unidades']--;
            if ($_SESSION['carrito'][$indice]['unidades'] == 0) {
                unset($_SESSION['carrito'][$indice]);
            }

        }
        header('Location:'.base_url.'Carrito/Index');
    }
}