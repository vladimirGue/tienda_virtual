<?php
include_once 'app/models/Categoria.php';
include_once 'app/models/Producto.php';
class CategoriaController{

    public function Index(){
        Utils::isAdmin();
        $categoria = new Categoria();
        $result = $categoria->getAll();

        include_once 'app/views/categorias/Index.php';
    }
    public function Ver(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            //obtener datos de categoria
            $cat = new Categoria();
            $cat->setID($id);
            $categoria = $cat->getOne();

            //obtener productos por categoria
            $prod = new Producto();
            $prod->setCategoria_id($id);
            $productos = $prod->getAllCategory();
        }
        include_once 'app/views/categorias/Ver.php';
    }
    public function Crear(){
        Utils::isAdmin();
        include_once 'app/views/categorias/Crear.php';
    }
    public function Save(){
        Utils::isAdmin();
        if (isset($_POST) && isset($_POST['categoriaCr'])) {
            $categoria = new Categoria();
            $categoria->setNombre($_POST['categoriaCr']);
            $categoria->Save();
            header('Location:'.base_url.'categoria/Index');

        }
    }
}
?>