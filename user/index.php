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
	    			<h3>Usuarios/h3>
	    		</div>
				<div class="row">
					<p>
						<a href="create.php" class="btn btn-success">Add user</a>
					</p>
					
					<table class="table table-striped table-bordered">
			            <thead>
			                <tr>		                 
			                	<th>id</th>
			                	<th>name</th>
	                        	<th>pass</th>
	                        	<th>image</th> 
	                        	<th>rating</th>                           		                  
			                </tr>
			            </thead>
			            <tbody>
			              	<?php 
						   	include 'database.php';
						   	$pdo = Database::connect();
						   	$sql = 'SELECT * FROM user';
		 				   	foreach ($pdo->query($sql) as $row) {
								echo '<tr>';							   	
	    					   	echo '<td>


	    					   	'. $row['id'] . '</td>';
	    					  	echo '<td>'. $row['name'] . '</td>';
	    					  	echo '<td>'. $row['password'] .'</td>';
	    					  	echo '<td>'. $row['image'] .'</td>';
	    					  	echo '<td>'. $row['star'] .'</td>';
	                            
	                            echo '<td width=250>';
	                           	echo '<a class="btn" href="read.php?id='.$row['id'].'">Detalles</a>';
	    					   	echo '&nbsp;';
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