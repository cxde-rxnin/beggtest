
<?php
include 'deet.php';

$giv = mysqli_query($db, "select * from giveaway where id = '".$_GET['myval']."'");

$givdeet = mysqli_fetch_array($giv);
    
    $Gid = $givdeet['id'];
    $Crid = $givdeet['userId'];
    $GName = $givdeet['GiveAwayName'];
    $Elimit = number_format($givdeet['EntryLimit']);
    $Glimit = number_format($givdeet['GiveAwayLimit']);
    $GAmount =  number_format($givdeet['GiveAwayAmount']);
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
    echo"<script>
        var form = document.getElementsByClassName('giv');
        form[0].style.display = 'none';
    </script>";
} elseif ($SDate > time()) {
    $St = "Pending";
    echo"<script>
        var form = document.getElementsByClassName('giv');
        form[0].style.display = 'none';
    </script>";
} else if ($SDate < time()) {
    $St = "Active";
} else{
    $St = "Ended";
    echo"<script>
    var form = document.getElementsByClassName('giv');
    form[0].style.display = 'none';
    </script>";
}

if ($givdeet) {
        echo "
        <div class='dtaill'>
            <h1 class='Title'>$GName</h1>
            <p>Giveaway Creator: <span class='prize'>$Gfname $Glname</span></p>
            <p>Giveaway Prize: <span class='prize'>$GAmount</span></p>
            <p>Status: <span class='status'>$St</span></p>
            <p>Giveaway Requirements: <span class='Req'>$Req</span></p>

            <form class='frm giv' id='fm' action='post'>
                <input type='hidden' name='val' value='$Gid'>
                <input type='text' name='tag' id='Tgg' placeholder='Input BeggTag'>
                <button type='submit'>Join Giveaway</button>
            </form>

        </div>
        <div class='shows'></div>
        ";
    } else {
        echo"<p class='message'>No Giveaway</p>";
    }

?>
<div class="fn"></div>

<script>

$(document).ready(function () {
        $(".giv").on('submit', function(c){
            c.preventDefault();

            $.ajax({
                url: 'Gentry.php',
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

            });
});

</script>