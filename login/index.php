<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: dashboard.php");
}

if(isset($_POST['btn-login']))
{
	$email = mysql_real_escape_string($_POST['email']);
	$upass = mysql_real_escape_string($_POST['password']);
	
	$email = trim($email);
	$upass = trim($upass);
	
	$res=mysql_query("SELECT u_id, f_name, l_name, u_pass , u_type FROM users WHERE u_email='$email'");
	$row=mysql_fetch_array($res);
	
	$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
	
	if($count == 1 && $row['u_pass']==md5($upass)&& $row['u_type']=="Admin")
	{
		$_SESSION['user'] = $row['u_id'];
		header("Location: dashboard.php");
	}
	else if($count == 1 && $row['u_pass']==md5($upass)&& $row['u_type']=="Employee")
	{
		$_SESSION['user'] = $row['u_id'];
		header("Location: dashboard.php");
	}
	else
	{
		?>
        <script>alert('Username or Password Is Wrong !');</script>
        <?php
	}
	
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>VSMS ADMIN LOGIN</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

</head>

<body>
	<div class="loinpage">
		<div class="mar">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in to Admin Area</div>
				<div class="panel-body">
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" required>
							</div>
							<button class="btn btn-success" type="submit" name="btn-login">Sign In</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	</div>
	</div>	
</body>

</html>
