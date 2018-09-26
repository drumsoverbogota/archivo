<script type="text/javascript">
    
    function borrar(){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('banda/delete/'.$banda_item['nombrecorto']); ?>";
		else
			return false;
	} 
</script>

<h1><?php echo $entrada_item['titulo'].' ('.$entrada_item['fecha'].')'?></h1>
<p>
	<?php echo $entrada_item['contenido']?>
</p>