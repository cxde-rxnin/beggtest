
<?php

session_start();

include 'conn.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $email = $_POST["email"];

    $pass = $_POST["pass"];

    $userEmail = mysqli_query($db, "select * from user where Email='$email' and Password='$pass'");

    if (empty($email) || empty($pass)) {
        echo '<script>swal("LOGIN FAILED","Please Input Required Info","error")</script>';
    } elseif (mysqli_num_rows($userEmail)<1) {
        echo '<script>swal("ERROR","User does not exist","error")</script>';
    } else {
        $fetch=mysqli_fetch_array($userEmail);
        $id=$fetch['id'];
        $FName = $fetch['FirstName'];
        $LName = $fetch['LastName'];
        echo "<script>swal('LOGIN SUCCESSFUL','Welcome $FName $LName' ,'success')</script>";


           $_SESSION['user']=$id;
            echo "<script>
            setTimeout(function(){
            window.location.href='index.php';
           },2000);
            </script>";
           
        
    
        }


}



?>