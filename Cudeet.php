



<?php
include 'deet.php';

$crw = mysqli_query($db, "select * from crowdfund where id = '".$_GET['myvall']."'");

$crwdeet = mysqli_fetch_array($crw);
    
    $Cid = $crwdeet['id'];
    $Crid = $crwdeet['userId'];
    $CName = $crwdeet['FundName'];
    $CAmount = number_format($crwdeet['FundAmount']);
    $Climit = number_format($crwdeet['AmountRaised']);
    $SDate = $crwdeet['StartDate'];
    $EDate = $crwdeet['EndDate'];
    $Req = $crwdeet['Req'];

    $Crd = mysqli_query($db, "select * from user where id = '$Crid'");
    $Crname = mysqli_fetch_array($Crd);
    $Cfname = $Crname['FirstName'];
    $Clname = $Crname['LastName'];


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


if ($crwdeet) {

        echo "
            <h1 class='Title'>$CName</h1>
            <p>CrowdFund Creator: <span class='prize'>$Cfname $Clname</span></p>
            <p>Target Amount: <span class='prize'>$CAmount</span></p>
            <p>Amount Raised: <span class='prize'>$Climit</span></p>
            <p>Status: <span class='status'>$St</span></p>";
            if ($St == "Ended") {
                
            }
            else{
                if ($Crid != $_SESSION['user']) {
                    echo"
                        <form class='frm Snd' id='fm' action='post'>
                            <input type='hidden' name='vall' value='$Cid'>
                            <input type='text' name='ammt' class='Amount1' id='amt' placeholder='Input Amount' oninput='comma(this)'>
                            <button type='submit'>Send Fund</button>
                        </form>

                    ";
                } else {
                    echo"
                        <form class='frm Ugiv' id='fm' action='post'>
                            <input type='hidden' name='val' value='$Cid'>
                            <button type='submit' id='end'>End CrowdFund</button>
                        </form>
                    ";
                };
            }
            echo "

        <div class='shows'></div>
        ";
    } else {
        echo"<p class='message'>No CrowdFund</p>";
    }

?>
<div class="fn"></div>

<script>

$(document).ready(function () {
        $(".Ugiv").on('submit', function(c){
            c.preventDefault();

            if (confirm("Do you want to end this Crowdfund?")== true ) {
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


        function comma(input) {
            var value = input.value.replace(/,/g, '');
            var ui = parseFloat(value);
            if (!isNaN(ui)) {
                var formattedValue = ui.toLocaleString();
                input.value = formattedValue;
            } else {
                input.value = '';
            }
        }

        function removeComma(input) {
            var value = input.value;
            var cleanValue = value.replace(/,/g, '');
            input.value = cleanValue;
            return cleanValue;
        }


            $(".Snd").on('submit', function(c){
            c.preventDefault();
            var amountInput1 = document.querySelector('.Amount1');
            var cleanValue1 = removeComma(amountInput1);

            if (confirm("Do you want to help?")== true ) {
                $.ajax({
                url: 'CForm.php',
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