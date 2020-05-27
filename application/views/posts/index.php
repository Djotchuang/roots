<h2 class="title"><?= $title ?></h2>
<?php foreach($posts as $post) : ?>
	<h3 id="post-title" class="post-title"><?php echo $post['title']; ?></h3>
	<div class="row" id="row">
		<div class="col-md-5">
			<img class="post-thumb" id="post-card" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
			<div class="pull-left image" >
                    <img src="<?php echo $post['avatar']; ?>" id="post-image" class="img-circle avatar" alt="user profile image">
            </div>
           <div class="title h5" id="post-name">
             <a href="<?=base_url();?>users/fetch_user/<?=$post['id'];?>"><b><?php echo $post['username']; ?></b></a>
                        made a post.
           </div>
		</div>
		<div class="col-md-7">
			<small class="post-date">Posted on: <?php echo $post['created_at']; ?> in <strong><?php echo $post['cname']; ?></strong></small><br>
		<?php echo word_limiter($post['body'], 60); ?>
		<br><br>
		<p><a class="btn btn-default" href="<?php echo site_url('/posts/'.$post['slug']); ?>">Read More</a></p>
		</div>
	</div>
<?php endforeach; ?>
<div class="pagination-links">
		<?php echo $this->pagination->create_links(); ?>
</div>