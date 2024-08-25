<?=
include('./include/DashBoardHeader.php');
include('../database/env.php');
$query = "SELECT * FROM foods ORDER BY id DESC";
$result = mysqli_query($connection, $query);
$foods = mysqli_fetch_all($result, MYSQLI_ASSOC);

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
            <th>Food Title</th>
            <th>Food Detail</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          <?php foreach ($foods as  $key => $food){
         ?>

          <tr>
            <td><?= ++$key ?></td>
            <td><?= empty($food['title']) ? '---' : (strlen($food['title']) > 5 ? substr($food['title'], 0, 5) . '....' : $food['title']) ?></td>
            <td><?= empty($food['detail']) ? '---' : (strlen($food['detail']) > 5 ? substr($food['detail'], 0, 5) . '....' : $food['detail']) ?></td>
            <td><?= empty($food['price']) ? : $food['price'] ?></td>
            <td>
            <a href="./categories.php?id=<?= $food['id'] ?>&title=<?= $food['title'] ?>" class="btn btn-primary btn-delete btn-sm">Edit</a>

            </td>
            <td>

            <a href="../controller/CategoryDelete.php?id=<?=$food['id']?>" class="btn btn-danger btn-delete btn-sm">Delete</a>
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
