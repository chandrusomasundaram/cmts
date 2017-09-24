<?php
	include "init.php";
	session_start();
	$output=null;
	$name = null;
	$name = $_SESSION["username"];
	$city = $_SESSION["admincity"];
	if($name != null)
	$query = "select emp_name from employee_pd;";
	$result = mysqli_query($db_conn,$query);
	$GLOBALS['design'] = "<header class='panel-heading'>
               <h4 align='center'><b>Delivers</b></h4>
               </header>
			   <table class='table table-striped table-advance table-hover' id='table_value'>
               <tbody>
               <tr>
               <th><i class='icon_profile'></i> Name</th>
               <th><i class='icon_mail_alt'></i> Email</th>
               <th><i class='icon_mobile'></i> Mobile</th>
			   <th><i class='icon_info'></i> Status</th>
               </tr>";
	$GLOBALS['designend'] = "</tbody>
				  			</table>";
	function displayError(){
		echo $GLOBALS['design'];
	  	echo"<tr><td colspan='6' align='center'><b>No Data Available</b></td></tr>";
	  	echo $GLOBALS['designend'];
	}
	$count = mysqli_num_rows($result);
	if($count > 0)
	{
	 $row = mysqli_fetch_assoc($result);
	 $query = "SELECT * FROM employee_pd where emp_type='deliver' AND emp_city = '".$city."'";
	 $result = mysqli_query($db_conn,$query);
	 $count = mysqli_num_rows($result);
	 if($count>=1)
	 {
	  while($row = mysqli_fetch_array($result))
	  {
		$output .= "<tr>
		<td>".$row['emp_name']."</td>
		<td>".$row['emp_email']."</td>
		<td>".$row['emp_mob']."</td>
		<td>".$row['emp_status']."</td>
		</tr>";
	  }
	  echo $GLOBALS['design'];
	  echo $output;
	  echo $GLOBALS['designend'];
	 }
	 else
	 {
	  displayError();
	 }
	}
?>