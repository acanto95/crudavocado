<?php 
	
	require 'database.php';
		$nombError = null;
		$passError = null;
		$imgError   = null;
		$starError = null;
		

	if ( !empty($_POST)) {
		
		$name = $_POST['name'];
		$password = $_POST['password'];
		$image   = $_POST['image'];
		$star   = $_POST['star'];
		
		// validate input
		$valid = true;
		
		if (empty($name)) {
			$nombError = 'Porfavor escribe un nombre';
			$valid = false;
		}
		if (empty($password)) {
			$desError = 'Porfavor agrega una constraseña';
			$valid = false;
		}
		if (empty($image)) {
			$imgError = 'Porfavor agrega una imagen';
			$valid = false;
		}	

		if (empty($star)) {
			$starError = 'Porfavor agrega una calificacion';
			$valid = false;
		}				
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO user (id,name,password, image,star) values(null, ?, ?, ?,?)";			
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$password,$image,$star));			
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
		   			<h3>Agregar un usuario nuevo</h3>
		   		</div>
	    		
				<form class="form-horizontal" action="create.php" method="post">
				
					<div class="control-group <?php echo !empty($nombError)?'error':'';?>">
						<label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (($nombError != null)) ?>
					      		<span class="help-inline"><?php echo $nombError;?></span>						      	
					    </div>
					</div>

							<div class="control-group <?php echo !empty($passError)?'error':'';?>">
						<label class="control-label">password</label>
					    <div class="controls">
					      	<input name="password" type="password"  placeholder="password" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (($passError != null)) ?>
					      		<span class="help-inline"><?php echo $passError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($imgError)?'error':'';?>">
						<label class="control-label">image</label>
					    <div class="controls">
					      	<input name="image" type="int"  placeholder="image" value="<?php echo !empty($image)?$image:'';?>">
					      	<?php if (($imgError != null)) ?>
					      		<span class="help-inline"><?php echo $imgError;?></span>						      	
					    </div>
					</div>

					<div class="control-group <?php echo !empty($starError)?'error':'';?>">
						<label class="control-label">star</label>
					    <div class="controls">
					      	<input name="star" type="int"  placeholder="star" value="<?php echo !empty($star)?$star:'';?>">
					      	<?php if (($starError != null)) ?>
					      		<span class="help-inline"><?php echo $starError;?></span>						      	
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