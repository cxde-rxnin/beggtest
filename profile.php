

<script>



</script>




<?php

    include 'deet.php';

    $profile = mysqli_query($db, "select * from user where id = '".$_SESSION['user']."' ");

    $user = mysqli_fetch_array($profile);

    $FName = $user['FirstName'];
    $LName = $user['LastName'];
    $tag = $user['Tag'];
    $Num = $user['AccountNumber'];

    if ($profile) {

        echo"
            <h1 class='Title'>$FName $LName</h1>
            <p class='sub'>@$tag</p>
            <p class='lilsub'>Account Number: $Num</p>

            <div class='ttt'></div>

            <form action='' method='post' class='frm LogOut'>
                <button type='submit'>
                    Log Out
                </button>
            </form>
        ";
    }

?>

<script>
    $(document).ready(function () {
        $(".LogOut").on('submit', function () {

            $.ajax({
                url: 'logout.php',
                type: 'post',
                data: new FormData(this),
                contentType: false,
                processData:false,
                cache: false,
                beforeSend: function(){},
                success: function(){
                },
                error: function(){
                    alert(0)
                }
            });

        });
    })
</script>