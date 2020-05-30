</div>
<section class="hero">
  <div class="container text-center">
    <div class="row">
      <div class="col-md-12">
        <a class="hero-brand" href="index.html" title="Home">
          <img class="hero-logo" alt="Logo" src="<?= base_url(); ?>assets/images/logo.png"></a>
      </div>
    </div>

    <div class="col-md-12">
      <h1 class="hero-caption">
        What is roots all about?
      </h1>

      <p class="tagline">
        Want to know what's happening in your community? Here is an opportunity for you.
        <ion-icon name="heart-circle"></ion-icon> <br> Register and meet your brethren around the world.
      </p>
      <?php if (!$this->session->userdata('logged_in')) : ?>
        <a class="btn btn-full" id="btn" href="<?= base_url() ?>/users/register">Get Started Now</a>
      <?php endif; ?>
      <?php if ($this->session->userdata('logged_in')) : ?>
        <a class="btn btn-full" id="btn" href="<?= base_url() ?>posts">Continue Exploring</a>
      <?php endif; ?>
    </div>
  </div>

</section>