<div class="page-title">
	<div class="container">
		<h2><?=$title?></h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-2 col-md-12 sidebar1">
		<div class="post-div1 sticky-top">
			<?php if ($this->session->userdata('logged_in')): ?>
				<a class="d-flex my-0" href="<?=base_url()?>users/profile">
					<img src="" class="image avatar-image" alt="user profile image">
					<p class="first-child">username</p>
				</a>
			<?php endif;?>

			<a class="d-flex" href="<?php echo base_url(); ?>">
				<ion-icon name="home-outline" class="image"></ion-icon>
				<p>Home</p>
			</a>

			<a class="d-flex" href="<?php echo base_url(); ?>posts">
				<ion-icon name="duplicate-outline" class="image"></ion-icon>
				<p>Newsfeed</p>
			</a>

			<a class="d-flex" href="<?php echo base_url(); ?>posts/categories">
				<ion-icon name="list-outline" class="image"></ion-icon>
				<p>Categories</p>
			</a>

			<a class="d-flex" href="<?php echo base_url(); ?>countries">
				<ion-icon name="earth-outline" class="image"></ion-icon>
				<p>Countries</p>
			</a>
		</div>
	</div>

	<div class="col-lg-7 col-md-12">
		<div class="post-div2">
			<?php foreach ($posts as $post): ?>
				<div class="row">
					<div class="col-md-5">
						<a href="<?php echo site_url('posts/' . $post['slug']); ?>?>">
							<img class="post-thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
						</a>

					</div>
					<div class="col-md-7 post-content">
						<div class="post-top mb-2 d-flex justify-content-between">
							<h5>
								<a class="btn btn-full post-btn" href="<?php echo site_url('/countries/posts/' . $post['country_id']); ?>">
									<?php echo $post['cname']; ?>
								</a>
							</h5>
							<h5 class="ml-auto">
								<a class="btn btn-full post-btn" href="#">category</a>
							</h5>
						</div>
						<a href="<?php echo site_url('/posts/' . $post['slug']); ?>?>">
							<h4 class="post-title"><?php echo ucfirst($post['title']); ?></h4>
						</a>
						<p><?php echo word_limiter($post['body'], 20); ?></p>
						<hr class="separator">
						<div class="meta-data d-flex justify-content-between">
							<div class="like">
								<ion-icon name="thumbs-up-outline"></ion-icon>
								<p class="mr-auto"></p>
							</div>
							<div class="index-comment">
								<ion-icon name="chatbubbles-outline"></ion-icon>
								<p class="mr-auto"> 0 Comments </p>
							</div>
							<div>
								<p class="pull-right"><?php echo time_elapsed_string($post['created_at']); ?></p>
							</div>
						</div>

						<div class="comment-details index-comment-details">
							<div class="comment-info">
								<img src="" class="comment-avatar avatar-image" alt="user profile image">
								<span>
									<h6>Joachim &nbsp;</h6>
									<p>Karl is doing this just to test</p>
								</span>
							</div>

							<div class="comment-info">
								<img src="" class="comment-avatar avatar-image" alt="user profile image">
								<span>
									<h6>Joachim &nbsp;</h6>
									<p>Karl is doing this just to test</p>
								</span>
							</div>

							<div class="comment-info">
								<img src="" class="comment-avatar avatar-image" alt="user profile image">
								<span>
									<h6>Joachim &nbsp;</h6>
									<p>Karl is doing this just to test</p>
								</span>
							</div>

							<div class="comment-info">
								<img src="" class="comment-avatar avatar-image" alt="user profile image">
								<span>
									<h6>Joachim &nbsp;</h6>
									<p>Karl is doing this just to test</p>
								</span>
							</div>

							<div class="comment-info">
								<img src="" class="comment-avatar avatar-image" alt="user profile image">
								<span>
									<h6>Joachim &nbsp;</h6>
									<p>Karl is doing this just to test</p>
								</span>
							</div>
							<?php if ($this->session->userdata('logged_in')): ?>
								<div class="form-group index-comment2">
									<textarea name="body" class="md-textarea form-control index-comment-body" placeholder="comment"></textarea>
									<button class="btn float-right" type="submit">post</button>
								</div>
							<?php endif;?>
						</div>
						<hr class="separator">

						<div class="meta-data">
							<small>Posted by
								<img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
								<a href="<?=base_url();?>users/fetch_user/<?=$post['id'];?>">
									<?php echo ucfirst($post['username']); ?>
								</a>
							</small>
						</div>
					</div>
				</div>
				<hr class="separator"><br>
			<?php endforeach;?>
			<div class="pagination-links">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>

	<!-- People Nearby -->
	<div class="col-lg-3 col-md-12 nearby-sidebar">
		<div class="post-div3 sticky-top">
			<br>
			<aside class="sidebar">
				<section class="search-bar">
					<form action="<?=base_url();?>users/fetch" method="post" class="form-inline">
						<input name="search" class="form-control mr-2 text-black search-input" type="text" placeholder="Search">
						<button class="search-button" id="search-bar-btn" type="submit">
							<ion-icon name="search-outline"></ion-icon>
						</button>
					</form>
				</section>
				<section class="people-nearby">
					<h5>People Nearby</h5>
					<?php foreach ($peoples as $people): ?>
					<div id="people_nearby" class="nearby-meta-data">
						<img src="<?php echo $people['avatar']; ?>" class="nearby-avatar avatar-image" alt="user profile image">
						<a href="<?=base_url();?>users/fetch_user/<?=$people['id'];?>">
							<?php echo ucfirst($people['username']); ?>
						</a>
					</div>
					<?php endforeach?>
					<hr class="separator">
				</section> <br>
				<section class="latest-post">
					<h5>Recent Posts</h5>
					<?php foreach ($latests as $latest): ?>
					<div class="post-data">
						<div class="post-info">
							<img class="post-thumbnail" src="<?php echo site_url(); ?>uploads/<?php echo $latest['post_image']; ?>">
							<a href="<?php echo site_url('/posts/' . $latest['slug']); ?>?>">
								<h6 class="post-title"><?php echo ucfirst($latest['title']); ?></h6>
							</a>
						</div>
						<div class="meta-data d-flex justify-content-between">
							<p class="ml-auto">

								<?php echo time_elapsed_string($post['created_at']) . '&nbsp;'; ?>

							</p>
							<input value="<?=$post['pid']?>" type="hidden" class="count_input">
						<p><span class="count"></span></p>
						</div>
						<hr class="separator">
					</div>
                   <?php endforeach;?>
				</section>
			</aside>
		</div>
	</div>
</div>