<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Virtual</title>
    <link rel="stylesheet" href="<?=base_url?>public/css/Styles.css">
    <!--bootstrap-->
    <link rel="stylesheet" href="<?=base_url?>public/css/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!--font awsone-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
    <!--Menu navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="<?=base_url?>public/img/camiseta.png" width="80" class="img-thumbnail" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop"
            aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTop">
                <h4 class="text-center">TIENDA DE CAMISETAS</h4>
            <ul class="navbar-nav ml-auto">
                    <?php if (!isset($_SESSION['identidad'])) {?> 
                        <li class="nav-item">
                            <button type="button" class="btn btn-link"
                            style="float: right; color: black;" data-toggle="modal" data-target="#Insesion">
                            INICIAR SESION
                            </button>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-link" href="<?=base_url?>Usuario/Registro"
                                style="float: right; color: black;">
                                REGISTRARSE
                            </a>
                        </li>
                        <?php }else { ?>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" style="float: right; color: black;"
                                type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <?=$_SESSION['identidad']->nombre;?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <form action="<?=base_url?>Usuario/Logout" method="post">
                                    <input type="submit" class="dropdown-item" value="CERRAR SESION">
                                </form>
                            </div>
                        </div>
                        <?php  } ?>
                <?php $stats = Utils::statsCarrito();?>
                <li class="nav-item">
                    <a href="<?=base_url?>Carrito/Index">
                        <i class="fas fa-shopping-cart cart" style="font-size: 30px;float: right;">
                            <span class="badge badge-primary rounded-circle"><?=$stats['count']?></span>
                        </i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!--Menu navbar-->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo base_url;?>">VladimirGM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url;?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorias
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php 
                        $result = Utils::showCategoria();
                        foreach ($result as $cat) {?>
                        <a class="dropdown-item" href="<?=base_url?>Categoria/Ver&id=<?=$cat->id;?>"><?php echo $cat->nombre;?></a>
                        <?php } ?>
                    </div>
                </li>
                <?php if (isset($_SESSION['admin'])) {?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?=base_url?>Categoria/Index">Gestionar categorias</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?=base_url?>Producto/Gestion">Gestionar productos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?=base_url?>Pedido/Gestion">Gestionar pedidos</a>
                </li>
                <?php } ?>
                <?php if (isset($_SESSION['identidad'])) {?>
                <li class="nav-item active">
                    <a class="nav-link" href="<?=base_url?>Pedido/misPedidos">Mis pedidos</a>
                </li>
                <?php } ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <!--Login-->
    <!-- Modal -->
    <div class="modal fade" id="Insesion" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?=base_url?>Usuario/Login" method="post">
                    <div class="modal-body">
                        <div class="row justify-content-md-center">
                            <div class="col-sm-10 shadow p-3 mb-5 bg-white rounded">
                                <h4 style="border-bottom:1px solid black;text-align:center;">TIENDA DE CAMISETES</h4>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" class="form-control" name="emailSesion" id="inputEmail">
                                </div>
                                <div class="form-group">
                                    <label for="inputPass">Contraseña</label>
                                    <input type="password" class="form-control" name="contraseñaSesion" id="inputPass" autocomplete="on">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                        <input type="submit" class="btn btn-primary" value="ENTRAR">
                    </div>
                </form>
            </div>
        </div>
    </div>