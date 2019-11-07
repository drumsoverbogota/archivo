<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('publicacion/edit/'.$publicacion_item['nombrecorto']); ?>

    <label for="nombre">Nombre</label>
    <input type="input" name="nombre" value ="<?php echo $publicacion_item['nombre'] ?>"/><br />
    
    <label for="fecha">Fecha</label>
    <input type="input" name="fecha" value ="<?php echo $publicacion_item['fecha'] ?>"/><br />

    
    <label for="numero">Número</label>
    <input type="input" name="numero" value ="<?php echo $publicacion_item['numero'] ?>"/><br />
    
    <label for="notas">Notas</label>
    <textarea name="notas"><?php echo str_replace("<br />", "", $publicacion_item['notas']) ?></textarea><br /> 
    
    <label for="link">Link</label>
    <input type="input" name="link" value ="<?php echo $publicacion_item['link'] ?>"><br />     

    <label for="visible">¿Es visible?</label>
    <input name="visible" type="checkbox"
        <?php if($publicacion_item['visible'] != 0) echo "checked";?>
    ><br />    

    <input type="hidden" name="nombrecorto" value="<?php echo $publicacion_item['nombrecorto']; ?>" />
    <input type="submit" name="submit" value="Editar publicacion" />

</form>