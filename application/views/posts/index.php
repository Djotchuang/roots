<div class="page-title">
	<div class="container">
		<h2><?=$title?></h2>
	</div>
</div>
<div class="row">

	<!-- Sidebar -->
	<div class="col-lg-2 col-md-12 sidebar1">
		<div class="sticky-top">
			<div class="post-div1">
				<?php if ($this->session->userdata('logged_in')) : ?>
					<a class="d-flex my-0" href="<?= base_url() ?>users/profile">
						<img src="" class="image avatar-image" alt="user profile image">
						<p class="first-child">username</p>
					</a>
				<?php endif; ?>

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
	</div>

	<!-- Chats -->
	<?php if ($this->session->userdata('logged_in')) : ?>
		<div class="sidebar-chats">
			<div class="chats-title">
				<h6 class="mt-0 pt-2 d-flex"><strong></p></strong>
				</h6>
				<p>200 online</p>
			</div>
			<div class="chat-data">
				<h6><strong>CONTACTS</strong></h6>
				<div class="d-flex my-0" href="#">
					<span class="d-flex">
						<img src="" class="image avatar-image" alt="user profile image">
						<p><?php echo ellipsize('Karl Djotchuang Tamo', 20); ?></p>
					</span>
					<span class="circle ml-auto"></span>
				</div>
				<div class="d-flex my-0" href="#">
					<span class="d-flex">
						<img src="" class="image avatar-image" alt="user profile image">
						<p><?php echo ellipsize('Djotchuang Tamo', 20); ?></p>
					</span>
					<span class="circle ml-auto"></span>
				</div>
				<div class="d-flex my-0" href="#">
					<span class="d-flex">
						<img src="" class="image avatar-image" alt="user profile image">
						<p><?php echo ellipsize('username', 20); ?></p>
					</span>
					<span class="circle ml-auto"></span>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!-- Chat Box -->
	<div class="page-content page-container" id="page-content">
		<div class="padding">
			<div class="row container d-flex justify-content-center">
				<div class="card card-bordered">
					<div class="card-header">
						<a href="<?= base_url() ?>users/profile" class="d-flex">
							<h4 class="card-title"><strong><?php echo ellipsize(ucwords('karl djotchuang tamo'), 20); ?></strong></h4>
							<span class="rounded"></span>
						</a>
						<small class="closeBtn">X</small>
					</div>
					<div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:400px !important;">
						<div class="media media-chat"> <img class="chatbox-avatar" src="<?php echo base_url('/assets/images/avatar/noimage.jpg'); ?>" alt="...">
							<div class="media-body">
								<p>Hi</p>
								<p>How are you ...???</p>
								<p>What are you doing tomorrow?<br> Can we come up a bar?</p>
								<p class="meta"><time datetime="2018">23:58</time></p>
							</div>
						</div>
						<div class="media media-meta-day">Today</div>
						<div class="media media-chat media-chat-reverse">
							<div class="media-body">
								<p>Hiii, I'm good.</p>
								<p>How are you doing?</p>
								<p>Long time no see! Tomorrow office. will be free on sunday.</p>
								<p class="meta"><time datetime="2018">00:06</time></p>
							</div>
						</div>
						<div class="media media-chat">
							<img class="chatbox-avatar" src="<?php echo base_url('/assets/images/avatar/noimage.jpg'); ?>" alt="...">
							<div class="media-body">
								<p>Okay</p>
								<p>We will go on sunday? </p>
								<p class="meta"><time datetime="2018">00:07</time></p>
							</div>
						</div>
						<div class="media media-chat media-chat-reverse">
							<div class="media-body">
								<p>That's awesome!</p>
								<p>I will meet you Sandon Square sharp at 10 AM</p>
								<p>Is that okay?</p>
								<p class="meta"><time datetime="2018">00:09</time></p>
							</div>
						</div>
						<div class="media media-chat"> <img class="chatbox-avatar" src="<?php echo base_url('/assets/images/avatar/noimage.jpg'); ?>" alt="...">
							<div class="media-body">
								<p>Okay i will meet you on Sandon Square </p>
								<p class="meta"><time datetime="2018">00:10</time></p>
							</div>
						</div>
						<div class="media media-chat media-chat-reverse">
							<div class="media-body">
								<p>Do you have pictures of Matley Marriage?</p>
								<p class="meta"><time datetime="2018">00:10</time></p>
							</div>
						</div>
						<div class="media media-chat"> <img class="chatbox-avatar" src="<?php echo base_url('/assets/images/avatar/noimage.jpg'); ?>" alt="...">
							<div class="media-body">
								<p>Sorry I don't have. i changed my phone.</p>
								<p class="meta"><time datetime="2018">00:12</time></p>
							</div>
						</div>
						<div class="media media-chat media-chat-reverse">
							<div class="media-body">
								<p>Okay then see you on sunday!!</p>
								<p class="meta"><time datetime="2018">00:12</time></p>
							</div>
						</div>

					</div>
					<div id="write" class="publisher bt-1 border-light">
						<img class="chatbox-avatar avatar-xs" src="<?php echo base_url('/assets/images/avatar/noimage.jpg'); ?>" alt="...">
						<input class="publisher-input" type="text" placeholder="Write something">
						<span class="publisher-btn file-group text-info">
							<i class="fa fa-paperclip file-browser"></i> <input type="file">
						</span>
						<a class="publisher-btn text-info" href="#" data-abc="true"><i class="fa fa-smile"></i></a>
						<a class="publisher-btn text-info" href="#" data-abc="true"><i class="fa fa-paper-plane"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Posts Section -->
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
								<?php if ($this->session->userdata('logged_in')) : ?>
									<a href="<?= base_url(); ?>users/fetch_user/<?= $post['id']; ?>">
										<img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
										<?php echo ucfirst($post['username']); ?>
									</a>
								<?php else : ?>
									<a href="<?= base_url(); ?>users/login">
										<img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
										<?php echo ucfirst($post['username']); ?>
									</a>
								<?php endif; ?>
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
				<?php if ($this->session->userdata('logged_in')) : ?>
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
				<?php endif; ?>
				<section class="latest-post">
					<h5>Recent Posts</h5>
					<?php foreach ($latests as $latest) : ?>
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
								<input value="<?= $post['pid']; ?>" type="hidden" class="count_input">
								<p><span class="count"></span></p>
							</div>
							<hr class="separator">
						</div>
					<?php endforeach; ?>

				</section>
			</aside>
		</div>
	</div>
</div>