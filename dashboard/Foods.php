<?=
include('./include/DashBoardHeader.php');
include('../database/env.php');
$query = "SELECT * FROM categories ORDER BY id DESC";
$result = mysqli_query($connection, $query);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
$FoodQuery = "SELECT foods.id, foods.category_id, categories.title AS category_title, foods.title, foods.food_img, foods.status FROM foods INNER JOIN categories ON foods.category_id = categories.id ORDER BY foods.id DESC ";
$FoodResult = mysqli_query($connection,$FoodQuery);
$Foods = mysqli_fetch_all($FoodResult,1);
?>


<div class="row">
  <div class="col-xl-4 mb-6 order-0">
    <div class="card">
      <form action="../controller/FoodStore.php" method="POST" enctype="multipart/form-data">
        <div class="card-header d-flex py-0 pt-3 justify-content-between align-items-center">
          <h4>
           <?= isset($_REQUEST['id']) ? 'Edit' : 'Add' ?> Add Foods
          </h4>
          <button class="btn btn-primary" ><?= isset($_REQUEST['id']) ? 'Update' : 'Store' ?> </button>
        </div>
        <div class="card-body">
          <label for="">
            Food Title
            <input type="text"  name="title" class="form-control my-2" placeholder="Food Title">
            <span class="text-danger"><?= $_SESSION['errors']['title_error'] ?? null ?></span>
          </label>
          <label for="">
            Food Detail
            <input type="text"  name="detail" class="form-control my-2" placeholder="Food Detail">
            <span class="text-danger"><?= $_SESSION['errors']['detail_error'] ?? null ?></span>
          </label>
          <label for="">
            Price
            <input type="number"  name="price" class="form-control my-2" placeholder="Price">
            <span class="text-danger"><?= $_SESSION['errors']['price_error'] ?? null ?></span>
          </label>
          <label for="" class="d-block">
            Food Image
            <input type="file"  name="food_img" class="form-control my-2">
            <span class="text-danger"><?=$_SESSION['errors']['foodImg_error'] ?? null ?></span>
          </label>

<select name="category" class="form-control">

<?php
foreach ($categories as $key => $category) {
?>

        <option value="<?= $category['id']?>"><?= $category['title']?></option>

        <?php
}
?>

</select>
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
            <th>Foods</th>
            <th>Status</th>
            <th>Category</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php foreach ($Foods as  $key => $Food){
         ?>

          <tr>
            <td><?= ++$key ?></td>
            <td><img width="40px" src="../<?= $Food['food_img']?>" class="me-2" alt="" ><?= $Food['title'] ?></td>
            <td class="text-center">
              <a href="../controller/FoodStatus.php?id=<?=$Food['id']?> &status=<?=$Food['status']?>" class="text-warning">
                <i class="bx bx<?= $Food['status'] == 1 ? 's' : null ?>-star"></i>
              </a>
            </td>
            <td><?= $Food['category_title'] ?></td>
            <td>
            <a href="?id=<?= $Food['id'] ?>&title=<?= $Food['title'] ?>" class="btn btn-primary btn-delete btn-sm">Edit</a>

            </td>
            <td>

            <a href="?id=<?=$Food['id']?>" class="btn btn-danger btn-delete btn-sm">Delete</a>
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
            title: "Food Store successfull"
        });
    </script>
<?php
}


unset($_SESSION["errors"]);
unset($_SESSION["success"]);
?>
