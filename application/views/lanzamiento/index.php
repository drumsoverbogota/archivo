<h2><?php echo $title; ?></h2>


<table style="width:100%">

  <tr>
    <th>Nombre</th>
	<th>Banda(s)</th>  
	<th>Referencia</th>  	
    <th>Formato</th> 
    <th>Año</th>
  </tr>


<div align="center">
Página
<?php for ($i=1; $i <= ($total/$limite)+1; ++$i) {?>
	<?php if ($pagina == $i){?>
		<b><a href="<?php echo site_url('lanzamientos/'.$i); ?>"><?php echo $i; ?></a></b>
	<?php } else {?>
		<a href="<?php echo site_url('lanzamientos/'.$i); ?>"><?php echo $i; ?></a>
	<?php }?>		
<?php }?>	
</div>

<?php foreach ($lanzamiento as $lanzamiento_item): ?>
	<tr>
		<th>
			<a href="<?php echo site_url('lanzamiento/'.$lanzamiento_item['id']); ?>"><?php echo $lanzamiento_item['nombre']; ?></a></p>
		</th>
		<th>
			<?php echo nl2br($lanzamiento_item['bandas']); ?>
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

<div align="center">
Página
<?php for ($i=1; $i <= ($total/$limite)+1; ++$i) {?>
	<?php if ($pagina == $i){?>
		<b><a href="<?php echo site_url('lanzamientos/'.$i); ?>"><?php echo $i; ?></a></b>
	<?php } else {?>
		<a href="<?php echo site_url('lanzamientos/'.$i); ?>"><?php echo $i; ?></a>
	<?php }?>		
<?php }?>	
</div>