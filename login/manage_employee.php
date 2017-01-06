<?php include("header.php");?>
<?php
if(isset($_POST['update']))
{	
	$u_email = mysql_real_escape_string($_POST['u_email']);
	$f_name = mysql_real_escape_string($_POST['f_name']);
	$l_name = mysql_real_escape_string($_POST['l_name']);
	$u_bday =  $_POST['u_bday'];
	$u_position = mysql_real_escape_string($_POST['u_position']);
	$u_address = mysql_real_escape_string($_POST['u_address']);
	$u_type = mysql_real_escape_string($_POST['u_type']);
	$u_pass = md5(mysql_real_escape_string($_POST['u_pass']));
	$u_gender = mysql_real_escape_string($_POST['u_gender']);
	$s_question = mysql_real_escape_string($_POST['s_question']);
	$s_ans = mysql_real_escape_string($_POST['s_ans']);
	$u_mobile = mysql_real_escape_string($_POST['u_mobile']);
	
	if(mysql_query("INSERT INTO users (u_mobile,s_ans,s_question,u_gender,u_pass,u_address,f_name,l_name,u_bday,u_position,u_type,u_email)VALUES('$u_mobile','$s_ans','$s_question','$u_gender','$u_pass','$u_address','$f_name','$l_name','$u_bday','$u_position','$u_type','$u_email')"))
		{
			?>
			<script>alert('successfully registered ');</script>
			<?php 
		}
		else
		{
			?>
			<script>alert('error while Adding! Check email/Server...');</script>
			<?php
		}	
	}
?>

<!DOCTYPE html>
<html>
<head>
<style>
.status-available{color:#2FC332;}
.status-not-available{color:#D60202;}
</style>
<link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<link href="Scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="scripts/jtable/jquery.jtable.js" type="text/javascript"></script></head>
<body>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Manage Users</li>
			</ol>
		</div><!--/.row-->
		
	<!--	<div class="row">
			<div class="col-lg-6">
				<h1 class="page-header">Add new user</h1>
			</div>
		</div><!--/.row-->
		
		
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Add New Employee</div>
					<div class="panel-body">
					<form method="post">
						<fieldset>
							<div class="form-group">
								Email : <input class="form-control" placeholder="E-mail" name="u_email" id="username" type="email" onBlur="checkAvailability()" required><span id="user-availability-status"></span> 
							</div>
							<div class="form-group">
								Password : <input class="form-control" placeholder="Password" name="u_pass" type="password" required>
							</div>
							<div class="form-group">
								First Name : <input class="form-control" placeholder="First Name" name="f_name" type="text"  required>
							</div>
							<div class="form-group">
								Last Name : <input class="form-control" placeholder="Last Name" name="l_name" type="text" required>
							</div>
							<div class="form-group">
								Mobile : <input class="form-control" placeholder="Mobile" name="u_mobile" type="number"  required>
							</div>
							<div class="form-group">
								Position : <input class="form-control" placeholder="Position" name="u_position" type="text" required>
							</div>
							<div class="form-group">
								Gender : <input type="radio" name="u_gender" value="Male"> Male
										 <input type="radio" name="u_gender" value="Female"> Female
											
							</div>
							<div class="form-group">
								Date of Birth:<input type="date" name="u_bday">
							</div>
							<div class="form-group">
								Address: <textarea rows="3" cols="10" class="form-control"  name="u_address"></textarea>
							</div>
							<div class="form-group">
								Security Question : 
									<select class="form-control" placeholder="Security Question" name="s_question">
										  <option value="What is your 1st Phone No?">What is your 1st Phone No?</option>
										  <option value="Who is your 1st teacher?">Who is your 1st teacher?</option>
										  <option value="Who do you prise?">Who do you prise?</option>
									</select>
							</div>
							<div class="form-group">
								Answear: <input class="form-control" placeholder="Answear" name="s_ans" type="text" required>
							</div>
							<div class="form-group">
								User Type: 
										   <input type="radio" name="u_type" value="Admin"> Admin
										   <input type="radio" name="u_type" value="Employee"> Employee 								
							</div>
							<button type="submit" name="update">Submit</button>
						</fieldset>
					</form>
				</div>
				</div>
			</div>			
			
			
			<div class="col-xs-6">
				<div class="panel panel-default">
					<div class="panel-heading">All Employee</div>
					<div class="panel-body">
					<div id="userTableContainer" ></div>
				    </div>
				</div>
			</div>
			
		</div><!--/.row-->
		
		</div><!--/.row-->

		
		
		
		
		
		
		
		
			<script>
			function checkAvailability() {
				$("#loaderIcon").show();
				jQuery.ajax({
				url: "Actions.php?action=checkuser",
				data:'username='+$("#username").val(),
				type: "POST",
				success:function(data){
					$("#user-availability-status").html(data);
					$("#loaderIcon").hide();
				},
				error:function (){}
				});
			}
			</script>
			
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#userTableContainer').jtable({
				title: 'All Users ',
				actions: {
					listAction: 'Actions.php?action=listu',
					deleteAction: 'Actions.php?action=deleteu'
				},
				fields: {
					u_id: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					u_email: {
						title: 'User Email',
						width: '10%'
					},
					f_name: {
						title: 'First Name',
						width: '12%'	
					},
					l_name: {
						title: 'Last Name',
						width: '12%'	
					},
					u_mobile: {
						title: 'Mobile',
						width: '12%'	
					},
					u_type: {
						title: 'Role',
						width: '5%'	
					}				
				}
			});
			
			//Load person list from server
			$('#userTableContainer').jtable('load');

		});
		
		
		

	</script>
</body>

</html>