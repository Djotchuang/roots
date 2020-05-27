<h2 class="title"><?php echo $post['title']; ?></h2>
<small class="post-date">Posted on: <?php echo $post['created_at']; ?></small><br>
<img id="post-card-lg" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
<div class="post-body">
	<?php echo $post['body']; ?>
</div>

<?php if ($this->session->userdata('user_id') == $post['user_id']): ?>
	<hr>
	<a class="btn btn-primary pull-left" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit</a>
	<?php echo form_open('/posts/delete/' . $post['pid']); ?>
		<input class="btn btn-danger pull-right" id="btn-delete" type="submit" value="Delete" class="btn btn-danger">
	</form>
<?php endif;?>
<hr>
<h3>Comments</h3>
<?php if ($comments): ?>
	<?php foreach ($comments as $comment): ?>
	<div class="" >
            <img src="<?php echo $comment['avatar']; ?>" id="post-image-two" class="img-circle avatar" alt="user profile image">
    </div>	
	<div class="well">
			<h5><strong><?php echo $comment['username']; ?> &nbsp;</strong><?php echo $comment['body']; ?></h5>
		</div>
	<?php endforeach;?>
<?php else: ?>
	<p>No Comments To Display</p>
<?php endif;?>
<hr>
<h3>Add Comment</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('comments/create/' . $post['pid']); ?>
	<div class="form-group">
		<textarea id="comment-body" name="body" class="form-control" placeholder="Write your comment here"></textarea>
	</div>
	<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
	<button class="btn btn-primary" type="submit">Submit</button>
</form>
