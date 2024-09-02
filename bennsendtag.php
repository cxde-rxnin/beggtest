<?php

include 'deet.php';

if ($_SERVER['REQUEST_METHOD']=="POST") {

    $amt = $_POST['Amount'];
    $ID = $_POST['vxll'];

    $bennTag = mysqli_query($db, "select * from user where id='$ID'");
    $Barr = mysqli_fetch_array($bennTag);
    $arrr = $Barr["id"];
    $DemBal = $Barr["AccountBalance"];
    $tgg = $Barr["Tag"];


    $userTag = mysqli_query($db, "select * from user where id='".$_SESSION['user']."'");
    $farr = mysqli_fetch_array($userTag);
    $arr = $farr["id"];
    $AccBal = $farr["AccountBalance"];
    $type = "Debit";
    $type2 = "Credit";

    if (empty($amt)) {
        echo '<script>swal("TRANSFER FAILED","Please Input Amount","error")</script>';
    } elseif ($amt <= 99) {
        echo '<script>swal("TRANSFER FAILED","Minimum transfer amount is #100","error")</script>';
    } elseif ($amt > $AccBal) {
        echo '<script>swal("TRANSFER FAILED","Insufficient Balance","error")</script>';
    } else {
        $newBal = $Accbal - $amt ;
        $creBal = $DemBal + $amt;
        $user=mysqli_query($db, "update user set AccountBalance= '$newBal' where id = '".$_SESSION['user']."' ");
        $Demuser=mysqli_query($db, "update user set AccountBalance= '$creBal' where id = '$arrr' ");
        $DebitTransaction=mysqli_query($db, "insert into transactions(userId, BName, TransactionType, Amount)values('".$_SESSION['user']."', '$arrr', '$type', '$amt')");
        $Transaction=mysqli_query($db, "insert into transactions(userId, BName, TransactionType, Amount)values('$arrr','".$_SESSION['user']."', '$type2', '$amt')");
        echo "<script>swal('TRANSFER SUCCESSFUL', 'Transferred $amt to @$tgg. New Balance is $newBal' ,'success')</script>";
    }

}

?>

<script>
    document.getElementById("mnt").value = '';
</script>