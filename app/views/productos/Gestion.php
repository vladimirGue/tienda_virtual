<div class="container-fluid title-h2">
  <h2 class="text-center">Gestion de productos</h2>
</div>
<br>
<br>
<div class="container">
  <div class="row justify-content-end">
    <div class="col-sm-6">
      <form action="<?=base_url;?>Producto/Crear" method="post">
        <button type="submit" value="CREAR CATEGORIA" class="btn btn-primary">
          SUBIR CAMISETA <i class="fas fa-plus"></i>
        </button>
      </form>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-sm-6">
        <!--Variables sesion producto-->
        <?php if (isset($_SESSION['producto']) && $_SESSION['producto']==='completed') {?>
        <div class="alert alert-success" role="alert">
          El producto se ha registrado de manera exitosa
        </div>
        <?php }elseif (isset($_SESSION['producto']) && $_SESSION['producto']!='completed') {?>
          <div class="alert alert-danger" role="alert">
            El producto no se ha registrado
          </div>
        <?php }?>
        <?php Utils::deleteSession('producto');?>
        <!--Variables sesion borrar-->
        <?php if (isset($_SESSION['delete']) && $_SESSION['delete']==='completed') {?>
        <div class="alert alert-success" role="alert">
          El producto se ha borrado de manera exitosa
        </div>
        <?php }elseif (isset($_SESSION['delete']) && $_SESSION['delete']!='completed') {?>
          <div class="alert alert-danger" role="alert">
            El producto no se ha borrado
          </div>
        <?php }?>
        <?php Utils::deleteSession('delete');?>
    </div>
  </div>
  <br>
  <div class="row justify-content-md-center">
    <div class="col-sm-8">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Editar</th>
            <th scope="col">Borrar</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($productos as $cat) {?>
          <tr>
            <th scope="row"><?php echo $cat->id;?></th>
            <td><?php echo $cat->nombre;?></td>
            <td><?php echo $cat->descripcion;?></td>
            <td><?php echo $cat->precio;?></td>
            <td><?php echo $cat->stock;?></td>
            <td>
              <form action="<?=base_url;?>Producto/Edit" method="post">
                <button type="submit" value="<?=$cat->id;?>" name="editar" class="btn btn-warning">
                  <i class="fas fa-edit"></i>
                </button>
              </form>
            </td>
            <td>
              <form action="<?=base_url;?>Producto/Delete" method="post">
                <button type="submit" value="<?=$cat->id;?>" name="borrar" class="btn btn-danger">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<br>