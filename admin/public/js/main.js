/*
 * jQuery File Upload Plugin JS Example 8.9.0
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, regexp: true */
/*global $, window, blueimp */

$(function () {
    'use strict';

$(document).bind('dragover', function (e) {
    var dropZone = $('#dropzone'),
        timeout = window.dropZoneTimeout;
    if (!timeout) {
        dropZone.addClass('in');
    } else {
        clearTimeout(timeout);
    }
    var found = false,
        node = e.target;
    do {
        if (node === dropZone[0]) {
            found = true;
            break;
        }
        node = node.parentNode;
    } while (node != null);
    if (found) {
        dropZone.addClass('hover');
    } else {
        dropZone.removeClass('hover');
    }
    window.dropZoneTimeout = setTimeout(function () {
        window.dropZoneTimeout = null;
        dropZone.removeClass('in hover');
    }, 100);
});

   $(".files").sortable(
    {

         update: function( event, ui ) {
            var obj=Array();
           var pos=$(".files").sortable("serialize");
            console.log(ui.item,'change',ui.helper);
              $(".files tr").each(function(i,m){
                obj[i]=$(m).data("num-id");
            })
            $.ajax(
                {url:url+"albums/sort/"+$("#id_album").val(),
                dataType:"json",
                type:"POST",
                data:{listPos:pos,listId:obj},
                success:function(data)
            {

                generateNoty2(data.result,data.message,50);
            }});
            $(".files").children().remove();
            loadFiles();
         },

    });

//sino fasun esquema de la navegacio i d les funcions k vols k tingui una web tan gran
//no pk les webs k faig son petites
//xo si en faig una d gran desde 0 ho intentare
//


    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({url:url+"albums/do_upload2/"+$("#randir").val()+"/"+$("#id_album").val(),dropZone: $('#dropzone')});
var fileCount = 0, fails = 0, successes = 0;
$("#fileupload").bind('fileuploaddone', function(e){
    generateNoty2("success","Imagen/es suidas correctamente",5);
      $(".files").children().remove();
            loadFiles();
})
$('#fileupload').bind('fileuploadsubmit', function (e, data) {

    var inputs = data.context.find(':input');
    var sortir=false;
    var inputs2=inputs.filter('[required]');
    if($(inputs2[0]).val().trim()=="")
    {
        sortir=true;
        $(inputs2[0]).focus();
    }
    else
    {
        if($(inputs2[1]).val().trim()=="")
        {
             sortir=true;
             $(inputs2[1]).focus();
        }
    }
    if(sortir==true)
    {
        $(".start").removeAttr("disabled");
        return false;
    }
    data.formData = inputs.serializeArray();
    console.log("ss");
});
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )

    );

   // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    loadFiles();
function loadFiles()
{
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: url+"albums/listfiles/"+$("#randir").val()+"/"+$("#id_album").val(),
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
          /*  var
           $('.edit-title').editable({
                validate: function(value) {
                if($.trim(value) == '') return 'This field is required';
                }
                });
           /* $(".edit-title").editable($(".title").data("url"),{
                 type      : 'text',
                 cancel    : 'Cancelar',
                 submit    : 'Guardar',
                 indicator : 'Guardando',
                 tooltip   : 'Clicar para editar',
                callback : function(value, settings)
                {
                    if(value=="success")
                        generateNoty2(value,"Imagen modificada correctamente",5);
                    else
                        generateNoty2(value,"Error al modificar la imagen",5);
                },
                onsubmit:function(settings,td){
                    var input = $(td).find('input');
                    if($(input).val().trim()=="")
                    {
                        $(input).css({'border':'red 1px solid'});
                        return false;
                    }
                    else
                    {
                        $(input).css({'border':'none'})
                        return true;
                    }
                }
            });*/
            $('.edit-desc').editable({
                type:'text',
                name:'desc',
                url:$(this).data('url'),
                title:'Introduzca la descripción',

            })
            $('.edit-title').editable({
                type:'text',
                name:'title',
                url:$(this).data('url'),
                title:'Introduzca el título',
                validate: function(value) {
                if($.trim(value) == '') return 'This field is required';
                }
            })
   /*         $(".edit-desc").editable({
                 type      : 'text',
                 cancel    : 'Cancelar',
                 submit    : 'Guardar',
                 indicator : 'Guardando',
                 default:"clcar psara",
                 tooltip   : 'Clicar para editar',
                 callback : function(value, settings) {
                    if(value=="success")
                        generateNoty2(value,"Imagen modificada correctamente",5);
                    else
                        generateNoty2(value,"Error al modificar la imagen",5);
                },
                onsubmit:function(settings,td){
                    var input = $(td).find('input');
                    if($(input).val().trim()=="")
                    {
                        $(input).css({'border':'red 1px solid'});
                        return false;
                    }
                    else
                    {
                        $(input).css({'border':'none'})
                        return true;
                    }
                }
            });*/
            $(".comment").on("click",function(){
                document.location=$(this).data("url");

            });
    });
}
$("#formAlbum").validate({
    rules:{
        title:{
            required:true,
        },
        description:{
            required:true,
        }
    },
    messages:{
        title:{
            required:"El titulo es necesario",
        },
        description:{
            required:"La descripción es necesaria"
        }


    }
})
$("#updateAlbum").on("click",function(){
    if($("#formAlbum").valid())
    {
        $.ajax({url:url+"albums/updateAlbum/"+$("#id_album").val(),
            type:"POST",
            data:{'title':$("#titleAlbum").val(),'description':$("#descriptionAlbum").val().trim()},
            dataType:"json",
            success:function(data){
                generateNoty2(data.result,data.message,5);
            }
        });
    }
    return false;
})
function generateNoty2(type,text,seg) {
    var nonys = noty({
        text: text,
        type: type,
      dismissQueue: true,
        layout: 'top',
        theme: 'defaultTheme',
    });
    nonys.setTimeout(seg*1000);

  }
});