<?php if (AuthComponent::user('id')) { ?>

  <div class="modal fade" id="modalTomarFoto" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content cuadro_foto">
        <div class="modal-header">
          <button type="button" id="btn_cerrar_camara" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body cuadro_foto">
          <video muted="muted" id="video"></video>
          <button type="button" id="btn_tomar" class="btn btn-primary form-control">Tomar foto</button>
          <canvas id="canvas" style="display: none;"></canvas>
          <div class="cuadro_botones" style="display: none;">
            <div class="row">
              <div class="col-md-6">
                <button type="button" id="btn_guardar_foto" class="btn btn-primary form-control">Guardar</button>
              </div>
              <div class="col-md-6">
                <button type="button" id="btn_cancelar_foto" class="btn btn-primary form-control">Tomar otra foto</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php } else { ?>

  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="modalTitle"></h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body" id="resultModal"></div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

<?php } ?>