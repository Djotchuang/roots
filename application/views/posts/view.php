<div class="page-title">
	<div class="container-fluid">
		<a href="<?php echo base_url('posts/'); ?>?>">
			<h2>Posts</h2>
		</a>
	</div>
</div>

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
		</div>
	</div>

	<!-- Post Section -->

	<div class="col-lg-7 col-md-12  view-content">
		<div class="post-div2">
			<img class="post-thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
			<h4 class="post-title"><?php echo ucfirst($post['title']); ?></h4>
			<hr class="separator">
			<div class="meta-data">
				<?php if ($this->session->userdata('logged_in')) : ?>
					<a href="<?= base_url(); ?>users/fetch_user/<?= $post['id']; ?>">
						<span>
							<img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
							<p><?php echo ucfirst($post['username']); ?> </p>
						</span>
					</a>
				<?php else : ?>
					<a href="<?= base_url(); ?>users/login">
						<span>
							<img src="<?php echo $post['avatar']; ?>" class="post-avatar avatar-image" alt="user profile image">
							<p><?php echo ucfirst($post['username']); ?> </p>
						</span>
					</a>
				<?php endif; ?>
				<span>
					<ion-icon name="alarm-outline"></ion-icon>
					<p><?php echo time_elapsed_string(strtotime($post['created_at'])); ?> </p>
				</span>
				<a href="<?php echo site_url('/countries/posts/' . $post['country_id']); ?>">
					<span>
						<ion-icon name="earth-outline"></ion-icon>
						<p><?php echo $post['cname']; ?></p>
					</span>
				</a>
				<a href="#">
					<span>
						<ion-icon name="list-outline"></ion-icon>
						<p>Sports</p>
					</span>
				</a>
			</div>
			<p><?php echo ucfirst($post['body']); ?></p>
			<hr class="separator">
			<?php if ($this->session->userdata('user_id') == $post['id']) : ?>
				<div class="buttons">
					<a class="btn btn-primary pull-left edit" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit</a>
					<?php echo form_open('/posts/delete/' . $post['pid']); ?>
					<input class="btn btn-danger pull-right delete-view" type="submit" value="Delete" class="btn btn-danger">
					</form>
				</div>
				<hr class="separator">
			<?php endif; ?>
			<div id="comments" class="comment-heading">
				<h5><strong> COMMENTS (<?= $counts ?>) <ion-icon name="chevron-down-outline"></ion-icon></strong></h5>
			</div>
			<?php if ($comments) : ?>
				<div id="comment-div">
					<?php foreach ($comments as $comment) : ?>
						<div class="comment-details">
							<div class="comment-info">
								<img src="<?php echo $comment['avatar']; ?>" class="comment-avatar avatar-image" alt="user profile image">
								<span class="w-100">
									<h5><?php echo ucfirst($comment['username']); ?> &nbsp;</h5>
									<p class="commentBody"><?php echo $comment['body']; ?></p>
									<?php if ($this->session->userdata('logged_in')) : ?>
										<?php if ($this->session->userdata('user_id') == $comment['user_id']) : ?>
											<div class="form-group index-comment2 editComment">
												<textarea name="body" class="md-textarea form-control index-comment-body"></textarea>
												<button class=" index-comment-postbtn btn float-right" type="submit">update</button>
											</div>
										<?php else : ?>
											<div class="form-group index-comment2">
												<textarea name="body" class="md-textarea form-control index-comment-body" placeholder="write your reply"></textarea>
												<button class=" index-comment-postbtn btn float-right" type="submit">reply</button>
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</span>
								<?php if ($this->session->userdata('logged_in')) : ?>
									<div class="dropdown">
										<ion-icon name="ellipsis-horizontal-outline" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></ion-icon>
										<div class="dropdown-menu">
											<!-- If user session id equals comment id display edit/delete, else display reply -->
											<?php if ($this->session->userdata('user_id') == $comment['user_id']) : ?>
												<a class="dropdown-item editBtn" data-edit_id="<?= $comment['comment_id']; ?>" href="">Edit</a>
												<a class="dropdown-item" href="">Delete</a>
											<?php else : ?>
												<a class="dropdown-item replyBtn" data-reply_id="<?= $comment['comment_id']; ?>" href="">Reply</a>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<hr class="separator">
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<p>There are no comments</p>
			<?php endif; ?>
			<?php if ($this->session->userdata('logged_in')) : ?>
				<div class="comment-heading">
					<h6><strong> Add a Comment </strong></h6>
				</div>
				<?php echo validation_errors(); ?>
				<?php echo form_open('comments/create/' . $post['pid'] . '/#comments'); ?>
				<div class="form-group">
					<textarea name="body" class="md-textarea form-control comment-body" rows="1" placeholder="Write your comment here"></textarea>
				</div>
				<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
				<button class="btn btn-primary submit-btn float-right" type="submit">Post Comment</button>
				<br>
				</form>
			<?php endif; ?>
		</div>
	</div>

	<!-- People Nearby -->
	<div class="col-lg-3 col-md-12 nearby-sidebar">
		<div class="post-div3 sticky-top">
			<br>
			<aside class="sidebar">
				<section class="search-bar">
					<form action="<?= base_url(); ?>users/fetch" method="post" class="form-inline">
						<input name="search" class="form-control mr-2 text-black search-input" type="text" placeholder="Search post">
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
								<a href="<?= base_url(); ?>users/fetch_user/<?= $post['id']; ?>">
									<?php echo ucfirst($people['username']); ?>
								</a>
							</div>
						<?php endforeach; ?>
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
									<?php echo time_elapsed_string(strtotime($latest['created_at'])) . '&nbsp;'; ?>
								</p>
							</div>
						</div>
					<?php endforeach ?>
					<hr class="separator">
				</section>
			</aside>
		</div>

	</div>
</div>