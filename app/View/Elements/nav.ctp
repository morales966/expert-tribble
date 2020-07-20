<nav class="navbar navApp navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a href="<?php echo $this->Html->url(array('controller'=>'Pages','action'=>'home')) ?>">
      <img height="100px" width="320px" src="<?php echo $this->Html->url('/img/logo.webp') ?>" class="img-logo">
    </a>
    <div>
      <button class="btn btn-outline-primary btn-lg" id="btn_dejar_datos">DEJAR DATOS</button>
      <!-- <button class="btn btn-outline-primary btn-lg" id="btn_agregar_cliente">CREAR CUENTA</button> -->
      <button class="btn btn-outline-primary btn-lg" id="btn_login">INICIAR SESIÓN</button>
      <h2 class="txt-pbx">PBX: 590 46 03</h2>
      <ul class="nav navbar-nav navbar-riht"> 
        <li class="nav-item tx">
          <a class="nav-link itemNegro" id="home" href="<?php echo $this->Html->url(array('controller'=>'Pages','action'=>'home')) ?>">INICIO</a>
        </li>
        <li class="nav-item tx">
          <a class="nav-link itemNegro" id="about" href="<?php echo $this->Html->url(array('controller'=>'Pages','action'=>'about')) ?>">
            QUIENES SOMOS
          </a>
        </li>
        <li class="nav-item tx">
          <a class="nav-link itemNegro" id="businnes" href="<?php echo $this->Html->url(array('controller'=>'Pages','action'=>'businnes')) ?>">
            COMERCIOS AFILIADOS CREDIVENTAS
          </a>
        </li>
      </ul>
      <div class="contenedor-icono">
        <a href="https://api.whatsapp.com/send?phone=573232880909" data-toggle="tooltip" data-placement="left" title="Conversar en whatsapp" target="_blank">
          <img height="45px" width="60px" src="<?php echo $this->Html->url('/img/redes/whatsapp.jpg') ?>" class="mi-imagen-abajo-derecha">
        </a>
      </div>
    </div>
  </div>
</nav>