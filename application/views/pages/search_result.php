<div class="flex-wrapper">
  <div class="page-title">
    <div class="container-fluid">
      <h2><?= $title; ?></h2>
    </div>
  </div>
  <?php foreach ($search as $row) : ?>
    <div class="search-info">
      <img id="post-img" src="<?php echo $row['avatar']; ?>" alt="" data-control-key="primary_details">
      <span>
        <h6 class="name"><span dir="ltr"><?= $row['username']; ?></span></h6>
        <div class="medium-dark truncate-line headline"><span dir="ltr"><?= $row['occupation']; ?></span></div>
        <dd class="location small"><span><?= $row['country']; ?></span></dd>
      </span>
    </div>
    <hr class="separator">
  <?php endforeach; ?>
</div>