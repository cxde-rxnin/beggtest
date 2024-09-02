<?php

session_start();

include 'conn.php';

$userDetails = mysqli_query($db, "select * from user where id = '".$_SESSION['user']."'");

$fetch = mysqli_fetch_array($userDetails);


$id = $fetch['id'];
$FName = $fetch['FirstName'];
$LName = $fetch['LastName'];
$AccNum = $fetch['AccountNumber'];
$Bank = $fetch['BankName'];
$Accbal = $fetch['AccountBalance'];
$Tag = $fetch['Tag'];

?>