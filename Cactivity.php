

<?php

            include 'deet.php';

            $Crw = mysqli_query($db, "select * from CrowdFund where userId != '".$_SESSION['user']."' and Status = 'Active'");

            while ($Crwdeet = mysqli_fetch_array($Crw)) {
                
                $ID = $Crwdeet['id'];
                $Cid = $Crwdeet['userId'];
                $FName = $Crwdeet['FundName'];
                $Amount = $Crwdeet['FundAmount'];
                $AmntRaised = $Crwdeet['AmountRaised'];
                $SDate = $Crwdeet['StartDate'];
                $EDate = $Crwdeet['EndDate'];
                $Req = $Crwdeet['Req'];

                $nm = mysqli_query($db, "select * from user where id = '$Cid'");
                $cfname = mysqli_fetch_array($nm);
                $gfname = $cfname['FirstName'];
                $glname = $cfname['LastName'];
            
                $Dr = "$gfname $glname created";
            

            if ($SDate == time()) {
                $St = "Active";
            } elseif (time() >= $EDate) {
                $St = "Ended";
                $updateStatus = mysqli_query($db, "update crowdfund set Status= 'Ended' where id = '$ID'");
            } elseif ($SDate > time()) {
                $St = "Pending";
            } else if ($SDate < time()) {
                $St = "Active";
            } else{
                $St = "Ended";
                $updateStatus = mysqli_query($db, "update crowdfund set Status= 'Ended' where id = '$ID'");
            }
           // $Amount=$AmntRaised*100/($Amount);


            if ($Crwdeet) {
                echo" <div class='wth modl-open' id='$ID'>

                <div class='txx'>
                    <div class='texx'>
                        <h2 id='mss'>$Dr $FName</h2> 
                    </div>
                    <div class='amt'>
                        <h2>$St</h2>
                    </div>
                </div>
                <progress value='$AmntRaised' max='$Amount'></progress>
                </div>
                ";
            } else {
                echo"<p class='message'>You have not started a crowdfund</p>";
            }

        }
?>



<script>

        var modl = document.getElementsByClassName('modl');
        var openb = document.getElementsByClassName('modl-open');
        var closeb = document.getElementsByClassName('modl-close');

        for (let i = 0; i < openb.length; i++) {

            openb[i].addEventListener("click", function() {

            //    alert(openb[i].id);
                modl[0].style.display = 'flex';

            $.ajax({
                url: "Cudeet.php",
                type: "get",
                data: "nav=link",
                processData: "false",
                contentType: "false",
                cache: "false",
                beforeSend: function () {
                    $(".dtll").html("loading");
                },
                success: function (d) {
                //    setInterval(() => {
                        $(".dtll").load("Cudeet.php?myvall="+openb[i].id);
                //    }, 2000);
                },
                error: function () {
                }
            });
        })
        }

        closeb[0].addEventListener("click", function() {
            modl[0].style.display = 'none';
        })

</script>