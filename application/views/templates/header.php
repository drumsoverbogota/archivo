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

		/*.marquee {
		    width: 450px;
		    margin: 0 auto;
		    white-space: nowrap;
		    overflow: hidden;
		    box-sizing: border-box;
		    
		    position: relative;
		    left: 40%;
			
			color: #a9a9a9;
			font-family: 'Source Sans Pro', sans-serif;
			letter-spacing: 2px; 
			font-weight: 100;
			font-size: 16px;
				
		}*/

.scroll-left {
height: 20px; 
overflow: hidden;
position: relative;
}
.scroll-left p {
position: absolute;
width: 170%;
height: 100%;
margin: 0;
line-height: 20px;
text-align: center;
/* Starting position */
-moz-transform:translateX(100%);
-webkit-transform:translateX(100%); 
transform:translateX(100%);
/* Apply animation to this element */ 
-moz-animation: scroll-left 20s linear infinite;
-webkit-animation: scroll-left 20s linear infinite;
animation: scroll-left 20s linear infinite;
}
/* Move it (define the animation) */
@-moz-keyframes scroll-left {
0% { -moz-transform: translateX(100%); }
100% { -moz-transform: translateX(-100%); }
}
@-webkit-keyframes scroll-left {
0% { -webkit-transform: translateX(100%); }
100% { -webkit-transform: translateX(-100%); }
}
@keyframes scroll-left {
0% { 
-moz-transform: translateX(100%); /* Browser bug fix */
-webkit-transform: translateX(100%); /* Browser bug fix */
transform: translateX(100%); 
}
100% { 
-moz-transform: translateX(-100%); /* Browser bug fix */
-webkit-transform: translateX(-100%); /* Browser bug fix */
transform: translateX(-100%); 
}
}


		select {
		    width: 100%;
		    padding: 16px 20px;
		    border: none;
		    border-radius: 4px;
		    background-color: #f1f1f1;
		}

		input[type=input] {
		    width: 100%;
		    padding: 6px 10px;
		    margin: 8px 0;
		    box-sizing: border-box;
		}
		textarea {
		    width: 100%;
		    height: 150px;
		    padding: 12px 20px;
		    box-sizing: border-box;
		    border: 2px solid #ccc;
		    border-radius: 4px;
		    background-color: #f8f8f8;
		    resize: none;
		}		

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

?>

<div align="center"><h5>Un archivo de Punk Colombiano</h5></div>
<div align="center"><h2>El Muladar</h2></div>



<ul>

  <li><a href="<?php echo site_url('paginas'); ?>">Inicio</a></li>  

  <li> Archivo  
	  <ul>
			<li><a href="<?php echo site_url('lanzamiento/'); ?>">Lanzamientos</a></li>
			<li><a href="<?php echo site_url('banda/'); ?>">Bandas</a></li>
			<li><a href="<?php echo site_url('buscar/'); ?>">Buscar en el archivo</a></li>
	  </ul>
  </li>
  <li><a href="<?php echo site_url('about'); ?>">Acerca de</a></li>
  <li><a href="<?php echo site_url('contact'); ?>">Contacto</a></li>
  
</ul>
<hr/>
<!-- end header -->