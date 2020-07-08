<div class="flex-wrapper">
  <div class="page-title">
    <div class="container-fluid">
      <h2><?= $title; ?></h2>
    </div>
  </div>
  <?php foreach ($search as $row) : ?>
    <?php if ($this->session->userdata('logged_in')) : ?>
      <div class="search-info">
        <a href="<?= base_url() ?>users/profile">
          <img id="post-img" class="avatar-image" src="<?php echo $row['avatar']; ?>" alt="" data-control-key="primary_details">
        </a>
        <span>
          <a href="<?= base_url() ?>users/fetch_user/<?= $row['id']; ?>">
            <h6 class="name"><span dir="ltr"><?= $row['username']; ?></span></h6>
          </a>
          <dd class="location"><span><?= $row['country']; ?></span></dd>
        </span>
      </div>
      <hr class="separator">
    <?php endif; ?>
  <?php endforeach; ?>
</div>