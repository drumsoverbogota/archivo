<?php 		

?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
	
	<style>

		body{
			font-size: 1em;
		}
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

.center-justified {
    margin: 0 auto;
    text-align: justify;
    width: 90%;
}

@keyframes slide {
  from { left:100%; transform: translate(0, 0); }
  to { left: -100%; transform: translate(-100%, 0); }
}
@-webkit-keyframes slide {
  from { left:100%; transform: translate(0, 0); }
  to { left: -100%; transform: translate(-100%, 0); }
}

.marquee { 


  width:100%;
  height:120px;
  line-height:120px;
  overflow:hidden;
  position:relative;
}

.text {
  position:absolute;
  top:0;
  white-space: nowrap;
  height:120px;

  animation-name: slide;
  animation-duration: 30s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;
  -webkit-animation-name: slide;
  -webkit-animation-duration: 30s;
  -webkit-animation-timing-function:linear;
  -webkit-animation-iteration-count: infinite;
}



		select.grande {
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


		.top-image {
		    display: block;
		    margin-left: auto;
		    margin-right: auto;					    						
			/*width: 25%;*/
			width: 20vw;
			min-width: 218px;			

		}		

		.view-image {
			width: 40vw;
			max-width: 400px;
			min-width: 100px;
			height: auto;				

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





<!--<div align="center"><h2>El Muladar</h2></div>-->
<div align="center"><h5>Un archivo de Punk Colombiano</h5></div>
<a href="<?php echo site_url('/'); ?>"><img class="top-image" src="<?php echo base_url('images/muladarlogo.png'); ?>"></a>


<ul>

  <li><a href="<?php echo site_url('paginas'); ?>">Inicio</a></li>  

  <li> Archivo  
	  <ul>
			<li><a href="<?php echo site_url('lanzamiento/'); ?>">Lanzamientos</a></li>
			<li><a href="<?php echo site_url('banda/'); ?>">Bandas</a></li>
			<li><a href="<?php echo site_url('buscar/'); ?>">Buscar en el archivo</a></li>
	  </ul>
  </li>
  <!--<li><a href="<?php echo site_url('about'); ?>">Acerca de</a></li>-->
  <li><a href="<?php echo site_url('contact'); ?>">Contacto</a></li>
  
</ul>
<hr/>

<!-- end header -->