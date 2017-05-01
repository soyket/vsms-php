<?php include("header.php");?>
<!DOCTYPE html>
<html>
<body>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">ADMIN Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $vcount; ?></div>
							<div class="text-muted">Sold Vehicles</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked pen tip"><use xlink:href="#stroked-pen-tip"/></svg>

						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $vcount; ?></div>
							<div class="text-muted">Customers</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large"><?php echo $ucount; ?></div>
							
							<div class="text-muted">Total Employees</div>
						</div>
						
					</div>
				</div>
			</div>
			
		</div><!--/.row-->
		
		
								
		<div class="row">
			<div class="col-md-8">
			
				by - Soykot Chowdhury, AIUB
				
			</div><!--/.col-->
			
			<div class="col-md-4">
			
				
								
			</div><!--/.col-->
		</div><!--/.row-->
	</div>	<!--/.main-->

</body>

</html>
