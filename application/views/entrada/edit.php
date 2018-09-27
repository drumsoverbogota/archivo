<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('entrada/edit/'.$entrada_item['id']); ?>

    <label for="titulo">Titulo</label>
    <input type="input" name="titulo" value ="<?php echo $entrada_item['titulo'] ?>"/><br />
    
    <label for="resumen">Resumen (solo blog)</label>
    <textarea name="resumen"><?php echo $entrada_item['resumen'] ?></textarea><br />  

    <label for="contenido">Contenido</label>
    <textarea name="contenido"><?php echo $entrada_item['contenido'] ?></textarea><br />
    
    <select class="grande" name="tipo">
        <?php if ($entrada_item['tipo']== 'blog'): ?>
            <option value="blog" selected = "selected">Blog</option>
            <option value="noticia">Noticia</option>            
        <?php else: ?>
            <option value="blog">Blog</option>
            <option value="noticia" selected = "selected">Noticia</option>            
        <?php endif ?>

    </select><br />
    
    <input type="hidden" name="id" value="<?php echo $entrada_item['id']; ?>" />
    <input type="submit" name="submit" value="Editar Entrada" />


</form>