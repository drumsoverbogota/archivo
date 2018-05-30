<script type="text/javascript">
    
    function borrar(){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('banda/delete/'.$banda_item['id']); ?>";
		else
			return false;
	} 
</script>


<?php if ($banda_item['imagen'] == NULL){ ?>
	<P><IMG SRC="<?php echo base_url('images/placeholder.jpg'); ?>" ALIGN="RIGHT"></P>
<?php } else{?>
	<P><IMG SRC="<?php echo base_url('images/'.$banda_item['imagen']); ?>" ALIGN="RIGHT"></P>
<?php }?>
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
Lanzamientos
<ul>
<?php foreach ($lanzamiento as $lanzamiento_item): ?>
	<li>
		<a href="<?php echo site_url('lanzamiento/'.$lanzamiento_item['id']); ?>">
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
<a href="<?php echo site_url('banda/edit/'.$banda_item['id']); ?>">Editar</a>|
<a href="<?php echo site_url('banda/upload/'.$banda_item['id']); ?>">Subir imagen</a>|
<a href="javascript:void(0);" onclick="borrar()">Borrar</a>

</h5></div>
<?php
}
?>


