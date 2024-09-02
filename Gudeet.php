

<?php
include 'deet.php';

$giv = mysqli_query($db, "select * from giveaway where id = '".$_GET['myvaxl']."'");



$givdeet = mysqli_fetch_array($giv);
    
    $Gid = $givdeet['id'];
    $Crid = $givdeet['userId'];
    $GName = $givdeet['GiveAwayName'];
    $Elimit = number_format($givdeet['EntryLimit']);
    $Glimit = number_format($givdeet['GiveAwayLimit']);
    $GAmount = number_format($givdeet['GiveAwayAmount']);
    $SDate = $givdeet['StartDate'];
    $EDate = $givdeet['EndDate'];
    $Req = $givdeet['Req'];

    $Crd = mysqli_query($db, "select * from user where id = '$Crid'");
    $Crname = mysqli_fetch_array($Crd);
    $Gfname = $Crname['FirstName'];
    $Glname = $Crname['LastName'];


if ($SDate == time()) {
    $St = "Active";
} elseif (time() >= $EDate) {
    $St = "Ended";
} elseif ($SDate > time()) {
    $St = "Pending";
} else if ($SDate < time()) {
    $St = "Active";
    
} else{
    $St = "Ended";   
}


if ($giv) {

    echo "
        <h1 class='Title'>$GName</h1>
        <p>Giveaway Creator: <span class='prize'>$Gfname $Glname</span></p>
        <p>Giveaway Prize: <span class='prize'>$GAmount</span></p>
        <p>Status: <span class='status'>$St</span></p>
        <p>Entry Limit: $Elimit</p>
        <p>Winner Limit: $Glimit</p>";
        if ($St == "Ended") {
                
        }
        else{
        
    echo"

        <form class='frm Ugiv' id='fm' action='post'>
            <input type='hidden' name='val' value='$Gid'>
            <button type='submit' id='end'>End Giveaway</button>
        </form>";
    }
    echo "

        <div class='shows'></div>
        ";
    } else {
        echo mysqli_error($db);
    }

?>
<div class="fn"></div>

<script>

$(document).ready(function () {
        $(".Ugiv").on('submit', function(c){
            c.preventDefault();

            if (confirm("Do you want to end this giveaway?")== true ) {
                $.ajax({
                url: 'GForm.php',
                type: 'post',
                data: new FormData(this),
                contentType: false,
                processData:false,
                cache: false,
                beforeSend: function(){},
                success: function(dd){
                    $(".fn").html(dd);
                    
                },
                error: function(){
                   alert(dd);
                }
            });
            }



            });
        });

</script>