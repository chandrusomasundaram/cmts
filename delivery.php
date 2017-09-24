<?php
	include "init.php";
	session_start();
	$output = null;
	$name = null;
	$name = $_SESSION["username"];
	$city = $_SESSION["admincity"];
	if($name != null)
	$query = "select emp_name from employee_pd;";
	$result = mysqli_query($db_conn,$query);
	$GLOBALS['design'] = "<header class='panel-heading'>
               <h4 align='center'><b>Pickup Requestors</b></h4>
               </header>
			   <table class='table table-striped table-advance table-hover' id='table_value'>
               <tbody>
               <tr>
               <th><i class='icon_profile'></i> Name</th>
			   <th><i class='icon_calendar'></i> Booked Date</th>
               <th><i class='icon_calendar'></i> Delivery Date</th>
               <th><i class='icon_mobile'></i> Mobile</th>
			   <th><i class='icon_info'></i> Status</th>
			   <th><i class='icon_gift'></i> Type</th>
			   <th><i class='icon_cogs'></i> Action</th>
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
	 $query = "SELECT * FROM pickup p INNER JOIN customer_registration cr ON p.cus_id = cr.cus_id AND deliver_city = '".$city."'";
	 $result = mysqli_query($db_conn,$query) or die(displayError());
	 $count = mysqli_num_rows($result);
	 if($count >= 1)
	 {
	  while($row = mysqli_fetch_array($result))
	  {
		$output .= "<tr>
		<td>".$row['deliver_name']."</td>
        <td>".$row['book_date']."</td>
		<td>".$row['schedule_date']."</td>
		<td>".$row['deliver_mob']."</td>
		<td>".$row['status']."</td>
		<td>".$row['parcel_type']."</td>
		<td><button type='submit' data-id1=".$row['pickup_id']." name='delete' id='btn_delete' class='btn btn-xs btn-success btn_delete'>></button></td>
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