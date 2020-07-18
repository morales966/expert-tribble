<main id="main">
  <section id="why-us" class="why-us">
     <div class="container">
        <div class="content">
 			<h1>APROBACIÓN DE CRÉDITO INMEDIATO</h1>
			<h2>PARA COMERCIOS AFILIADOS</h2>
 			<br><br><br>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus optio ad corporis.</p>
        </div>
     </div>
  </section>

  <section id="web_aplication">
	<div class="cuadro_web">
		<button type="button" class="btn btn-outline-info btn-lg" id="btn_aplicar">Aplicar</button>
	</div>
  </section>

  <section id="services" class="services section-bg">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h2 class="title_services">NUESTROS SERVICIOS</h2>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6" data-aos="fade-aaup">
          <div class="icon-box">
            <h4 class="title">AFILIACIONES DE COMERCIOS</h4>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="icon-box">
            <h4 class="title">MEDIOS DE PAGO</h4>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="icon-box">
            <h4 class="title">ASESORÍAS Y ACOMPAÑAMIENTO</h4>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php 
  echo $this->Html->script("controller/users/add_client.js?".rand(),             array('block' => 'AppScript'));
?>