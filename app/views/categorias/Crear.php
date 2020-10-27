<h2 class="text-center">CREAR CATEGORIA</h2>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-6">
      <form action="<?=base_url;?>Categoria/Save" method="post">
        <div class="form-group">
          <label for="categoria">Categoria</label>
          <input type="text" name="categoriaCr" class="form-control" id="categoria" required> 
        </div>
        <button type="submit" class="btn btn-primary">CREAR</button>
      </form>
    </div>
  </div>
</div>