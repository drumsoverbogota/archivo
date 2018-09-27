<script type="text/javascript">
    
    function borrar(){
		var r=confirm("Do you want to delete this?")
		if (r==true)
			window.location = "<?php echo site_url('entrada/delete/'.$entrada_item['id']); ?>";
		else
			return false;
	} 
</script>


<h1><?php echo $entrada_item['titulo'].' ('.$entrada_item['fecha'].')'?></h1>
<?php echo $entrada_item['contenido']?>


<?php 	
	if ($this->ion_auth->logged_in()){
?>
	<div align="right"><h5>
	<a href="<?php echo site_url('entrada/edit/'.$entrada_item['id']); ?>">Editar</a>|
	<a href="javascript:void(0);" onclick="borrar()">Borrar</a></h5></div>
<?php
	}
?>

