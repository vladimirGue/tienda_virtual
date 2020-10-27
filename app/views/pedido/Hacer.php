<?php if (isset($_SESSION['identidad'])) {?>
<div class="container">
    <div class="row border-bottom justify-content-center">
        <h1 class="text-center">Hacer pedido</h1>
    </div>
    <br>
    <a href="<?=base_url?>Carrito/Index">Ver los productos y el precio del pedido</a>
    <br>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 title_Pedido">
                <h3 class="text-center">Direccion para el envio</h3>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <form action="<?=base_url?>Pedido/Add" method="post">
                <div class="form-group">
                    <label for="prov">Colonia</label>
                    <input type="text" class="form-control" name="prov" id="prov" required>
                </div>
                <div class="form-group">
                    <label for="ciud">Ciudad</label>
                    <input type="text" class="form-control" name="localidad" id="localidad" required>
                </div>
                <div class="form-group">
                    <label for="dire">Dirección</label>
                    <input type="text" class="form-control" name="dire"  id="dire" required>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-6">
                        <input type="submit" name="conPedido" class="btn btn-success btn-block" value="CONFIRMAR PEDIDO">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <br>
</div>
<?php } else {?>
<h1>Necesitas estar identificado</h1>
<p>Necesitas iniciar sesion en la web para poder realizar tu pedido</p>
<?php }?>