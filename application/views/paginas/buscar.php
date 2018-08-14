
<!-- begin page content -->
<p><b>Buscar</b></p>

<?php echo validation_errors(); ?>
<?php echo form_open('buscar', array('method'=>'get')); ?>
    <label for="peticion">Palabra por la cual buscar</label>
    <input type="input" name="peticion" value ="<?php echo $peticion ?>"/><br />
    <input type="submit" value="Buscar" />
</form>    

<?php if ($peticion !=""){ ?>
	<?php if (isset($banda)){ ?>
		<?php if (count($banda) > 0){ ?>
			<h3>
			Bandas que cumplen el criterio
			</h3>
			<?php foreach ($banda as $banda_item): ?>
				<?php if($banda_item['extranjera'] == 0 or $extranjera == 'true') { ?>
					<li>	
					<a href="<?php echo site_url('banda/'.$banda_item['id']); ?>"><?php echo $banda_item['nombre']; ?></a>
					<?php if ($banda_item['otros']){?>
						(<?php echo str_replace("\n", ",", $banda_item['otros']); ?>)
					<?php }?>
					</li>
				<?php } ?>
			<?php endforeach; ?>



			
		<?php } ?>
	<?php } ?>
	<?php if (isset($lanzamiento)){ ?>
		<?php if (count($lanzamiento) > 0){ ?>
			<h3>
			Lanzamientos que cumplen el criterio
			</h3>
			<table style="width:100%">

			  <tr>
			    <th>Nombre</th>				
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

			
		<?php } ?>
	<?php } ?>		
<?php } ?>



<!-- end page content -->
