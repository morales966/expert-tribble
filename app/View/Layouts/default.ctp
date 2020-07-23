<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
	    	<?php echo Configure::read('Application.name') ?>
		</title>
		<?php
			echo $this->Html->css(array('style.css?'.rand(),'lib/font-awesome/css/font-awesome.css','lib/font/flaticon.css','lib/bootstrap.css','lib/parsley.css','lib/sweetalert.css'));
			echo $this->Html->css(array('styleSession.css?'.rand()));
			echo $this->fetch('AppCss');
			echo $this->Html->meta('favicon.ico','img/favicon.png',array('type' => 'icon'));
	    ?>
	</head>
	<body>
		<?php 
			echo $this->element('modal');
	    	echo $this->element('variables_js');
	    	echo $this->fetch('variablesAppScript');
	    	echo $this->Html->script('lib/jquery-3.5.0.js');
    	?>

    	<div id="message_alert">
			<?php echo $this->Flash->render(); ?>
		</div>

		<div class="wrapper">
	    	<?php echo $this->element('navSession'); ?>
			<?php echo $this->fetch('content'); ?>
	    </div>
		
	    <?php
    		echo $this->Html->script(array('lib/popper.min.js','lib/bootstrap.js','lib/parsley/parsley.js','lib/parsley/es.js','lib/sweetalert.js'));
			echo $this->Html->script(array('app.js?'.rand(),'appSession.js?'.rand()));
	    	echo $this->fetch('AppScript');
	    ?>
	</body>
</html>