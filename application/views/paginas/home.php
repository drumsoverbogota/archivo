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

<p>El Muladar es un archivo de Punk Colombiano. Pueden ver todos los discos disponibles para descarga acá en <a href="<?php echo site_url('lanzamiento/'); ?>">Lanzamientos Disponibles</a>, las bandas acá en <a href="<?php echo site_url('banda/'); ?>">Bandas</a>, los fanzines acá en <a href="<?php echo site_url('publicacion/'); ?>">Publicaciones</a> o usar el <a href="<?php echo site_url('buscar/'); ?>">buscador</a>.</p>
<p>
También empezamos a agregar los discos que aún no tenemos disponibles acá en <a href="<?php echo site_url('lanzamiento?no_disponibles=true'); ?>"> Todos los lanzamientos </a>. Ahí están los discos que sabemos que existen pero no tenemos acceso el disco en físico para digitalizarlo. </p>

<hr/>

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



