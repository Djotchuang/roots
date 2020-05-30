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
  <nav class="navbar navbar-expand-lg" id="nav-bar">
    <div class="container">
      <a class="navbar-brand" id="logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="LOGO">
      </a>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav mr-auto">
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>"><span>
                <ion-icon style="font-size:1.5rem !important; margin-right:.2em !important; margin-bottom:-.18em !important" name="home-outline"></ion-icon>
              </span>Home</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>posts"><span>
                <ion-icon style="font-size:1.5rem !important; margin-right:.2em !important; margin-bottom:-.18em !important" name="duplicate-outline">
              </span>Newsfeed</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>countries"><span>
                <ion-icon style="font-size:1.5rem !important; margin-right:.2em !important; margin-bottom:-.18em !important" name="earth-outline">
              </span>Countries</a></li>
        </ul>
        <ul class="nav navbar-nav nav-pills navbar-right">
          <?php if (!$this->session->userdata('logged_in')) : ?>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a></li>
          <?php endif; ?>
          <?php if ($this->session->userdata('logged_in')) : ?>
            <form action="<?= base_url(); ?>users/fetch" method="post" id="search-form" class="form-inline my-2 my-lg-0">
              <input id="input-form" name="search" class="form-control mr-md-2 text-black" type="text" placeholder="Search People">
              <button id="search-submit" class="btn btn-secondary my-2 my-sm-0" type="submit" disabled>Search</button>
            </form>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>posts/create">
                <ion-icon name="create-outline"></ion-icon>
              </a></li>
            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>countries/create">
                <ion-icon name="notifications-outline"></ion-icon>
              </a></li>
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
        </ul>
      </div>
    </div>
  </nav>

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