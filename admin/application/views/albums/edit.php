            <script type="text/javascript">
var url='<?php echo base_url();?>';
var uri='<?php echo uri_string();?>';
var i=uri.indexOf("/");
var uri2=uri.substr(0,i);

</script>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fileupload-ui-noscript.css"></noscript>

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Editar Campos del Album <?php echo  $album[0]->title; ?>
        </div>
        <div class="panel-body formAlbum">
            <form id="formAlbum" action="<?php echo base_url(); ?>albums/update/<?php echo  $album[0]->id; ?>" method="POST" />
               <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" id="titleAlbum" name="title" value="<?php echo  $album[0]->title; ?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Descripción</label>
                    <div class="col-sm-8">
                        <textarea rows="3" id="descriptionAlbum" name="description">
                          <?php echo  $album[0]->description; ?>
                        </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" id="updateAlbum" class="btn btn-default">Guardar el título y la
                       descripción del Album</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Editar Archivos del Album
        </div>
        <div class="panel-body">

            <div id="dropzone" class="fade well">Arrastre los archivos que quiera añadir aquí </div>

           <!-- Upload function on action form -->
            <form id="fileupload" action="upload/do_upload2" method="POST" enctype="multipart/form-data">
                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                <input type='hidden' id="randir" name="randir" value="<?php echo  $album[0]->folder_name; ?>"/>
                <input type='hidden' id="id_album"  name="id" value="<?php echo  $album[0]->id; ?>"/>
                <div class="row fileupload-buttonbar">
                    <div class="col-lg-12">
                            <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Añadir archivos...</span>
                            <input type="file" name="userfile[]" multiple>
                        </span>
                        <button type="submit" class="btn btn-primary start">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Iniciar Carga múltiple</span>
                        </button>
                        <button type="reset" class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancelar carga múltiple</span>
                        </button>
                        <span class="fileupload-loading"></span>
                        <div class="pull-right">
                            <button type="button" class="btn btn-danger delete">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Eliminar Seleccionadas</span>
                            </button>

                                <label>Seleccionar Todas<input type="checkbox" class="toggle"></label>

                        </div>
                        <!-- The loading indicator is shown during file processing -->

                    </div>
                    <!-- The global progress information -->
                    <div class="col-lg-5 fileupload-progress fade">
                        <!-- The global progress bar -->
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                        </div>
                        <!-- The extended global progress information -->
                        <div class="progress-extended">&nbsp;</div>
                    </div>
                </div>

                <!-- The table listing the files available for upload/download -->
                <table role="presentation" class="table table-striped">
                    <thead>
                    <tr>
                        <td>Posición</td>
                        <td>Miniatura</td>
                        <td>Nombre fichero</td>
                        <td>Título</td>
                        <td>Descripción</td>
                        <td>Tamaño</td>
                        <td></td>
                    </tr>
                </thead>
                    <tbody class="files"></tbody></table>
            </form>

        </div>
    </div>
</div>


            <!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- The template to display files available for upload -->

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
    <td></td>
        <td>
            <span class="preview"></span>
        </td>



        <td>
            <p class="name">{%=file.name%}</p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td  colspan="2" class="form-horizontal">
               <div class="form-group">
                    <label for="title" class="col-lg-3 control-label">Título Imagen</label>
                    <div class="col-sm-8">
                        <input type="text" id="title" name="titlephoto[]" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-lg-3 control-label">Descripción Imagen</label>
                    <div class="col-sm-8 ">
                        <textarea rows="3"id="desc" name="desc[]" required>

                        </textarea>
                    </div>
                </div>
        </td>
        <td>
            <p class="size">{%=o.formatFileSize(file.size)%}</p>
            {% if (!o.files.error) { %}
                <div class="progress progress-striped active " role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            {% } %}
        </td>

        <td class="col-lg-3">
            {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Iniciar</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr id="item-{%=file.pos%}" data-num-id="{%=file.id%}"  class="template-download fade" data-pos="{%=file.pos%}">
        <td>
            <span class="pos" >{%=file.pos%}  </span>
        </td>
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span data-id="{%=file.id%}" data-pk='{%=file.id%}' class="title edit-title" data-url="{%=file.modifyUrl%}/title/{%=file.id%}">{%=(file.title)%}</span>
        </td>
         <td>
            <span class="descr edit-desc" data-pk='{%=file.id%}' data-url="{%=file.modifyUrl%}/description/{%=file.id%}">{%=(file.description)%}</span>
        </td>

         <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            <span class="comment" data-url="{%=file.commentUrl%}/{%=file.id%}"><button type="button" class="btn btn-default">Ver Commentarios</button></span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Eliminar</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">

            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url(); ?>public/js/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->

<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->

<script src="<?php echo base_url(); ?>public/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>public/js/noty/packaged/jquery.noty.packaged.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->