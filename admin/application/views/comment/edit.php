<?php var_dump($comment);?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Editar Commentario de la Fotografia <?php echo $photo[0]['title']; ?> del Album <?php echo $album[0]->title; ?>
        </div>
        <div class="panel-body">
          <div  style="float:leftFF">
        	<form id="formComment">
 				<div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Título</label>
                    <div class="col-sm-10">
           			    <input type="text" value="<?php echo $comment[0]->comment;?>"/>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" id="updateComment" class="btn btn-default">Guardar el título y la
                     el commentario</button>
                    </div>
                </div>
			</form>
    </div>
    <div style="clear:both;"></div>
      <div style="float:left ;width:30000px">
      <?php if(count($tree_comments)>0){?>
</div>

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
    	</div>
    </div>
</div>
<script type="text/javascript">
var url2='<?php echo base_url();?>';
var uri='<?php echo uri_string();?>';
var i=uri.indexOf("/");
var uri2=uri.substr(0,i);

</script>
<script type="text/javascript">
  $(function(){
      var id_comment="<?php echo $comment[0]->id; ?>"
     $(".tree li span[data-id='"+id_comment+"']").draggable();
    $(".tree li span").droppable({
        drop:function(event,ui){
            $(this).html("drop");
            var new_parent=$(this).data("id");
            var id=$(ui.draggable).data("id");
            $.ajax({url:url2+"comment/change_parent/"+id+"/"+new_parent,
                    type:"get",
                    dataType:"json",
                    success:function(data){
                      generateNoty(data.result,data.message);
                      document.location.reload();
                    }
                  })

        }
    });
  });
  function generateNoty(type,text,seg) {
    var n = noty({
      text: text,
      type: type,
        dismissQueue: true,
      layout: 'center',
      theme: 'defaultTheme',
    });
    n.setTimeout(seg*1000,function(){
      document.location.reload();
    });
  }
</script>
<script src="<?php echo base_url(); ?>public/js/jquery-ui-1.10.3.custom.min.js"></script>
