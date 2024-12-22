
<?php include "partials/db_connect.php"; ?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome to iDiscuss - Coding forum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>


  <?php include "partials/header.php"; ?>
 

  <!-- slider starts here -->
  <div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/i (1).jpg" class="d-block w-100" alt="..." height="400">
      </div>
      <div class="carousel-item">
        <img src="images/i (2).jpg" class="d-block w-100" alt="..." height="400">
      </div>
      <div class="carousel-item">
        <img src="images/i (3).jpg" class="d-block w-100" alt="..." height="400">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- container containing categories -->
  <div class="container my-4" style="min-height:300px;">
    <h1 class="text-center">iDiscuss Categories</h1>
    <div class="row">
      <!-- fetch all categories -->
      <?php
      $sql = "select * from categories";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['category_id'];
        $cat = $row['category_name'];
        $desc = $row['category_description'];
        echo '<div class="col-md-4 my-2">
                 <div class="card" style="width: 18rem;">
                    <img src="images/' . $cat . '.jpg" class="card-img-top" alt="image" width="80" height="200">

                    <div class="card-body">
                      <h5 class="card-title"><a href="threadlist.php/?catid=' . $id . '"> ' . $cat . '</a></h5>
                      <p class="card-text">' . substr($desc, 0, 90) . '...
                      </p>
                      <a href="threadlist.php/?catid=' . $id . '" class="btn btn-primary">View threads</a>
                    </div>
                   </div>
                </div>';
      }
      ?>
    </div>
  </div>

  <?php include "partials/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>