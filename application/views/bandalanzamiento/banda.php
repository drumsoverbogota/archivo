<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('bandalanzamiento/asignar_banda'); ?>

<select name="banda_id">

<?php foreach ($banda as $banda_item): ?>
	<option value="<?php echo $banda_item['id']; ?>"><?php echo $banda_item['nombre']; ?></option>			
	

<?php endforeach; ?>

</select>
<input type="submit" name="submit" value="Create news item" />
</form>