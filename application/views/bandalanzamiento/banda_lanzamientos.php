<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('bandalanzamiento/create_banda'); ?>



<?php foreach ($lanzamiento as $lanzamiento_item): ?>


	<label for="nombre"><?php echo "\"".$lanzamiento_item['id']."\""; ?> - <?php echo $lanzamiento_item['nombre']; ?></label>
	
	
	<input type="checkbox" name="lanzamientos[]" value="<?php echo $lanzamiento_item['id']; ?>"
	<?php
			
		if (in_array($lanzamiento_item['id'], $asignados)) {
			echo "checked";
		}
	?>	
	/><br />		
	

<?php endforeach; ?>
<input type="hidden" name="banda" value="<?php echo $banda_id; ?>" />
<input type="submit" name="submit" value="Create news item" />
</form>