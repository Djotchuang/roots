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
  <header>
    <nav class="navbar navbar-expand-xl navbar-dark">
      <div class="container">
        <a class="navbar-brand" id="logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="logo">
        </a>
        <button id="nav-toggle-button" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <div class="navdiv nav1">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>">
                  <ion-icon name="home-outline"></ion-icon>
                  <p>Home</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>posts">
                  <ion-icon name="duplicate-outline"></ion-icon>
                  <p>Newsfeed</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>countries">
                  <ion-icon name="earth-outline"></ion-icon>
                  <p>Countries</p>
                </a>
              </li>
            </div>
            <div class="navdiv nav2">
              <?php if (!$this->session->userdata('logged_in')) : ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>users/login">
                    <p>Login</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>users/register">
                    <p>Register</p>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($this->session->userdata('logged_in')) : ?>
                <form action="<?= base_url(); ?>users/fetch" method="post" id="search-form" class="form-inline my-2 my-lg-0">
                  <input id="input-form" name="search" class="form-control mr-2 text-black" type="text" placeholder="Search People">
                  <button id="search-submit" class="btn btn-secondary my-2 my-sm-0" type="submit" disabled>Search</button>
                </form>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>posts/create">
                    <ion-icon name="create-outline"></ion-icon>
                  </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>countries/create">
                    <ion-icon name="notifications-outline"></ion-icon>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" id="profile-icon" data-toggle="dropdown" role="button" href="#" aria-haspopup="true" aria-expanded="false">
                    <ion-icon name="person-circle-outline"></ion-icon>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?= base_url() ?>users/profile">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>users/logout">Logout</a>
                  </div>
                </li>
              <?php endif; ?>
            </div>
          </ul>
        </div>
      </div>
    </nav>
  </header>



  <div class="container">
    <!-- Flash messages -->
    <div class="flash-data" style="margin-top: 1.5rem;">
      <?php if ($this->session->flashdata('user_registered')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_registered') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('post_created')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_created') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('post_updated')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_updated') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('category_created')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('category_created') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('post_deleted')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('post_deleted') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('login_failed')) : ?>
        <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('login_failed') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('user_loggedin')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedin') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('user_loggedout')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('user_loggedout') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('category_deleted')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('category_deleted') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('profile_updated')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('profile_updated') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('avatar')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('avatar') . '</p>'; ?>
      <?php endif; ?>

      <?php if ($this->session->flashdata('avatar_error')) : ?>
        <?php echo '<p class="alert alert-success">' . $this->session->flashdata('avatar_error') . '</p>'; ?>
      <?php endif; ?>
    </div>