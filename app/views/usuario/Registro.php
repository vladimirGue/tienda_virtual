<h2 class="text-center">Registrarse</h2>
<?php if (isset($_SESSION['Register']) && $_SESSION['Register'] === 'completed') {?>
        <strong class="alert alert-success">Registro completado exitosamente</strong>
<?php } elseif(isset($_SESSION['Register']) && $_SESSION['Register'] === 'failed') {?>
        <strong class="alert alert-danger">Fallo el registro, introduce bien los datos</strong>
<?php } ?>
<?php Utils::deleteSession('Register');?>
<div class="container">
        <div class="row justify-content-md-center">
                <div class="col-sm-6 shadow p-3 mb-5 bg-white rounded">
                        <form action="<?=base_url?>Usuario/Save" method="post">
                                <div class="form-group">
                                        <label for="inputNom">Nombre</label>
                                        <input type="text" class="form-control" name="Nombre" id="inputNom">
                                </div>
                                <div class="form-group">
                                        <label for="inputApe">Apellidos</label>
                                        <input type="text" class="form-control" name="Apellidos" id="inputApe">
                                </div>
                                <div class="form-group">
                                        <label for="inputEmail">Email</label>
                                        <input type="email" class="form-control" name="Email" id="inputEmail">
                                </div>
                                <div class="form-group">
                                        <label for="inputPass">Contraseña</label>
                                        <input type="password" class="form-control" name="Contraseña" id="inputPass">
                                </div>
                                <div class="row justify-content-end">
                                        <input type="submit" style="float:left;" class="btn btn-primary" value="REGISTRARSE">
                                </div>
                        </form>
                </div>
        </div>
</div>