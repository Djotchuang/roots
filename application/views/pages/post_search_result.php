<div class="page-title">
    <div class="container-fluid">
        <h2><?= $title; ?></h2>
    </div>
</div>

<div class="post-search-result">
    <div class="row">
        <?php foreach ($search as $row) : ?>
            <?php if ($row) : ?>
                <div class="col-md-3 post-search">
                    <a href="<?php echo site_url('/posts/' . $row['slug']); ?>">
                        <div class="card w-90">
                            <img class="search-post-img card-img-top" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $row['post_image']; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h6 class="card-title post-title mt-0"><?php echo ucfirst($row['title']); ?></h6>
                                <p class="post-body"><?php echo word_limiter($row['body'], 10); ?></p>
                                <span class=" mt-2 d-flex">
                                    <p><?php echo date("M d, Y", strtotime($row['created_at'])) . '&nbsp;'; ?></p>
                                    <p>/ <?= $counts ?> comments</p>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach ?>
    </div>
</div>