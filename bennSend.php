<?php

include 'deet.php';
$bnn = mysqli_query($db, "select * from beneficiaries where BennId = '".$_GET['vxll']."'");


$benf = mysqli_fetch_array($bnn);
    
    $bennf = $benf['BennId'];

    $btag = mysqli_query($db, "select * from user where id = '$bennf'");

    $bentg = mysqli_fetch_array($btag);

    $btag = $bentg['Tag'];

    if ($btag) {
        echo"
        
            <div class='cacc'>
                <h2>Send to $btag</h2>
                <div class='close closse' style='margin-right: 20px;'></div>
            </div>
            <form action='post' class='frm frmb'>
                <input type='hidden' name='vxll' value='$bennf'>
                <input type='text' name='Amount' class='amount' id='mnt' placeholder='Input Amount' oninput='comma(this)''>
                <button type='submit'>Send</button>
            </form>
        
            <div class='fn'></div>
        ";
    } else {
        echo"
            <script> alert('error'); </script>
        ";
    }

?>

<script>

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


$(document).ready(function () {
    $(".frmb").on('submit', function(c){
        c.preventDefault();
        var amountInput1 = document.querySelector('.amount');
        var cleanValue1 = removeComma(amountInput1);

            $.ajax({
                url: 'bennsendtag.php',
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