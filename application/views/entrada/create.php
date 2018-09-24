<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('entrada/create'); ?>

    <label for="titulo">Titulo</label>
    <input type="input" name="nombre" /><br />
	
    <label for="resumen">Resumen (solo blog)</label>
    <textarea name="otros"></textarea><br />	

    <label for="contenido">Contenido</label>
    <textarea name="integrantes"></textarea><br />
	
    <select class="grande" name="tipo">
        <option value="blog">Blog</option>
        <option value="noticia">Noticia</option>
    </select><br />


    <input type="submit" name="submit" value="Insertar nueva Entrada" />

</form>