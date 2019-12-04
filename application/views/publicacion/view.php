<script type="text/javascript">
    
    function borrar(){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('publicacion/delete/'.$publicacion_item['nombrecorto']); ?>";
		else
			return false;
	} 
</script>

<p><h1><?php echo $publicacion_item['nombre'].' '.$publicacion_item['numero'].' ('.$publicacion_item['fecha'].')'?></h1><p>


<?php 

if ($publicacion_item['imagen'] == NULL){ ?>
	<P><IMG class = 'view-image' SRC="<?php echo base_url('images/placeholder.gif'); ?>">
<?php } else{
		preg_match('/(.*)\.(.*)/',$publicacion_item['imagen'], $match);
		$path = $match[1];
		$extension = $match[2];
		$thumb = $path.'_small.'.$extension;

	?>
	<P><a href="<?php echo base_url('images/'.$publicacion_item['imagen']); ?>"><IMG class = 'view-na' SRC="<?php echo base_url('images/'.$thumb); ?>"></IMG></a>
<?php }?>
</P>


<?php 
if ($publicacion_item['notas'] != ""){ ?>
	<h3>Notas</h3>
	<?php echo nl2br($publicacion_item['notas']);?>
<?php 
}
?>
<hr>

<?php 
if ($publicacion_item['link'] != ""){ ?>
	<a href="<?php echo site_url('lanzamiento/link/'.base64_encode($publicacion_item['link'])); ?>">Link de descarga</a>
<?php 
}else{
?>
	¡No hay link disponible!
<?php 
}
?>
<br>
<p class="gray">Id de referencia: <?php echo $publicacion_item['indice_referencia']; ?></p>


<?php 	
	if ($this->ion_auth->logged_in()){
?>
	<div align="right"><h5>
	<a href="<?php echo site_url('publicacion/edit/'.$publicacion_item['nombrecorto']); ?>">Editar</a>|
	<a href="<?php echo site_url('publicacion/upload/'.$publicacion_item['nombrecorto']); ?>">Subir imagen</a>|
	<a href="javascript:void(0);" onclick="borrar()">Borrar</a></h5></div>
<?php
	}
?>

