<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('publicacion/create'); ?>

    <label for="nombre">Nombre</label>
    <input type="input" name="nombre" /><br />
    
    <label for="referencia">Fecha</label>
    <input type="input" name="fecha" /><br />
    
    <label for="numero">Número</label>
    <input type="input" name="numero" /><br />
    
    <label for="notas">Notas</label>
    <textarea name="notas"></textarea><br />    
    
    <label for="link">Link</label>
    <input type="input" name="link"><br />

    <label for="indice_referencia">ID de referencia en el archivo</label>
    <input type="input" name="indice_referencia"><br />    

    <label for="visible">¿Es visible?</label>
    <input name="visible" type="checkbox" checked><br />

    <input type="submit" name="submit" value="Crear nueva publicación" />

</form>