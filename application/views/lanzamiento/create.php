<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('lanzamiento/create'); ?>

    <label for="nombre">Nombre</label>
    <input type="input" name="nombre" /><br />

    <label for="text">Text</label>
    <input type="input" name="title" /><br />

    <input type="submit" name="submit" value="Create news item" />

</form>