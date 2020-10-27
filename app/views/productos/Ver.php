<?php if (isset($producto) && !empty($producto)) {?>
<h4 class="Pdestacados_h4" style="margin-top:2em;">DETALLES DE PRODUCTO</h4>
<!--Card horizontal para mostrar detalles de producto-->
<div class="container">
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <?php if ($producto->imagen !=null) {?>
                <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="card-img-top" style="height: 100%;"
                    alt="">
                <?php } else {?>
                <img src="<?=base_url?>public/img/camiseta.png" class="card-img-top" style="height: 100%;" alt="">
                <?php } ?>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="h4 card-title"><?php echo  $producto->nombre;?></p>
                    <p class="card-text text-muted"><?php echo  $producto->descripcion;?></p>
                    <p class="prix">$<?php echo  $producto->precio;?><small class="text-muted"> MXN</small></p>
                    <p class="card-text">Actualmente hay disponibles: <?php echo  $producto->stock;?></p>
                    <form action="" method="post">
                        <div class="row justify-content-md-center">
                            <div class="col-sm-6">
                                <input type="button" value="COMPRAR" class="btn btn-primary btn-block" data-toggle="modal" data-target="#card-info">
                            </div>
                        </div>
                    </form>
                    <br>
                    <form action="<?=base_url;?>Carrito/Add" method="post">
                        <div class="row justify-content-md-center">
                            <div class="col-sm-6">
                                <button type="submit" name="idCarr" value="<?php echo  $producto->id;?>" class="btn btn-success btn-block">AÑADIR A CARRITO</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <h4 class="Pdestacados_h4">SUGERENCIAS</h4>
    <div class="row row-cols-1 row-cols-md-2">
        <?php foreach ($productos as $prod) {?>
        <div class="col mb-4">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <?php if ($prod->imagen !=null) {?>
                        <img src="<?=base_url?>uploads/images/<?=$prod->imagen?>" class="card-img-top" style="min-height: 100%;" alt="">
                        <?php } else {?>
                        <img src="<?=base_url?>public/img/camiseta.png" class="card-img-top" style="min-height: 100%;" alt="">
                        <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="h5 card-title"><?php echo  $prod->nombre;?></p>
                                    <p class="card-text text-muted"><?php echo  $prod->descripcion;?></p>
                                    <p class="prix">$<?php echo  $prod->precio;?><small class="text-muted"> MXN</small>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <form action="" method="post">
                                        <div class="row justify-content-md-center">
                                            <div class="col-sm-12">
                                                <input type="submit" value="COMPRAR"
                                                    class="btn btn-primary btn-sm">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row justify-content-md-center">
                                            <div class="col-sm-12">
                                                <input type="submit" value="AÑADIR A CARRITO"
                                                    class="btn btn-success btn-sm">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<!-- BOTON PAGAR SIN HABILITAR-->
<div class="modal fade" id="card-info" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Estatus de Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Por el momento el pago de los productos esta deshabilitado</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
      </div>
    </div>
  </div>
</div>
<?php } else{ ?>
<h2>El producto no existe</h2>
<?php } ?>