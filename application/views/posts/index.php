<div class="page-title">
	<div class="container">
		<h2><?= $title ?></h2>
	</div>
</div>
<div class="loader"></div>
<div class="row">
	<!-- Sidebar -->
	<div class="col-lg-2 col-md-12 sidebar1">
		<div class="sticky-top">
			<div class="post-div1">
				<?php if ($this->session->userdata('logged_in')) : ?>
					<?php foreach ($profiles as $profile) : ?>
						<?php if ($this->session->userdata('user_id') == $profile['id']) : ?>
							<a class="d-flex my-0" href="<?= base_url() ?>users/profile">
								<img src="<?= $profile['avatar'] ?>" class="image avatar-image" alt="user profile image">
								<p class="first-child"><?= $profile['username'] ?></p>
							</a>
						<?php endif; ?>
					<?php endforeach ?>
				<?php endif; ?>

				<a class="d-flex" href="<?php echo base_url(); ?>">
					<ion-icon name="home-outline" class="image"></ion-icon>
					<p>Home</p>
				</a>

				<a class="d-flex" href="<?php echo base_url(); ?>posts">
					<ion-icon name="duplicate-outline" class="image"></ion-icon>
					<p>Newsfeed</p>
				</a>

				<a class="d-flex" href="<?php echo base_url(); ?>categories">
					<ion-icon name="list-outline" class="image"></ion-icon>
					<p>Categories</p>
				</a>

				<a class="d-flex" href="<?php echo base_url(); ?>countries">
					<ion-icon name="earth-outline" class="image"></ion-icon>
					<p>Countries</p>
				</a>
			</div>
			<?php if ($this->session->userdata('logged_in')) : ?>
				<div class="pinned-posts">
					<p class="pin-title"> Pinned Posts </p>
					<div class="post-data" id="pin_post">
						<?php foreach ($pinposts as $pinpost) : ?>
							<div class="post-info">
								<a href="<?php echo site_url('/posts/' . $pinpost['pin_slug']); ?>">
									<h6 class="post-title"><?php echo ellipsize(ucfirst($pinpost['pin_title']), 39); ?></h6>
								</a>
							</div>
							<div class="pin-meta meta-data d-flex justify-content-between">
								<button class="mr-1 unpin-post" data-id="<?= $pinpost['id'] ?>">unpin</button>
								<p class="ml-auto">
									<?php echo time_elapsed_string(strtotime($pinpost['pin_time'])) . '&nbsp;'; ?>
									<?php //echo strtotime($pinpost['pin_time']); 
									?>
								</p>
							</div>
							<hr class="separator">
						<?php endforeach ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- Posts Section -->
	<div class="col-lg-7 col-md-12">
		<div class="post-div2">
			<?php foreach ($posts as $post) : ?>
				<div class="row post">
					<div class="col-md-5">
						<a href="<?php echo site_url('posts/' . $post['slug']); ?>">
							<img class="post-thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
						</a>
					</div>

					<div class="col-md-7 post-content" id="post-<?= $post['pid'] ?>">
						<div class="post-top mb-2 d-flex justify-content-between">
							<h5>
								<a class="btn btn-full post-btn" href="<?php echo site_url('/countries/posts/' . $post['country_id']); ?>">
									<?php echo $post['cname']; ?>
								</a>
							</h5>
							<h5 class="ml-auto">
								<a class="btn btn-full post-btn" href="<?php echo site_url('/categories/posts/' . $post['category_id']); ?>"> <?= $post['ca_name']; ?> </a>
							</h5>
						</div>
						<a href="<?php echo site_url('/posts/' . $post['slug']); ?>">
							<h4 class="post-title"><?php echo ucfirst($post['title']); ?></h4>
						</a>
						<p><?php echo word_limiter($post['body'], 20); ?></p>
						<hr class="separator">
						<div class="meta-data d-flex justify-content-between check">
							<button class="like" id="lik-<?= $post['pid'] ?>" data-pid="<?= $post['pid'] ?>" data-id="<?= $post['id'] ?>">
								<ion-icon name="thumbs-up-outline"></ion-icon>
								<p class="mr-auto upvotes" id="upvotes-<?= $post['pid'] ?>"></p>
								<!-- <p>upvote(s)</p> -->
							</button>
							<button class="dislike" id="dis-<?= $post['pid'] ?>" data-pid="<?= $post['pid'] ?>" data-id="<?= $post['id'] ?>">
								<ion-icon name="thumbs-down-outline"></ion-icon>
								<p class="mr-auto downvotes" id="downvotes-<?= $post['pid'] ?>"></p>
								<!-- <p>downvote(s)</p> -->
							</button>
							<?php if ($this->session->userdata('logged_in')) : ?>
								<button class="pin-post" id="pin-<?= $post['pid'] ?>" data-pid="<?= $post['pid'] ?>" data-id="<?= $post['id'] ?>" data-title="<?= $post['title'] ?>" data-slug="<?= $post['slug'] ?>">
									<ion-icon name="eyedrop-outline"></ion-icon>
									<p>Pin</p>
								</button>
							<?php endif; ?>
							<div class="index-comment" data-id="<?= $post['pid']; ?>">
								<ion-icon name="chatbubbles-outline"></ion-icon>
								<p class="mr-auto" id="count-<?= $post['pid'] ?>"></p>
							</div>
							<div>
								<p class="pull-right"><?php echo time_elapsed_string(strtotime($post['created_at'])); ?></p>
							</div>
						</div>

						<div class="comment-details index-comment-details">
							<div class="all-comments" id="comments-<?= $post['pid']; ?>">
							</div>
							<?php if ($this->session->userdata('logged_in')) : ?>
								<?= form_open('comments/index_create/' . $post['pid']) ?>
								<div class="form-group index-comment2">
									<textarea name="body" class="md-textarea form-control index-comment-body" placeholder="comment"></textarea>
									<button class=" index-comment-postbtn btn float-right" type="submit">post</button>
								</div>
								</form>
							<?php endif; ?>
						</div>
						<hr class="separator">

					</div>
					<div class="post-content post-creator">
						<span class="d-flex nviews">
							<small class="d-flex">
								<p>100</p>
								<p>&nbsp;views</p>
							</small>
						</span>
						<div class="meta-data d-flex">
							<small>Posted by
								<?php if ($this->session->userdata('logged_in')) : ?>
									<a href="<?= base_url(); ?>users/fetch_user/<?= $post['id']; ?>">
										<img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
										<?php echo ucfirst($post['username']); ?>
									</a>
								<?php else : ?>
									<a href="<?= base_url(); ?>users/login">
										<img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
										<?php echo ellipsize($post['username'], 10); ?>
									</a>
								<?php endif; ?>
							</small>
							<?php if ($this->session->userdata('user_id') == $post['id']) : ?>
								<div class="chat-btn ml-auto">
									<p>&nbsp;&nbsp;&nbsp;</p>
								</div>
							<?php else : ?>
								<div class="ml-auto user-trigger" data-id="<?= $post['id'] ?>" data-name="<?= $post['username'] ?>" data-avatar="<?= $post['avatar'] ?>">
									<ion-icon class="m-1" name="mail-outline"></ion-icon>
									<p>Chat with <strong class="chat-btn-txt"><?= ellipsize($post['username'], 10) ?></strong></p>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<hr class="separator"><br>
			<?php endforeach; ?>
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
					<form action="<?= base_url(); ?>posts/fetch" method="post" class="form-inline">
						<input name="post_search" class="form-control mr-2 text-black search-input" type="text" placeholder="Search post">
						<button class="search-button" id="search-bar-btn" type="submit">
							<ion-icon name="search-outline"></ion-icon>
						</button>
					</form>
				</section>
				<?php if ($this->session->userdata('logged_in')) : ?>
					<section class="people-nearby">
						<h5>People Nearby</h5>
						<?php foreach ($peoples as $people) : ?>
							<div class="nearby-meta-data">
								<img src="<?php echo $people['avatar']; ?>" class="nearby-avatar avatar-image" alt="user profile image">
								<a href="<?= base_url(); ?>users/fetch_user/<?= $people['id']; ?>">
									<?php echo ucfirst($people['username']); ?>
								</a>
							</div>
						<?php endforeach; ?>
					</section> <br>
				<?php endif; ?>
				<section class="latest-post">
					<h5>Recent Posts</h5>
					<?php foreach ($latests as $latest) : ?>
						<div class="post-data">
							<div class="post-info">
								<a href="<?php echo site_url('/posts/' . $latest['slug']); ?>">
									<h6 class="post-title"><?php echo ellipsize(ucfirst($latest['title']), 55); ?></h6>
								</a>
							</div>
							<div class="meta-data d-flex justify-content-between">
								<p class="ml-auto">
									<?php echo time_elapsed_string(strtotime($latest['created_at'])) . '&nbsp;'; ?>
								</p>
								<input value="<?= $latest['pid']; ?>" type="hidden" class="count_input">
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

