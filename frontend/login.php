<?php include_once 'includes/header.php'; ?>
<!-- END nav -->

<section
  class="hero-wrap hero-wrap-2 js-fullheight"
  style="background-image: url('images/bg_3.jpg')"
  data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div
      class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
      <div class="col-md-9 ftco-animate pb-5">
        <p class="breadcrumbs">
          <span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span>
          <span>Login <i class="ion-ios-arrow-forward"></i></span>
        </p>
        <h1 class="mb-3 bread">Login</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section contact-section">
  <div class="container">
    <div class="row d-flex justify-content-center mb-5 contact-info">
      <div class="col-md-8 block-9 mb-md-5">
        <h2 class="text-center">Login</h2>
        <form action="#" class="bg-light p-5 contact-form">
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="Username or Email"
              required />
          </div>
          <div class="form-group">
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              required />
          </div>
          <div class="form-group">
            <input
              type="submit"
              value="Login"
              class="btn btn-primary py-3 px-5" />
          </div>
          <div class="text-center">
            <p>
              Don't have an account?
              <a class="text-primary" href="signup.php">Sign Up</a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php include_once 'includes/footer.php'; ?>
