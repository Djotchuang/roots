<?php echo form_open('users/login'); ?>
<div class="login_form">
	<h2 class="text-center"><?php echo $title; ?></h2><br>
	<div class="form-group">
		<input type="text" name="username" class="form-control" placeholder="Enter Username" required autofocus>
	</div>
	<div class="form-group">
		<input type="password" name="password" class="form-control" placeholder="Enter Password" minlength="6" maxlength="32" required autofocus>
	</div>
	<div>Forgot password? <a href="reset_password">Click Here</a></div><br>
	<div class="form-group">
		<button type="submit" class="btn btn-primary btn-block">Login</button>
	</div>
	<div class="text-center" style="color: #67428b;">Don't have an account?
		<a href="register">Register</a>
	</div>
</div>
<?php echo form_close(); ?>