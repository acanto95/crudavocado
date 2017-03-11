<?php 

	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$f_idError = null;
		$nombError = null;
		$passError = null;
		$imgError = null;
		$starError = null;
		
		// keep track post values
		$f_id = $_POST['f_id'];
		$name = $_POST['name'];
		$password = $_POST['password'];
		$image = $_POST['image'];
		$star = $_POST['star'];
		
		/// validate input
		$valid = true;
		
		if (empty($name)) {
			$nombError = 'Porfavor escribe un nombre';
			$valid = false;
		}

		if (empty($password)) {
			$passError = 'Porfavor escribe una password';
			$valid = false;
		}	

		if (empty($image)) {
			$imgError = 'Porfavor escribe un image';
			$valid = false;
		}	

		if (empty($star)) {
			$starError = 'Porfavor escribe un image';
			$valid = false;
		}			
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE user  set id = ?, name = ?, password = ?, image =?, star WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($f_id,$name,$password,$image,$star, $id));
			Database::disconnect();			
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM user where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$f_id = $data['id'];
		$name = $data['name'];
		$password = $data['password'];
		$image = $data['image'];
		$star = $data['star'];
		Database::disconnect();
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
		    		<h3>Actualizar datos de un usuario</h3>
		    	</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">

	    			<div class="control-group <?php echo !empty($f_idError)?'error':'';?>">

					    <label class="control-label">id</label>
					    <div class="controls">
					      	<input name="f_id" type="text" readonly placeholder="id" value="<?php echo !empty($id)?$id:''; ?>">
					      	<?php if (!empty($f_idError)): ?>
					      		<span class="help-inline"><?php echo $f_idError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($nombError)?'error':'';?>">

					    <label class="control-label">name</label>
					    <div class="controls">
					      	<input name="name" type="text"  placeholder="name" value="<?php echo !empty($name)?$name:''; ?>">
					      	<?php if (!empty($nombError)): ?>
					      		<span class="help-inline"><?php echo $nombError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($passError)?'error':'';?>">
					  
					    <label class="control-label">password</label>
					    <div class="controls">
					      	<input name="password" type="password" placeholder="password" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (!empty($descnError)): ?>
					      		<span class="help-inline"><?php echo $passError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

						<div class="control-group <?php echo !empty($imgError)?'error':'';?>">
					  
					    <label class="control-label">image</label>
					    <div class="controls">
					      	<input name="image" type="double" placeholder="image" value="<?php echo !empty($image)?$image:'';?>">
					      	<?php if (!empty($imgError)): ?>
					      		<span class="help-inline"><?php echo $imgError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($starError)?'error':'';?>">
					   <label class="control-label">star</label>
					    <div class="controls">
					      	<input name="star" type="int" placeholder="star" value="<?php echo !empty($star)?$star:'';?>">
					      	<?php if (!empty($starError)): ?>
					      		<span class="help-inline"><?php echo $starError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Actualizar</button>
						  <a class="btn" href="index.php">Regresar</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>