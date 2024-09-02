<?php

session_start();

include 'conn.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $email = $_POST["email"];
    
    $Fname = $_POST["fname"];

    $Lname = $_POST["lname"];

    $tag = $_POST["tag"];

    $pass = $_POST["pass"];

    $pass2 = $_POST["pass2"];

    $Bank = "Begg Microfinance";

    $balance = 100000;

    $Acc= rand(1000000000, 9999999999);

    

    $sel =mysqli_query($db, "select * from user where Tag='$tag'");


    if (empty($email) || empty($Fname) || empty($Lname) || empty($tag) || empty($pass) || empty($pass2)) {
        echo '<script>swal("SIGNUP FAILED!","Please Input Required Info!","error")</script>';
    } elseif (!preg_match("/^[a-zA-Z ]*$/" , $Fname) || !preg_match("/^[a-zA-Z ]*$/" , $Lname)) {
        echo '<script>swal("SIGNUP FAILED!","Names should contain letters only!","error")</script>';
    } elseif (strlen($pass)<5) {
        echo '<script>swal("SIGNUP FAILED!", "Password must be at least 5 digits long!", "error")</script>';
    } elseif ($pass != $pass2) {
        echo '<script>swal("SIGNUP FAILED!", "Password does not match !", "error")</script>';
    } elseif (mysqli_num_rows($sel)>0) {
        echo '<script>swal("SIGNUP FAILED!","Unique Tag already exists!","error")</script>';
    } else {

        $user=mysqli_query($db, "insert into user(FirstName,LastName,Email,Tag,Password,BankName,AccountNumber,AccountBalance)values('$Fname','$Lname','$email','$tag','$pass','$Bank','".rand(1000000000, 9999999999)."','$balance')");

   if($user){
    echo "<script>swal('SIGNUP SUCCESSFUL','Hello $Fname $Lname Your Account Number is $Acc' ,'success')</script>";
    $_SESSION['user']=mysqli_insert_id($db);
    echo "<script>
    setTimeout(function(){
    window.location.href='index.php';
   },6000);
    </script>";
   }

   else{
    echo "<script>swal('SIGNUP SUCCESSFUL','".mysqli_error($db)."' ,'error')</script>";

   }
   
    }






}





?>