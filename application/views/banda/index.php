<h2><?php echo $title; ?></h2>


<table style="width:100%">

  <tr>
    <th>Nombre</th>
	<th>Otros nombres</th>
	<th>Lanzamientos</th>  
  </tr>

<?php foreach ($banda as $banda_item): ?>
	<tr>
		<th>
			<a href="<?php echo site_url('banda/'.$banda_item['id']); ?>"><?php echo $banda_item['nombre']; ?></a>
		</th>
		<th>
			
			<?php echo $banda_item['otros']; ?>
			
		</th>		
		<th>
			-
		</th>		
        
	</tr>
<?php endforeach; ?>

</table>