<div class="page-title">
    <div class="container">
        <h2><?= $title; ?></h2>
    </div>
</div>

<div class="post-search-result">
    <aside class="sidebar">
        <section class="latest-post">
            <?php foreach ($search as $row) : ?>
                <div class="post-data">
                    <div class="post-info">
                        <a href="<?php echo site_url('/posts/' . $row['slug']); ?>?>">
                            <img class="post-thumbnail mr-3" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $row['post_image']; ?>">
                            <h6 class="post-title"><?php echo ucfirst($row['title']); ?></h6>
                        </a>

                        <div class="meta-data d-flex justify-content-between">
                            <p class="post-body"><?php echo word_limiter($row['body'], 70); ?></p>
                            <p class="ml-auto">
                                <?php echo date("M d, Y", strtotime($row['created_at'])) . '&nbsp;'; ?>
                            </p>
                            <p>/ <?= $counts ?> comments</p>
                        </div>
                    </div>
                </div>
                <hr class="separator">
            <?php endforeach ?>
        </section>
    </aside>
</div>