<script type="text/javascript">
    
    function borrar(){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('lanzamiento/delete/'.$lanzamiento_item['id']); ?>";
		else
			return false;
	} 
</script>


<?php if ($lanzamiento_item['imagen'] == NULL){ ?>
	<P><IMG SRC="<?php echo base_url('images/placeholder.jpg'); ?>" ALIGN="RIGHT">
<?php } else{?>
	<P><IMG SRC="<?php echo base_url('images/'.$lanzamiento_item['imagen']); ?>" ALIGN="RIGHT">
<?php }?>
	
</P>
<p><H3><?php echo $lanzamiento_item['nombre'];?> (<?php echo $lanzamiento_item['anho'];?>)</H3></p>
<P><?php echo $lanzamiento_item['referencia'];?></P>
<P><B>Banda</B>
	<ul>
		<?php foreach ($banda as $banda_item): ?>
			<li>	
				<a href="<?php echo site_url('banda/'.$banda_item['id']); ?>"><?php echo $banda_item['nombre']; ?></a>			
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


<?php 	
if ($this->ion_auth->logged_in()){
?>
<div align="right"><h5>
<a href="<?php echo site_url('lanzamiento/edit/'.$lanzamiento_item['id']); ?>">Editar</a>|
<a href="<?php echo site_url('lanzamiento/upload/'.$lanzamiento_item['id']); ?>">Subir imagen</a>|
<a href="javascript:void(0);" onclick="borrar()">Borrar</a>


</h5></div>
<?php
}
?>




