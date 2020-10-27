<div class="container-fluid title-h2">
    <h2 class="text-center">Detalle de pedido</h2>
</div>

<div class="container">
    <?php if (isset($ped)) {?>
    <?php if (isset($_SESSION['admin'])) {?>
    <h3>Cambiar estado del pedido</h3>
    <div class="row">
        <div class="col-sm-6">
            <form action="<?=base_url?>Pedido/Estado" method="post">
                <input type="hidden" value="<?=$ped->id?>" name="pedido_id">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary" type="submit">CAMBIAR ESTADO</button>
                    </div>
                    <select class="custom-select" id="estado" name="estado">
                        <optgroup label="Seleccionado" disabled>
                            <option class="selected" selected><?=$ped->estado?></option>
                        </optgroup>
                        <optgroup label="Elegir">
                            <option value="confirmado" <?=$ped->estado=='confirmado' ? 'disabled':''; ?>>Pendiente</option>
                            <option value="En preparacion" <?=$ped->estado=='En preparacion' ? 'disabled':''; ?>>En preparacion</option>
                            <option value="Preparado para enviar" <?=$ped->estado=='Preparado para enviar' ? 'disabled':''; ?>>Preparado para enviar</option>
                            <option value="enviado" <?=$ped->estado=='enviado' ? 'disabled':''; ?>>Enviado</option>
                        </optgroup>
                    </select>
                </div>
            </form>
        </div>
    </div>
    <?php } ?>
    <h3>Dirección de envio</h3>
    <div>
        Colonia: <?=$ped->provincia?><br>
        Ciudad: <?=$ped->localidad?><br>
        Dirección: <?=$ped->direccion?><br>
    </div>
    <br>
    <h3>Datos del pedido</h3>
    <div>
        Estado: <?=Utils::showEstado($ped->estado)?><br>
        Numero de pedido: <?=$ped->id?><br>
        Total a pagar: $<?=$ped->coste?><br>
        Productos:
            <table class="table">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Unidades</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($productos as $prod) {?>
                    <tr>
                        <td style="text-align: center">
                            <?php if ($prod->imagen !=null) {?>
                                <img src="<?=base_url?>uploads/images/<?=$prod->imagen?>" class="card-img-top img-thumbnail"
                                    style="width:200px" alt="">
                                <?php } else {?>
                                <img src="<?=base_url?>public/img/camiseta.png" class="card-img-top img-thumbnail" alt="">
                            <?php } ?>
                        </td>
                        <td style="vertical-align: middle;"><?=$prod->nombre?></td>
                        <td style="vertical-align: middle;">$<?=$prod->precio?></td>
                        <td style="vertical-align: middle;">x<?=$prod->unidades?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
    </div>
    <?php } ?>
</div>