

<?php

include 'deet.php';


if ($_SERVER['REQUEST_METHOD']=="POST") {
        

    $accNum = $_POST["AccNum"];
    $Amount = $_POST["SendAmnt"];
    $type = "Debit";
    $type2 = "Credit";

    $iduser = mysqli_query($db, "select * from user where AccountNumber = $accNum");

    $farr = mysqli_fetch_array($iduser);

    $arr = $farr["id"];
    $DemBal = $farr["AccountBalance"];

    if (empty($accNum) || empty($Amount)) {
        echo '<script>swal("TRANSFER FAILED","Please Input Required Info","error")</script>';
    } elseif ($accNum == $AccNum && $id == $_SESSION['user']) {
        echo '<script>swal("TRANSFER FAILED","You cannot send money to yourself","error")</script>';
    } elseif (strlen($accNum) != 10) {
        echo '<script>swal("TRANSFER ERROR","Invalid Account Number","error")</script>';
    } elseif ($Amount <= 99) {
        echo '<script>swal("TRANSFER FAILED","Minimum transfer amount is #100","error")</script>';
    } elseif ($Accbal < $Amount) {
        echo '<script>swal("TRANSFER FAILED","Insufficient Balance","error")</script>';
    } else {

        $newBal = $Accbal - $Amount;
        $creBal = $DemBal + $Amount;
        $user=mysqli_query($db, "update user set AccountBalance= '$newBal' where id = '".$_SESSION['user']."' ");
        $Demuser=mysqli_query($db, "update user set AccountBalance= '$creBal' where id = '$arr' ");
        $DebitTransaction=mysqli_query($db, "insert into transactions(userId, BName, TransactionType, Amount)values('".$_SESSION['user']."', '$arr', '$type', '$Amount')");
        $Benn=mysqli_query($db, "insert into beneficiaries(userId, BennId,)values('".$_SESSION['user']."', '$arr')");
        $Transaction=mysqli_query($db, "insert into transactions(userId, BName, TransactionType, Amount)values('$arr','".$_SESSION['user']."', '$type2', '$Amount')");
        echo "<script>swal('TRANSFER SUCCESSFUL', 'Transferred $Amount to $accNum. New Balance is $newBal' ,'success')</script>";
    }

}

?>

<script>

    document.getElementById("AccBank").value = '';
    document.getElementById("AccNum").value = '';
    document.getElementById("amount").value = '';
    document.getElementById("sendd").classList.remove('show');



</script>