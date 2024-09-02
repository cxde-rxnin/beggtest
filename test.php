<?php

if (isset($_POST['sub'])) {
   $date =  date('d m');
   echo $date;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="test.php" method="post">
        <input type="date" name="sDate" id="">
        <input type="submit" name="sub" value="date">
    </form>
</body>
</html>