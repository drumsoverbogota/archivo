
<?php
	$sufijo = '';
	if($visible == 'true'){
		$sufijo .= '&visible=true';  
	}
	if($no_disponibles == 'true'){
		$sufijo .= '&no_disponibles=true';  
	}	
?>

<h2><?php echo $title;?></h2>


<table style="width:100%">

  <tr>
    <th>Nombre</th>
	<th>Banda(s)</th>  
	<th>Referencia</th>  	
    <th>Formato</th> 
    <th>Año</th>
	<?php
		if($no_disponibles == 'true'){
	?>
	<th>Disponible</th>
	<?php	
		}
	?>    
  </tr>


<div align="right">
	<form>
		Items a mostrar
		<select name="numero">
			<?php 
				for($i = 10; $i <= 100; $i= $i + 10){ 
					if ($i == $limite) {?>
					<option selected="select"><?php echo $i;?></option>		
			<?php }
				else{ ?>
					<option><?php echo $i;?></option>		
			<?php 
				}				
			} ?>
		</select>
		Ordenar por
		<?php 
			$options = array(
				'nombre'	=> 'Nombre',
				'anho'		=> 'Año',
				'formato'	=> 'Formato',
				'Referencia'=> 'Referencia',
			);
			echo form_dropdown('ordenar', $options, $ordenar);

			$options = array(
				'ascendente'	=> 'Ascendente',
				'descendente'	=> 'Descendente',
			);
			echo form_dropdown('ascendente', $options, $ascendente);


		?>
		<input type="hidden" name="visible" value="<?php echo($visible)?>" />
		<input type="hidden" name="no_disponibles" value="<?php echo($no_disponibles)?>" />
		<input type="submit" value="Mostrar" />
	</form>
</div>

<div align="center">
Página
<?php for ($i=1; $i <= ceil($total/$limite); ++$i) {?>
	<?php if ($pagina == $i){?>
		<b><?php echo $i; ?></b>
	<?php } else {?>
		
		<a href="<?php echo site_url('lanzamiento/?numero='.$limite.'&ascendente='.$ascendente.'&ordenar='.$ordenar.'&pagina='.$i.$sufijo); ?>"><?php echo $i; ?></a>
		
	<?php }?>		
<?php }?>	
</div>


<?php foreach ($lanzamiento as $lanzamiento_item): ?>
	<tr>
		<th>
			<a href="<?php echo site_url('lanzamiento/'.$lanzamiento_item['nombrecorto']); ?>"><?php echo $lanzamiento_item['nombre']; ?></a></p>
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
		<?php
			if($no_disponibles == 'true'){
				if($lanzamiento_item['disponible'] == 1){
		?>
		<th>Sí</th>
		<?php	
			}
			else{
		?>
		<th><p class="rojo">No</p></th>
		<?php				
				}
			}
		?>            
	</tr>
<?php endforeach; ?>
	
</table>


<div align="center">
Página
<?php for ($i=1; $i <= ceil($total/$limite); ++$i) {?>
	<?php if ($pagina == $i){?>
		<b><?php echo $i; ?></b>
	<?php } else {?>
		
		<a href="<?php echo site_url('lanzamiento/?numero='.$limite.'&ascendente='.$ascendente.'&ordenar='.$ordenar.'&pagina='.$i.$sufijo); ?>"><?php echo $i; ?></a>
		
	<?php }?>		
<?php }?>	
</div>
