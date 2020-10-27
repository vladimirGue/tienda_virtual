<?php
include_once 'app/models/Pedido.php';
class PedidoController{

    public function Hacer(){
        
        include_once 'app/views/pedido/Hacer.php';
    }
    public function Add(){
        if (isset($_SESSION['identidad'])) {
            $usuario_id = $_SESSION['identidad']->id;
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];
            //recibir variables por post
            $provincia = isset($_POST['prov']) ? $_POST['prov']:false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad']:false;
            $dire = isset($_POST['dire']) ? $_POST['dire']:false;

            if ($provincia && $localidad && $dire) {
               //guardar datos en la base de datos
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($dire);
                $pedido->setCoste($coste);

                $save = $pedido->Save();

                //guardar linea de pedido
                $save_linea =$pedido->save_Linea();

                if ($save && $save_linea) {
                    $_SESSION['pedido'] = 'confirmado';
                } else {
                    $_SESSION['pedido'] = 'failed';
                }
                
            }else{
                $_SESSION['pedido'] = 'failed';
            }
            header('Location: '.base_url.'Pedido/Confirmado');

        }else{
            //Rederigir al index
            header('Location: '.base_url);
        }
    }
    public function Confirmado(){
        if (isset($_SESSION['identidad'])) {
            $identidad = $_SESSION['identidad'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identidad->id);
            $ped = $pedido->getOneByUser();

            $pedido_prod = new Pedido();
            $productos = $pedido_prod->getProductoByPedido($ped->id);
        }
        include_once 'app/views/pedido/Confirmado.php';
    }
    public function misPedidos(){
        Utils::isIdentity();
        $usuario_id = $_SESSION['identidad']->id;

        //obtener todos los productos por usuario
        $pedido = new Pedido();
        $pedido->setUsuario_id($usuario_id);
        $peds = $pedido->getAllByUser();
        include_once 'app/views/pedido/mis_Pedidos.php';
    }
    public function Detalles(){
        Utils::isIdentity();
        if (isset($_POST['numPedido']) || isset($_GET['numPedido'])) {
            if (isset($_SESSION['admin'])) {
                $id = isset($_GET['numPedido']) ? $_GET['numPedido']:$_POST['numPedido'];
            }elseif (Utils::isIdentity()) {
                $id = $_POST['numPedido'];
            }
            //$id = $_POST['numPedido'];
            //sacar datos del pedido
            $pedido = new Pedido();
            $pedido->setID($id);
            $ped = $pedido->getOne();

            //sacar los productos
            $pedido_prod = new Pedido();
            $productos = $pedido_prod->getProductoByPedido($id);

            include_once 'app/views/pedido/Detalle.php';
        } else {
            header('Location: '.base_url.'Pedido/misPedidos');
        }
        
    }
    public function Gestion(){
        Utils::isAdmin();
        $gestion = true; 

        $pedido = new Pedido();
        $peds = $pedido->getAll();
        include_once 'app/views/pedido/mis_Pedidos.php';
    }
    public function Estado(){
        Utils::isAdmin();
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            //recoger datos del formulario
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];

            //actualizar el pedido
            $pedido = new Pedido();
            $pedido->setID($id);
            $pedido->setEstado($estado);
            $upd_ped = $pedido->updateOne();

            header('Location: '.base_url.'Pedido/Detalles&numPedido='.$id);
        } else {
            header('Location: '.base_url);
        }
        
    }
}
?>