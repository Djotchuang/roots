<div class="page-title">
	<div class="container-fluid">
		<h2><?= $title; ?></h2>
	</div>
</div>
<ul class="list-group category-index">
	<?php foreach ($categories as $category) : ?>
		<li class="list-group-item">
			<a href="<?php echo site_url('/categories/posts/' . $category['ca_id']); ?>">
				<?php echo $category['ca_name']; ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>