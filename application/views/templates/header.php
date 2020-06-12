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
  <script src="https://kit.fontawesome.com/ea1c3344cf.js" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-xl navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo-roots.png" alt="logo">
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
                <a class="nav-link" href="<?php echo base_url(); ?>posts/">
                  <ion-icon name="duplicate-outline"></ion-icon>
                  <p>Newsfeed</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>posts/categories">
                  <ion-icon name="list-outline"></ion-icon>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>countries">
                  <ion-icon name="earth-outline"></ion-icon>
                  <p>Countries</p>
                </a>
              </li>
            </div>
            <?php if ($this->session->userdata('logged_in')) : ?>
              <form action="<?= base_url(); ?>users/fetch" method="post" id="search-form" class="form-inline my-2 my-lg-0">
                <input id="input-form" name="search" class="form-control mr-2 text-black search-input" type="text" placeholder="Search People">
                <button class="btn btn-secondary btn-sm search-button" type="submit">Search</button>
              </form>
            <?php endif; ?>
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
                <div class="nav-icons">
                  <li class="nav-item">
                    <a class="nav-link" title="Create Post" href="<?php echo base_url(); ?>posts/create">
                      <ion-icon name="create-outline"></ion-icon>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" title="Add a Country" href="<?php echo base_url(); ?>countries/create">
                      <ion-icon name="notifications-outline"></ion-icon>
                    </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" title="Account" id="profile-icon" data-toggle="dropdown" role="button" href="#" aria-haspopup="true" aria-expanded="false">
                      <ion-icon name="person-circle-outline"></ion-icon>
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="<?= base_url() ?>users/profile">Profile</a>
                      <a class="dropdown-item" href="#">Settings</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo base_url(); ?>users/logout">Logout</a>
                    </div>
                  </li>
                </div>
              <?php endif; ?>
            </div>
          </ul>
        </div>
      </div>
    </nav>
  </header>



  <div class="container">
    <!-- Flash messages -->
    <div class="flash-data">

      <?php if ($this->session->flashdata('upload_error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('upload_error'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('user_registered')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('user_registered'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('post_created')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('post_created'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('post_updated')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('post_updated'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('category_created')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('category_created'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('post_deleted')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('post_deleted'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('login_failed')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('login_failed'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('user_loggedin')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('user_loggedin'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="outline: none; border: none">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('user_loggedout')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('user_loggedout'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="outline: none; border: none">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('category_deleted')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('category_deleted'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('profile_updated')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('profile_updated'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('avatar')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('avatar'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if ($this->session->flashdata('avatar_error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php echo $this->session->flashdata('avatar_error'); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>
      <?php if ($this->session->flashdata('reset_error')) : ?>
        <?php echo '<p class="alert alert-danger">' . $this->session->flashdata('reset_error') . '</p>'; ?>
      <?php endif; ?>
    </div>