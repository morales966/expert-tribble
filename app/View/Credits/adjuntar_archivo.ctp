<form id="form_adjuntar_plan" enctype="multipart/form-data")>
	<div class="form-group">
		<?php echo $this->Form->hidden('id',array('label' => false,'class' => 'form-control','value' => $credit_id)); ?>
		<?php echo $this->Form->input('adjuntar_archivo',array('type' => 'file','label' => false,'class' => 'form-control','id' => 'txt_plan_pagos')); ?>
	</div>
</form>
<div class="form-group">
   <?php echo $this->Form->button('Guardar',array("class" => "btn btn-info form-control","id" => "btn_adjuntar_archivo","type" => "button")); ?>
</div>

<table class="table">
	<thead class="thead-dark">
		<tr>
			<th>Archivo</th>
			<th>Asesor</th>
			<th>Fecha</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($datas_credit as $credit): ?>
		<tr>
			<td>
				<a target="_blank" href="<?php echo $this->Html->url('/files/credits/plan_pagos/'.$credit['Stage']['description']) ?>">
					Archivo
				</a>
			</td>
			<td><?php echo $this->Utilities->name_user($credit['Stage']['user_id']); ?></td>
			<td><?php echo $credit['Stage']['created'] ?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>