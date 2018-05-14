<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('bandalanzamiento/asignar_lanzamiento'); ?>

<select name="lanzamiento_id">

<?php foreach ($lanzamiento as $lanzamiento_item): ?>
	<option value="<?php echo $lanzamiento_item['id']; ?>"><?php echo $lanzamiento_item['nombre']; ?></option>			
	

<?php endforeach; ?>

</select>
<input type="submit" name="submit" value="Create news item" />
</form>