<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('lanzamiento/create'); ?>

    <label for="nombre">Nombre</label>
    <input type="input" name="nombre" /><br />
	
    <label for="referencia">Referencia</label>
    <input type="input" name="referencia" /><br />

    <label for="formato">Formato</label>
    <select class="grande" name="formato">
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

    <label for="link_youtube">Link de Youtube</label>
    <input type="input" name="link_youtube"><br />    

    <label for="indice_referencia">ID de referencia en el archivo</label>
    <input type="input" name="indice_referencia"><br />    

    <label for="visible">¿Es visible?</label>
    <input name="visible" type="checkbox" checked><br />

    <input type="submit" name="submit" value="Crear nuevo lanzamiento" />

</form>