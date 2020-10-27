<?php if (isset($gestion)) {?>
    <div class="container-fluid title-h2">
        <h2 class="text-center">Gestionar pedido</h2>
    </div>
<?php }else{?>
    <div class="container-fluid title-h2">
        <h2 class="text-center">Mis Pedidos</h2>
    </div>
<?php } ?>

<br>
<div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-sm-8">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No. Pedido</th>
                            <th>Coste</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            foreach ($peds as $producto) {
                        ?>
                        <tr>
                            <td style="text-align: center">
                                <form action="<?=base_url?>Pedido/Detalles" method="post">
                                    <button type="submit" name="numPedido" value="<?=$producto->id?>" class="btn btn-link"><?=$producto->id?></button>
                                </form>
                            </td>
                            <td style="vertical-align: middle;">
                                <?=$producto->coste?>
                            </td>
                            <td style="vertical-align: middle;"><?=$producto->fecha?></td>
                            <td><?=Utils::showEstado($producto->estado)?></td>
                            <td>
                                <form action="<?=base_url?>Pedido/Detalles" method="post">
                                    <input type="hidden" name="numPedido" value="<?=$producto->id?>">
                                    <input type="submit" value="VER DETALLES" class="btn btn-info">
                                </form>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
    </div>