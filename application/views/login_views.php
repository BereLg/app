<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-4 col-md-offset-4">
			<h1 class="text-center login-title">Inicie sesión para continuar</h1>
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