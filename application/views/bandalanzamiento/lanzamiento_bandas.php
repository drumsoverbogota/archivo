<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('bandalanzamiento/create_lanzamiento'); ?>



<?php foreach ($banda as $banda_item): ?>


	<label for="nombre"><?php echo "\"".$banda_item['id']."\""; ?> - <?php echo $banda_item['nombre']; ?></label>
	
	
	<input type="checkbox" name="bandas[]" value="<?php echo $banda_item['id']; ?>"
	<?php
			
		if (in_array($banda_item['id'], $asignados)) {
			echo "checked";
		}
	?>	
	/><br />		
	

<?php endforeach; ?>
<input type="hidden" name="lanzamiento" value="<?php echo $lanzamiento_id; ?>" />
<input type="submit" name="submit" value="Create news item" />
</form>


