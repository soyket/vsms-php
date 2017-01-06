<?php
session_start();
include_once 'login/dbconnect.php';

if(isset($_SESSION['cus'])!="")
{
	header("Location: myaccount.php");
}

if(isset($_POST['btn-login']))
{
	$c_email = mysql_real_escape_string($_POST['c_email']);
	$c_pass = mysql_real_escape_string($_POST['c_pass']);
	
	$res=mysql_query("SELECT * FROM customer WHERE c_email='$c_email'");
	$row=mysql_fetch_array($res);
	
	$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
	
	if($count == 1 && $row['c_pass']== $c_pass)
	{
		$_SESSION['cus'] = $row['c_id'];
		header("Location: myaccount.php");
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
<link href="login/css/styles.css" rel="stylesheet">

</head>

<body>
	<div class="loinpage">
		<div class="mar">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in to Client Area</div>
				<div class="panel-body">
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="c_email" type="email" autofocus="" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="c_pass" type="password" required>
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
