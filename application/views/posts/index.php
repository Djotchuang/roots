<div class="page-title">
	<div class="container">
		<h2><?= $title ?></h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-9 col-md-12 post">
		<?php foreach ($posts as $post) : ?>
			<div class="row">
				<div class="col-md-5">
					<a href="<?php echo site_url('posts/' . $post['slug']); ?>?>">
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
							<img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
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
		<div class="sticky-top">
			<br>
			<aside class="sidebar">
				<section class="search-bar">
					<form action="<?= base_url(); ?>users/fetch" method="post" class="form-inline">
						<input id="input-form" name="search" class="form-control mr-2 text-black search-input" type="text" placeholder="Search">
						<button class="search-button" id="search-bar-btn" type="submit">
							<ion-icon name="search-outline"></ion-icon>
						</button>
					</form>
				</section>
				<section class="people-nearby">
					<h5>People Nearby</h5>
					<div class="nearby-meta-data">
						<img src="<?php echo $post['avatar']; ?>" class="nearby-avatar avatar-image" alt="user profile image">
						<a href="<?= base_url(); ?>users/fetch_user/<?= $post['id']; ?>">
							<?php echo ucfirst($post['username']); ?>
						</a>
					</div>
					<hr class="separator">
				</section> <br>
				<section class="latest-post">
					<h5>Recent Posts</h5>
					<div class="post-data">
						<div class="post-info">
							<img class="post-thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
							<a href="<?php echo site_url('/posts/' . $post['slug']); ?>?>">
								<h6 class="post-title"><?php echo ucfirst($post['title']); ?></h6>
							</a>
						</div>
						<div class="meta-data d-flex justify-content-between">
							<p class="ml-auto">
								<?php echo date("M d, Y", strtotime($post['created_at'])) . '&nbsp;'; ?>
							</p>
							<p>/ 0 Comments</p>
						</div>
					</div>
					<hr class="separator">
				</section>
			</aside>
		</div>

	</div>
</div>