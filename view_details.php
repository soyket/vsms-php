<?php
include_once 'login/dbconnect.php';

$res=mysql_query("SELECT * FROM vehicle");
?>
<?php $res=mysql_query("SELECT * FROM vehicle");
$query_parent = mysql_query("SELECT * FROM manufacturer") or die("Query failed: ".mysql_error());
?>
<!DOCTYPE html>
<html>

<head>
<title>Vehicle Mnagement System</title>
<link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet"  type="text/css" href="css/bootstrap.min.css"/>
<script rel="stylesheet" src="js/main.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js"></script>
</head>

<body>

<div class="header">
	<div class="logo"><a href="#"><img src="images/logo1.png" alt="" height="90px"/></a></div>
			<div class="navigation">
				<nav class="navbar navbar-inverse navbar-fixed">
				  <div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						  <ul class="nav navbar-nav">
						  <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
						  <li><a href="#">About us</a></li>
							<li><a href="#">Contacts</a></li>
						  </ul>
						  
						</div>
					</div><!-- /.navbar-collapse -->
				</nav>
			</div>
</div>
	<div class="container-fluid">
		<div class="page-header text-center">
			<h3 class="text-uppercase">All Vehicle Information<h3>
		</div>
		
		<div style="padding-left: 25%">
		<div style="display:inline">Sold Vehicle Filter</div>
			<div class="input-append date datepicker divDatePicker inline" id="datepicker" style="margin:0px;padding:0px;display:inline">
			<input type="text" class="datepicker input-small validation rightBorderNone otherTabs" id="fromDate" name="displayDate" placeholder="From Date" />
			<button class="btn leftBorderNone" type="button"><i class="glyphicon glyphicon-calendar"></i></button>
			</div>
		<div class="input-append date datepicker divDatePicker inline" id="datepicker" style="margin:0px;padding:0px;padding-left:4px;;display:inline">
        <input type="text" placeholder="To Date" class="datepicker input-small validation rightBorderNone otherTabs" id="toDate" name="displayDate" />
        <button class="btn leftBorderNone" type="button"><i class="glyphicon glyphicon-calendar"></i></button>
		</div>
		<br><br>
		<table >
        <tbody>
			<tr>
            <td>    Min Price:</td>
            <td><input type="text" id="min" name="min"></td>
			 <td>   Max Price:</td>
            <td><input type="text" id="max" name="max"></td>
			</tr>
       
		</tbody></table>
				
		</div>
		
		
		
		 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
             <tr>
           
                <th>Vehicle id</th>
                <th>Model</th>
                <th>Manufacturer</th>
                <th>Category</th>
                <th>Adding date(m/d/Y)</th>
                <th>Selling date</th>
                <th>Status</th>
                <th>Image</th>
                <th>Buying price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
              
                <th>Vehicle id</th>
                <th>Model</th>
                <th>Manufacturer</th>
                <th>Category</th>
                <th>Adding date</th>
                <th>Selling date</th>
                <th>Status</th>
                <th>Image</th>
                <th>Buying price</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
             <?php
            $i = 1;
            while ($vehicle = mysql_fetch_assoc($res)) { ?>
              <tr class="<?php if($vehicle['status']!="Available") echo 'danger'; else echo 'success'?>">
                <td><?php echo $vehicle['v_id']; ?></td>
                <td><?php echo $vehicle['model_name']; ?></td>
                <td><?php echo $vehicle['manufacturer_name']; ?></td>
                <td><?php echo $vehicle['category']; ?></td>
                <td><?php $date = new DateTime($vehicle['add_date']); echo $date->format('m/d/Y'); ?></td>
                <td><?php if($vehicle['sold_date']=== NULL){ echo 'NULL'; }else{ $date = new DateTime($vehicle['sold_date']); echo $date->format('m/d/Y'); }?></td>
                <td><?php echo $vehicle['status']; ?></td>
                <td><img src="uploads/<?php $path=explode("*",$vehicle['image']); echo $path[0]; ?>" width="200" height="100"></td>
                <td><?php echo $vehicle['b_price']; ?></td>
                <td width=200px>
	
					<a href="sell.php?id=<?php echo $vehicle['v_id']; ?>" class="btn btn-success"<?php if($vehicle['status']!="Available") echo 'style="display:none"';  ?>>Sell</a>
                    <a href="Actions.php?action=v_edit&id=<?php echo $vehicle['v_id']; ?>" class="btn btn-warning" style="display:none" >Edit</a>
                    <a data-toggle="modal" data-target="#myModal" href="<?php if($vehicle['status']!="Available"){ echo 'Actions.php?action=vs_view&id=';} else{ echo 'Actions.php?action=v_view&id='; }?><?php echo $vehicle['v_id']; ?>" class="btn btn-info" >View</a>
                    <a onclick="return confirm('All records will be deleted, continue?')" href="Actions.php?action=v_delete&id=<?php echo $vehicle['v_id']; ?>" class="btn btn-danger" <?php if($userRow['u_type']!="Admin"){echo 'style="display:none"';} ?>  >Delete</a>
					
				</td>
            </tr>
            <?php } ?>
           
        </tbody>
    </table>
			
	</div>				

	
	
	
	
	
	 
	 
	 
	 
	 
	 
	 
         <script>
         $(document).ready(function() {
    $('#example').DataTable( {
        initComplete: function () {
            this.api().columns([2,3,6]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
    if(column.search() === '^'+d+'$'){
        select.append( '<option value="'+d+'" selected="selected">'+d+'</option>' )
    } else {
        select.append( '<option value="'+d+'">'+d+'</option>' )
    }
} );
            } );
        }
    } );
} );


