<?php echo form_open('users/reset_password'); ?>
<div class="reset_password">
    <h2 class="text-center"><?php echo $title; ?></h2>
    <small><?php echo validation_errors(); ?></small>
    <div class="form-group">
        <label for="email">Enter your email below and we'll send you a link to reset your password</label>
        <input type="text" name="email" class="form-control" placeholder="Enter Email" minlength="6" maxlength="32" required autofocus>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-danger btn-block">Send Link</button>
    </div>
</div>
<?php echo form_close(); ?>