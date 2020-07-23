<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<?php echo $this->Html->charset(); ?>
		<title><?php echo Configure::read('Application.name') ?></title>

		<?php
			echo $this->Html->css(array('style.css?'.rand(),'lib/font-awesome/css/font-awesome.css','lib/font/flaticon.css','lib/parsley.css','lib/sweetalert.css'));
			echo $this->fetch('AppCss');
			echo $this->Html->meta('favicon.ico','img/favicon.png',array('type' => 'icon'));
	    ?>	    
	    <?php
			echo $this->Html->css('landing.css');
	    ?>
      	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
 		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
	</head>
	<body>
		<?php 
			echo $this->element('modal');
	    	echo $this->element('variables_js');
	    	echo $this->fetch('variablesAppScript');
	    	echo $this->Html->script('lib/jquery-3.5.0.js');
    	?>
    	<?php 
    		echo $this->element('menu-landing');
    	?>
		<div id="message_alert">
			<?php echo $this->Flash->render(); ?>
		</div>	

		<a href="https://wa.me/573232880909" class="intro-banner-vdo-play-btn pinkBg " target="_blank"> 
            <i class="fa fa-whatsapp text-white"></i>
            <p class="textwp abrio-wp-landing-rpb">Asesoría desde Whatsapp</p> 
            <span class="ripple pinkBg"></span> 
            <span class="ripple pinkBg"></span> 
            <span class="ripple pinkBg"></span> 
        </a>
		<a href="#" class="scroll-top" title="Ir arriba"><i class="fa fa-angle-up"></i></a>        		
		<?php echo $this->fetch('content'); ?>
	    <?php echo $this->element('footer'); ?>
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		<?php echo $this->Html->script('custom.js');?>
		<script> AOS.init({duration: 1000,})</script>
	    <?php
    		echo $this->Html->script(array('lib/popper.min.js','lib/bootstrap.js','lib/parsley/parsley.js','lib/parsley/es.js','lib/sweetalert.js'));
			echo $this->Html->script(array('app.js?'.rand()));
	    	echo $this->fetch('AppScript');
	    ?>
	</body>
</html>