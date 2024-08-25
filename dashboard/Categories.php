<?=
include('./include/DashBoardHeader.php');
include('../database/env.php');
$query = "SELECT * FROM categories ORDER BY id DESC";
$result = mysqli_query($connection, $query);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>


<div class="row">
  <div class="col-xl-4 mb-6 order-0">
    <div class="card">
      <form action="../controller/CategoryStore.php" method="POST" enctype="multipart/form-data">
        <div class="card-header d-flex py-0 pt-3 justify-content-between align-items-center">
          <h4>
           <?= isset($_REQUEST['id']) ? 'Edit' : 'Add' ?> Add Categories
          </h4>
          <button class="btn btn-primary" ><?= isset($_REQUEST['id']) ? 'Update' : 'Store' ?> </button>
        </div>
        <div class="card-body">
          <label for="">
            Categories Title
            <input type="text" value="<?= $_REQUEST['title'] ?? null ?>" name="title" class="form-control my-2" placeholder="Categorie Title">
              <input type="hidden" name="id" value="<?= $_REQUEST['id'] ?? null ?>">
            <span class="text-danger"><?= isset($_SESSION['errors']['title_error']) ?></span>
          </label>

        </div>
      </form>
    </div>
  </div>


  <div class="col-xl-8 mb-6 order-0">
    <div class="card">

      <div class="table-responsive">
        <table class="table">

          <tr>
            <th>ID</th>
            <th>Categorie Title</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php foreach ($categories as  $key => $categorie){
         ?>

          <tr>
            <td><?= ++$key ?></td>
            <td><?= empty($categorie['title']) ? : $categorie['title'] ?></td>
            <td>
            <a href="./categories.php?id=<?= $categorie['id'] ?>&title=<?= $categorie['title'] ?>" class="btn btn-primary btn-delete btn-sm">Edit</a>

            </td>
            <td>

            <a href="../controller/CategoryDelete.php?id=<?=$categorie['id']?>" class="btn btn-danger btn-delete btn-sm">Delete</a>
            </td>
          </tr>
<?php


          }

          ?>


        </table>
      </div>
    </div>
  </div>



</div>
</div>




<?php
include("./include/DashboardFooter.php");

if (isset($_SESSION["success"])) {
?>
    <script>
        Toast.fire({
            icon: "success",
            title: "Category Store successfull"
        });
    </script>
<?php
}


unset($_SESSION["errors"]);
unset($_SESSION["success"]);
?>
