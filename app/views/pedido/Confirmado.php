<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'confirmado') {?>
<div class="container">
    <h1 class="border-bottom text-center">Tu pedido se ha confirmado</h1>
    <p  class="text-center">Tu pedido ha sido guardado con extio
        una vez que realices la transferencia bancaria con el coste
        de tu pedido, sera procesado y enviado.
    </p>
    <?php if (isset($ped)) {?>
        <h3>Datos del pedido</h3>
        <div>
            Numero de pedido: <?=$ped->id?><br>
            Total a pagar: <?=$ped->coste?><br>
            Productos:
            <?php foreach ($productos as $prod) {?>
                <ul>
                    <li>
                        <?=$prod->nombre?> - $<?=$prod->precio?> - x<?=$prod->unidades?>
                    </li>
                </ul>
            <?php }?>
            </div>
    <?php } ?>
</div>
<?php } elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'confirmado') {?>
    <div class="container">
        <h1 class="text-center">Tu pedido no ha sido procesado</h1>
    </div>
<?php } ?>