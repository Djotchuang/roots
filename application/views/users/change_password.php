<?php echo form_open('users/update_password'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4" id="form-center">
        <h1 class="text-center"><?php echo $title; ?></h1>
        <div class="form-group">
            <input type="text" name="newpassword" class="form-control" placeholder="New Password" required autofocus>
        </div>
        <div class="form-group">
            <input type="text" name="password2" class="form-control" placeholder="Confirm Password" required autofocus>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
        </div>
    </div>
</div>
<?php echo form_close(); ?>