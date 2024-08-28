<?php
include('./database/env.php');
$FoodQuery = "SELECT foods.id, foods.category_id, categories.title AS category_title, foods.title,foods.details, foods.price, foods.food_img, foods.status FROM foods INNER JOIN categories ON foods.category_id = categories.id WHERE status = 1  ORDER BY foods.id DESC ";
$res = mysqli_query($connection, $FoodQuery);
$FoodData = mysqli_fetch_all($res, 1);

$CategoriesFood = [];
$foodIndex = 0;

foreach ($FoodData as $key => $item) {


  if (!isset($CategoriesFood[$item['category_title']])) {
    $CategoriesFood[$item['category_title']] = [];
  }
  $CategoriesFood[$item['category_title']][] = $item;
}





?>
<!-- Menu Section -->
<section id="menu" class="menu section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Our Menu</h2>
    <p><span>Check Our</span> <span class="description-title">Yummy Menu</span></p>
  </div><!-- End Section Title -->



  <div class="container">

    <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
      <?php

      foreach ($CategoriesFood as $title => $data) {
        $foodIndex++;
      ?>
        <li class="nav-item">
          <a class="nav-link <?= $foodIndex == 1 ? "active show" : null ?>" data-bs-toggle="tab" data-bs-target="#menu-<?= $title ?>">
            <h4><?= $title ?></h4>
          </a>
        </li>
      <?php

      }

      ?>



    </ul>

    <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

      <?php
      $foodIndex = 0;
      foreach ($CategoriesFood as $title => $data) {
        $foodIndex++;
      ?>

        <div class="tab-pane fade <?= $foodIndex == 1 ? "active show" : null ?>" id="menu-<?= $title ?>">

          <div class="tab-header text-center">
            <p>Menu</p>
            <h3><?= $title ?></h3>
          </div>

          <div class="row gy-5">

            <?php

            foreach ($data as $food) {
            ?>
              <div class="col-lg-4 menu-item">
                <a href="./<?= $food['food_img'] ?>" class="glightbox"><img src="./<?= $food['food_img'] ?>" class="menu-img img-fluid" alt=""></a>
                <h4><?= $food['title'] . $foodIndex ?></h4>
                <p class="ingredients">
                  <?= $food['details'] ?>
                </p>
                <p class="price">
                  $<?= $food['price'] ?>
                </p>
              </div>
            <?php
            }

            ?>




          </div>
        </div>

      <?php
      }

      ?>




    </div>

  </div>

</section><!-- /Menu Section -->