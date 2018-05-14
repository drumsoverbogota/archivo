<script type="text/javascript">
    
    function borrar(){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('banda/delete/'.$banda_item['id']); ?>";
		else
			return false;
	} 
</script>



<P><IMG SRC="<?php echo base_url('images/placeholder.jpg'); ?>" ALIGN="RIGHT"><B>Banda</B></P>

<p><H3><?php echo $banda_item['nombre'];?></H3></p>
<p><H3><?php echo $banda_item['otros'];?></H3></p>

<hr/>




<?php 	
if ($this->ion_auth->logged_in()){
?>
<div align="right"><h5>
<a href="<?php echo site_url('banda/edit/'.$banda_item['id']); ?>">Editar</a>|
<a href="javascript:void(0);" onclick="borrar()">Borrar</a>

</h5></div>
<?php
}
?>


