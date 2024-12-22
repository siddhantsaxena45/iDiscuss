<?php
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <h2 class="navbar-brand  my-3" >iDiscuss</h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/iDiscuss">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categories
                            </a>
                            <ul class="dropdown-menu">
                            ';
$sql = "select category_name,category_id from categories limit 3";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    echo '                      
                                <li>
                                    <a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a>
                                </li> ';
}
echo '    
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/iDiscuss/about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/iDiscuss/contact.php">Contact</a>
                        </li>
                    </ul>';

echo '          <div class="d-flex align-items-center">';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '   <form class="d-flex my-2 my-lg-0" method="get" action="/iDiscuss/search.php">
                                <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                                <p class="text-light my-0 mx-2">Welcome ' . $_SESSION['useremail'] . '</p>
                                <a href="/iDiscuss/partials/logout.php" class="btn btn-outline-success ms-2">Logout</a>
                        </form>';
} else {
    echo '          <form class="d-flex my-2 my-lg-0" method="get" action="/iDiscuss/search.php">
                            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <button class="btn btn-outline-success ms-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-outline-success ms-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
}
echo '           </div>
             </div>
        </nav> ';

include 'partials/loginModal.php';
include 'partials/signupModal.php';
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> Signed Up successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
} elseif (isset($_GET['error'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Failed!</strong> ' . $_GET['error'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
