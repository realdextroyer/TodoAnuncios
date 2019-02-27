<tr align="center">
				<td><?php echo $nombre_producto ?></td>
				<td><img width="100" src='<?php echo $URLfoto ?>'></td>
				<td><?php echo $precio_anuncio.' €' ?></td>
				<td><a style="color: blue; text-decoration: none;" href='<?php echo $URLanuncio ?>' target=”_blank” ><?php echo $nombre_web ?></a></td>
				<td>
					<?php
					//Pintamos la imagen dependiendo de la valoracion
					switch ($valor)
					{
						case '0':
							echo "<img width=50 src='../../images/chollo.jpg'>";
						break;
						case '1':
							echo "<img width=50 src='../../images/correcto.jpg'>";
						break;
						case '2':
							echo "<img width=50 src='../../images/malo.jpg'>";
						break;
					}
					?>	
				</td>

			</tr>