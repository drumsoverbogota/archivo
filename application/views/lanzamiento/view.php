<script type="text/javascript">
    
    function borrar(){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('lanzamiento/delete/'.$lanzamiento_item['nombrecorto']); ?>";
		else
			return false;
	} 
</script>




<?php 

if ($lanzamiento_item['imagen'] == NULL){ ?>
	<P><IMG class = 'view-image' SRC="<?php echo base_url('images/placeholder.gif'); ?>" ALIGN="RIGHT">
<?php } else{
		preg_match('/(.*)\.(.*)/',$lanzamiento_item['imagen'], $match);
		$path = $match[1];
		$extension = $match[2];
		$thumb = $path.'_small.'.$extension;

	?>
	<P><a href="<?php echo base_url('images/'.$lanzamiento_item['imagen']); ?>"><IMG class = 'view-na' SRC="<?php echo base_url('images/'.$thumb); ?>" ALIGN="RIGHT"></IMG></a>
<?php }?>
	
</P>
<p><H3><?php echo $lanzamiento_item['nombre'];?> (<?php echo $lanzamiento_item['anho'];?>)</H3></p>
<P><?php echo $lanzamiento_item['referencia'];?></P>
<P><B>Banda</B>
	<ul>
		<?php foreach ($banda as $banda_item): ?>
			<li>	
				<a href="<?php echo site_url('banda/'.$banda_item['nombrecorto']); ?>"><?php echo $banda_item['nombre']; ?></a>			
			</li>		
		<?php endforeach; ?>
	</ul>
</P>

<BR CLEAR="ALL">

<hr>

<?php echo nl2br($lanzamiento_item['tracklist']);?>

<hr>

<?php echo nl2br($lanzamiento_item['creditos']);?>
<?php echo nl2br($lanzamiento_item['notas']);?>
<hr>

<?php 
if ($lanzamiento_item['link'] != ""){ ?>
	<a href="<?php echo site_url('lanzamiento/link/'.base64_encode($lanzamiento_item['link'])); ?>">Link de descarga</a>
<?php 
}else{
?>
	¡No hay link disponible!
<?php 
}
?>


<?php 	
if ($this->ion_auth->logged_in()){
?>
<div align="right"><h5>
<a href="<?php echo site_url('lanzamiento/edit/'.$lanzamiento_item['nombrecorto']); ?>">Editar</a>|
<a href="<?php echo site_url('lanzamiento/upload/'.$lanzamiento_item['nombrecorto']); ?>">Subir imagen</a>|
<a href="javascript:void(0);" onclick="borrar()">Borrar</a>


</h5></div>
<?php
}
?>




