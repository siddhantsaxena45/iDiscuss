
<?php include "partials/db_connect.php"; ?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome to iDiscuss - Coding forum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .container{
        min-height: 90vh;   
    max-width: 60vw; }
  </style>
</head>

<body>


  <?php include "partials/header.php"; ?>

  <div class="container">

     <h1 class="my-4 text-center">Search results for <em>"<?php echo $_GET['search']; ?>"</em></h1>
     <?php
     $query=$_GET['search'];
     $sql="SELECT * FROM `thread` where MATCH (`thread_title`,`thread_desc`) against('$query')";
     $result=mysqli_query($conn,$sql);
     $noResult=true;
     while($row=mysqli_fetch_assoc($result)){
              $noResult=false;
              $title=$row['thread_title'];
              $desc=$row['thread_desc'];
              $id=$row['thread_id'];
              $url="/iDiscuss/thread.php?threadid=".$id;
        echo ' <div class="result">
                     <h3><a href="'.$url.'" class="text-dark">'.$title.'</a></h3>
                     <p>'.$desc.'</p>
                </div> ';

     }
     if($noResult){
        echo'<div class="bg-dark text-light p-2 mb-4 rounded-3" style="max-width: 1000px; ">
                    <div class="container-fluid py-2 px-3">
                        <p class="fs-3 text-center">No results found</p>
                        
                    
                    </div>
             </div>';
     }

     ?>
    
  </div>

 
  <?php include "partials/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>