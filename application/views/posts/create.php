<h2 class="title" id="title"><?= $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('posts/create'); ?>
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" placeholder="Add Title">
  </div>
  <div class="form-group">
    <label>Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add Body"></textarea>
  </div>
  <div class="form-group">
	  <label>country</label>
	  <select name="country_id" class="form-control">
		  <?php foreach($countries as $country): ?>
		  	<option value="<?php echo $country['id']; ?>"><?php echo $country['cname']; ?></option>
		  <?php endforeach; ?>
	  </select>
  </div>
  <div class="form-group">
	  <label>Upload Image</label>
	  <input class="btn btn-primary" type="file" name="userfile" size="20">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>