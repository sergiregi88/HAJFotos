 <h3>Listado de albumes</h3>
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
     echo "<h4> No hay familias</h4>";
 }
    echo anchor(base_url().'albums/create',"Crear familia",array('class'=>"btn"));?>

<script type="text/javascript">
	$(".delete").on("click",function(){
		var id=$(this).data("id");
		if(confirm("Esta seguro/a de eliminar este album?"))
		{
		$.ajax({url:'http://localhost/aida/HAJFotos/albums/delete/'+id,
			type:"get",
			dataType:"json",
			success:function(data){
				console.log(data);
				if(data.result=="question")
				{
					if(confirm("Este Album tiene Imagenes quere borrar tambien las imagenes?"))
					{
						$.ajax({url:'http://localhost/aida/HAJFotos/albums/deleteImagesOfAlbum/'+id,
						type:'get',
						dataType:'json',
						success:function(data){
							console.log(data);
							if(data.result=="success")
							{

							}
							else
							{

							}
						}});
					}
					else
					{

					}
				}
				else if(data.result=="success")
				{

				}
				else
				{

				}

			}});
		}
		return false;
	})

</script>