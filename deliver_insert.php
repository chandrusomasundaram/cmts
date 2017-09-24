<?php

include "init.php";

if(isset($_POST['btn_save']))
{
    $name = $_POST["fullname"];
    $password = $_POST["password"];
    $city = $_POST["city"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $phnum = $_POST["phnum"];
    $office = $_POST["office_address"];
    $office_id = 0;
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $image = $_FILES["fileToUpload"]["name"];
        $query = "SELECT * FROM employee_pd WHERE emp_email LIKE '".$email."' OR emp_mob LIKE '".$phnum."';";
        $result = mysqli_query($db_conn,$query);
        if(mysqli_num_rows($result) > 0) {
            echo "<script type='text/javascript'>alert('Deliverer all ready Registered');</script>";
        }
        else {
            $query1 = "SELECT * FROM office_details WHERE office_name='".$office."';";
            $result1 = mysqli_query($db_conn,$query1);
            while($row = mysqli_fetch_array($result1)){
                $office_id = $row['office_id'];
            }
            $query = "INSERT INTO employee_pd VALUES('','".$office_id."','".$image."','".$name."','".$password."','".$address."','".$city."','".$email."','".$phnum."','Free','deliver');";
            $result = mysqli_query($db_conn,$query);
            echo "<script type='text/javascript'>alert('Register Successfully');</script>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Error in image uploading');</script>";
    }
mysqli_close($db_conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico">
    
    <title>Home Page</title> 
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/nstyle.css" rel="stylesheet" />
</head>

<body>
<section id="container" class="">
    <header class="header dark-bg">
        <div class="toggle-nav">
            <div class="icon-reorder tooltips"><i class="icon_menu"></i></div>
        </div>
        <a href="homepage.php" class="logo">CMTS <span class="lite">Admin</span></a>
        <div class="top-nav notification-row">                
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
			<span class="username">
            <?php 
                session_start(); 
                if($_SESSION['username']==''){
                    header('location:index.php');
                }
                echo $_SESSION['adminname'];
            ?>
            </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <div class="log-arrow-up"></div>
                    <li>
                        <a href="logout.php"><i class="icon_key_alt"></i> Log Out</a>
                    </li>
            </ul>
        </li>
        </div>
    </header>      
    <aside>
        <div id="sidebar"  class="nav-collapse">
        <ul class="sidebar-menu"> 
			<li class="sub-menu">
                <a href="javascript:;" onclick="fetch_data();">
                <span>
                        <i class="arrow_carrot-right"></i>Pickup Requestors
                </span>
                </a>
            </li>    
            <li class="sub-menu">
                <a href="javascript:;" onclick="delivery();" class="">
                <span>
                        <i class="arrow_carrot-right"></i>Delivery Details
                </span>
                </a>
            </li>   
            <li class="sub-menu">
                <a href="javascript:;" onclick="deliver();" class="">
                <span>
                        <i class="arrow_carrot-right"></i>Deliverer Details
                </span>
                </a>
            </li>      
            <li class="sub-menu">
                <a href="deliver_insert.php" class="">
                <span>
                        <i class="arrow_carrot-right"></i>New Deliverer Entry
                </span>
                </a>
            </li> 
            <!--<li class="sub-menu">
                <a href="javascript:;" onclick="report();" class="">
                <span>
                        <i class="arrow_carrot-right"></i>Report
                </span>
                </a>
            </li>-->
        </ul>
        </div>
    </aside>
    <section id="main-content">
    <section class="wrapper">        
		<div class="row">
            <div class="col-lg-12">
                <section class="panel">
					<div class="table-responsive" id="tableresponse">   
                        <div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading"> <center> <h3> <b> Deliverer Entry </b> </h3> </center> </header>
            <div class="panel-body">
                <div class="form">
                    <form class="form-validate form-horizontal" name="register_form" id="register_form" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group ">
                            <label for="fullname" class="control-label col-lg-2">Full name <span class="required">*</span></label>
                            <div class="col-lg-10">
                                <input class=" form-control" id="fullname" name="fullname" type="text"/>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="address" class="control-label col-lg-2">Address <span class="required">*</span></label>
                               <div class="col-lg-10">
                                    <input class=" form-control" id="address" name="address" type="text"/>
                               </div>
                        </div>
                        <div class="form-group ">
                             <label for="Office" class="control-label col-lg-2">Office name <span class="required">*</span></label>
                                <div class="col-lg-10">
                                <select class=" form-control" id="office_address" name="office_address" required="true">
                                    <option disabled selected value> -- select an option -- </option>
                                      <?php 
                                            include "init.php";
                                            $query = "select office_name from office_details;";
                                            $result = mysqli_query($db_conn,$query);
                                            if(mysqli_num_rows($result)>0){
                                                while($row = mysqli_fetch_row($result)) { echo "<option value='".$row[0]."'>".$row[0]."</option>"; }
                                            } 
                                        ?>
                                </select>
                                </div>
                        </div>
                        <div class="form-group ">
                             <label for="password" class="control-label col-lg-2">Password <span class="required">*</span></label>
                                <div class="col-lg-10">
                                     <input class="form-control " id="password" name="password" type="password"/>
                                </div>
                        </div>
                        <div class="form-group ">
                             <label for="city" class="control-label col-lg-2">City <span class="required">*</span></label>
                                <div class="col-lg-10">
                                     <input class="form-control " id="city" name="city" type="text"/>
                                </div>
                        </div>
                        <div class="form-group ">
                             <label for="email" class="control-label col-lg-2">Email <span class="required">*</span></label>
                                <div class="col-lg-10">
                                     <input class="form-control " id="email" name="email" type="email"/>
                                </div>
                        </div>
                        <div class="form-group ">
                             <label for="phone" class="control-label col-lg-2">Phone Number <span class="required">*</span></label>
                                <div class="col-lg-10"> 
                                     <input class="form-control " id="Phnum" name="phnum" type="text"/>
                                </div>
                        </div>
                        <div class="form-group ">
                             <label for="phone" class="control-label col-lg-2">Upload Image <span class="required">*</span></label>
                                <div class="col-lg-10"> 
                                     <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                                </div>
                        </div>
                        <div class="form-group ">
                             <label for="agree" class="control-label col-lg-2 col-sm-3">Agree to Our Policy <span class="required">*</span></label>
                                <div class="col-lg-10 col-sm-9">
                                     <input  type="checkbox" style="width: 20px" class="checkbox form-control" id="agree" name="agree"/>
                                </div>
                        </div>
                        <div class="form-group">
                             <div class="col-lg-offset-2 col-lg-10">
                                  <center><button value="btn_save" id="btn_save" type="submit" name="btn_save" class="btn btn-primary">Save</button></center>
                                  <center><span id="success_msg"></span></center>
                             </div>
                        </div>
                      </div>
                 </div>
            </div>
        </section>
    </div>
  </div>                     
</div>
<div><center><p id="success_msg"></p></center></div>
</section>
</div>
</div>
</section>
</section>
</section>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script src="js/form-validation-script.js"></script>
    <script src="js/scripts.js"></script> 
    <script>
        function fetch_data(){
			$.ajax({
				url:"pickup.php",
				method:"POST",
				success:function(data){
					$('#tableresponse').html(data);
				}
			})
		}
        function deliver(){
            $.ajax({
                url:"deliver.php",
                method:"POST",
                success:function(data){
                    $('#tableresponse').html(data);
                }
            })
        }

        function delivery(){
            $.ajax({
                url:"delivery.php",
                method:"POST",
                success:function(data){
                    $('#tableresponse').html(data);
                }
            })
        }
      
        function report(){
            $.ajax({
                url:"report.php",
                method:"POST",
                success:function(data){
                    $('#tableresponse').html(data);
                }
            })
        }

	    $(document).ready(function(){
		$(document).on('click','.btn_delete',function(){
		    var email = $(this).data("id1");
		    if(confirm("Are you want to assign this request?")){
		    $.ajax({
			    url:"assign.php",
			    method:"POST",
			    data:{id:email},
			    dataType:"text",
			    success:function(data){
				alert(data);
				fetch_data();
			    }
		    });
		  }
	   });

	});
	</script>   
  </body>
</html>