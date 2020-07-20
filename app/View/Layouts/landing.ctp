<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php echo $this->Html->charset(); ?>
		<title><?php echo Configure::read('Application.name') ?></title>
		<?php
		echo $this->Html->meta('favicon.ico','img/favicon.png',array('type' => 'icon'));
	    ?>
	    <?php
			echo $this->Html->css('landing.css');
	    ?>
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
      	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	  
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
	</head>
	<body>
		<div id="message_alert">
			<?php echo $this->Flash->render(); ?>
		</div>
		<nav class="navbar nav-custom fixed-top navbar-expand-md">
			<div class="container-fluid">
			  <a class="navbar-brand" href="#">
			    <img src="img/crediventas-white.png" id="logo" dataattr="img/logo-crediventas.png" alt="">
			  </a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="main-menu">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="">Inicio <span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#beneficios">Beneficios</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Quiero solicitar un crédito</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#mas-info">Más información</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Comercios Afiliados</a>
			      </li>			      
			    </ul>
			    <a class="btn btn-success ml-md-3" target="_blank" href="https://wa.me/573232880909">Contactar a un asesor</a>
			  </div>
			</div>
		</nav>
		<a href="https://wa.me/573232880909" class="intro-banner-vdo-play-btn pinkBg " target="_blank"> 
            <i class="fab fa-whatsapp text-white"></i>
            <p class="textwp abrio-wp-landing-rpb">Asesoría desde Whatsapp</p> 
            <span class="ripple pinkBg"></span> 
            <span class="ripple pinkBg"></span> 
            <span class="ripple pinkBg"></span> 
        </a>
		<a href="#" class="scroll-top" title="Ir arriba">
		    <i class="fa fa-angle-up"></i>
		</a>        		
		<?php echo $this->fetch('content'); ?>
		 <?php
    		echo $this->Html->script('custom.js');
	    ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

		<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		<script>
		   AOS.init({
		      duration: 1200,
		    })
		</script>
	</body>
</html>
