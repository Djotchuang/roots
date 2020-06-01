<div class="page-title">
  <div class="container">
    <h2><?= $title ?></h2>
  </div>
</div>
<?php echo validation_errors(); ?>

<?php echo form_open('posts/update'); ?>
<input type="hidden" name="id" value="<?php echo $post['pid']; ?>">
<div class="form-group">
  <label>Title</label>
  <input type="text" class="form-control" name="title" placeholder="Add Title" value="<?php echo $post['title']; ?>">
</div>
<div class="form-group">
  <label>Body</label>
  <textarea id="editor1" class="form-control" name="body" placeholder="Add Body"><?php echo $post['body']; ?></textarea>
</div>
<div class="form-group">
  <label>Country</label>
  <select name="country_id" class="form-control">
    <?php foreach ($countries as $country) : ?>
      <option value="<?php echo $country['id']; ?>"><?php echo $country['cname']; ?></option>
    <?php endforeach; ?>
  </select>
</div>
<button type="submit" class="btn btn-primary submit-btn">Submit</button>
</form>