<div class="flex-wrapper">
  <div class="page-title">
    <div class="container">
      <h2><?= $title; ?></h2>
    </div>
  </div>
  <?php foreach ($search as $row) : ?>
    <img id="post-img" src="<?php echo $row['avatar']; ?>" alt="" class="profile-path primary-details img-circle avatar" data-control-key="primary_details">
    <h3 class="large-semibold name"><span dir="ltr"><?= $row['username']; ?></span></h3>
    <div class="medium-dark truncate-line headline"><span dir="ltr"><?= $row['occupation']; ?></span></div>
    <dd class="location small"><span><?= $row['country']; ?></span></dd></img>
    <div class="line"></div>
  <?php endforeach; ?>
</div>