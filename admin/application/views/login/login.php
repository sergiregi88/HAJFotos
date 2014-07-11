  <div class="container">

    <div class="row">
      <div class="span4 offset4 well">

        <legend>Por favor Entra Usuario y Contaseña</legend>

        <?php if (isset($error) && $error): ?>
          <div class="alert alert-error">
            <a class="close" data-dismiss="alert" href="#">×</a>Usuario y/o Conraseña incorrctos!
          </div>
        <?php endif; ?>

        <?php echo form_open('login/login_user') ?>

        <input type="text" id="username" class="span4" name="username" placeholder="Usuario">
        <input type="password" id="password" class="span4" name="password" placeholder="Contraseña">

        <!--<label class="checkbox">
          <input type="checkbox" name="remember" value="1"> Remember Me
        </label>-->

        <button type="submit" name="submit" class="btn btn-info btn-block">Entrar</button>

        </form>
      </div>
    </div>
  </div>