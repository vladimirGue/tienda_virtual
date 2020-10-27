<?php
include_once 'app/models/Producto.php';
class ProductoController{

    public function Index(){
        $prod = new Producto();
        $results = $prod->getRand(6);
        include_once 'app/views/productos/Destacados.php';
    }
    public function Ver(){
        if (isset($_POST)) {
            $id = isset($_POST['idDetail']) ? $_POST['idDetail']:'';
            //tomar sugerencias
            $prods = new Producto();
            $productos = $prods->getRand(6);

            //tomar un solo producto para detalles
            $prod = new Producto();
            $prod->setID($id);
            $producto = $prod->getOne();
        }
            include_once 'app/views/productos/Ver.php';
        
    }
    public function Gestion(){
        Utils::isAdmin();
        $prod = new Producto();
        $productos = $prod->getAll();
        include_once 'app/views/productos/Gestion.php';
    }
    public function Crear(){
        include_once 'app/views/productos/Crear.php';
    }
    public function Save(){
        if (isset($_POST)) {
            $cat = isset($_POST['categoriaP']) ? $_POST['categoriaP']:false;
            $nom = isset($_POST['nombreP']) ? $_POST['nombreP']:false;
            $desc = isset($_POST['descripcionP']) ? $_POST['descripcionP']:false;
            $pre = isset($_POST['precioP']) ? $_POST['precioP']:false;
            $stock = isset($_POST['stockP']) ? $_POST['stockP']:false;


            if ($cat && $nom && $desc && $pre && $stock) {
                $prod = new Producto();
                $prod->setCategoria_id($cat);
                $prod->setNombre($nom);
                $prod->setDescripcion($desc);
                $prod->setPrecio($pre);
                $prod->setStock($stock);
                //cargar la imagen
                if (isset($_FILES['imagenP'])) {
                
                    $file = $_FILES['imagenP'];
                    $namefile = $file['name'];
                    $mimetype = $file['type'];
                    if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $file == 'image/gif') {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images',0777,true);//creamos la carpeta si no existe
                        }
                        move_uploaded_file($file['tmp_name'],'uploads/images/'.$namefile);
                        $prod->setImagen($namefile);
                    }
                }
                if (!empty($_POST['idEdit'])) {
                    $id = $_POST['idEdit'];
                    $prod->setID($id);
                    $saved = $prod->Edit();
                } else {
                    $saved = $prod->Save();
                }
                
                if ($saved) {
                    $_SESSION['producto'] = 'completed';
                } else {
                    $_SESSION['producto'] = 'failed';
                }
                
            } else {
                $_SESSION['producto'] = 'failed';
            }
            
        }else{
            $_SESSION['producto'] = 'failed';
        }
        header('Location:'.base_url.'Producto/Gestion');
    }
    public function Edit(){
        Utils::isAdmin();
        if (isset($_POST)) {
            $id = isset($_POST['editar']) ? $_POST['editar']:'';
            $edit = true;
            $prod = new Producto();
            $prod->setID($id);
            $producto = $prod->getOne();
            include_once 'app/views/productos/Crear.php';
        }else{
            header('Location:'.base_url.'Producto/Gestion');
        }
    }
    public function Delete(){
        Utils::isAdmin();
        if (isset($_POST)) {
            $id = isset($_POST['borrar']) ? $_POST['borrar']:'';
            $delete = new Producto();
            $delete->setID($id);
            $delete = $delete->Delete();
            if ($delete) {
                $_SESSION['delete'] = 'completed';
            } else {
                $_SESSION['delete'] = 'failed';
            }
            
        }else{
            $_SESSION['delete'] = 'failed';
        }
        header('Location:'.base_url.'Producto/Gestion');
    }
}
?>