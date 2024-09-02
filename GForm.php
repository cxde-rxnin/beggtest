

<?php

    include 'deet.php';


    if ($_SERVER['REQUEST_METHOD']=="POST") {

        $ID = $_POST['val'];

        $updateStatus = mysqli_query($db, "update giveaway set Status= 'Ended' where id = '$ID'");
        echo "<script>swal('SUCCESS', 'Successfully Ended Giveaway' ,'success')</script>";

    }

?>
