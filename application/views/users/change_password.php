<?php echo form_open('users/update_password'); ?>
<div class="change_password">
    <h2 class="text-center"><?php echo $title; ?></h2><br>
    <div class="form-group">
        <input type="text" name="newpassword" class="form-control" placeholder="New Password" minlength="6" maxlength="32" required autofocus>
    </div>
    <div class="form-group">
        <input type="text" name="password2" class="form-control" placeholder="Confirm Password" minlength="6" maxlength="32" required autofocus>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Change Password</button>
    </div>
</div>
<?php echo form_close(); ?>