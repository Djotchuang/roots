<div class="page-title">
	<div class="container">
		<h2>Posts</h2>
	</div>
</div>

<div class="row">
	<div class="col-lg-9 col-md-12 post view-content">
		<a href="<?php echo site_url('/posts/' . $post['slug']); ?>?>">
			<img class="post-thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
		</a>
		<a href="<?php echo site_url('/posts/' . $post['slug']); ?>?>">
			<h4 class="post-title"><?php echo ucfirst($post['title']); ?></h4>
		</a>
		<hr class="separator">
		<div class="meta-data">
			<a href="<?= base_url(); ?>users/fetch_user/<?= $post['pid']; ?>">
				<span>
					<img src="<?php echo $post['avatar']; ?>" class="post-avatar" alt="user profile image">
					<p><?php echo ucfirst($post['username']); ?> </p>
				</span>
			</a>
			<span>
				<ion-icon name="alarm-outline"></ion-icon>
				<p><?php echo date("M d, Y", strtotime($post['created_at'])); ?> </p>
			</span>
			<span>
				<ion-icon name="earth-outline"></ion-icon>
				<p><?php echo $post['cname']; ?></p>
			</span>
			<span>
				<ion-icon name="chatbubbles-outline"></ion-icon>
				<p>0 Comments </p>
			</span>
		</div>
		<p><?php echo ucfirst($post['body']); ?></p>
		<hr class="separator">
		<?php if ($this->session->userdata('user_id') == $post['id']) : ?>
			<div class="buttons">
				<a class="btn btn-primary pull-left edit" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit</a>
				<?php echo form_open('/posts/delete/' . $post['pid']); ?>
				<input class="btn btn-danger pull-right" type="submit" value="Delete" class="btn btn-danger">
				</form>
			</div>
			<hr class="separator">
		<?php endif; ?>
		<div class="comment-heading">
			<h5>COMMENTS</h5>
		</div>
		<?php if ($comments) : ?>
			<?php foreach ($comments as $comment) : ?>
				<div class="comment-details">
					<div class="comment-info">
						<img id='user-avatar' src="<?php echo $comment['avatar']; ?>" class="comment-avatar" alt="user profile image">
						<span>
							<h5><?php echo ucfirst($comment['username']); ?> &nbsp;</h5>
							<p><?php echo $comment['body']; ?></p>
						</span>
					</div>
				</div>
				<hr class="separator">
			<?php endforeach; ?>
		<?php else : ?>
			<p>There are no comments</p>
		<?php endif; ?>
		<?php if ($this->session->userdata('logged_in')) : ?>
			<div class="comment-heading">
				<h5>Leave a Reply</h5>
			</div>
			<?php echo validation_errors(); ?>
			<?php echo form_open('comments/create/' . $post['pid']); ?>
			<div class="form-group">
				<textarea id="comment-body" name="body" class="form-control" rows="4" placeholder="Write your comment here"></textarea>
			</div>
			<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
			<button class="btn btn-primary submit-btn float-right" type="submit">Post Comment</button>
			<br>
			</form>
		<?php endif; ?>
	</div>

	<!-- People Nearby -->
	<div class="col-lg-3 col-md-12 nearby-sidebar">
		<aside class="sidebar">
			<section class="latest-post">
				<h4 id="people_nearby_text">People Nearby</h4>
				<div id="people_nearby" class="nearby-meta-data">
				</div>
			</section>
		</aside>
	</div>
</div>