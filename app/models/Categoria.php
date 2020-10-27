<?php

class Categoria{
    private $id;
    private $nombre;
    private $db;

    public function __construct(){
        $this->db = new Base();
    }
    function getID(){
        return $this->id;
    }
    function getNombre(){
        return $this->nombre;
    }
    function setID($id){
        $this->id = $id;
    }
    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getAll(){
        $this->db->query('SELECT * FROM categorias;');
        $result = $this->db->registros();
        return $result;
        
    }
    public function getOne(){
        $this->db->query('SELECT * FROM categorias WHERE id = :id');
        $this->db->bind('id', $this->getID());
        $result = $this->db->registro();
        return $result;
    }
    public function Save(){
        $this->db->query('INSERT INTO categorias(nombre) values(:nomcat)');
        $this->db->bind('nomcat',$this->getNombre());

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
}