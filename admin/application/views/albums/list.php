<script type="text/javascript">
var url2='<?php echo base_url();?>';
var uri='<?php echo uri_string();?>';
var i=uri.indexOf("/");
var uri2=uri.substr(0,i);

</script>
 <h3>Listado de álbumes</h3>
    <?php if(count($list_albums)>0){?>
		<table class='table table-striped'>

			<thead>
                            <tr>

                                <th>#</th><th> Nombre</th>
                            </tr>
			</thead>

			<tbody>

				<?php  for($i=0;$i<count($list_albums);$i++){?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $list_albums[$i]->title; ?></td>
						<td><?php echo anchor(base_url().'albums/edit/'.$list_albums[$i]->id,"<i class='glyphicon glyphicon-pencil' title='Editar'></i><span>Editar</span>",array('class'=>'btn btn-default'));?></td>

			             <td><?php echo anchor(base_url().'albums/delete/'.$list_albums[$i]->id,"<i class='glyphicon glyphicon-trash' title='Eliminar'></i><span>Eliminar</span>",array('class'=>'btn btn-danger delete',"data-id"=>$list_albums[$i]->id));?></td>


					</tr>
				<?php } ?>
			</tbody>
			<tfoot>
			</tfoot>
		</table>

    <?php

                                }
 else {
     echo "<h4> No hay álbumes</h4>";
 }
    echo anchor(base_url().'albums/create',"Crear álbum",array('class'=>"btn"));?>

<script type="text/javascript">
	$(".delete").on("click",function(){
		var id=$(this).data("id");
		if(confirm("Esta seguro/a de eliminar este album?"))
		{
		$.ajax({url:url2+'albums/delete/'+id,
			type:"get",
			dataType:"json",
			success:function(data){
				console.log(data);
				if(data.result=="question")
				{
					if(confirm("Este Album tiene Imagenes quere borrar tambien las imagenes?"))
					{
						$.ajax({url:url2+'albums/deleteImagesOfAlbum/'+id,
						type:'get',
						dataType:'json',
						success:function(data){
							if(data.result=="success")
							{
								generateNoty(data.result,data.message,10);
							}
							else
							{
								generateNoty(data.result,data.message,10);
							}
						}});
					}
				}
				else if(data.result=="success")
				{
					generateNoty(data.result,data.message,10);
					setTimeout(function(){window.location.reload();},2*1000)
				}
				else
				{
					generateNoty(data.result,data.message,10);
					setTimeout(function(){window.location.reload()},2*1000)
				}
			}});
		}
		return false;

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
  		window.location.reload();
  	});
  }

</script>