

<?php

include 'deet.php';
   


if ($_SERVER['REQUEST_METHOD']=="POST") {
        
    $tag = $_POST["Tag"];
    $Amount = $_POST["Amount"];
    $userTag = mysqli_query($db, "select * from user where Tag='$tag'");
    $farr = mysqli_fetch_array($userTag);
    $arr = $farr["id"];
    $DemBal = $farr["AccountBalance"];
    $type = "Debit";
    $type2 = "Credit";


    if (empty($tag) || empty($Amount)) {
        echo '<script>swal("TRANSFER FAILED","Please Input Required Info","error")</script>';
    } elseif ($tag == $Tag) {
        echo '<script>swal("TRANSFER FAILED","You cannot send money to yourself","error")</script>';
    } elseif (mysqli_num_rows($userTag)<1) {
        echo '<script>swal("TRANSFER FAILED","Invalid Tag","error")</script>';
    } elseif ($Amount <= 99) {
        echo '<script>swal("TRANSFER FAILED","Minimum transfer amount is #100","error")</script>';
    } elseif ($Accbal < $Amount) {
        echo '<script>swal("TRANSFER FAILED","Insufficient Balance","error")</script>';
    } else {

        $newBal = $Accbal - $Amount ;
        $creBal = $DemBal + $Amount;
        $user=mysqli_query($db, "update user set AccountBalance= '$newBal' where id = '".$_SESSION['user']."' ");
        $Demuser=mysqli_query($db, "update user set AccountBalance= '$creBal' where id = '$arr' ");
        $DebitTransaction=mysqli_query($db, "insert into transactions(userId, BName, TransactionType, Amount)values('".$_SESSION['user']."', '$arr', '$type', '$Amount')");
        $Transaction=mysqli_query($db, "insert into transactions(userId, BName, TransactionType, Amount)values('$arr','".$_SESSION['user']."', '$type2', '$Amount')");
        echo "<script>swal('TRANSFER SUCCESSFUL', 'Transferred $Amount to @$tag. New Balance is $newBal' ,'success')</script>";
        $benn = mysqli_query($db, "select * from beneficiaries where userId = '".$_SESSION['user']."' && BennId = '$arr' ");
        $bnn = mysqli_num_rows($benn);
        if ($bnn > 0) {
        }else {
            $Benn=mysqli_query($db, "insert into beneficiaries(userId, BennId)values('".$_SESSION['user']."', '$arr')");
        }
    }

}

?>

<script>

    document.getElementById("tag").value = '';
    document.getElementById("amnt").value = '';
    document.getElementById("sendd").classList.remove('show');

</script>