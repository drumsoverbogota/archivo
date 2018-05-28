<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('banda/edit/'.$banda_item['id']); ?>

    <label for="nombre">Nombre</label>
    <input type="input" name="nombre" value ="<?php echo $banda_item['nombre'] ?>"/><br />
	
    <label for="otros">Otros nombres</label>
    <textarea name="otros"><?php echo str_replace("<br />", "", $banda_item['otros']); ?></textarea><br />	

    <label for="integrantes">Integrantes</label>
    <textarea name="integrantes"><?php echo str_replace("<br />", "", $banda_item['integrantes']); ?></textarea><br />
	
    <label for="comentarios">Comentarios</label>
    <textarea name="comentarios"><?php echo str_replace("<br />", "", $banda_item['comentarios']); ?></textarea><br />

    <label for="extranjera">¿Es extranjera?</label>
    <input name="extranjera" type="checkbox"
    
    <?php if($banda_item['extranjera'] != 0) echo "checked";?>
        

    ><br />

	<input type="hidden" name="id" value="<?php echo $banda_item['id']; ?>" />
    <input type="submit" name="submit" value="Edit" />

</form>