<?php
function __autoload($class) {
	include_once($class.".php");
}
$switch = new database;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="sample application to display list of users">
    <meta name="author" content="john panelo">
    <link rel="icon" href="favicon.ico">

    <title>Users App</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/jquery.dataTables.css" rel="stylesheet">
	<link href="css/" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" class="init">
		$(document).ready(function() {
			$('#users').DataTable();
			$('#viewUserDetails').on('show.bs.modal', function(e) {
	            var $modal = $(this),
	                userId = e.relatedTarget.id;
	            $.ajax({
	                cache: false,
	                type: 'POST',
	                url: 'view.php',
	                data: 'id='+userId,
	                success: function(data) 
	                {
	                    $modal.find('.details').html(data);
	                }
	            });
	        })
		});
	</script>
  </head>

  <body role="document">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Users App</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Users App</h1>
        <p>This is a simple and clean object-oriented implementation of a table displaying a list of users using simple connection to PDO MySQL database using Bootstrap, DataTable, JQuery.</p>
      </div>

      <div class="page-header">
        <h1>Users</h1>
      </div>
      
      <p>
      	<table id="users" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Department</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
			<?php
			foreach($switch->retrieve() as $value) {
				echo "<tr>";
				echo "<td>".$value["firstname"]."</td>";
				echo "<td>".$value["lastname"]."</td>";
				echo "<td>".$value["email"]."</td>";
				echo "<td>".$value["role"]."</td>";
				echo "<td>".$value["department"]."</td>";
				echo "<td><a href='#viewModal' data-toggle='modal' data-target='#viewUserDetails' id='".$value["id"]."' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-zoom-in' aria-hidden='true'></span></a></td>";
				echo "</tr>";
			}
			?>
        </tbody>
		</table>
      </p>
   		
	  <div id="viewUserDetails" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">	
		<div class="modal-dialog">
		  <div class="modal-content">
		    <div class="modal-header">
		      <button type="button" class="close" data-dismiss="modal">&times;</button>
		      <h4 class="modal-title">User Details</h4>
		    </div>
		    <div class="modal-body details">
		    </div>
		    <div class="modal-footer">
		      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
		  </div>
		</div>
	  </div>
    </div> <!-- /container -->
  </body>
</html>
