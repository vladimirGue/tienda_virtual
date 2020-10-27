<?php
class Base{
    private $host = '127.0.0.1';
    private $db_name = 'tienda_master';
    private $user = 'root';
    private $password = '';

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        //configura la conexion
        $pdo = 'mysql:dbname='.$this->db_name.';host='.$this->host;
        $options = array(
            PDO::ATTR_PERSISTENT=>true,
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        );
        //crear una instancia pdo
            try {
                $this->dbh=new PDO($pdo,$this->user,$this->password,$options);
                
            } catch (PDOException $e) {
                $this->error=$e->getMessage();
                echo $this->error;
            }
    }

    //preparamos la consulta
    public function query($sql){
        $this->stmt=$this->dbh->prepare($sql);
    }

    //vinculamos la consulta con bind
    public function bind($parametre,$valeur,$type=null){

       if(is_null($type)){
           switch(true){
             case is_int($valeur):
                $type=PDO::PARAM_INT;
             break;
             case is_bool($valeur):
                $type=PDO::PARAM_BOOL;
             break;
             case is_null($valeur):
                $type=PDO::PARAM_NULL;
             break;
             default:
             $type=PDO::PARAM_STR;
             break;
           }
       }
       $this->stmt->bindValue($parametre,$valeur,$type);
    }

    //ejecuta la consulta
    public function execute(){
       return $this->stmt->execute();
        
    }

    //Obtener los registros
    public function registros(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //obtener un solo registro
    public function registro(){
       $this->execute();
       return $this->stmt->fetch(PDO::FETCH_OBJ);
   }

   //obtener cantidad de filas
   public function rowCount(){
       return $this->stmt->rowCount(PDO::FETCH_OBJ);
   }
}
?>