<nav class="navbar navbar-inverse navbar-fixed-top">
	<!-- El logotipo y el icono que despliega el menú se agrupan para mostrarlos mejor en los dispositivos móviles -->
	<div class="container-fluid">
	<div class="navbar-header">
	<a class="navbar-brand navbar-left" href="#"><img class="logo" src="<?php echo base_url('images/logo.png'); ?>" alt="logo"></a>
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-nav">
			<span class="sr-only">Desplegar navegación</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>		
	</div>
	<div class="collapse navbar-collapse" id="bs-nav">
		<ul class="nav navbar-nav">
			<li class="active"> <a href="<?php echo base_url();?>">Principal</a></li>
			<li> <a href="<?php echo base_url('login')?>">Login</a></li>
			<li><a href="<?php echo base_url('quienes_somos');?>">Quiénes somos</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu-Desplegable <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li> <a href="<?php echo base_url();?>">Principal</a></li>
					
					<li> <a href="<?php echo base_url('carrito')?>">Carrito</a></li>
					<!-- uso una linea para dividir secciones del menu desplegable -->
					<li class="divider"></li>
					<li> <a href="#">Administracion</a></li>
				</ul>
			</li>
		</ul>
		<!-- Barra de Busqueda -->
		<!-- Clase navbar-form para poner formularios en el menu de navegacion -->
		<!-- el formulario de busqueda se pega a la izquierda/role search es una barra de busqueda -->
		<form action="" class="navbar-form navbar-left" role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Buscar">
				<button type="submit" class="btn btn-default">Enviar</button>
			</div>
		</form>
	</div>
	</div>
</nav>