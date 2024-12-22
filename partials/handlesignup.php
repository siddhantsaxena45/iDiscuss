<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    $showError="false";
    include 'db_connect.php';
     $email=$_POST['signupEmail'];
     $pass=$_POST['signupPassword'];
     $cpass=$_POST['signupCpassword'];
     
     $sql="select * from users where user_email='$email'";
     $result=mysqli_query($conn,$sql);
     $num=mysqli_num_rows($result);
     if($num>0){
        $showError="Email already exists";
     }
     else{
        if($pass==$cpass){
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` ( `user_email`, `user_password`) VALUES ('$email', '$hash')";
            $result=mysqli_query($conn,$sql);
            $showAlert="true";
            header("Location:/iDiscuss/index.php?signupsuccess=true");
            exit();
        }
        else{
           $showError="Passwords do not match";
        }

     }
     header("Location:/iDiscuss/index.php?signupsuccess=false&error=$showError");
    
}


?>