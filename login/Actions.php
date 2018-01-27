<?php

try
{
	error_reporting(E_ALL ^ E_DEPRECATED);
	$con = mysql_connect("localhost","root","");   //change as per your localhost or server database settings
	mysql_select_db("vsms", $con);   //change as per your localhost or server database settings

	//Getting records (listAction)
	if($_GET["action"] == "list")
	{
		$result = mysql_query("SELECT * FROM manufacturer;");
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
		
	}
	
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{
		//Insert record into database
		$result = mysql_query("INSERT INTO manufacturer(manufacturer_name) VALUES('" . mysql_real_escape_string($_POST["manufacturer_name"]) . "');");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM manufacturer WHERE manufacturer_id = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);

	}
	
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{
		//Update record in database
		$result = mysql_query("UPDATE manufacturer SET manufacturer_name = '" . mysql_real_escape_string($_POST["manufacturer_name"]) . "' WHERE manufacturer_id = " . $_POST["manufacturer_id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM manufacturer WHERE manufacturer_id = " . $_POST["manufacturer_id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	// model CURD 
	
	else if($_GET["action"] == "listm")
	{
		//Get records from database
		$result = mysql_query("SELECT * FROM model;");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
		}	
	else if($_GET["action"] == "listma")           //combobox for model 
	{
		//Get records from database						  
		$result = mysql_query("SELECT * from manufacturer;");
		$rows = array();
		while ($row = mysql_fetch_array($result)) {
			$eil = array();
			$eil["DisplayText"] = $row[1];
			$eil["Value"] = $row[1];
			$rows[] = $eil;
				}
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Options'] = $rows;  
		print json_encode($jTableResult);  
	}
	
	else if($_GET["action"] == "createm")
	{
		//Insert record into database
		$result = mysql_query("INSERT INTO model(model_name, manufacturer_name) VALUES('" . mysql_real_escape_string($_POST["model_name"]) . "', '" . mysql_real_escape_string($_POST["manufacturer_name"]) . "');");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM model WHERE model_id = LAST_INSERT_ID();");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	
	else if($_GET["action"] == "updatem")
	{
		//Update record in database
		$result = mysql_query("UPDATE model SET model_name = '" . mysql_real_escape_string($_POST["model_name"]) . "', manufacturer_name = '" . mysql_real_escape_string($_POST["manufacturer_name"]) . "' WHERE model_id = " . $_POST["model_id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "deletem")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM model WHERE model_id = " . $_POST["model_id"] . ";");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	
	
	//////////////User adding /updating / deleting //////////////////////
	else if($_GET["action"] == "checkuser")
	{
				if(!empty($_POST["username"])) {
					$uname= mysql_real_escape_string($_POST["username"]);
				  $result = mysql_query("SELECT count(*) FROM users WHERE u_email='" . $uname . "'");
				  $row = mysql_fetch_row($result);
				  $user_count = $row[0];
				  if($user_count>0) {
					  echo "<span class='status-not-available'> Username Not Available.</span>";
				  }else{
					  echo "<span class='status-available'> Username Available.</span>";
				  }
				}
	}
	
	
	else if($_GET["action"] == "listu")
	{
		$result = mysql_query("SELECT u_id,u_email,f_name,l_name,u_mobile,u_type FROM users;");
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
		
	}
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "deleteu")
	{
		//Delete from database
		$result = mysql_query("DELETE FROM users WHERE u_id = " . $_POST["u_id"] . " AND su !=1 ;");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	
	// vehicle quary actions
	
	else if($_GET["action"] == "v_delete")
	{
	
	$id = $_GET["id"];
	$result = mysql_query("SELECT * FROM vehicle WHERE v_id = $id;");
	$Row=mysql_fetch_array($result);
	
	if(mysql_query("DELETE FROM vehicle WHERE v_id = $id;"))
		{
				$path=explode("*",$Row['image']);
					$i=count($path);
					$file_path = 'uploads/';
					for($j=0;$j<$i;$j++)
					{
						$src=$file_path.$path[$j];
			            @unlink($src);
					}
			?>
			<script>document.location = 'vehicles.php';</script>
			
			<?php 
		}
		else
		{
			?>
			<script>alert('Error while Updating...');</script>
			<?php
		}	
	}
	else if($_GET["action"] == "v_view")
	{
	    $id = $_GET["id"];
		$res=mysql_query("SELECT * FROM vehicle WHERE v_id = $id;");
        $vehicleRow=mysql_fetch_array($res);
		
		echo '<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Modal</title>  
</head>
<body>
  <div class="modal-dialog modal-lg">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Vehicle Details</h4>
				  </div>
				  <div class="modal-body">
					<form role="form">
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Vehicle ID</label><input type="text" class="form-control" value="'.$vehicleRow['v_id'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Manufacturer</label><input type="text" class="form-control" value="'.$vehicleRow['manufacturer_name'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Model</label><input type="text" class="form-control" value="'.$vehicleRow['model_name'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Vehicle Category</label><input type="text" class="form-control" value="'.$vehicleRow['category'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">	
							<div class="form-group">
							  <label>Vehicle Buying Price</label><input type="text" class="form-control" value="'.$vehicleRow['b_price'].'" disabled>
							</div></div>
							<div class="col-xs-6">	
							<div class="form-group">
							  <label>Vehicle Selling Price</label><input type="text" class="form-control" value="'.$vehicleRow['s_price'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">		
							<div class="form-group">
							  <label>Added On </label><input type="text" class="form-control" value="'.$vehicleRow['add_date'].'" disabled>
							</div></div>
							<div class="col-xs-6">	
							<div class="form-group">
							  <label>Sold On </label><input type="text" class="form-control" value="'.$vehicleRow['sold_date'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">		
							<div class="form-group">
							  <label>Current Mileage</label><input type="text" class="form-control" value="'.$vehicleRow['mileage'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Registration Year	</label><input type="text" class="form-control" value="'.$vehicleRow['registration_year'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Insurance Id</label><input type="text" class="form-control" value="'.$vehicleRow['insurance_id'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Gear Type</label><input type="text" class="form-control" value="'.$vehicleRow['gear'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>No of Doors</label><input type="text" class="form-control" value="'.$vehicleRow['doors'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>No of Seats</label><input type="text" class="form-control" value="'.$vehicleRow['seats'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Engine Number</label><input type="text" class="form-control" value="'.$vehicleRow['e_no'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Chassis Number</label><input type="text" class="form-control" value="'.$vehicleRow['c_no'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Color: </label><input type="text" class="form-control" value="'.$vehicleRow['v_color'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Sold by : </label><input type="text" class="form-control" value="'.$vehicleRow['u_id'].'" disabled>
							</div></div></div>
							<div class="form-group">
							  <label>Fual Tank Capacity(litter)</label><input type="text" class="form-control" value="'.$vehicleRow['tank'].'" disabled>
							</div>
							<div class="form-group">
							  <label>Gallery</label><br><br>';
									$path=explode("*",$vehicleRow['image']);
															$i=count($path);
															$file_path = 'uploads/';
															for($j=0;$j<$i;$j++)
															{
																$src=$file_path.$path[$j];
																?>
									<img src="<?php echo $src; ?>" class="img-thumbnail" width="240" height="140">
									<?php } 
							echo '</div>
						  </form>
				  </div>
				  <div class="modal-footer">
					<button type="button" onclick="javascript:window.location.reload()" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>

			  </div>
</body>
</html>';
	
}
	
	else if($_GET["action"] == "v_cat")
	{
	$parent_cat = $_GET['parent_cat'];

		$query = mysql_query("SELECT * FROM model WHERE manufacturer_name = '$parent_cat'");
		while($row = mysql_fetch_array($query)) {
			echo "<option value='$row[model_name]'>$row[model_name]</option>";
		}
	}
	
	else if($_GET["action"] == "vs_delete")
	{
	
	$id = $_GET["id"];
	
	if(mysql_query("DELETE FROM customer WHERE v_id = $id;"))
		{   
		$result = mysql_query("UPDATE vehicle SET s_price = NULL,u_id = NULL,sold_date = NULL, status = 'Available'  WHERE v_id =$id;");
			?>
			<script>document.location = 'sold.php';</script>
			<?php 
		}
		else
		{
			?>
			<script>alert('Error while Deleting...');</script>
			<?php
		}	
	}
	
	else if($_GET["action"] == "vs_view")
	{ 
	    $id = $_GET["id"];
		$res=mysql_query("SELECT * FROM customer JOIN vehicle ON customer.v_id=vehicle.v_id JOIN users ON vehicle.u_id=users.u_id WHERE customer.v_id = $id;");
        $vehicleRow=mysql_fetch_array($res);
		$d1=strtotime($vehicleRow['w_start']);
		$d2=strtotime($vehicleRow['w_end']);
		$d3= $d2-$d1;
		$wleft = floor($d3 / (60*60*24) );
		
		echo '<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Modal</title>  
</head>
<body>
  <div class="modal-dialog modal-lg">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" onclick="javascript:window.location.reload()" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Vehicle Details</h4>
				  </div>
				  <div class="modal-body">
					<form role="form">
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Vehicle ID</label><input type="text" class="form-control" value="'.$vehicleRow['v_id'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Manufacturer</label><input type="text" class="form-control" value="'.$vehicleRow['manufacturer_name'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Model</label><input type="text" class="form-control" value="'.$vehicleRow['model_name'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Vehicle Category</label><input type="text" class="form-control" value="'.$vehicleRow['category'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">	
							<div class="form-group">
							  <label>Vehicle Buying Price</label><input type="text" class="form-control" value="'.$vehicleRow['b_price'].'" disabled>
							</div></div>
							<div class="col-xs-6">	
							<div class="form-group">
							  <label>Vehicle Selling Price</label><input type="text" class="form-control" value="'.$vehicleRow['s_price'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">		
							<div class="form-group">
							  <label>Added On </label><input type="text" class="form-control" value="'.$vehicleRow['add_date'].'" disabled>
							</div></div>
							<div class="col-xs-6">	
							<div class="form-group">
							  <label>Sold On </label><input type="text" class="form-control" value="'.$vehicleRow['sold_date'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">		
							<div class="form-group">
							  <label>Current Mileage</label><input type="text" class="form-control" value="'.$vehicleRow['mileage'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Registration Year	</label><input type="text" class="form-control" value="'.$vehicleRow['registration_year'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Insurance Id</label><input type="text" class="form-control" value="'.$vehicleRow['insurance_id'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Gear Type</label><input type="text" class="form-control" value="'.$vehicleRow['gear'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>No of Doors</label><input type="text" class="form-control" value="'.$vehicleRow['doors'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>No of Seats</label><input type="text" class="form-control" value="'.$vehicleRow['seats'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Engine Number</label><input type="text" class="form-control" value="'.$vehicleRow['e_no'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Chassis Number</label><input type="text" class="form-control" value="'.$vehicleRow['c_no'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Color: </label><input type="text" class="form-control" value="'.$vehicleRow['v_color'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Sold by User ID: </label><input type="text" class="form-control" value="'.$vehicleRow['u_id'].'" disabled>
							</div></div></div>
							
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Customer First Name : </label><input STYLE="color: #FFFFFF;background-color: #72A4D2;" type="text" class="form-control" value="'.$vehicleRow['cf_name'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Customer Last Name: </label><input STYLE="color: #FFFFFF;background-color: #72A4D2;" type="text" class="form-control" value="'.$vehicleRow['cl_name'].'" disabled>
							</div></div></div>
							<div class="form-group">
							  <label>Customer Address : </label><input STYLE="color: #FFFFFF;background-color: #72A4D2;" type="text" class="form-control" value="'.$vehicleRow['c_address'].'" disabled>
							</div>
							<div class="form-group">
							  <label>Extra Features Promised : </label><input STYLE="color: #FFFFFF;background-color: #72A4D2;" type="text" class="form-control" value="'.$vehicleRow['extra'].'" disabled>
							</div>
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Customer Email : </label><input STYLE="color: #FFFFFF;background-color: #72A4D2;" type="text" class="form-control" value="'.$vehicleRow['c_email'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Customer Mobile: </label><input STYLE="color: #FFFFFF;background-color: #72A4D2;" type="text" class="form-control" value="'.$vehicleRow['c_mobile'].'" disabled>
							</div></div></div>
							
						<div class="row">
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Invoice ID : </label><input STYLE="color: #FFFFFF;background-color: #72A4D2;" type="text" class="form-control" value="'.$vehicleRow['invoice_id'].'" disabled>
							</div></div>
							<div class="col-xs-6">
							<div class="form-group">
							  <label>Payment was made in: </label><input STYLE="color: #FFFFFF;background-color: #72A4D2;" type="text" class="form-control" value="'.$vehicleRow['payment_type'].'" disabled>
							</div></div></div>
						<div class="row">
							<div class="col-xs-6">		
							<div class="form-group">
							  <label>Warranty Ends at: </label><input STYLE="color: #FFFFFF;background-color: #72A4D2;" type="text" class="form-control" value="'.$vehicleRow['w_end'].'" disabled>
							</div></div>
							<div class="col-xs-6">	
							<div class="form-group">
							  <label>Warranty Remaining(days) :</label><input STYLE="color: #FFFFFF;background-color: #72A4D2;" type="text" class="form-control" value="'.$wleft.'" disabled>
							</div></div></div>
							
							<div class="form-group">
							  <label>Fual Tank Capacity(litter)</label><input type="text" class="form-control" value="'.$vehicleRow['tank'].'" disabled>
							</div>
							<div class="form-group">
							  <label>Gallery</label><br><br>';
									$path=explode("*",$vehicleRow['image']);
															$i=count($path);
															$file_path = 'uploads/';
															for($j=0;$j<$i;$j++)
															{
																$src=$file_path.$path[$j];
																?>
									<img src="<?php echo $src; ?>" class="img-thumbnail" width="240" height="140">
									<?php } 
							echo '</div>
						  </form>
				  </div>
				  <div class="modal-footer">
					<button type="button" onclick="javascript:window.location.reload()" class="btn btn-default" data-dismiss="modal">Close</button>
				  </div>
				</div>

			  </div>
</body>
</html>';
	
}
	
	

	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error message
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['Message'] = $ex->getMessage();
	print json_encode($jTableResult);
}
	
?>