<!-- Chats -->
<?php if ($this->session->userdata('logged_in')) : ?>
	<div class="sidebar-chats">
		<div class="chats-title">
			<h6 class="mt-0 pt-2 d-flex"><strong></strong>
			</h6>
			<!-- <p>Your Chats</p> -->
		</div>
		<div class="chat-data">
			<div class="chat-data-items"></div>
		</div>
	</div>

	<!-- Chat Box -->
	<div class="page-content page-container" id="page-content">
		<div class="padding">
			<div class="row container d-flex justify-content-center">
				<div class="card card-bordered" id="chat-card" data-id="<?= $profile['id'] ?>">
					<div class="card-header d-flex">
						<div id="chat-avatar"></div>
						<div id="chat-id"></div>
						<span class="d-flex mr-auto">
							<h4 class="card-title"><strong class="chat-box-title"></strong></h4>
							<span class="rounded"></span>
						</span>
						<button class="closeBtn">close</button>
					</div>
					<div class="ps-container ps-theme-default ps-active-y" id="chat-content-<?= $profile['id'] ?>" style="overflow-y: scroll !important; height:400px !important;"></div>
					<div id="write" class="publisher bt-1 border-light">
						<img class="chatbox-avatar avatar-image avatar-xs" src="<?= $profile['avatar'] ?>" alt="...">
						<input class="publisher-input" id="chat_msg_area" type="text" placeholder="Write something">
						<span class="publisher-btn file-group text-info">
							<i class="fa fa-paperclip file-browser"></i> <input type="file">
						</span>
						<button class="publisher-btn text-info" data-abc="true" id="chat-submit"><i class="fa fa-paper-plane"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>