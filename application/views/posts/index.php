<div class="page-title">
	<div class="container">
		<h2><?= $title ?></h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-9 col-md-12 post">
		<?php foreach ($posts as $post) : ?>
			<div class="row">
				<div class="col-md-5 col-sm-12">
					<a href="<?php echo site_url('/posts/' . $post['slug']); ?>?>">
						<img class="post-thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
					</a>
				</div>
				<div class="col-md-7 post-content">
					<h5><?php echo $post['cname']; ?></h5>
					<a href="<?php echo site_url('/posts/' . $post['slug']); ?>?>">
						<h4 class="post-title"><?php echo ucfirst($post['title']); ?></h4>
					</a>
					<p><?php echo word_limiter($post['body'], 20); ?></p>
					<hr class="separator">
					<div class="meta-data d-flex justify-content-between">
						<ion-icon name="chatbubbles-outline"></ion-icon>
						<p class="mr-auto">0 Comments</p>
						<p class="pull-right"><?php echo date("M d, Y", strtotime($post['created_at'])); ?></p>
					</div>
					<div class="meta-data">
						<small>Posted by
							<img src="<?php echo $post['avatar']; ?>" class="post-avatar" alt="user profile image">
							<a href="<?= base_url(); ?>users/fetch_user/<?= $post['id']; ?>">
								<?php echo ucfirst($post['username']); ?>
							</a>
						</small>
					</div>
				</div>
			</div>
			<hr class="separator"><br>
		<?php endforeach; ?>
		<div class="pagination-links">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>

	<!-- People Nearby -->
	<div class="col-lg-3 col-md-12 nearby-sidebar">
		<aside class="sidebar">
			<section class="latest-post">
				<h4>People Nearby</h4>
				<div class="nearby-meta-data">
					<img src="<?php echo $post['avatar']; ?>" class="nearby-avatar" alt="user profile image">
					<a href="<?= base_url(); ?>users/fetch_user/<?= $post['id']; ?>">
						<?php echo ucfirst($post['username']); ?>
					</a>
				</div>
			</section>
		</aside>
	</div>
</div>