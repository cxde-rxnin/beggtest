

<?php session_start(); include 'db.php';


if ($_SERVER['REQUEST_METHOD']=="POST")  {





$fullname=mysqli_escape_string($conn, myfun($_POST['fullname']));
$username=mysqli_escape_string($conn, myfun($_POST['username']));
$emailphone=mysqli_escape_string($conn, myfun($_POST['emailphone']));
$password=mysqli_escape_string($conn, myfun($_POST['password']));
$confirmpassword=mysqli_escape_string($conn, myfun($_POST['confirmpassword']));



if (empty($fullname) || empty($username) || empty($emailphone) || empty($password)) {
echo '<script>swal("LOGIN FAILED!","Some box are empty!","error")</script>';

				
}

elseif (!preg_match("/^[a-zA-Z ]*$/" , $fullname)) {
echo '<script>swal("LOGIN FAILED!","Name should contain only letter and white space","error")</script>';

}

elseif(strlen($username)<5){
	echo '<script>swal("LOGIN FAILED!","Username must be atleast five length","error")</script>';

}

elseif(strlen($emailphone)<10){

echo '<script>swal("LOGIN FAILED!","Email is not your correct","error")</script>';

}

else{

if (strlen($password)<6) {
	echo '<script>swal("LOGIN FAILED!","password must be at list 6 length","error")</script>';


}

elseif ($password!=$confirmpassword) {
	echo '<script>swal("LOGIN FAILED!","Password does not match","error")</script>';


		
}

else{
	$sel=mysqli_query($conn, "select * from signup where emailphone='$emailphone'");
	$sel1=mysqli_query($conn, "select * from signup where username='$username'");

	if (mysqli_num_rows($sel)>0) {
	echo '<script>swal("LOGIN FAILED!","Email or phone number already taken","error")</script>';


	}
	elseif (mysqli_num_rows($sel1)>0) {
	echo '<script>swal("LOGIN FAILED!","Username already taken","error")</script>';


	}

	else{
		$userid=mt_rand()+rand(100,1000);
		$selectid=mysqli_query($conn, "SELECT * from signup where userid='$userid'");
		if (mysqli_num_rows($selectid)>0) {
		echo "<script>alert('Submit again')</script>";
		}
		else{
			
	$ins=mysqli_query($conn, "insert into signup(fullname,username,emailphone,password,userid)values('$fullname','$username','$emailphone','$password','$userid')");



if($ins){
setcookie('user',$emailphone,time()+(86400*30),"/");
	
	if ($ins) {
	$hour=Date('h');
	$minutes=Date('i');
	$ap=Date('a');
$_SESSION['gameround']=1;
	$notification=mysqli_query($conn, "insert into notification(emailphone,maintext,minute,hour,day,month,year,type,typeshort,typecolor)values('$emailphone','You have signup for Reality game. Your userid is $userid','$minutes','$hour','".Date('d')."','".Date('m')."','".Date('Y')."','signup','S','red')");
	echo header("Location:checksignup.php");
}

}
	//echo "<script>window.location.href='index.php'</script>";

	}

	}
	
		//echo "<script>alert('Successful Registration!')</script>";
}


}
}


function myfun($para){
	$para=trim($para);
	$para=stripslashes($para);
	$para=htmlspecialchars($para);
	return $para;
}

?>