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
						<td><?php echo $list_albums[$i]->name; ?></td>
						<td><?php echo anchor(base_url().'albums/edit/'.$list_albums[$i]->id,"<i class='btn pencil icon-red' title='Editar'></i>");?></td>
                        <td><?php echo anchor(base_url().'albums/delete/'.$list_albums[$i]->id,"<i class='btn-remove-circle' title='Eliminar'></i>",array('onclick'=>"return confirm('Seguro que quere eliminar este producto?');"));?></td>

        </tr></td>

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

