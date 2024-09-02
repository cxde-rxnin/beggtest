
<?php

    include 'deet.php';

    if ($_SERVER['REQUEST_METHOD']=="POST") {

        $tag = $_POST["tag"];
        $ID = $_POST["val"];

        $lim = mysqli_query($db, "select * from giveaway where id = '$ID'");

        $limit = mysqli_fetch_array($lim);

        $Elim = $limit['EntryLimit'];
        $Wlim = $limit['GiveAwayLimit'];

        $Joined = mysqli_query($db, "select * from giveawayentry where giveAwayId = '$ID'");
        $Ujoin = mysqli_num_rows($Joined);


        $benn = mysqli_query($db, "select * from giveawayentry where userId = '".$_SESSION['user']."'");
        $bnn = mysqli_num_rows($benn);
        
       if ($Ujoin < $Elim) {
           
        if (empty($tag)) {
            echo '<script>swal("INPUT FAILED","Please Input Required Info","error")</script>';
        } elseif ($tag != $Tag) {
            echo '<script>swal("INPUT FAILED","Please Input Your Tag","error")</script>';
        } elseif ($bnn > 0) {
            echo '<script>swal("INPUT FAILED","You Cannot Join A Giveaway Twice","error")</script>';
        } else {
            $entry = mysqli_query($db, "insert into giveawayentry(giveAwayId, userId, userTag)values('$ID', '".$_SESSION['user']."', '$tag')");
            echo '<script>swal("Congrats","Successfully Joined This Giveaway","success")</script>';
        }

        }  else{
            echo '<script>swal("INPUT FAILED","Giveaway Entry Limit Has Been Reached","error")</script>';
        }

    }

?>


<script>

    document.getElementById("Tgg").value = '';

</script>