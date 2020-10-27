<div class="container-fluid title-h2">
  <h2 class="text-center">Categorias de camisetas</h2>
</div>
<br>
<br>
<div class="container">
  <div class="row justify-content-end">
    <div class="col-sm-6">
      <form action="<?=base_url;?>Categoria/Crear" method="post">
        <button type="submit" value="CREAR CATEGORIA" class="btn btn-primary">
          CREAR CATEGORIA <i class="fas fa-plus"></i>
        </button>
      </form>
    </div>
  </div>
  <br>
  <div class="row justify-content-md-center">
    <div class="col-sm-6">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nombre</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $cat) {?>
          <tr>
            <th scope="row"><?php echo $cat->id;?></th>
            <td><?php echo $cat->nombre;?></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<br>