<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('lanzamiento/edit/'.$lanzamiento_item['id']); ?>

    <label for="nombre">Nombre</label>
    <input type="input" name="nombre" value ="<?php echo $lanzamiento_item['nombre'] ?>"/><br />
	
    <label for="referencia">Referencia</label>
    <input type="input" name="referencia" value ="<?php echo $lanzamiento_item['referencia'] ?>"/><br />

    <label for="formato">Formato</label>
	<input type="input" name="formato" value ="<?php echo $lanzamiento_item['formato'] ?>"/><br />
	
    <label for="anho">Año</label>
	<input type="input" name="anho" value ="<?php echo $lanzamiento_item['anho'] ?>"/><br />
	
    <label for="tracklist">Tracklist</label>
    <textarea name="tracklist"><?php echo $lanzamiento_item['tracklist'] ?></textarea><br />		
	
    <label for="creditos">Creditos</label>
    <textarea name="creditos"><?php echo $lanzamiento_item['creditos'] ?></textarea><br />	

	<label for="notas">Notas</label>
    <textarea name="notas"><?php echo $lanzamiento_item['notas'] ?></textarea><br />	
	
	<label for="link">Link</label>
    <input type="input" name="link" value ="<?php echo $lanzamiento_item['link'] ?>"><br />		

	<input type="hidden" name="id" value="<?php echo $lanzamiento_item['id']; ?>" />
    <input type="submit" name="submit" value="Create news item" />

</form>