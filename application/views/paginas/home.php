
<!-- begin page content -->
<div class="center-justified">

<p><h2>¡Bienvenidos a El Muladar!</h2></p>

<p>El Muladar es un archivo de Punk Colombiano. Pueden ver todos los discos acá en <a href="<?php echo site_url('lanzamiento/'); ?>">Lanzamientos</a>, las bandas acá en <a href="<?php echo site_url('banda/'); ?>">Bandas</a> o usar el <a href="<?php echo site_url('buscar/'); ?>">buscador</a>.</p>

<p><h2>Noticias</h2></p>


<?php foreach ($noticias as $noticia_item): ?>

	<h3><?php echo $noticia_item['titulo'].' ('.$noticia_item['fecha'].')'?></h3>
	<?php echo $noticia_item['contenido']?>

<?php endforeach; ?>

</div>
<!-- end page content -->



