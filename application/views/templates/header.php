<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico');?>">
    <title><?php echo $title; ?></title>

	<?php
	if (isset($title)){
	?>
	<meta property="og:title" content="El Muladar: <?php echo $title; ?>" />
	<?php
	} else{
	?>
	<meta property="og:title" content="El Muladar" />
	<?php
	}
	?>
	<?php
	if (isset($descripcion)){
	?>
	<meta property="og:description" content="<?php echo $descripcion;?>" />
	<?php
	} else{
	?>
	<meta property="og:description" content="El Muladar es un archivo de Punk Colombiano de libre acceso." />
	<?php
	}
	?>
	<?php
	if (isset($imagen)){
		if ($imagen != NULL){
	?>
	<meta property="og:image" content="<?php echo base_url('images/'.$imagen);?>"/>
	<?php
		}
		else{
	?>
	<meta property="og:image" content="<?php echo base_url('images/logo.png');?>"/>
	<?php
	}} else{
	?>
	<meta property="og:image" content="<?php echo base_url('images/logo.png');?>"/>
	<?php
	}
	?>
	<meta property="og:type" content="website"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/main.css">
	
	
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

?>

<!--<div align="center"><h2>El Muladar</h2></div>-->
<div align="center"><h5>Un archivo de Punk Colombiano</h5></div>
<a href="<?php echo site_url('/'); ?>"><img class="top-image" src="<?php echo base_url('images/muladarlogo.png'); ?>"></a>


<ul>

  <li><a href="<?php echo site_url('paginas'); ?>">Inicio</a></li>  

  <li> Archivo  
	  <ul>
			<li><a href="<?php echo site_url('lanzamiento'); ?>">Lanzamientos Disponibles</a></li>
			<li><a href="<?php echo site_url('lanzamiento?no_disponibles=true'); ?>">Todos los lanzamientos</a></li>
			<li><a href="<?php echo site_url('banda'); ?>">Bandas</a></li>
			<li><a href="<?php echo site_url('publicacion'); ?>">Fanzines y otras publicaciones</a></li>
			<li><a href="<?php echo site_url('buscar'); ?>">Buscar en el archivo</a></li>
	  </ul>
  </li>
  <li><a href="<?php echo site_url('blog'); ?>">Blog</a></li>  
  <li><a href="<?php echo site_url('about'); ?>">Acerca de</a></li>
  <li><a href="<?php echo site_url('contact'); ?>">Contacto</a></li>
  
</ul>
<hr/>

<!-- end header -->