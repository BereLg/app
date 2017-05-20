<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-6 col-sm-offset-3">
			<h2 class="text-center login-title">¿Ya es usuario? Inicie sesión</h2>
			<!-- Genero un formulario para loguearse -->
			<?php echo validation_errors(); ?>
			<div class="account-wall">
				<?php echo form_open('verificar_usuario', ['class' => 'form-signin', 'role' => 'form']); ?>
				<?php echo form_input(['name' => 'username', 'id' => 'username', 'class' => 'form-control',
					'placeholder' => 'Usuario', 'required'=>'required', 'autofocus'=>'autofocus']); ?>
				<?php echo form_input(['type' => 'password','name' => 'password', 'id' => 'password', 
					'class' => 'form-control','placeholder' => 'Contraseña', 'required'=>'required']); ?>
				<?php echo form_submit('submit', 'Iniciar sesión',"class='btn btn-lg btn-primary btn-block'"); ?>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>