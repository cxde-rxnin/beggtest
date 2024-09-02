
<script>

    function openTabx(event, tabName) {
        var i, tabcontent, tablinks;

        tabcontent = document.querySelectorAll("div[id^='Chop']");
        for (let j = 0; j < tabcontent.length; j++) {
            tabcontent[j].style.display = "none";
        }

        tablinks = document.getElementsByClassName("cntte");
        for ( i = 0; i < tablinks.length; i++) {
            tablinks[i].style.borderBottom = '';
        }

        document.getElementById(tabName).style.display = "block";
        event.currentTarget.style.borderBottom = "4px solid #c3e647";

    }

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector('.cntte').click();
    });

</script>

<?php

            include 'deet.php';

            $Crw = mysqli_query($db, "select * from crowdfund where userId = '".$_SESSION['user']."' and Status = 'Active'");

            while ($Crwdeet = mysqli_fetch_array($Crw)) {
                
                $Dr = "You created ";
                $ID = $Crwdeet['id'];
                $FName = $Crwdeet['FundName'];
                $Amount = $Crwdeet['FundAmount'];
                $AmntRaised = $Crwdeet['AmountRaised'];
                $SDate = $Crwdeet['StartDate'];
                $EDate = $Crwdeet['EndDate'];
                $Req = $Crwdeet['Req'];
            

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

            if ($Crwdeet) {
                echo"<div class='wth moddl-open' id='$ID' onclick='cliq(this)'>
                        <div class='txx'>
                            <div class='texx'>
                                <h2 id='mss'>$Dr $FName</h2> 
                            </div>
                            <div class='amt'>
                                <h2>$St</h2>
                            </div>
                        </div>
                        <progress value='$AmntRaised' max='$Amount'></progress>
                    </div>";
            } else {
                echo"<p class='message'>You have not started a crowdfund</p>";
            }

        }
?>



<script>

        var moddll = document.getElementsByClassName('moddll');
        var openc = document.getElementsByClassName('moddll-open');
        var closec = document.getElementsByClassName('moddll-close');

        function cliq(i) {
            i=i.id;

            moddll[0].style.display = 'flex';

            $.ajax({
                url: "Cudeet.php?myvall="+i,
                type: "get",
                data: "nav=link",
                processData: "false",
                contentType: "false",
                cache: "false",
                beforeSend: function () {
                    $(".dttll").html("loading");
                },
                success: function (d) {
                //    setInterval(() => {
                        $(".dttll").load("Cudeet.php?myvall="+i);
                //    }, 2000);
                },
                error: function () {
                }
            });
        
        }

        closec[0].addEventListener("click", function() {
            moddll[0].style.display = 'none';
        })

</script>