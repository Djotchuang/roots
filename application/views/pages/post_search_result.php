<div class="page-title">
    <div class="container">
        <h2><?= $title; ?></h2>
    </div>
</div>

<div class="post-search-result">
    <aside class="sidebar">
        <section class="latest-post">
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