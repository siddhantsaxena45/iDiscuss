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
    
    <?php
    $cid = $_GET['catid'];
    $sql = "select * from categories where category_id=$cid";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {

        $cat = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>
    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    $showAlert = false;
    if ($method == 'POST') {
        $th_title = $_POST['title'];
        //sanitize angular brackets from xss attacks
        $th_title=str_replace("<","&lt;",$th_title);
        $th_title=str_replace(">","&gt;",$th_title);
        $th_desc = $_POST['desc'];
        $th_desc=str_replace("<","&lt;",$th_desc);
        $th_desc=str_replace(">","&gt;",$th_desc);
        $th_u_id = $_POST['userid'];
        $sql = "INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ( '$th_title', '$th_desc', $cid, $th_u_id)";
        $result = mysqli_query($conn, $sql);

        $showAlert = true;
    }
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> You have added a thread .
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>

    <div class="container my-4 ">

        <div class="container mx-auto my-5 text-center" style="max-width: 1000px;">
            <div class="px-4 py-0 mb-4 bg-dark text-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">Welcome to <?php echo $cat; ?> Forums</h1>
                    <p class="col fs-4 text-center"><?php echo $catdesc; ?></p>
                    <hr class="my-2">
                    <p class="col fs-6 text-center">This is a peer to peer forum for sharing knowledge.Be respectful.Be civil.Be mindful of quantity.Be considerate. Follow guidelines.Avoid prohibited content.Avoid prohibited aliases or images.
                    </p>
                    <button class="btn btn-success btn-lg mt-3" type="button">Learn More</button>
                </div>
            </div>
        </div>

    </div>


    <div class="container mx-auto my-5" style="max-width: 1000px;">
        <h4 class=" mb-4"> Start Discussion</h4>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '<form action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Problem Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">keep your title short and crisp</div>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Ellaborate your concern</label>

                <textarea class="form-control" placeholder="Leave a comment here" name="desc" id="desc" style="height: 100px"></textarea>
                 <input type="hidden" id="user_id" name="userid" value="'.$_SESSION['userid'].'">
                
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>';
        } else {
            echo '
           <p class="col fs-5 ">You are not logged in . Login to start discussion .</p>
               ';
        }
        ?>
    </div>


    <div class="container mx-auto my-5" style="max-width: 1000px; min-height:550px;">
        <h1 class="text-center mb-4">Browse Questions</h1>



        <?php
        $cid = $_GET['catid'];
        $sql = "select * from thread where thread_cat_id=$cid";
        $result = mysqli_query($conn, $sql);

        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;

            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $time = $row['thread_time'];

            $dateTime = new DateTime($time);
            $formattedTime = $dateTime->format('j M y \a\t g:i a');

            $tuid = $row['thread_user_id'];
            $sql2 = "select user_email from users where user_id=$tuid";
            $result2 = mysqli_query($conn, $sql2);
            $row = mysqli_fetch_assoc($result2);

            $username = $row['user_email'];

            echo '
        <div class="d-flex align-items-center my-4">
            <div class="flex-shrink-0">
                <img src="/iDiscuss/images/prof.png" width="39">
            </div>
            <div class="flex-grow-1 ms-3">
            
                <h5 class="mt-0"><a href="/iDiscuss/thread.php?threadid=' . $id . '" class="text-dark">' . $title . '</a></h5>
                ' . $desc . '
            </div>
            <p class="fw my-0">Asked by : ' .  $username. '<br>  On : ' . $formattedTime . '</p>
        </div>';
        }
        if ($noResult) {
            $noResult = true;
            echo '<div class="bg-dark text-light p-2 mb-4 rounded-3" style="max-width: 1000px; ">
                    <div class="container-fluid py-2 px-3">
                        <p class="fs-3">No threads found</p>
                        <p class="fs-5">Be the first person to ask a question</p>
                    
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