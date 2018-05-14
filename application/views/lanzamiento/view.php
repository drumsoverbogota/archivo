<script type="text/javascript">
    
    function borrar(){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('lanzamiento/delete/'.$lanzamiento_item['id']); ?>";
		else
			return false;
	} 
</script>


<P><IMG SRC="<?php echo base_url('images/placeholder.jpg'); ?>" ALIGN="RIGHT"><B>Banda</B></P>

<p><H3><?php echo $lanzamiento_item['nombre'];?> (<?php echo $lanzamiento_item['anho'];?>)</H3></p>

<P><?php echo $lanzamiento_item['referencia'];?><BR CLEAR="ALL">



<hr>

<?php echo $lanzamiento_item['tracklist'];?>

<hr>

<?php echo $lanzamiento_item['creditos'];?>
<?php echo $lanzamiento_item['notas'];?>


<?php 	
if ($this->ion_auth->logged_in()){
?>
<div align="right"><h5><a href="<?php echo site_url('lanzamiento/edit/'.$lanzamiento_item['id']); ?>">Editar</a>|
<a href="javascript:void(0);" onclick="borrar()">Borrar</a>


</h5></div>
<?php
}
?>




