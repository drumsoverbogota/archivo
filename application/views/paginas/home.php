<script type="text/javascript">
    
    function borrar(id){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('entrada/delete/'); ?>".concat(id);
		else
			return false;
	} 
</script>

<!-- begin page content -->
<div class="center-justified">

<p><h2>¡Bienvenidos a El Muladar!</h2></p>

<p>El Muladar es un archivo de Punk Colombiano. Pueden ver todos los discos acá en <a href="<?php echo site_url('lanzamiento/'); ?>">Lanzamientos</a>, las bandas acá en <a href="<?php echo site_url('banda/'); ?>">Bandas</a> o usar el <a href="<?php echo site_url('buscar/'); ?>">buscador</a>.</p>

<p><h2>Noticias</h2></p>


<?php foreach ($noticias as $noticia_item): ?>

	<h3><?php echo $noticia_item['titulo'].' ('.$noticia_item['fecha'].')'?></h3>
	<?php echo $noticia_item['contenido']?>

	<?php 	
		if ($this->ion_auth->logged_in()){
	?>
		<div align="right"><h5>
		<a href="<?php echo site_url('entrada/edit/'.$noticia_item['id']); ?>">Editar</a>|
		<a href="javascript:void(0);" onclick="borrar(<?php echo $noticia_item['id']?>)">Borrar</a></h5></div>
	<?php
		}
	?>

<?php endforeach; ?>

</div>
<!-- end page content -->



