<script type="text/javascript">
    
    function borrar(id){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('entrada/delete/'); ?>".concat(id);
		else
			return false;
	} 
</script>

<p><h2>Blog</h2></p>
<div class="center-justified">
	<?php if (isset($blog)){ ?>
		<?php if (count($blog) > 0){ ?>
			<?php foreach ($blog as $blog_item): ?>

				<h3><?php echo $blog_item['titulo'].' ('.$blog_item['fecha'].')'?></h3>
				<?php echo $blog_item['resumen']?>
				<br>
				<a href="<?php echo site_url('entrada/'.$blog_item['id']); ?>">Leer entrada completa</a>
				<?php 	
					if ($this->ion_auth->logged_in()){
				?>
					<div align="right"><h5>
					<a href="<?php echo site_url('entrada/edit/'.$blog_item['id']); ?>">Editar</a>|
					<a href="javascript:void(0);" onclick="borrar(<?php echo $blog_item['id']?>)">Borrar</a></h5></div>
				<?php
					}
				?>

			<?php endforeach; ?>
		<?php } else {?>
			<p>¡Aún no hay nada por acá!</p>
		<?php } ?>
	<?php } ?>
</div>
<!-- end page content -->