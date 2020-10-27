<!--Body-->
<div class="container" style="margin-top: 5em;">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="Pdestacados_h4">PRODUCTOS DESCATADOS</h4>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3">
        <?php foreach ($results as $prod) {?>
        <div class="col mb-4">
            <div class="card h-100">
                <!--si no existe la imagen en la base de datos
                    agrego una por defecto-->
                <div class="card-body card-img" style="transform: rotate(0);">
                    <?php if ($prod->imagen !=null) {?>
                    <img src="<?=base_url?>uploads/images/<?=$prod->imagen?>" class="card-img-top" alt="">
                    <?php } else {?>
                    <img src="<?=base_url?>public/img/camiseta.png" class="card-img-top" alt="">
                    <?php } ?>
                    <div class="card-body card_prod">
                        <form action="<?=base_url?>Producto/Ver" method="post">
                            <button type="submit" name="idDetail" class="btn-link card-title stretched-link h4"
                                value="<?php echo  $prod->id;?>"><?php echo  $prod->nombre;?></button>
                        </form>
                        <p class="card-text text-muted"><?php echo  $prod->descripcion;?></p>
                        <p class="prix">$<?php echo  $prod->precio;?></p>
                    </div>
                </div>
                <div class="row justify-content-md-center card-btns">
                    <div class="col-sm-12">
                        <!-- Button trigger modal -->
                        <form action="" method="post">
                            <input type="button" value="COMPRAR" class="btn btn-primary btn-block" data-toggle="modal" data-target="#card-info">
                        </form>
                    </div>
                </div>
                <div class="row justify-content-md-center card-btns">
                    <div class="col-sm-12">
                        <form action="<?=base_url;?>Carrito/Add" method="post">
                            <input type="hidden" name="idCarr" value="<?php echo  $prod->id;?>">
                            <input type="submit" value="AÑADIR A CARRITO" class="btn btn-success btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
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