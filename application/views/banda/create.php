<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('banda/create'); ?>

    <label for="nombre">Nombre</label>
    <input type="input" name="nombre" /><br />
	
    <label for="otros">Otros nombres</label>
    <textarea name="otros"></textarea><br />	

    <label for="integrantes">Integrantes</label>
    <textarea name="integrantes"></textarea><br />
	
    <label for="comentarios">Comentarios</label>
    <textarea name="comentarios"></textarea><br />	

    <input type="submit" name="submit" value="Insertar nueva banda" />

</form>