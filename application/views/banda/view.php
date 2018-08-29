<script type="text/javascript">
    
    function borrar(){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('banda/delete/'.$banda_item['nombrecorto']); ?>";
		else
			return false;
	} 
</script>

<?php 

if ($banda_item['imagen'] == NULL){ ?>
	<P><IMG class = 'view-image' SRC="<?php echo base_url('images/placeholder.gif'); ?>" ALIGN="RIGHT">
<?php } else{
		preg_match('/(.*)\.(.*)/',$banda_item['imagen'], $match);
		$path = $match[1];
		$extension = $match[2];
		$thumb = $path.'_small.'.$extension;

	?>
	<P><a href="<?php echo base_url('images/'.$banda_item['imagen']); ?>"><IMG class = 'view-image' SRC="<?php echo base_url('images/'.$thumb); ?>" ALIGN="RIGHT"></IMG></a>
<?php }?>
</P>


<p><H3><?php echo $banda_item['nombre'];?> 
<?php if ($banda_item['otros']){?>
	(<?php echo str_replace("\n", ",", $banda_item['otros']); ?>)
<?php }?>
</H3></p>

<p>
<?php if ($banda_item['integrantes']){?>
<b>Integrantes</b>
<pre>
<?php echo $banda_item['integrantes']; ?>
</pre>
<?php }?>
</p>
<BR CLEAR="ALL">

<hr>
<h4>Lanzamientos</h4>
<ul>
<?php foreach ($lanzamiento as $lanzamiento_item): ?>
	<li>
		<a href="<?php echo site_url('lanzamiento/'.$lanzamiento_item['nombrecorto']); ?>">
			<?php echo $lanzamiento_item['nombre']; ?>
			(<?php echo $lanzamiento_item['anho']; ?>)
			</a>
	</li>	
<?php endforeach; ?>
</ul>
<hr>
<p>
<?php if ($banda_item['comentarios']){?>
<b>Notas</b>
<pre>
<?php echo $banda_item['comentarios']; ?>
</pre>
<?php }?>
</p>

<?php 	
if ($this->ion_auth->logged_in()){
?>
<div align="right"><h5>
<a href="<?php echo site_url('banda/edit/'.$banda_item['nombrecorto']); ?>">Editar</a>|
<a href="<?php echo site_url('banda/upload/'.$banda_item['nombrecorto']); ?>">Subir imagen</a>|
<a href="javascript:void(0);" onclick="borrar()">Borrar</a>

</h5></div>
<?php
}
?>


