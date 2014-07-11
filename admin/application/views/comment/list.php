<script type="text/javascript">
var url2='<?php echo base_url();?>';
var uri='<?php echo uri_string();?>';
var i=uri.indexOf("/");
var uri2=uri.substr(0,i);

</script>
 <h3>Arbol de comentarios de la foto del album</h3>
    <?php if(count($tree_comments)>0){?>


    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" type="text/css" rel="stylesheet"/>
    <style type="text/css">
    .tree {
    min-height:20px;
    padding:19px;
    margin-bottom:20px;
    background-color:#fbfbfb;
    border:1px solid #999;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
}
.tree li {
    list-style-type:none;
    margin:0;
    padding:10px 5px 0 5px;
    position:relative
}
.tree li::before, .tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:1px solid #999;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:1px solid #999;
    height:20px;
    top:25px;
    width:25px
}
.tree li span {
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border:1px solid #999;
    border-radius:5px;
    display:inline-block;
    padding:3px 8px;
    text-decoration:none
}
.tree li.parent_li>span {
    cursor:pointer;
}
.tree>ul>li::before, .tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:30px
}
.tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
    background:#eee;
    border:1px solid #94a0b4;
    color:#000
}
    </style>
		<div id="tree" class="tree well">
			<ul>
				<?php  show($tree_comments);?>
			</ul>
	</div>
    <?php

                                }
 else {
     echo "<h4> No hay Comentarios</h4>";
 }
function show($node)
{

	foreach($node as $item)
	{
		echo "<li ><span data-id=".$item['id']."><i";
		if($item['id_parent']=='0')
		{
			echo ' class="icon-folder-open"';
		}
		else if($item['id_parent']!='0')
		{
			if(count($item['children'])==0)
				echo ' class="icon-leaf"';
			else
				echo ' class="icon-minus-sign"';
		}
		else
		{

		}
		echo '> </i> '.$item['comment'].' ';
		echo ' </span> ';
		echo anchor(base_url().'comment/edit/'.$item['id'].'/'.$item['id_photo'].'/'.$item['id_album'],'<i class="glyphicon glyphicon-pencil" title="Editar"></i> Editar',array('class'=>'btn btn-default'));
		echo " ";
		echo anchor(base_url().'comment/delete/'.$item['id'].'/'.$item['id_photo'].'/'.$item['id_album'],'<i class="glyphicon glyphicon-trash" title="Eliminar"></i> Eliminar',array('class'=>'btn btn-danger delete','data-id'=>$item['id']));

		if(!(empty($item['children'])))
		{
			echo "<ul>";show($item['children']);echo "</ul>";
		}

	}




}
 ?>
 <script type="text/javascript">
$(function () {

    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');

    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });

    $(".edit").on("click",function(){
    	console.log($(this).data("id"));

    })
});

    </script>
    <script src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3.custom.min.js"></script>