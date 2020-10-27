<?php
class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct(){
        $this->db = new Base();
    }

    public function getID(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellidos(){
        return $this->apellidos;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getRol(){
        return $this->rol;
    }
    public function getImagen(){
        return $this->imagen;
    }
    //aqui todos los setter
    public function setID($id){
        $this->id = $id;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }
    public function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setRol($rol){
        $this->rol = $rol;
    }
    public function setImagen($imagen){
        $this->imagen = $imagen;
    }
    public function Save(){
        $this->db->query('INSERT INTO usuarios(nombre,apellidos,email,password,rol,imagen) VALUES(:nom,:apes,:email,SHA2(:pass,256),null,null)');
        $this->db->bind(':nom',$this->getNombre());
        $this->db->bind(':apes',$this->getApellidos());
        $this->db->bind(':email',$this->getEmail());
        $this->db->bind(':pass',$this->getPassword());
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    public function Login(){
        $this->db->query('SELECT * FROM usuarios where email=:email and password=SHA2(:pass,256)');
        $this->db->bind(':pass', $this->getPassword());
        $this->db->bind(':email', $this->getEmail());

        if ($this->db->execute() && $this->db->rowCount() === 1) {
            return $this->db->registro();
        } else {
            return false;
        }
        
    }
}
?>