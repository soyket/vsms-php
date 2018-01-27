<?php  include("header.php"); ?>
<?php 
	$id = $_GET["id"]; 
	$u_id = $_SESSION['user'];
			if(isset($_POST['sold']))
			{	
				$v_id = mysql_real_escape_string($id);
				$nid =  mysql_real_escape_string($_POST['nid']);
				$cf_name =  mysql_real_escape_string($_POST['cf_name']);
				$cl_name =  mysql_real_escape_string($_POST['cl_name']);
				$c_email =  mysql_real_escape_string($_POST['c_email']);
				$c_mobile =  mysql_real_escape_string($_POST['c_mobile']);
				$w_start =  mysql_real_escape_string($_POST['w_start']);
				$w_end =  mysql_real_escape_string($_POST['w_end']);
				$payment_type =  mysql_real_escape_string($_POST['payment_type']);
				$c_address =  mysql_real_escape_string($_POST['c_address']);
				$c_pass =  mysql_real_escape_string($_POST['c_pass']);
				$extra =  mysql_real_escape_string($_POST['extra']);
				$s_price =  mysql_real_escape_string($_POST['s_price']);
				$invoice_id= "#IE9S".mysql_real_escape_string($id). "S";
				$qrr="INSERT INTO customer(v_id,nid,cf_name,cl_name,c_email,c_mobile,w_start,w_end,payment_type,c_address,c_pass,extra,invoice_id) VALUES('$v_id','$nid','$cf_name','$cl_name','$c_email','$c_mobile','$w_start','$w_end','$payment_type','$c_address','$c_pass','$extra','$invoice_id')";
					echo $qrr;
					if(mysql_query($qrr))
					{
				
					  $result = mysql_query("UPDATE vehicle SET s_price = '" . $s_price . "',u_id = '" . $u_id . "',sold_date = '" . $w_start . "', status = 'Sold'  WHERE v_id =$v_id;");
						?>
						<script>document.location = 'vehicles.php';</script>
						<?php
					}
					else
					{
						?>
						<script>alert('error while Inserting data!! Possible Reason : Duplicate Data/Field Missing');</script>
						<?php
					}			
			}
?>
<html>
<body>
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close"  onclick="history.go(-1);" data-dismiss="modal" aria-hidden="true">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>
					<h4 class="modal-title custom_align" id="Heading">Add Customer Details to sell Vehicle</h4>
				</div>
			<form class="form-horizontal" method="post">  
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-6">
							<input name="cf_name" type="text" class="form-control" placeholder="First Name" required>	                	
						</div>
						<div class="col-xs-6">
							<input name="cl_name" type="text" class="form-control" placeholder="Last Name" required>	                	
						</div>
					</div>
							
						<br>
						
					<div class="row">
						<div class="col-xs-3">
							<h5>Selected Vehicle :</h5>	                	
						</div>
						<div class="col-xs-3">
							<input name="v_id"  type="text" class="form-control" value="<?php echo $id; ?>" disabled>	                	
						</div>
						<div class="col-xs-6">
							<input name="c_email" type="email" class="form-control" placeholder="Email Address(User Name)" required>	                	
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6">
						<br>
						 <input type="number" step="any" class="form-control" name="s_price" placeholder="Selling Price" required>
						</div>
					</div>
							
						<br>
					<div class="row">
						<div class="col-xs-12">
							<input type="text" class="form-control" name="c_address" placeholder="Address" required>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-xs-12">
							<input type="text" class="form-control" name="nid" placeholder="National ID/ SSN" required>
						</div>
					</div>
							
					<br>

					<div class="row">
								<div class="col-xs-5">
									<input type="text" class="form-control" name="c_mobile" placeholder="Mobile No" required>
								</div>
								<div class="col-xs-3">
									<h5>Payment Method</h5>
								</div>
								<div class="col-xs-4">
									<select class="form-control" name="payment_type" required>
									  <option value="Cash">Cash</option>
									  <option value="Cheque">Cheque</option>
									  <option value="Visa/Master Card">Visa/Master Card</option>
									  <option value="Wire Transfer">Wire Transfer</option>
									</select>
								</div>
					</div>
							
							<br>                     

							<div class="row">
								<div class="col-xs-6">
									Warranty Start Date:
									<input type="date" class="form-control" name="w_start" value="<?php echo date("Y-m-d"); ?>">
								</div>
								<div class="col-xs-6">
									Warranty End Date:
									<input type="date" class="form-control" name="w_end"  required>
								</div>
							</div>

						<br>
						  
								<div class="form-group">
									<div class="col-xs-12">	
										<textarea rows="2" class="form-control" name="extra" placeholder="Extra Features" required></textarea>
									</div>
								</div>
								
								<br>
								
								<div class="form-group">
									<div class="col-xs-12">	
										<input type="text" class="form-control" name="c_pass" placeholder="Password For the customer" required>
									</div>
								</div>


				</div>
							<div class="modal-footer ">
								
								<button type="submit" name="sold" id="sold" class="btn btn-success btn-lg" style="width: 100%;">
									<span class="glyphicon glyphicon-ok-sign"></span>
										Sell
								</button>
								<br><br>
								<button type="button" onclick="history.go(-1);"  class="btn btn-default" data-dismiss="modal">Back</button>
									
							</div>
						</form> 
			</div> <!-- /.modal-content -->
		</div>
	</body>
</html>
