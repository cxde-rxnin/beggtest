<?php


session_start();

include 'deet.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $name = $_POST["Name"];
    $eLimit = $_POST["limit"];
    $wLimit = $_POST["Wlimit"];
    $amt = $_POST["Amount"];
    $sDate = $_POST["Sdate"];
    $eDate = $_POST["Edate"];
    $Date1 = strtotime($sDate);
    $Date2 = strtotime($eDate);
    $req = $_POST["req"];
    $Wamt = $amt * $wLimit;


    if (empty($name) || empty($eLimit) || empty($wLimit) || empty($amt) || empty($req)) {
        echo '<script>swal("REGISTRATION FAILED","Please Input Required Info","error")</script>';
    } elseif (empty($sDate) || empty($eDate)) {
        echo '<script>swal("REGISTRATION FAILED","Giveaway must have both start and end dates.","error")</script>';
    } elseif ($amt <= 0) {
        echo '<script>swal("REGISTRATION FAILED","Amount cannot be less than 0","error")</script>';
    }   elseif ($amt < 1000) {
        echo '<script>swal("REGISTRATION FAILED","Why are you stingy?","error")</script>';
    } elseif ($Accbal < $Wamt ) {
        echo '<script>swal("Insufficient Funds","You no get money you wan do giveaway.","error")</script>';
    } else {
        echo '<script>swal("REGISTRATION SUCCESSFUL","Successfully created a giveaway session","success")</script>';
        $newBal = $Accbal - $Wamt;
        $user=mysqli_query($db, "update user set AccountBalance= '$newBal' where id = '".$_SESSION['user']."' ");
        $CreateGiveAway=mysqli_query($db, "insert into giveaway(userId, GiveAwayName, EntryLimit, GiveAwayLimit, GiveAwayAmount, StartDate, EndDate, Req)values('".$_SESSION['user']."', '$name', '$eLimit', '$wLimit', '$amt', '$Date1', '$Date2', '$req')");
    }

}

?>


<script>

    document.getElementById("Name").value = '';
    document.getElementById("Elimit").value = '';
    document.getElementById("Wlimit").value = '';
    document.getElementById("Amount").value = '';
    document.getElementById("tarea").value = '';
</script>