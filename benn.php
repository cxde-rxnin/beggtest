<?php

    include 'deet.php';

    $Benn = mysqli_query($db, "select * from beneficiaries where userId = '".$_SESSION['user']."'");
    while ($Bname = mysqli_fetch_array($Benn)) {
        $bid = $Bname['BennId'];

        $Bid = mysqli_query($db, "select * from user where id = '$bid' ");
        $Name = mysqli_fetch_array($Bid);
        $row = mysqli_num_rows($Bid);
        $BName = $Name['Tag'];

        if($row < 0){
            echo"<p class='BennErr'>You do not have any beneficiaries</p>";
        } elseif ($row > 1) {
            break;
        }else {
            echo"<div class='bentag moddl-open' id='$bid'>
            <input type='hidden' name='vxll'>
            <p>$BName</p>
            </div>";
        }

    }
?>

<script>

        var moddl = document.getElementsByClassName('modaall');
        var openB = document.getElementsByClassName('bentag');
        var closeB = document.getElementsByClassName('closse');

        for (let i = 0; i < openB.length; i++) {

            openB[i].addEventListener("click", function(y) {

               // alert(open[i].id);
                moddl[0].style.display = 'flex';

            $.ajax({
                url: "bennSend.php?vxll="+openB[i].id,
                type: "get",
                data: "nav=link",
                processData: "false",
                contentType: "false",
                cache: "false",
                beforeSend: function () {
                    $(".frrm").html("loading");
                },
                success: function (d) {
                //    setInterval(() => {
                        $(".frrm").html(d);
                //    }, 2000);
                },
                error: function () {
                }
            });
        })
        }

        closeB[0].addEventListener('click', function() {
            moddl[0].style.display = 'none';
        })


</script>