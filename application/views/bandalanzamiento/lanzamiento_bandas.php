<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('bandalanzamiento/create_lanzamiento'); ?>

<?php $primera = "" ?>

<?php foreach ($banda as $banda_item): ?>


	<?php if (mb_substr($banda_item['nombre'], 0, 1) !== $primera){
		$primera = mb_substr($banda_item['nombre'], 0, 1);
		echo "<b>".$primera."</b></br>";
	}
	?>

	<label for="nombre"> - <?php echo $banda_item['nombre']; ?></label>
	
	
	<input type="checkbox" name="bandas[]" value="<?php echo $banda_item['id']; ?>"
	<?php
			
		if (in_array($banda_item['id'], $asignados)) {
			echo "checked";
		}
	?>	
	/><br />		
	

<?php endforeach; ?>
<input type="hidden" name="lanzamiento" value="<?php echo $lanzamiento_id; ?>" />
<input type="submit" name="submit" value="Asignar" />
</form>


