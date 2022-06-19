<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container-fluid mt-5 mb-5 bg-success">
	<div class="row justify-content-center align-items-center mt-5 mb-5">
		<div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
			<div id="login" class="card p-2">
				<div class="text-center">
					<h1>Loggin</h1>
				</div>
				<div class="card-body">
					<form name="login" id="login" method="post" accept-charset="utf-8" action="<?= base_url('Login/login')?>" autocomplete="off" role="form" class="form-signin">
						<input class="form-control my-1" placeholder="Usuario" name="usuario" id="usuario" type="text" value="" autofocus="" autocomplete="off" style="font-size: 1.4vw;">

						<input class="form-control my-2" placeholder="Contraseña" name="pass" id="pass" type="password" value="" autocomplete="off" style="font-size: 1.4vw;">

						<button type="submit" class="btn btn-lg btn-block btn-signin my-3 bg-secondary" name="botonlogin" id="botonlogin" style="font-size: 1.5vw;">Ingresar</button>
					</form>
					<?php
						if (isset($respuestalogin)){
							?>
							<div class="alert alert-danger" role="alert">
								<?php echo $respuestalogin; ?>
							</div>
							<?php
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<br/>
