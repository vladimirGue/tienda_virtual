<?php
class Pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct(){
        $this->db = new Base();
    }

    public function getID(){
        return $this->id;
    }
    public function getUsuario_id(){
        return $this->usuario_id;
    }
    public function getProvincia(){
        return $this->provincia;
    }
    public function getLocalidad(){
        return $this->localidad;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getCoste(){
        return $this->coste;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getHora(){
        return $this->hora;
    }
    public function setID($id){
        $this->id = $id;
    }
    public function setUsuario_id($usuario_id){
        $this->usuario_id = $usuario_id;
    }
    public function setProvincia($provincia){
        $this->provincia = $provincia;
    }
    public function setLocalidad($localidad){
        $this->localidad = $localidad;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function setCoste($coste){
        $this->coste = $coste;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setHora($hora){
        $this->hora = $hora;
    }

    public function getAll(){
        $this->db->query('SELECT * FROM pedidos');
        $results = $this->db->registros();

        return $results;
    }
    public function getOne(){
        $this->db->query('SELECT * FROM pedidos WHERE id = :id');
        $this->db->bind('id',$this->getID());
        $result = $this->db->registro();

        return $result;
    }
    public function getOneByUser(){
        $this->db->query('SELECT p.id,p.coste FROM pedidos p
                        WHERE p.usuario_id = :usuario_id ORDER BY p.id DESC LIMIT 1');
        $this->db->bind('usuario_id',$this->getUsuario_id());
        $result = $this->db->registro();

        return $result;
    }
    public function getAllByUser(){
        $this->db->query('SELECT * FROM pedidos 
                        WHERE usuario_id = :usuario_id ORDER BY id DESC');
        $this->db->bind('usuario_id',$this->getUsuario_id());
        $result = $this->db->registros();

        return $result;
    }
    public function getProductoByPedido($id){
        $this->db->query('SELECT pr.*, lp.unidades FROM productos pr 
                        INNER JOIN lineas_pedidos lp ON pr.id=lp.producto_id 
                        WHERE lp.pedido_id=:pedido_id');
        $this->db->bind('pedido_id',$id);
        $results_pr = $this->db->registros();

        return $results_pr;
    }
    public function Save(){
        $this->db->query("INSERT INTO pedidos(usuario_id,provincia,localidad,direccion,coste,estado,
        fecha,hora) values(:user,:prov,:localidad,:dir,:coste,'confirmado',CURDATE(),CURTIME())");
        
        $this->db->bind('user',$this->getUsuario_id());
        $this->db->bind('prov',$this->getProvincia());
        $this->db->bind('localidad',$this->getLocalidad());
        $this->db->bind('dir',$this->getDireccion());
        $this->db->bind('coste',$this->getCoste());

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function save_Linea(){
        $this->db->query("SELECT LAST_INSERT_ID() AS 'pedido';");
        $pedido_id =$this->db->registro()->pedido;

        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];
            $this->db->query('INSERT INTO lineas_pedidos(pedido_id,producto_id,unidades)
            VALUES(:pedido_id,:producto_id,:unidades)');
            $this->db->bind('pedido_id',$pedido_id);
            $this->db->bind('producto_id',$producto->id);
            $this->db->bind('unidades',$elemento['unidades']);
            $save =$this->db->execute();
        }
        if ($save) {
            return true;
        } else {
            return false;
        }
        

    }
    public function updateOne(){
        $this->db->query('UPDATE pedidos SET estado=:estado WHERE id=:id');
        $this->db->bind('estado',$this->getEstado());
        $this->db->bind('id',$this->getID());

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
}