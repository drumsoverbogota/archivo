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
	<P><IMG SRC="<?php echo base_url('images/placeholder.jpg'); ?>" ALIGN="RIGHT"><B>Banda</B></P>
<?php } else{?>
	<P><IMG SRC="<?php echo base_url('images/'.$banda_item['imagen']); ?>" ALIGN="RIGHT"><B>Banda</B></P>
<?php }?>
<p><H3><?php echo $banda_item['nombre'];?></H3></p>
<p><H3><?php echo nl2br($banda_item['otros']);?></H3></p><BR CLEAR="ALL">

<hr>
Lanzamientos
<ul>
<?php foreach ($lanzamiento as $lanzamiento_item): ?>
	<li>
		<a href="<?php echo site_url('lanzamiento/'.$lanzamiento_item['id']); ?>"><?php echo $lanzamiento_item['nombre']; ?></a>
	</li>	
<?php endforeach; ?>
</ul>
<hr>

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


