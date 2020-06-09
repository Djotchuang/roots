<div class="page-title">
  <div class="container">
    <h2><?= $title ?></h2>
  </div>
</div>
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
  <label>Categories</label>
  <select name="category" class="form-control">
    <option value="Sports">Sports</option>
    <option value="Football">Football</option>
    <option value="News">News</option>
  </select>
</div>
<div class="form-group">
  <label>Country</label>
  <select name="country_id" class="form-control">
    <?php foreach ($countries as $country) : ?>
      <option value="<?php echo $country['id']; ?>"><?php echo $country['cname']; ?></option>
    <?php endforeach; ?>
  </select>
</div>
<div class="form-group">
  <label>Upload Image</label>
  <input class="btn btn-primary" type="file" name="userfile" size="20" required>
</div>
<div class="form-group">
  <button type="submit" class="btn btn-primary submit-btn">Submit</button>
</div>
</form>