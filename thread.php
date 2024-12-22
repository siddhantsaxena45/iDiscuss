<?php include "partials/db_connect.php"; ?><!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to iDiscuss - Coding forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>


    <?php include "partials/header.php"; ?>
    
  
    <?php
     $tid = $_GET['threadid'];
    $method = $_SERVER['REQUEST_METHOD'];
    $showAlert = false;
    if ($method == 'POST') {
        $content = $_POST['comment'];
        $userid = $_POST['userid'];
        $content=str_replace("<","&lt;",$content);
        $content=str_replace(">","&gt;",$content);
        $sql = "INSERT INTO `comments` ( `comment_content`, `thread_id`,comment_by) VALUES ( '$content', '$tid','$userid')";
        $result = mysqli_query($conn, $sql);

        $showAlert = true;
    }
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> You have added a comment .
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>
      <?php
   
    $sql = "select * from thread where thread_id=$tid";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $tuid=$row['thread_user_id'];
        $sql = "select user_email from users where user_id =$tuid";
        
        $result = mysqli_query($conn, $sql);
        $row2 = mysqli_fetch_assoc($result);
       
        $username = $row2['user_email'];
    }
    ?>

    <div class="container my-4 ">

        <div class="container mx-auto my-5 text-center" style="max-width: 1000px;">
            <div class="px-4 py-0 mb-4 bg-dark text-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold"><?php echo $title; ?> </h1>
                    <p class="col fs-4 text-center"><?php echo $desc; ?></p>
                    <hr class="my-2">
                    <p class="col fs-6 text-center">This is a peer to peer forum for sharing knowledge.Be respectful.Be civil.Be mindful of quantity.Be considerate. Follow guidelines.Avoid prohibited content.Avoid prohibited aliases or images.
                    </p>
                    
                    <p>Posted by :<b> <?php echo $username ; ?></b></p>
                </div>
            </div>
        </div>

    </div>
    <div class="container mx-auto my-5" style="max-width: 1000px;">
        <h4 class=" mb-4"> Post comment </h4>

        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '
                  <form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">

            <div class="mb-3">
                <label for="comment" class="form-label">Answer to this thread</label>

                <textarea class="form-control" placeholder="Leave a comment here" name="comment" id="comment" style="height: 100px"></textarea>
                 <input type="hidden" id="user_id" name="userid" value="' . $_SESSION['userid'] . '">
            </div>

            <button type="submit" class="btn btn-success">Post comment</button>
        </form>
            ';
        } else {
            echo '
               <p class="col fs-5 ">You are not logged in . Login to post comments .</p>
                   ';
        }

        ?>

    </div>

    <div class="container mx-auto my-5" style="max-width: 1000px; min-height:550px;">
        <h1 class="text-center mb-4">Discussions</h1>

        <?php
        $id = $_GET['threadid'];
        $sql = "select * from comments where thread_id=$id";
        $result = mysqli_query($conn, $sql);

        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;

            $by = $row['comment_by'];
            $content = $row['comment_content'];
            $time = $row['comment_time'];
            $dateTime = new DateTime($time);
            $formattedTime = $dateTime->format("j M 'y \a\t g:i a");
            $tuid = $row['comment_by'];
            $sql2 = "select user_email from users where user_id=$tuid";
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result2);
            $username = $row['user_email'];

            echo '
        <div class="d-flex align-items-center my-4">
            <div class="flex-shrink-0">
                <img src="/iDiscuss/images/prof.png" width="34">
            </div>
            <div class="flex-grow-1 ms-3">
               <p class="fw-bold my-0">' . $username. ' at ' . $formattedTime . '</p>
                <em>' . $content . '<em>
            </div>
        </div>';
        }
        if ($noResult) {
            $noResult = true;
            echo '<div class="bg-dark text-light p-2 mb-4 rounded-3" style="max-width: 1000px; ">
                    <div class="container-fluid py-2 px-3">
                        <p class="fs-3">No answer found</p>
                        <p class="fs-5">Be the first person to answer</p>
                    
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