<div class="flex-wrapper">
  <h2 id="search-title"><?=$title;?></h2>
  <?php foreach($search as $row):?>
 <img id="post-img" src="<?php echo $row['avatar']; ?>" alt="" class="profile-path primary-details img-circle avatar" data-control-key="primary_details"><h3 class="large-semibold name"><span dir="ltr"><?=$row['username'];?></span></h3><div class="medium-dark truncate-line headline"><span dir="ltr"><?=$row['occupation'];?></span></div><dd class="location small"><span><?=$row['country'];?></span></dd></img>
 <div class="line"></div>
<?php endforeach; ?>
</div>