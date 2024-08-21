<?php include('./Include/DashBoardHeader.php'); ?>

<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="text-center mb-4">
          <h2>Profile</h2>
        </div>

        <form enctype="multipart/form-data" action="../controller/UpdateProfile.php" method="POST">
          <div class="text-center mb-4">
            <label for="avatar">
              <img src="<?= GetImage() ?>" class="w-px-100 rounded-circle ProfileImg mb-3" alt="Profile Image" />
              <br>
              <span class="text-danger"><?= $_SESSION['errors']['profileImg_error'] ?? '' ?></span>
            </label>
            <input type="file" accept=".jpg,.png" id="avatar" name="profile" class="d-none">
          </div>

          <div class="form-group mb-3">
            <label for="username">Your Name</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= htmlspecialchars($_SESSION['auth']['username']) ?>" placeholder="Your Name" />
            <span class="text-danger"><?= $_SESSION['errors']['name_error'] ?? '' ?></span>
          </div>

          <div class="form-group mb-3">
            <label for="email">Your Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($_SESSION['auth']['email']) ?>" placeholder="Email" />
            <span class="text-danger"><?= $_SESSION['errors']['email_error'] ?? '' ?></span>
          </div>

          <div class="text-center">
            <button class="btn btn-primary">Update Profile</button>
          </div>
        </form>
        <form action="../controller/UpdatePassword.php" method="POST" style="text-align: center;">
          <span class="text-danger"><?= $_SESSION["errors"]["user_error"] ?? null ?></span>

          <input type="password" name="oldpassword" id="oldpassword" class="form-control my-2" placeholder="Enter Your Old  Password" />
          <span class="text-danger"><?= $_SESSION["errors"]["oldpassword_error"] ?? null ?></span>
          <input type="password" name="newpassword" id="newpassword" class="form-control my-2" placeholder="Enter Your New Password" />
          <span class="text-danger"><?= $_SESSION["errors"]["newpassword_error"] ?? null ?></span>
          <input type="password" name="confirmpassword" id="confirmpassword" class="form-control my-2" placeholder="Confirm Your New Password" />
          <span class="text-danger"><?= $_SESSION["errors"]["confirmpassword_error"] ?? null ?></span>
          <br />
          <button class="btn btn-primary">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('./Include/DashBoardFooter.php'); ?>

<script>
  const ImageInput = document.querySelector('#avatar');
  const ProfileImage = document.querySelector('.ProfileImg');

  function ProfileImageUpdate(event) {
    ProfileImage.src = URL.createObjectURL(event.target.files[0]);
  }

  ImageInput.addEventListener('change', ProfileImageUpdate);





  <?php

  if (isset($_SESSION['success'])) {

?>

<script>
Toast.fire({
  icon: "success",
  title: "Profile updated successfully"
});
</script>
<?php
}




  unset($_SESSION['errors']);
  unset($_SESSION['success']);
  unset($_SESSION["password"]);
