<?php
class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $imagen;
    private $db;

    public function __construct(){
        $this->db = new Base();
    }

    public function getID(){
        return $this->id;
    }
    public function getCategoria_id(){
        return $this->categoria_id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getDescripcion(){
        return $this->descripcion;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getStock(){
        return $this->stock;
    }
    public function getOferta(){
        return $this->oferta;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getImagen(){
        return $this->imagen;
    }
    public function setID($id){
        $this->id = $id;
    }
    public function setCategoria_id($categoria_id){
        $this->categoria_id = $categoria_id;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function setPrecio($precio){
        $this->precio = $precio;
    }
    public function setStock($stock){
        $this->stock = $stock;
    }
    public function setOferta($oferta){
        $this->oferta = $oferta;
    }
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function getAll(){
        $this->db->query('SELECT * FROM productos');
        $results = $this->db->registros();

        return $results;
    }
    public function getAllCategory(){
        $this->db->query('SELECT p.*, c.nombre AS cat_nom FROM productos p INNER JOIN categorias c
                        ON p.categoria_id = c.id WHERE categoria_id = :cat_id');
        $this->db->bind('cat_id', $this->getCategoria_id());
        $results = $this->db->registros();
        $rows = $this->db->rowCount();

        $array = array('registros' => $results, 'rows' => $rows);
        return $array;
    }
    public function getOne(){
        $this->db->query('SELECT * FROM productos WHERE id = :id');
        $this->db->bind('id',$this->getID());
        $result = $this->db->registro();

        return $result;
    }
    public function getRand($limite){
        $this->db->query('SELECT *  FROM productos ORDER BY RAND() LIMIT :lim');
        $this->db->bind('lim',$limite);
        $results = $this->db->registros();
        return $results;
    }
    public function Save(){
        $this->db->query('INSERT INTO productos(categoria_id,nombre,descripcion,precio,stock,oferta,
        fecha,imagen) values(:cat,:nomcat,:descr,:pre,:stock,null,CURDATE(),:img)');
        $this->db->bind('cat',$this->getCategoria_id());
        $this->db->bind('nomcat',$this->getNombre());
        $this->db->bind('descr',$this->getDescripcion());
        $this->db->bind('pre',$this->getPrecio());
        $this->db->bind('stock',$this->getStock());
        $this->db->bind('img',$this->getImagen());

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function Edit(){
        if ($this->getImagen() != null) {
            $this->db->query('UPDATE productos SET categoria_id=:cat,nombre=:nomcat,descripcion=:descr,precio=:pre,stock=:stock,
        imagen = :img WHERE id = :id');
        $this->db->bind('img',$this->getImagen());
        } else {
            $this->db->query('UPDATE productos SET categoria_id=:cat,nombre=:nomcat,descripcion=:descr,precio=:pre,stock=:stock
            WHERE id = :id');
        }
        $this->db->bind('id',$this->getID());
        $this->db->bind('cat',$this->getCategoria_id());
        $this->db->bind('nomcat',$this->getNombre());
        $this->db->bind('descr',$this->getDescripcion());
        $this->db->bind('pre',$this->getPrecio());
        $this->db->bind('stock',$this->getStock());

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function Delete(){
        $this->db->query('DELETE FROM productos WHERE id=:id');
        $this->db->bind('id',$this->getID());
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    
}