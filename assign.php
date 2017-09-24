<?php
 
require 'init.php';

$pickup_id = $_POST["id"];

$query = "SELECT sender_area,sender_city FROM pickup WHERE pickup_id LIKE '".$pickup_id."' AND status LIKE 'registered';";
$result = mysqli_query($db_conn,$query);
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $pickup_area = $row[0];
    $pickup_city = $row[1];
    $query_sec = "SELECT office_id FROM office_details WHERE office_city LIKE '".$pickup_city."';";
    $result_sec = mysqli_query($db_conn,$query_sec);
    if($result_sec) {
        $row_sec = mysqli_fetch_array($result_sec);   
        $office_id = $row_sec[0];
        $query_thr = "SELECT emp_id FROM  employee_pd WHERE office_id LIKE '".$office_id."' AND emp_type LIKE 'deliver' ;";
        $result_thr = mysqli_query($db_conn,$query_thr);
        if($result_thr) {
            $row_thr = mysqli_fetch_array($result_thr);
            $emp_id = $row_thr[0];
            $assign_date = date("M d H:i");
            $query_five = "SELECT * FROM assign_pickup WHERE pickup_id LIKE '".$pickup_id."';";
            $result_five = mysqli_query($db_conn,$query_five);
            if(mysqli_num_rows($result_five) > 0) {
                echo "Pickup request already assigned"; 
            } 
            else {
                $query_four = "INSERT INTO assign_pickup VALUES('','".$pickup_id."','".$emp_id."','".$assign_date."');";
                $result_four = mysqli_query($db_conn,$query_four);
                if($result_four) {
                    echo "Pickup successfully assigned to deliverer.";
                }
                else {
                    echo "Server busy, Please try later.";
                }
            }
        }
    } 
}
mysqli_close($db_conn);
?>