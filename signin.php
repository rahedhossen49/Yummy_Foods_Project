<?php
include('./include/AuthHeader.php');
?>



<div class="card px-sm-6 px-0">
  <div class="card-body">
    <!-- Logo -->
    <div class="app-brand justify-content-center">
      <a href="signin.php" class="app-brand-link gap-2">
        <img src="./assets/img/logo.png" alt="">
      </a>
    </div>
    <!-- /Logo -->
    <h4 class="mb-1 mb-2 text-center text-danger">Welcome to Yummy Food! 👋</h4>
    <p class="mb-6 text-center text-primary ">Please sign-in to your account!</p>

    <form id="formAuthentication" class="mb-6" action="./controller/LoginUser.php" method="POST">
      <div class="mb-6">
        <label for="email" class="form-label">Email or Username</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email or username" autofocus />
        <span class="text-danger"><?=$_SESSION['errors']['email_error'] ?? null ?></span>

      </div>
      <div class="mb-6 form-password-toggle">
        <label class="form-label" for="password">Password</label>
        <div class="input-group input-group-merge">
          <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
        <span class="text-danger"><?=$_SESSION['errors']['password_error'] ?? null ?></span>

      </div>
      <div class="mb-8">
        <div class="d-flex justify-content-between mt-8">
          <div class="form-check mb-0 ms-2">
            <input class="form-check-input" type="checkbox" id="remember-me" />
            <label class="form-check-label" for="remember-me"> Remember Me </label>
          </div>
          <a href="auth-forgot-password-basic.html">
            <span>Forgot Password?</span>
          </a>
        </div>
      </div>
        <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
      </div>
    </form>

    <p class="text-center">
      <span>New on our platform?</span>
      <a href="signup.php">
        <span>Create an account</span>
      </a>
    </p>
  </div>
</div>
<!-- /Register -->
</div>
</div>
</div>

<?=include('./include/AuthFooter.php');?>


<?php

if(isset($_SESSION['success'])){
?>
    <script>
    Toast.fire({
      icon: "success",
      title: "Signed up successfully"
    });
    </script>

<?php
  }

  session_unset();

?>
