<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connect.php';

    $email = $_POST['loginemail'];
    $pass = $_POST['loginpassword'];

    $sql = "SELECT * FROM users WHERE user_email='$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($pass, $row['user_password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $email;
            $_SESSION['userid'] = $row['user_id'];
            header("Location: /iDiscuss");
            exit();
        } else {
            $showError = "password not matched";
        }
    } else {
        $showError = "user not found";
    }
    header("Location: /iDiscuss/index.php?loginsuccess=false&error=$showError");
}
