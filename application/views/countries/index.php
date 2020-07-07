<div class="page-title">
	<div class="container-fluid">
		<h2><?= $title; ?></h2>
	</div>
</div>
<ul class="list-group country-index">
	<?php foreach ($countries as $country) : ?>
		<li class="list-group-item">
			<a href="<?php echo site_url('/countries/posts/' . $country['c_id']); ?>">
				<?php echo $country['cname']; ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>