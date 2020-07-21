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


Footer version 1
<div class="lineFooter"></div>
<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h1 class="txtTituloFooter">CONTACTANOS</h1>
        <ul style="list-style-type: square">
          <li style="color: white; font-size: 20px;">Atención al Cliente. 590 4603</li>
          <li style="color: white; font-size: 20px;">Crédito Whatsapp. 304 5926143</li>
          <li style="color: white; font-size: 20px;">Cll 50 Nro. 46-36 Of. 1510 Ed. Furatena - Medellin. Ant.</li>
          <li style="color: white; font-size: 20px;">Info@crediventas.com</li>
        </ul>
        <p style="text-align: center; color: white; font-size: 22px;">
          <strong>Lunes a Sábado 10:00 - 07:00</strong>
        </p>
      </div>
      <div class="col-md-3">
        <h1 class="txtTituloFooter">ESCRIBENOS</h1>
        <div class="row">
          <div class="col-md-6 form-group">
            <div class="form-group">
              <?php echo $this->Form->input('1',array('label' => false,'class' => 'form-control','placeholder' => 'XXX')); ?>
            </div>
            <div class="form-group">
              <?php echo $this->Form->input('2',array('label' => false,'class' => 'form-control','placeholder' => 'XXX')); ?>
            </div>
            <div class="form-group">
              <?php echo $this->Form->input('3',array('label' => false,'class' => 'form-control','placeholder' => 'XXX')); ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php 
                echo $this->Form->input('description',array('label' => false,'class' => 'form-control','placeholder' => 'Descripción','type' => 'textarea','rows'=>'5'));
              ?>
            </div>
          </div>
        </div>
        <button class="btn btn-primary form-control">Enviar</button>
      </div>
      <div class="col-md-5">
        <h1 class="txtTituloVisitanosFooter">VISITANOS</h1>
        <iframe class="cuadroMapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.0562152775144!2d-75.56632310460711!3d6.248912863590496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e4428f881635ec7%3A0x51ffe723d0b7c8e7!2sCl.%2050%20%2346-36%2C%20Medell%C3%ADn%2C%20Antioquia!5e0!3m2!1ses!2sco!4v1591063394356!5m2!1ses!2sco" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
      </div>
    </div>
  </div>
</div>
<div class="copyRight">
  <h1>Copyright © 2017-2020 - Crediventas.com</h1>
</div>