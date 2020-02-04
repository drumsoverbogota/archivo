<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('lanzamiento/edit/'.$lanzamiento_item['nombrecorto']); ?>

    <label for="nombre">Nombre</label>
    <input type="input" name="nombre" value ="<?php echo $lanzamiento_item['nombre'] ?>"/><br />
	
    <label for="referencia">Referencia</label>
    <input type="input" name="referencia" value ="<?php echo $lanzamiento_item['referencia'] ?>"/><br />

    <label for="formato">Formato</label>
    <select class="grande" name="formato">
        <?php for($i = 0; $i < count($formatos); ++$i) { ?>
            <?php if ($lanzamiento_item['formato'] == $formatos[$i]) {?>
                <option value="<?php echo $i+1 ?>" selected = "selected"><?php echo $formatos[$i]; ?></option> 
            <?php } else{ ?>                         
                <option value="<?php echo $i+1 ?>"><?php echo $formatos[$i]; ?></option>
            <?php } ?>     
        <?php } ?>

    </select><br />    
	
    <label for="anho">Año</label>
	<input type="input" name="anho" value ="<?php echo $lanzamiento_item['anho'] ?>"/><br />
	
    <label for="tracklist">Tracklist</label>
    <textarea name="tracklist"><?php echo str_replace("<br />", "", $lanzamiento_item['tracklist']) ?></textarea><br />		
	
    <label for="creditos">Creditos</label>
    <textarea name="creditos"><?php echo str_replace("<br />", "", $lanzamiento_item['creditos']) ?></textarea><br />	

	<label for="notas">Notas</label>
    <textarea name="notas"><?php echo str_replace("<br />", "", $lanzamiento_item['notas']) ?></textarea><br />	
	
	<label for="link">Link</label>
    <input type="input" name="link" value ="<?php echo $lanzamiento_item['link'] ?>"><br />		

    <label for="link_youtube">Link de Youtube</label>
    <input type="input" name="link_youtube" value ="<?php echo $lanzamiento_item['link_youtube'] ?>"><br />         

    <label for="indice_referencia">ID de referencia en el archivo</label>
    <input type="input" name="indice_referencia" value ="<?php echo $lanzamiento_item['indice_referencia'] ?>"><br />        

    <label for="visible">¿Es visible?</label>
    <input name="visible" type="checkbox"
        <?php if($lanzamiento_item['visible'] != 0) echo "checked";?>
    ><br />    

	<input type="hidden" name="nombrecorto" value="<?php echo $lanzamiento_item['nombrecorto']; ?>" />
    <input type="submit" name="submit" value="Editar lanzamiento" />

</form>