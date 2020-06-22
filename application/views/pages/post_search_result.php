<div class="page-title">
    <div class="container">
        <h2><?= $title; ?></h2>
    </div>
</div>

<div class="post-search-result">
    <aside class="sidebar">
        <section class="latest-post">
            <?php foreach($search as $row) : ?>
            <div class="post-data">
                <div class="post-info">
                    <img class="post-thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $row['post_image']; ?>">
                    <a href="<?php echo site_url('/posts/' . $row['slug']); ?>?>">
                        <h6 class="post-title"><?php echo ucfirst($row['title']); ?></h6>
                    </a>
                </div>
                <div class="meta-data d-flex justify-content-between">
                    <p class="ml-auto">
                        <?php echo date("M d, Y", strtotime($row['created_at'])) . '&nbsp;'; ?>
                    </p>
                    <p>/ <?=$counts?></p>
                </div>
            </div>
            <hr class="separator">
            <?php endforeach?>
        </section>
    </aside>
</div>