<h2><?php echo $title; ?></h2>


<table style="width:100%">

  <tr>
    <th>Nombre</th>
	<th>Banda</th>  
	<th>Referencia</th>  	
    <th>Formato</th> 
    <th>Año</th>
  </tr>

<?php foreach ($lanzamiento as $lanzamiento_item): ?>
	<tr>
		<th>
			<a href="<?php echo site_url('lanzamiento/'.$lanzamiento_item['id']); ?>"><?php echo $lanzamiento_item['nombre']; ?></a></p>
		</th>
		<th>
			-
		</th>		
		<th>
			<?php echo $lanzamiento_item['referencia']; ?>
		</th>		
		<th>
			<?php echo $lanzamiento_item['formato']; ?>
		</th>
		<th>
			<?php echo $lanzamiento_item['anho']; ?>
		</th>
        
        
	</tr>
<?php endforeach; ?>

</table>