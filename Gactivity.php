
<?php

            include 'deet.php';

            $giv = mysqli_query($db, "select * from giveaway where userId != '".$_SESSION['user']."' and Status = 'Active'");


            while ($givdeet = mysqli_fetch_array($giv)) {

                // $Dr = "$gfname $glname created ";
                $Id = $givdeet['id'];
                $Gid = $givdeet['userId'];
                $GName = $givdeet['GiveAwayName'];
                $Elimit = number_format($givdeet['EntryLimit']);
                $Glimit = number_format($givdeet['GiveAwayLimit']);
                $GAmount = number_format($givdeet['GiveAwayAmount']);
                $SDate = $givdeet['StartDate'];
                $EDate = $givdeet['EndDate'];
                $Req = $givdeet['Req'];

                $nm = mysqli_query($db, "select * from user where id = '$Gid'");
                $gvname = mysqli_fetch_array($nm);
                $gfname = $gvname['FirstName'];
                $glname = $gvname['LastName'];
            
                $Dr = "$gfname $glname created";

            if ($SDate == time()) {
                $St = "Active";
            } elseif (time() >= $EDate) {
                $St = "Ended";
                $updateStatus = mysqli_query($db, "update giveaway set Status= 'Ended' where id = '$Id'");
            } elseif ($SDate > time()) {
                $St = "Pending";
            } else if ($SDate < time()) {
                $St = "Active";
            } else{
                $St = "Ended";
                $updateStatus = mysqli_query($db, "update giveaway set Status= 'Ended' where id = '$Id'");
            }

            if ($givdeet) {
                echo" <div class='car modal-open' id='$Id'>
                <div class='texx'>
                    <h2 id='mss'>$Dr $GName</h2> 
                </div>
                <div class='amt'>
                    <h2>$St</h2>
                </div>
                </div>


                ";
            } else {
                echo"<p class='message'>There are no Giveaways</p>";
            }

        }
?>

<script>

        var modall = document.getElementsByClassName('modall');
        var open = document.getElementsByClassName('modal-open');
        var close = document.getElementsByClassName('modal-close');

        for (let i = 0; i < open.length; i++) {

            open[i].addEventListener("click", function() {
               // alert(open[i].id);
                modall[0].style.display = 'flex';

            $.ajax({
                url: "Gdeet.php",
                type: "get",
                data: "nav=link",
                processData: "false",
                contentType: "false",
                cache: "false",
                beforeSend: function () {},
                success: function () {
                //    setInterval(() => {
                        $(".dtail").load("Gdeet.php?myval="+open[i].id);
                //    }, 2000);
                },
                error: function () {
                }
            });
        })
        }

        close[0].addEventListener("click", function() {
            modall[0].style.display = 'none';
        })

</script>