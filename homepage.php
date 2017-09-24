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
                echo $_SESSION['adminname'];?></span>
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
                        <i class="arrow_carrot-right"></i>Pickup Details
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

            fetch_data();

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