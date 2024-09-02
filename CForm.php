


<?php

    include 'deet.php';

    if ($_SERVER['REQUEST_METHOD']=="POST") {

        $Ammt = $_POST["ammt"];
        $ID = $_POST["vall"];

        $lim = mysqli_query($db, "select * from crowdfund where id = '$ID'");

        $limit = mysqli_fetch_array($lim);

        $UID = $limit['userId'];
        $Amt = $limit['FundAmount'];
        $AmtRs = $limit['AmountRaised'];
        $type = "CrowdFund";
        $type2 = "SendFund";



        $benn = mysqli_query($db, "select * from user where id = '".$_SESSION['user']."'");
        $bnn = mysqli_fetch_array($benn);

        $baln = $bnn['AccountBalance']; 
        $bid = $bnn['id'];

        $Ubenn = mysqli_query($db, "select * from user where id = '$UID'");
        $bann = mysqli_fetch_array($Ubenn);

        $bal = $bann['AccountBalance']; 
        
           
        if (empty($Ammt)) {
            echo '<script>swal("FUNDING FAILED","Please Input Amount","error")</script>';
        } elseif ($Ammt <= 0) {
            echo '<script>swal("FUNDING FAILED","Amount Cannot Be Less Than Zero","error")</script>';
        } elseif ($Ammt > $baln) {
            echo '<script>swal("FUNDING FAILED","You Do Not Have Enough Money To Fund This Campaign","error")</script>';
        } else {

            $newBal = $baln - $Ammt;
            $NBal = $bal + $Ammt;
            $CBal = $AmtRs + $Ammt;

            $Transaction=mysqli_query($db, "insert into transactions(userId, BName,  TransactionType, Amount)values('$UID', '".$_SESSION['user']."', '$type', '$Ammt')");
            $UTransaction=mysqli_query($db, "insert into transactions(userId, BName,  TransactionType, Amount)values('".$_SESSION['user']."', '$UID', '$type2', '$Ammt')");
            $CrdFnd=mysqli_query($db, "update user set AccountBalance= '$newBal' where id = '".$_SESSION['user']."' ");
            $SndFnd=mysqli_query($db, "update user set AccountBalance= '$NBal' where id = '$UID' ");
            $CrwdFnd=mysqli_query($db, "update crowdfund set AmountRaised = '$CBal' where id = '$ID' ");
            echo '<script>swal("Congrats","Successfully Funded This Campaign","success")</script>';
        }

    }

?>


<script>

    document.getElementById("amt").value = '';

</script>