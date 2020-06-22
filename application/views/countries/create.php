<div class="page-title">
	<div class="container">
		<h2><?= $title; ?></h2>
	</div>
</div>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('countries/create', 'class="create-country"'); ?>
<div class="form-group">
	<label>Name</label>
	<input type="text" class="form-control" name="name" placeholder="Enter name">
</div>
<button type="submit" class="btn btn-primary submit-btn">Submit</button>
</form>