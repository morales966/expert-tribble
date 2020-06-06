<nav class="navbar navApp navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <div id="cuadroImagenNavbar">
      <a href="<?php echo $this->Html->url(array('controller'=>'Pages','action'=>'home')) ?>"></a>
    </div>
    <div>
      <button class="btn btn-outline-primary btn-lg">CREAR CUENTA</button>
      <button class="btn btn-outline-primary btn-lg" id="btn_login">INICIAR SESIÓN</button>
      <h2 class="txt-pbx">PBX: 590 46 03</h2>
      <ul class="nav navbar-nav navbar-riht"> 
        <li class="nav-item tx">
          <a class="nav-link itemNegro" id="home" href="<?php echo $this->Html->url(array('controller'=>'Pages','action'=>'home')) ?>">INICIO</a>
        </li>
        <li class="nav-item tx">
          <a class="nav-link itemNegro" id="about" href="<?php echo $this->Html->url(array('controller'=>'Pages','action'=>'about')) ?>">QUIENES SOMOS</a>
        </li>
        <li class="nav-item tx">
          <a class="nav-link itemNegro" id="businnes" href="<?php echo $this->Html->url(array('controller'=>'Pages','action'=>'businnes')) ?>"">COMERCIOS AFILIADOS CREDIVENTAS</a>
        </li>
      </ul>
    </div>
  </div>
</nav>