<br>
<div class="container-fluid title-h2">
    <h2 style="text-align: center">Carrito de la compra</h2>
</div>
<br>
<?php  if (isset($carrito)) {?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 offset-md-4 text-right">
                <a href="<?=base_url?>Carrito/Delete" class="btn btn-link danger">
                <h4><i class="fas fa-trash-alt"></i> Vaciar carrito</h4>
            </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Unidades</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            foreach ($carrito as $indice => $elemento) {
                            $producto = $elemento['producto'];
                        ?>
                        <tr>
                            <td style="text-align: center">
                                <?php if ($producto->imagen !=null) {?>
                                <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="card-img-top img-thumbnail"
                                    style="width:200px" alt="">
                                <?php } else {?>
                                <img src="<?=base_url?>public/img/camiseta.png" class="card-img-top img-thumbnail" alt="">
                                <?php } ?>
                            </td>
                            <td style="vertical-align: middle;">
                                <form action="<?=base_url?>Producto/Ver" method="post">
                                    <button type="submit" name="idDetail" value="<?=$producto->id?>"
                                        class="btn btn-link"><?=$producto->nombre?></button>
                                </form>
                            </td>
                            <td style="vertical-align: middle;"><?=$producto->precio?></td>
                            <td style="vertical-align: middle;">
                                <a href="<?=base_url?>Carrito/Up&indice=<?=$indice?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
                                <h5 class="m-3"><?=$elemento['unidades']?></h5>
                                <a href="<?=base_url?>Carrito/Down&indice=<?=$indice?>" class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></a>
                            </td>
                            <td style="vertical-align: middle;">
                                <form action="<?=base_url?>Carrito/Remove" method="post">
                                    <input type="hidden" name="producto_id" value="<?=$indice?>">
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4">
                <div class="shadow p-3 mb-5 bg-white rounded sticky-top">
                    <div class="row border-bottom">
                        <div class="col-sm-12">
                            <h4 class="font-weight-bold text-center">Detalles de compra</h4>
                        </div>
                    </div>
                    <div class="row border-bottom card-total-moddle">
                        <div class="col-sm-7">
                            <h6 class="text-muted">Total productos:</h6>
                        </div>
                        <?php $stats = Utils::statsCarrito();?>
                        <div class="col-sm-5">
                            <h6 class="text-muted">$<?=$stats['total']?></h6>
                        </div>
                    </div>
                    <div class="row card-total-footer">
                        <div class="col-sm-7">
                            <h5>Total:</h5>
                        </div>
                        <div class="col-sm-5">
                            <h5>$<?=$stats['total']?></h5>
                        </div>
                    </div>
                    <form action="<?=base_url?>Pedido/Hacer" method="post">
                        <input type="submit" value="HACER PEDIDO" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="thumbnail" style="text-align:center; position:relative;">
        <img src="<?=base_url?>public/img/Carrito...png" class="carr-Vacio" alt="EL CARRITO ESTA VACIO">
        <h3>EL CARRITO ESTA VACIO</h3>
    </div>
<?php }?>