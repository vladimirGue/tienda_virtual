<?php if (isset($edit) && isset($producto)) {?>
    <h2 class="text-center">EDITAR PRODUCTO <?=$producto->nombre;?></h2>
    <?php $url_action = base_url.'Producto/Save';?>
<?php } else { ?>
    <h2 class="text-center">CREAR NUEVO PRODUCTO</h2>
    <?php $url_action = base_url.'Producto/Save';?>
<?php } ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="<?=$url_action;?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombreP">Nombre</label>
                    <input type="text" name="nombreP" class="form-control" id="nombreP" value="<?= isset($edit) && isset($producto) ? $producto->nombre :''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="descripcionP">Descripcion</label>
                    <input type="text" name="descripcionP" class="form-control" id="descripcionP" value="<?= isset($edit) && isset($producto) ? $producto->descripcion :''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="precioP">Precio</label>
                    <input type="text" name="precioP" class="form-control" id="precioP" value="<?= isset($edit) && isset($producto) ? $producto->precio :''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="stockP">Stock</label>
                    <input type="number" name="stockP" class="form-control" id="stockP" value="<?= isset($edit) && isset($producto) ? $producto->stock :''; ?>" required>
                </div>
                <div class="form-group">
                    <label for="categoriaP">Categoria</label>
                    <select class="form-control" name="categoriaP" id="categoriaP">
                        <?php 
                        $result = Utils::showCategoria();
                        foreach ($result as $cat) {?>
                        <option value="<?php echo $cat->id;?>" <?=isset($producto) && $cat->id == $producto->categoria_id ? 'selected' :''; ?>>
                            <?php echo $cat->nombre;?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="imagenP">Imagen</label>
                    <?php if (isset($producto) && !empty($producto->imagen)) { ?>
                        <img class="img-thumbnail" width="100" src="<?=base_url;?>uploads/images/<?=$producto->imagen?>" alt="">
                    <?php } ?>
                    <input type="file" name="imagenP" class="form-control" id="imagenP">
                </div>
                <button type="submit" name="idEdit" value="<?=isset($producto) ?  $producto->id:'';?>" class="btn btn-primary">CREAR</button>
            </form>
        </div>
    </div>
</div>