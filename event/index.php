<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href="css/bootstrap.min.css" rel="stylesheet">
	    <script src="js/bootstrap.min.js"></script>
	</head>

	<body>
	    <div class="container">
	    		<div class="row">
	    			<h3>Usuarios</h3>
	    		</div>
				<div class="row">
					<p>
						<a href="create.php" class="btn btn-success">Add user</a>
					</p>
					
					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>		                 
			                	<th>id</th>
			                	<th>creator</th>
			                	<th>name</th>
	                        	<th>description</th>
	                        	<th>position</th> 
	                        	<th>date</th>
	                        	<th>Razon social</th>                            		                  
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * FROM event';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr>';							   	
	    					   	echo '<td>


	    					   	'. $row['id'] . '</td>';
	    					   	echo '<td>'. $row['id_user'] . '</td>';
	    					  	echo '<td>'. $row['name'] . '</td>';
	    					  	echo '<td>'. $row['description'] .'</td>';
	    					  	echo '<td>'. $row['position'] .'</td>';
	    					  	echo '<td>'. $row['date'] .'</td>';
	    					  	echo '<td>'. $row['razon'] . '</td>';
	                            
	                            echo '<td width=250>';

	                            echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Actualizar</a>';
	    					   	echo '&nbsp;';
	                           
	    		
	    					   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Eliminar</a>';
	    					   	echo '</td>';
							  	echo '</tr>';

						    }


						   	Database::disconnect();
						  	?>


						  	 <div class="form-actions">
						<a class="btn" href="../page3.php">Regresar</a>
					</div>
					    </tbody>
		            </table>
	    	</div>
	    </div> <!-- /container -->
	</body>
</html>