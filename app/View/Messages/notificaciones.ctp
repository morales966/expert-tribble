<?php echo $this->Utilities->data_null_notifications_new(count($datos)); ?>
<div class="status0 sizedrop">
	<?php foreach ($datos as $value): ?>
		<div class="item-notification-drop">
			<a class="dropdown-item small stateNotificacion" href="javascript:void(0)" data-uid="<?php echo $value['Message']['id']; ?>" data-state="<?php echo Configure::read('variables.noti_vista') ?>">
				<?php echo $value['Message']['description']; ?>
				<b>Fecha:</b><?php echo $value['Message']['created'] ?>	
			</a>
		</div>
		<div class="dropdown-divider"></div>
	<?php endforeach ?>
</div>
<?php if (count($datos) > 0): ?>
	<a class="dropdown-item small" href="javascript:void(0)" id="notificaciones_leidas">
		Marcar todas como leidas
	</a>
<?php endif ?>
<a class="dropdown-item small" href="<?php echo $this->Html->url(array('controller'=>'Messages','action'=>'index')) ?>">
	Ver todas mis notificaciones <i class="fa fa-chevron-right"></i> 
</a>