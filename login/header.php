<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE u_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);

$ut=mysql_query("SELECT COUNT(*) FROM users;");
$ucount=mysql_result($ut,0);

$vt=mysql_query("SELECT COUNT(*) FROM customer;");
$vcount=mysql_result($vt,0);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>VSMS Dashboard</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">
<link href="scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="css/custom.css" rel="stylesheet">
</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="dashboard.php"><span> VSMS </span>Admin Area</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg><?php echo $userRow['u_email']; ?> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="profile.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="logout.php?logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div>
		<a class="nav menu" href="#">
                    <img src="img/lamborghini-logo-psd-462117.png" alt="" height="200" width="180" style="margin-left: 9%; margin-top: 3%; "></a>
		<br></div>
		
		<ul class="nav menu side-nav">
		
			<li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<?php
   if($userRow['u_type']=="Admin") 
	echo '<li><a href="manage_employee.php"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Manage Employee</a></li><li role="presentation" class="divider"></li>';
  ?>
			<li><a href="model.php"><svg class="glyph stroked dashboard dial"><use xlink:href="#stroked-dashboard-dial"/></svg>Vehicle Model</a></li>
			<li><a href="vehicles.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>Vehicles</a></li>
			<li><a href="sold.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Sold Vehicles</a></li>
			<li role="presentation" class="divider"></li>
		</ul>

	</div><!--/.sidebar-->
		<!--/.main-->
	<script src="js/jquery-1.12.0.min.js" type="text/javascript"></script>
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="js/jquery.dataTables.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/lumino.glyphs.js"></script>
	
    
   
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>
</html>