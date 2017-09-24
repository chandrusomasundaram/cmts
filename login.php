<?php

include "init.php";

session_start();

if(isset($_POST['btn_login']))
{
$username = $_POST["username"];
$password = $_POST["password"];

$query = "select emp_name,emp_city from employee_pd where emp_email like '$username' and emp_pass like '$password' and emp_type like 'admin';";

$result = mysqli_query($db_conn,$query);
$count = mysqli_num_rows($result);

if($count > 0){
	$row = mysqli_fetch_row($result);
	$adminName = $row[0];
	$adminCity = $row[1];
	$_SESSION["adminname"] = $adminName;
	$_SESSION["username"] = $_POST["username"];
	$_SESSION["admincity"] = $adminCity;
	echo "<h3>".$_SESSION["username"]."</h3>";
	header('location:homepage.php');
}
else{
	include "index.php";
	echo "<script>
			document.getElementById('err_msg').innerHTML='Username or Password was invalid';
		  </script>";
}
mysqli_close($db_conn);
}
?>

