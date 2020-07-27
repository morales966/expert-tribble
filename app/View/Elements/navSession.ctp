<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button">
      	<i class="fa fa-align-center"></i>
      </a>
    </li>
  </ul>
CREDIVENTAS
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown ">
      <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell"></i>
        <span class="indicator" id="count_notificaciones">
          <?php echo $this->Utilities->count_notificaciones_user(); ?>
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" id="paint_notificaciones" aria-labelledby="alertsDropdown">
      </div>
    </li>
  	<li class="nav-item">
  		<a class="nav-link" href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'profile')) ?>" >
      	<?php echo AuthComponent::user('name'); ?>
      </a>
	  </li>
		<li class="nav-item">
			<a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'logout')) ?>" class="nav-link">
				Cerrar
			</a>
		</li>
  </ul>
</nav>

<?php $rolPermisosAdmin           = array(
                                    Configure::read('variables.roles.Administrador'),
                                    Configure::read('variables.roles.Administrador_secundario')
                                  ); ?>
<?php $rolesPermisoEcutivos       = array(
                                    Configure::read('variables.roles.Ejecutivo'),
                                    Configure::read('variables.roles.Administrador'),
                                    Configure::read('variables.roles.Administrador_secundario')
                                  ); ?>
<?php $rolesPermisoClientes       = array(
                                    Configure::read('variables.rolCliente'),
                                    Configure::read('variables.roles.Ejecutivo'),
                                    Configure::read('variables.roles.Administrador'),
                                    Configure::read('variables.roles.Administrador_secundario')
                                  ); ?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar">
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'profile')) ?>" class="nav-link" id="profile">
            <p>
              Perfil
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo $this->Html->url(array('controller'=>'Credits','action'=>'index')) ?>" class="nav-link" id="creditos">
            <p>
              Créditos
            </p>
          </a>
        </li>

        <?php if (in_array(AuthComponent::user('role'), $rolPermisosAdmin)): ?>
          <li class="nav-item">
            <a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'index')) ?>" class="nav-link" id="usuarios">
              <p>
                Usuarios
              </p>
            </a>
          </li>
        <?php endif ?>

        <?php if (in_array(AuthComponent::user('role'), $rolesPermisoEcutivos)): ?>
          <li class="nav-item">
            <a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'messages_data')) ?>" class="nav-link" id="datosDejados">
              <p>
                Datos dejados
              </p>
            </a>
          </li>
        <?php endif ?>

        <?php if (in_array(AuthComponent::user('role'), $rolesPermisoEcutivos)): ?>
          <li class="nav-item">
            <a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'comercios')) ?>" class="nav-link" id="comercios">
              <p>
                Comercios
              </p>
            </a>
          </li>
        <?php endif ?>

        <?php if (in_array(AuthComponent::user('role'), $rolesPermisoClientes)): ?>
          <li class="nav-item">
            <?php if (AuthComponent::user('role') == Configure::read('variables.rolCliente')) { ?>
              <a href="<?php echo $this->Html->url(array('controller'=>'Credits','action'=>'payments_available')) ?>" class="nav-link" id="pagos">
                <p>
                  Pagos
                </p>
              </a>
            <?php } else { ?>
              <a href="<?php echo $this->Html->url(array('controller'=>'Credits','action'=>'paid_customers')) ?>" class="nav-link" id="pagos">
                <p>
                  Pagos
                </p>
              </a>
            <?php } ?>
          </li>
        <?php endif ?>
			</ul>
		</nav>
  </div>
</aside>
