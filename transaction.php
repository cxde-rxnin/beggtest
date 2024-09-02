<?php

include 'deet.php';




    $trans = mysqli_query($db, "select * from transactions where userId = '".$_SESSION['user']."' order by id desc");

    while($tran = mysqli_fetch_array($trans)){



        $userid = $tran['userId'];
        $Bname = $tran['BName'];
        $Type = $tran['TransactionType'];
        $Amount = number_format($tran['Amount'],2);


        $bname = mysqli_query($db, "select * from user where id = '$userid' ");

        $Rname = mysqli_fetch_array($bname);
        $name = $Rname['FirstName'];
        $lname = $Rname['LastName'];
        $AccN = $Rname['AccountNumber'];


        $uName = mysqli_query($db, "select * from user where id = '$Bname' ");

        $Name = mysqli_fetch_array($uName);
        $FName = $Name['FirstName'];
        $LName = $Name['LastName'];



        if ($Type == "Debit") {
            $Dr = "You paid $FName $LName";
            $chrg = "- NGN $Amount";
        } elseif ($Type == "CrowdFund") {
            $Dr = "Your campaign was funded";
            $chrg = "+ NGN $Amount";
        } elseif ($Type == "SendFund") {
            $Dr = "You funded a campaign";
            $chrg = "- NGN $Amount";
        } else {
            $Dr = "You recieved payment from $FName $LName";
            $chrg = "+ NGN $Amount";
        }


        echo" <div class='car tn open-modal'>
                    <div class='texx'>
                        <h2 id='mss'>$Dr</h2> 
                    </div>
                    <div class='amt'>
                        <h2>$chrg</h2>
                    </div>
                </div>




            ";

                

    }
    
?>


