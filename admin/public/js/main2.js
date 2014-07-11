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

              $(".files tr").each(function(i,m){
                obj[i]=$(m).data("num-id");
            })
                $.ajax(
                {url:url+uri+"/sort/",
                dataType:"json",
                type:"POST",
                data:{listPos:pos,listId:obj},
                success:function(data)
            {

                generateNoty(data.result,data.message,50);
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
    $('#fileupload').fileupload({url:url+uri+"/do_upload2/",dropZone: $('#dropzone')});
var fileCount = 0, fails = 0, successes = 0;
$("#fileupload").bind('fileuploaddone', function(e){
    generateNoty("success","Imagen/s suidas correctamente",5);
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
        url: url+uri+"/listfiles/",
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});


/*
                $(".table").on("click",".edit-title",function(event){




                    $(this).unbind("click");
                     var text1=$(this).html();

                    var title=$(this);
                    var title_url=title.data("url");


                                        console.log(text1,title,title_url,$(this));


                    title.html("<input type='text' id='title-input' value='"+text1+"'/><button id='guardar'>Guardar</button><button id='cancel'>Cancelar</button>")
                    $(".table").on("click","#guardar",function(){
                        if(title.find("#title-input").val().trim()=="")
                        {
                            title.find("#title-input").css({'border':'red 1px solid'});
                            return false;
                        }
                        else
                        {
                            console.log(title.data('url'));
                            title.find("#title-input").css({'border':'none'})
                            var text=title.find("#title-input").val();
                           $.ajax({
                            url:title_url   ,
                            type:"post",
                            dataType:"json",
                            data:{"value":text},
                            success:function(data){
                                console.log(data);
                                var value=data.res;
                                 if(data.res=="success"){
                                    generateNoty(value,"Imagen modificada correctamente",5);
                                    title.text(data.data);
                                   }


                                else{
                                    generateNoty(value,"Error al modificar la imagen",5);
                                    title.text(text1);
                                                }

                            },
                            beforeSend:function(){
                                title.text("Guardant...");
                            },
                            })


                        }
                    })

$(this).bind("click");
                            return false;

                })
*/
              /* $(".edit-title").editable($('.title').data("url")    ,{

             type      : 'text',
             cancel    : 'Cancelar',
             submit    : 'Guardar',
             indicator : 'Guardando',
             tooltip   : 'Clicar para editar',
              callback : function(value, settings) {
                if(value=="success")
                    generateNoty(value,"Imagen modificada correctamente",5);
                else
                    generateNoty(value,"Error al modificar la imagen",5);

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

                    //return ($(this).valid());
                }
        // });*/
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
    });
}
function generateNoty(type,text,seg) {
    var n = noty({
        text: text,
        type: type,
      dismissQueue: true,
        layout: 'center',
        theme: 'defaultTheme',
    });
    n.setTimeout(seg*1000);

  }

});