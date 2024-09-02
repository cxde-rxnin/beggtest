<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="assets/SweetAlert/sweetalert.css">
    <script src="assets/SweetAlert/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style2.css">
    <title>Begg</title>
</head>
<body>
<?php
if(isset($_SESSION['user'])){
    echo " <div class='indexSection'></div>";
}

else{
    echo "<div class='loginSection'></div>";
}

?>
   
    
<script>
    $(document).ready(function () {
        $(".loginSection").load("loginSection.php");
        $(".indexSection").load("dashboard.php");
    })

</script>
    
</body>
</html>