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
    $(".edit").on("click",document,function()
    {
        alert("ss");
    });
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

    $(".files").sortable({
        update:function(event,ui)
        {
            var data=$(this).sortable("serialize");

            console.log(data);
            $.post("http://localhost/aida/HAJFotos/albums/sort",{list:data},function(o){

            },'json');

        }
    });
    //$( ".files" ).disableSelection();

      /* $("#fileupload").validate({

//Enabling validation for hidden types
ignore: [],

//Element in which error is shown
errorElement: "p",

//For error element
errorLabelContainer: ".error",

//For error placement
errorPlacement: function(error, element) {
    if($(element).attr("type") !== null && $(element).attr("type") === "hidden"){
        error.insertAfter($(element));
    }
    else{
        error.insertAfter($(element).parent());
    }
},

//Rules of validation
rules: {
    "titlephoto[]": {
        required: true
    },
    "desc[]": {
        required: true
    }
},

//Validation Messages
messages: {
    "titlephoto[]": {
        required: "Enter file title"
    },
    "desc[]": {
        required: "Enter file description"
    }
}});*/

/*    $(".titleInput").on("keyup",document,function(){
        console.log(mmm);
    })*/
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({url:"http://localhost/aida/HAJFotos/albums/do_upload2/"+$("#randir").val()+"/"+$("#id_album").val(),dropZone: $('#dropzone')});
$('#fileupload').bind('fileuploadchange', function (e, data) {
    //data.form[0].titlephoto.focus()

});
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
/*
$('#fileupload').bind('fileuploadsubmit', function (e, data) {
    var inputs = data.context.find(':input');
    console.log($("#titlephoto").val());
    if($("#titlephoto").hasClass("valid") && $("#desc").validate())
    {
        data.formData = inputs.serializeArray();
    }
    else
    {
        return false;
    }
});*/
    // Enable iframe cross-domain access via redirect option:

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

    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
            .call(this, $.Event('done'), {result: result});
            $(".title_descr_inputs").hide();
    });


});