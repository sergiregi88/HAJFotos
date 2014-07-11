<script type="text/javascript">
var url2='<?php echo base_url();?>';
var uri='<?php echo uri_string();?>';
var i=uri.indexOf("/");
var uri2=uri.substr(0,i);

</script>
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
                            <button type="button" id="createAlbum" class="btn btn-default">Crear Album</button>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>public/js/jquery.validate.js"></script>
<style type="text/css">
    label.error{
        color:red;
        margin:4px;
        font-size:1.2em;
    }
    input.error{
        border-radius: 5px;
        border:1px solid red;
    }
    input.focus
    {
        border-color:#adacad;
    }
    input.success{
        border-color:#2ed52e;
    }
    label.success{
        border-color:#2ed52e;
    }
</style>
<script type="text/javascript">
    $("#createAlbumForm").validate({
        rules:{
            title:{
                required:true,
            },
            description:{
                required:true
            }
        },
        messages:{
            title:{
                required:"El Título es necesario",
            },
            description:{
                required:"La Descripción es necesaria"
            }
        }
    });
    $("#createAlbum").on("click",function(){
        if($("#createAlbumForm").valid())
        {
            $.ajax({
                url:url2+"albums/createAlbum/",
                type:"POST",
                data:{"title":$("#title").val().trim(),"description":$("#description").val().trim()},
                dataType:"json",
                success:function(data){
                    generateNoty(data.result,data.message,5);
                    setTimeout(function(){window.location=url2+"albums";},2*1000)

                }
            })
        }
    })
function generateNoty(type,text,seg) {
    var on = noty({
        text: text,
        type: type,
      dismissQueue: true,
        layout: 'center',
        theme: 'defaultTheme',
    });
    on.setTimeout(seg*1000,
        function(){
            console.log("ssss");
            window.location=url2+"albums";
        });

  }
</script>

