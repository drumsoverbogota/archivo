<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('lanzamiento/create'); ?>

    <label for="nombre">Nombre</label>
    <input type="input" name="nombre" /><br />
	
    <label for="referencia">Referencia</label>
    <input type="input" name="referencia" /><br />

    <label for="formato">Formato</label>
    <select name="formato">
        <?php for($i = 0; $i < count($formatos); ++$i) { ?>
            <option value="<?php echo $i+1 ?>"><?php echo $formatos[$i]; ?></option>          
        <?php } ?>

    </select><br />
	
    <label for="anho">Año</label>
	<input type="input" name="anho" /><br />
	
    <label for="tracklist">Tracklist</label>
    <textarea name="tracklist"></textarea><br />		
	
    <label for="creditos">Creditos</label>
    <textarea name="creditos"></textarea><br />	

	<label for="notas">Notas</label>
    <textarea name="notas"></textarea><br />	
	
	<label for="link">Link</label>
    <input type="input" name="link"><br />		

    <input type="submit" name="submit" value="Crear nuevo lanzamiento" />

</form>