<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
		<div class="bg-white-content data-commerce row">
			<div class="col-md-6">
				<h1>Datos de tu clase:</h1>
				<span>PROVEEDOR</span><br>
				<b>Nombre: </b><<?php echo $user['User']['name']; ?><br>
				<b>Nit: </b><?php echo $user['Client'][0]['nit']; ?><br>
				<b>Dirección: </b><?php echo $user['Client'][0]['gremio']; ?><br>

				<span>Afiliado</span><br>
				<b>Número de cuenta: </b><?php echo $user['Client'][0]['numero_cuenta']; ?><br>
				<b>Tipo de cuenta: </b><?php echo $user['Client'][0]['tipo_cuenta']; ?><br>
				<b>Clase: </b><?php echo $user['Client'][0]['clase']; ?><br>
				<b>Cantidad de comercios: </b><?php echo $user['Client'][0]['cantidad_comercios']; ?><br>
				<b>Cuanto paga: </b><?php echo $user['Client'][0]['cuanto_paga']; ?><br>

			</div>
			<div class="col-md-6">
				<a id="TerminosCondiciones" href="javascript:void(0)">Tú contrato con nosotros</a>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalTerminosCondiciones" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content cuadro_terminos">
			<div class="modal-header">
          		<h2 class="modal-title" id="modalTitleGuardarCancelar">Terminos y condiciones</a>
				<button type="button" class="close btn_cerrar_tc">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<iframe id="docmento_vista" src="<?php echo $this->Html->url('/files/terminos.pdf') ?>"></iframe>>
			</div>
			<div class="modal-footer">
		        <button type="button" id="btn_aceptar_documento"  class="btn btn-primary">Acepto</button>
				<button type="button" class="btn btn-secondary btn_cerrar_tc">Cancelar</button>
		     </div>
		</div>
	</div>
</div>

<?php 
	echo $this->Html->script("controller/credits/add.js?".rand(),						array('block' => 'AppScript')); 
?>