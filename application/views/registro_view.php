<div class="container">
	<div class="row">
		<div class="col-sm-6 col-md-6 col-sm-offset-3">
			<h2 class="text-center login-title">¿Nuevo usuario? Regístrese</h2>
			<!-- Genero el formulario para crear una cuenta -->
			<?php echo validation_errors(); ?>
			<div class="account-wall">
				<?php echo form_open('nuevo_usuario', ['class' => 'form-group', 'role' => 'form', 'id' => 'form_registro']); ?>
				<?php echo form_input(['name' => 'nombre', 'id' => 'nombre', 'class' => 'form-control',
				'placeholder' => 'Nombre', 'required'=>'required', 'autofocus'=>'autofocus',
				'value'=>set_value('nombre')]); ?>
				<?php echo form_input(['name' => 'apellido', 'id' => 'apellido', 'class' => 'form-control',
				'placeholder' => 'Apellido', 'required'=>'required',
				'value'=>set_value('apellido')]); ?>
				<?php echo form_input(['type'=>'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control',
				'placeholder' => 'mail@example.ex', 'required'=>'required',
				'value'=>set_value('email')]); ?>
				<?php echo form_password(['name' => 'reg_password', 'id' => 'reg_password', 
				'class' => 'form-control','placeholder' => 'Contraseña', 'required'=>'required']); ?>
				<?php echo form_password(['name' => 're_password', 'id' => 're_password', 
				'class' => 'form-control','placeholder' => 'Repetir Contraseña', 'required'=>'required']); ?>
				<div>
				<?php echo form_button(['type'=>'submit','content'=>'Crear cuenta','class'=>'btn btn-lg btn-primary btn-block']); ?>
				<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>