$(function () {
    $("div .divDatePicker").each(function () {
        $(this).datepicker().on('changeDate', function (ev) {
            $(this).datepicker("hide");
        });
    });
    $(document).on('change', '#fromDate, #toDate', function () {
        $('#example').dataTable().DataTable().draw();
    });

});

/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[8] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    var table = $('#example').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    } );
} );




$.fn.dataTableExt.afnFiltering.push(

function (oSettings, aData, iDataIndex) {
    if (($('#fromDate').length > 0 && $('#fromDate').val() !== '') || ($('#toDate').length > 0 && $('#toDate').val() !== '')) {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth();
        var yyyy = today.getFullYear();
console.log(today+"-- "+dd+" --"+mm+" --"+yyyy);
        if (dd < 10) dd = '0' + dd;

        if (mm < 10) mm = '0' + mm;

        today = mm + '/' + dd + '/' + yyyy;
        var minVal = $('#fromDate').val();
        var maxVal = $('#toDate').val();
        //alert(minVal+"   ----   "+maxVal);
        if (minVal !== '' || maxVal !== '') {
            var iMin_temp = minVal;
            if (iMin_temp === '') {
                iMin_temp = '01/01/1980';
            }

            var iMax_temp = maxVal;
            var arr_min = iMin_temp.split("/");

            var arr_date = aData[5].split("/");
//console.log(arr_min[2]+"-- "+arr_min[0]+" --"+arr_min[1]);
             var iMin = new Date(arr_min[2], arr_min[0]-1, arr_min[1]);
          //  console.log(iMin);
           // console.log(" --"+yyy);
           

            var iMax = '';
            if (iMax_temp != '') {
                var arr_max = iMax_temp.split("/");
                iMax = new Date(arr_max[2], arr_max[0]-1, arr_max[1], 0, 0, 0, 0);
            }




            var iDate = new Date(arr_date[2], arr_date[0]-1, arr_date[1], 0, 0, 0, 0);
            //alert(iMin+" -- "+iMax);
      //  console.log("Test data "+iMin+" -- "+iMax+"-- "+iDate+" --"+(iMin <= iDate && iDate <= iMax));
            if (iMin === "" && iMax === "") {
                return true;
            } else if (iMin === "" && iDate < iMax) {
                // alert("inside max values"+iDate);
                return true;
            } else if (iMax === "" && iDate >= iMin) {
                // alert("inside max value is null"+iDate);                    
                return true;
            } else if (iMin <= iDate && iDate <= iMax) {
              //  alert("inside both values"+iDate);
                return true;
            }
            return false;
        }
    }
    return true;
});
         </script>
		 
<script type="text/javascript">
$(document).ready(function() {
    
	$("#parent_cat").change(function() {
		$(this).after();
		$.get('Actions.php?action=v_cat&parent_cat=' + $(this).val(), function(data) {
			$("#sub_cat").html(data);
			$('#loader').slideUp(200, function() {
				$(this).remove();
			});
		});	
    });

});
</script>
	
	
	
</body>
</html>