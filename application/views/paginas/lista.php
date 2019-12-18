
<table style="width:100%">

  <tr>
    <th>Referencia</th>
	<th>Nombre</th>  
    <th>Visible</th>
    <th>Link</th>
    <th>Bandas</th>
  </tr>
<p><h2>Lanzamientos</h2></p>

<?php foreach ($lanzamiento as $lanzamiento_item): ?>
	<tr>
		<th>
			<a href="<?php echo site_url('lanzamiento/'.$lanzamiento_item['nombrecorto']); ?>"><?php echo $lanzamiento_item['indice_referencia']; ?></a></p>
		</th>
		<th>
			<?php echo $lanzamiento_item['nombre']; ?>
		</th>		
		<th>
			<?php if ($lanzamiento_item['visible'] === '1') {
				echo "Sí";
			}
			else{
				echo "<p class=\"rojo\">No</p>";
			}?>
		</th>
		<th>
			<?php if ($lanzamiento_item['link'] != null) {
				echo "Sí";
			}
			else{
				echo "<p class=\"rojo\">No</p>";
			}?>
		</th> 		 
		<th>
			<?php if ($lanzamiento_item['bandas'] != null) {
				echo "Sí";
			}
			else{
				echo "<p class=\"rojo\">No</p>";
			}?>
		</th> 	        

	</tr>
<?php endforeach; ?>
</table>


<p><h2>Fanzines</h2></p>

<table>

  <tr>
    <th>Referencia</th>
	<th>Nombre</th>  
	<th>Número</th>  
    <th>Visible</th>
    <th>Link</th>
  </tr>

	<?php foreach ($publicacion as $publicacion_item): ?>
		<tr>
			<th>
				<a href="<?php echo site_url('publicacion/'.$publicacion_item['nombrecorto']); ?>"><?php echo $publicacion_item['indice_referencia']; ?></a></p>
			</th>
			<th>
				<?php echo $publicacion_item['nombre']; ?>
			</th>	
			<th>
				<?php echo $publicacion_item['numero']; ?>
			</th>					
			<th>
				<?php if ($publicacion_item['visible'] === '1') {
					echo "Sí";
				}
				else{
					echo "<p class=\"rojo\">No</p>";
				}?>
			</th>
			<th>
				<?php if ($publicacion_item['link'] != null) {
					echo "Sí";
				}
				else{
					echo "<p class=\"rojo\">No</p>";
				}?>
			</th> 				
		</tr>

	<?php endforeach; ?>
</table>