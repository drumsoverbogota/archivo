<?php 		

?>
<html>
<head>
    <title><?php echo $title; ?></title>
	
	<style>
		/*
		ul {
			list-style-type: none;
			margin: 10;
			padding: 10	;
			overflow: hidden;
			
		}

		li {
			float: left;
		}
			
		li a {
			padding: 2em;
		}
		hr {
			display: block;
			height: 1px;
			border: 0;
			border-top: 1px solid #ccc;
			margin: 1em 0;
			padding: 0;
		}		
		*/
		
		table {
			border-collapse: collapse;
		}
		table, th, td {
			border: 1px solid black;
		}		
	</style>
	
</head>
<body>
<?php 	
if ($this->ion_auth->logged_in()){
?>
<div align="right"><h5>Hola,
<a href="<?php echo site_url('admin'); ?>">Admin</a> 
<a href="<?php echo site_url('auth/logout'); ?>">Salir</a></h5></div>
<?php
}
else{
?>
<div align="right"><a href="<?php echo site_url('admin'); ?>">Iniciar sesión</a></div>
<?php
}
?>

<div align="center"><h5>Un archivo de Punk Colombiano</h5></div>
<div align="center"><h2>Sintoma de última década</h2></div>



<ul>

  <li><a href="<?php echo site_url('paginas'); ?>">Inicio</a></li>  
  <li><a href="<?php echo site_url('paginas/about'); ?>">Acerca de</a></li>
  <li> Archivo  
	  <ul>
			<li><a href="<?php echo site_url('lanzamiento/'); ?>">Lanzamientos</a></li>
			<li><a href="<?php echo site_url('banda/'); ?>">Bandas</a></li>
			<li><a href="<?php echo site_url('paginas/buscar/'); ?>">Buscar en el archivo</a></li>
	  </ul>
  </li>
  <li><a href="<?php echo site_url('paginas/contact'); ?>">Contacto</a></li>
  
</ul>
<hr/>
<!-- end header -->