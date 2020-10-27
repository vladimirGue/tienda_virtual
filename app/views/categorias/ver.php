<?php if (isset($categoria) && !empty($categoria)) {?>
        <div class="container" style="margin-top: 5em;">
            <h4 class="Pdestacados_h4"><?php echo $categoria->nombre;?></h4>
            <?php if ($productos['rows'] == 0) {?>
                <h4>No hay productos</h4>
            <?php } else {?>
            <div class="row row-cols-1 row-cols-md-3">
                <?php foreach ($productos['registros'] as $prod) {?>
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
                                    <a href="#" class="card-title stretched-link h4"><?php echo  $prod->nombre;?></a>
                                    <p class="card-text text-muted"><?php echo  $prod->descripcion;?></p>
                                    <p class="prix">$<?php echo  $prod->precio;?></p>
                                </div>
                            </div>
                            <a  href="#" class="btn btn-primary btn-block">COMPRAR</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
<?php } else{ ?>
    <h2>La categoria no existe</h2>
<?php } ?>