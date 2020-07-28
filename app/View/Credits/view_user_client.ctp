<div class="content info-request mb-3">
    <p class="">
        <b>Valor crédito</b> <?php echo h(number_format($credit['Credit']['valor_credito'],0,",","."));?>&nbsp;
    </p>
    <p class="">
        <b>Cuotas </b> <?php echo h($credit['Credit']['numero_meses']); ?>&nbsp;
    </p>
    <p class="">
        <b>Valor cuota </b> <?php echo h($credit['Credit']['valor_cuota']); ?>&nbsp;
    </p>
    <p class="">
        <b>Fecha de registro</b> <?php echo h($credit['Credit']['created']); ?>&nbsp;
    </p>

    <p class="">
        <b>Nombre</b> <?php echo h($credit['Credit']['nombre_persona'].' '.$credit['Credit']['apellido_persona']); ?>&nbsp;
    </p>        
    <p class="">
        <b>Cédula</b> <?php echo h($credit['Credit']['cedula_persona']); ?>&nbsp;
    </p>
    <p class="">
        <b>Telefono</b> <?php echo h($credit['Credit']['telefono_persona']); ?>&nbsp;
    </p>
</div>
<div class="row photos-request mt-4">
    <div class="col-md-4">
        <div class="card">
          <img class="card-img-top imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/perfil/'.$credit['Credit']['foto_perfil']) ?>" src="<?php echo $this->Html->url('/img/creditos/perfil/'.$credit['Credit']['foto_perfil']) ?>" >
          <div class="card-body">
            <p class="card-text">Foto de perfil</p>
          </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
          <img class="card-img-top imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_delantera']) ?>" src="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_delantera']) ?>">
          <div class="card-body">
            <p class="card-text">Foto Cédula Frontal</p>
          </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
          <img class="card-img-top imagen-credit" dataimg="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>" src="<?php echo $this->Html->url('/img/creditos/cedula/'.$credit['Credit']['foto_cedula_trasera']) ?>">
          <div class="card-body">
            <p class="card-text">Foto Cédula Posterior</p>
          </div>
        </div>
    </div>
</div>
    
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content cuadro_foto">
            <div class="modal-body">
                <img src="" id="img-product" width="100%" height="90%">
                <button class="btn btn-secondary form-control" id="btn_cerrar_mFoto">Cerrar</button>
            </div>
        </div>
    </div>
</div>