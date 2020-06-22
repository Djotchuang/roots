<div class="page-title">
	<div class="container">
		<h2><?= $title; ?></h2>
	</div>
</div>
<ul class="list-group country-index">
	<?php foreach ($countries as $country) : ?>
		<li class="list-group-item"><a href="<?php echo site_url('/countries/posts/' . $country['id']); ?>"><?php echo $country['cname']; ?></a>

			<!-- DELETE COUNTRY============================================			
		<?php if ($this->session->userdata('user_id') == $country['user_id']) : ?>
			<form class="cat-delete" action="countries/delete/<?php //echo $country['id']; 
																?>" method="POST">
				<input type="submit" class="btn-link text-danger" value="[X]">
			</form>
		<?php endif; ?>
	===========================================================  -->
		</li>
	<?php endforeach; ?>
</ul>