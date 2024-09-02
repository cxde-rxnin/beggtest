
    


<script>

function openTabb(event, tabName) {
    var i, tabcontent, tablinks;

    tabcontent = document.querySelectorAll("div[id^='Dabb']");
    for (let j = 0; j < tabcontent.length; j++) {
        tabcontent[j].style.display = "none";
    }

    tablinks = document.getElementsByClassName("cnte");
    for ( i = 0; i < tablinks.length; i++) {
        tablinks[i].style.borderBottom = '';
    }

    document.getElementById(tabName).style.display = "block";
    event.currentTarget.style.borderBottom = "4px solid #c3e647";

}

    document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('.cnte').click();


});


</script>

    
        
<?php

            include 'deet.php';

            $giv = mysqli_query($db, "select * from giveaway where userId = '".$_SESSION['user']."' and Status = 'Active' ");

            while ($givdeet = mysqli_fetch_array($giv)) {
                
                $Dr = "You created ";
                $ID = $givdeet['id'];
                $GName = $givdeet['GiveAwayName'];
                $Elimit = $givdeet['EntryLimit'];
                $Glimit = number_format($givdeet['GiveAwayLimit']);
                $GAmount = number_format($givdeet['GiveAwayAmount']);
                $SDate = $givdeet['StartDate'];
                $EDate = $givdeet['EndDate'];
                $Req = $givdeet['Req'];
            

            if ($SDate == time()) {
                $St = "Active";
            } elseif (time() >= $EDate) {
                $St = "Ended";
                $updateStatus = mysqli_query($db, "update giveaway set Status= 'Ended' where id = '$ID'");
            } elseif ($SDate > time()) {
                $St = "Pending";
            } else if ($SDate < time()) {
                $St = "Active";
            } else{
                $St = "Ended";
                $updateStatus = mysqli_query($db, "update giveaway set Status= 'Ended' where id = '$ID'");

            }

            if ($givdeet) {
                echo" <div class='car modll-open' id='$ID' onclick='clicks(this)'>
                <div class='texx'>
                    <h2 id='mss'>$Dr $GName</h2> 
                </div>
                <div class='amt'>
                    <h2>$St</h2>
                </div>
                </div>
                ";
            } else {
                echo"<p class='message'>You have not started a giveaway</p>";
            }

        }
?>

<script>

        var modll = document.getElementsByClassName('modll');
        var openB = document.getElementsByClassName('modll-open');
        var closeB = document.getElementsByClassName('modll-close');

        function clicks(i) {
            
        i=i.id

        modll[0].style.display = 'flex';

        $.ajax({
            url: "Gudeet.php?myvaxl="+i,
            type: "get",
            data: "nav=link",
            processData: "false",
            contentType: "false",
            cache: "false",
            beforeSend: function () {
                $(".dtaill").html("loading");
            },
            success: function (d) {
                    $(".dtaill").html(d);
            },
            error: function () {
            }
        });
    }

    closeB[0].addEventListener("click", function() {
        modll[0].style.display = 'none';
    })

</script>