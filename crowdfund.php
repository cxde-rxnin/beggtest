<?php


session_start();

include 'deet.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $name = $_POST["Name"];
    $amt = $_POST["Amount"];
    $sDate = $_POST["Sdate"];
    $eDate = $_POST["Edate"];
    $Date1 = strtotime($sDate);
    $Date2 = strtotime($eDate);
    $req = $_POST["req"];

    if (empty($name) || empty($amt) || empty($req)) {
        echo '<script>swal("REGISTRATION FAILED","Please Input Required Info","error")</script>';
    } elseif (empty($sDate) || empty($eDate)) {
        echo '<script>swal("REGISTRATION FAILED","CrowdFund must have both start and end dates.","error")</script>';
    } elseif ($amt <= 0) {
        echo '<script>swal("CrowdFund FAILED","Amount cannot be less than 0","error")</script>';
    }   elseif ($amt < 1000) {
        echo '<script>swal("CrowdFund FAILED","Why are you poor?","error")</script>';
    } else {
        echo '<script>swal("REGISTRATION SUCCESSFUL","Successfully Started a Crowd Fund session","success")</script>';
        $CreateCrowdFund=mysqli_query($db, "insert into crowdfund(userId, FundName, FundAmount, StartDate, EndDate, Req)values('".$_SESSION['user']."', '$name', '$amt', '$Date1', '$Date2', '$req')");
    }

}

?>

<script>
    document.getElementById("Name").value = '';
    document.getElementById("Amount").value = '';
    document.getElementById("tarea").value = '';
</script>