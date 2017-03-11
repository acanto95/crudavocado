<?php 
	
	require 'database.php';
		$idusError = null;
		$nombError = null;
		$desError = null;
		$posError   = null;
		$dateError = null;
		$razError = null;
		

	if ( !empty($_POST)) {
		$id_user = $_POST['id_user'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$position   = $_POST['position'];
		$date   = $_POST['date'];
		$razon = $_POST['razon'];
		
		// validate input
		$valid = true;


		if (empty($id_user)) {
			$idusError = 'Porfavor escribe un usuario';
			$valid = false;
		}
		
		if (empty($name)) {
			$nombError = 'Porfavor escribe un nombre';
			$valid = false;
		}
		if (empty($description)) {
			$desError = 'Porfavor agrega una descripcion';
			$valid = false;
		}
		if (empty($position)) {
			$posError = 'Porfavor agrega una positionn';
			$valid = false;
		}	

		if (empty($date)) {
			$dateError = 'Porfavor agrega una fecha';
			$valid = false;
		}	

		if (empty($razon)) {
			$razError = 'Porfavor agrega una razon';
			$valid = false;
		}						
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO event (id,id_user,name,description, position,date, razon) values(null, ?, ?, ?,?,?,?)";			
			$q = $pdo->prepare($sql);
			$q->execute(array($id_user,$name,$description,$position,$date,$razon));			
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta 	charset="utf-8">
	    <link   href=	"css/bootstrap.min.css" rel="stylesheet">
	    <script src=	"js/bootstrap.min.js"></script>
	</head>

	<body>
	    <div class="container">
	    	<div class="span10 offset1">
	    		<div class="row">
		   			<h3>Agregar un evento nuevo</h3>
		   		</div>
	    		
				<form class="form-horizontal" action="create.php" method="post">

						<div class="control-group <?php echo !empty($idusError)?'error':'';?>">
						<label class="control-label">id_user</label>
					    <div class="controls">
					      	<input name="id_user" type="int"  placeholder="id_user" value="<?php echo !empty($id_user)?$id_user:'';?>">
					      	<?php if (($idusError != null)) ?>
					      		<span class="help-inline"><?php echo $idusError;?></span>						      	
					    </div>
					</div>



				
					<div class="control-group <?php echo !empty($nombError)?'error':'';?>">
						<label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (($nombError != null)) ?>
					      		<span class="help-inline"><?php echo $nombError;?></span>						      	
					    </div>
					</div>

							<div class="control-group <?php echo !empty($desError)?'error':'';?>">
						<label class="control-label">description</label>
					    <div class="controls">
					      	<input name="description" type="text"  placeholder="description" value="<?php echo !empty($description)?$description:'';?>">
					      	<?php if (($desError != null)) ?>
					      		<span class="help-inline"><?php echo $desError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($posError)?'error':'';?>">
						<label class="control-label">position</label>
					    <div class="controls">
					      	<input name="position" type="double"  placeholder="position" value="<?php echo !empty($position)?$position:'';?>">
					      	<?php if (($posError != null)) ?>
					      		<span class="help-inline"><?php echo $posError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($dateError)?'error':'';?>">
						<label class="control-label">date</label>
					    <div class="controls">
					      	<input name="date" type="timestamp"  placeholder="date" value="<?php echo !empty($date)?$date:'';?>">
					      	<?php if (($dateError != null)) ?>
					      		<span class="help-inline"><?php echo $dateError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($razError)?'error':'';?>">
						<label class="control-label">razon</label>
					    <div class="controls">
					      	<input name="razon" type="text"  placeholder="razon" value="<?php echo !empty($razon)?$razon:'';?>">
					      	<?php if (($razError != null)) ?>
					      		<span class="help-inline"><?php echo $razError;?></span>						      	
					    </div>
					</div>


					<div class="form-actions">
						<button type="submit" class="btn btn-success">Agregar</button>
						<a class="btn" href="index.php">Regresar</a>
					</div>

				</form>
			</div>					
	    </div> <!-- /container -->
	</body>
</html>