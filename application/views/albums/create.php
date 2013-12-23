<?php echo @$error;?>
<div class="panel panel-default">
  <div class="panel-body">


<div class="center-block">
    <fieldset>
<form  class="form-horizontal"  id="createAlbumForm"  action="<?php echo base_url(); ?>albums/createAlbum" method="POST" >

        <div class="form-group">
    <label for="title" class="col-sm-2 control-label">Título</label>
    <div class="col-sm-10">
        <input type="text" id="title" name="title"/>
    </div>
</div>
    <div class="form-group">
    <label for="description" class="col-sm-2 control-label">Descripción</label>
    <div class="col-sm-8">
        <textarea rows="3"id="description" name="description"></textarea>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" id="createAlbum" class="btn btn-default">Crear Album</button>
    </div>
  </div>
</form>
</fieldset>
</div>
</div>
</div>

