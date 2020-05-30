<?php echo form_open('users/login'); ?>
<div class="row">
	<div class="col-md-4 col-md-offset-4" id="form-center">
		<h1 class="text-center"><?php echo $title; ?></h1>
		<div class="form-group">
			<input type="text" name="username" class="form-control" placeholder="Enter Username" required autofocus>
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>
		</div>
		<div class="small">Forgot password? <a href="reset_password">Click Here</a></div><br>
		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block">Login</button>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
<div class="text-center small" style="color: #67428b;">Don't have an account?
	<a href="register">Register</a>
</div>