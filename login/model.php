<?php include("header.php");?>
<!DOCTYPE html>
<html>
<head>
	<link href="themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
	<link href="scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
</head>
<body>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Vehicl Model / Manufacturar</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header">View / Edit / Delete - Vehicle Manufacturar & Model </h2>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-xs-6">
				<div class="panel panel-default">
					<div class="panel-heading">Vehicle Manufacturar</div>
					<div class="panel-body">
					<div id="manufacturerTableContainer" ></div>
				    </div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="panel panel-default">
					<div class="panel-heading">Vehicle Model</div>
					<div class="panel-body">
						<div id="modelTableContainer" ></div>
				    </div>
				</div>
			</div>
			
		</div><!--/.row-->
		
		</div><!--/.col-->

		
		
		
		
		
		
		<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#manufacturerTableContainer').jtable({
				title: 'All Car Manufacturer',
				actions: {
					listAction: 'Actions.php?action=list',
					createAction: 'Actions.php?action=create',
					updateAction: 'Actions.php?action=update',
					deleteAction: 'Actions.php?action=delete'
				},
				fields: {
					manufacturer_id: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					manufacturer_name: {
						title: 'Manufacturer Name',
						width: '100%'
					}
				}
			});

			//Load person list from server
			$('#manufacturerTableContainer').jtable('load');

		});

	</script>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#modelTableContainer').jtable({
				title: 'All Car Model',
				actions: {
					listAction: 'Actions.php?action=listm',
					createAction: 'Actions.php?action=createm',
					updateAction: 'Actions.php?action=updatem',
					deleteAction: 'Actions.php?action=deletem'
				},
				fields: {
					model_id: {
						key: true,
						create: false,
						edit: false,
					list: false
					},
					model_name: {
						title: 'Model Name',
						width: '30%'
					},
					manufacturer_name: {
						title: 'manufacturer',
						width: '12%',
						options: 'Actions.php?action=listma'
						//list :true	
					}
////////////////					
				}
			});

			//Load person list from server
			$('#modelTableContainer').jtable('load');

		});

	</script>
</body>

</html>