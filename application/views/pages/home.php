<html>

<head>
  <title>Roots</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/croppie.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fontawesome.min.css">
  <script src="<?= base_url() ?>assets/js/jquery-3.4.11.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/js/croppie.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?= base_url() ?>assets/js/main.js" type="text/javascript"></script>
  <script src="http://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
</head>

<body>
  <section class="hero">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          <a class="hero-brand" href="index.html" title="Home">
            <img class="hero-logo" alt="Logo" src="<?= base_url(); ?>assets/images/logo-roots.png"></a>
        </div>
      </div>

      <div class="col-md-12">
        <?php if (!$this->session->userdata('logged_in')) : ?>
          <h1 class="hero-caption">
            What is roots all about?
          </h1>
          <p class="tagline">
            Want to know what's happening in your community? Here is an opportunity for you.<br>
            Register and meet your brethren around the world.
          </p>
          <a class="btn btn-full" id="home_btn" href="<?= base_url(); ?>users/register">Get Started Now</a>
        <?php endif; ?>
        <?php if ($this->session->userdata('logged_in')) : ?>
          <h1 class="hero-caption">
            Are you tired?
          </h1>
          <p class="tagline">
            Don't leave now! We got a lot more info for you, more users, more chats<br>
            Click the button below and continue exploring. Have fun!
          </p>
          <a class="btn btn-full" id="home_btn" href="<?= base_url(); ?>posts">Continue Exploring</a>
        <?php endif; ?>
      </div>
    </div>
  </section>

</body>

</html>