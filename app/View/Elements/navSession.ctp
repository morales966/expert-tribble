<!-- Menu horizontal -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button">
        	<i class="fa fa-align-center"></i>
        </a>
      </li>
    </ul>

    <!-- BUSCADOR FORMULARIO
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <ul class="navbar-nav ml-auto">
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
<!-- Fin menu horizontal -->

<!-- Menu vertical -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?php echo $this->Html->url(array('controller'=>'Pages','action'=>'index')) ?>" class="nav-link" id="homeS">
						<p>
							Inicio
						</p>
					</a>
				</li>
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
			</ul>
		</nav>
    </div>
</aside>
<!-- Fin menu horizontal -->