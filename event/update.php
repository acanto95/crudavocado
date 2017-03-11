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
		$idusError = null;
		$nombError = null;
		$desError = null;
		$posError   = null;
		$dateError = null;
		$razError = null;
		
		// keep track post values
		$f_id = $_POST['f_id'];
		$id_user = $_POST['id_user'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$position   = $_POST['position'];
		$date   = $_POST['date'];
		$razon = $_POST['razon'];
		
		/// validate input
		$valid = true;
		
		if (empty($id_user)) {
			$idusError = 'Porfavor escribe un usuario';
			$valid = false;
		}
		
		if (empty($name)) {
			$nombError = 'Porfavor escribe un name';
			$valid = false;
		}
		if (empty($description)) {
			$desError = 'Porfavor agrega una description';
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
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE event set id = ?, id_user = ?, name = ?, description = ?, position =?,  position =?, date = ?, razon = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($f_id,$id_user $name,$description,$position,$date,$razon$id));
			Database::disconnect();			
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM event where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$f_id = $data['id'];
		$id_user = $data['id_user'];
		$name = $data['name'];
		$description = $data['description'];
		$position = $data['position'];
		$date = $data['date'];
		$razon = $data['razon'];
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
		    		<h3>Actualizar datos de un evento</h3>
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




					  <div class="control-group <?php echo !empty($idusError)?'error':'';?>">

					    <label class="control-label">id_user</label>
					    <div class="controls">
					      	<input name="id_user" type="int"  placeholder="id_user" value="<?php echo !empty($id_user)?$id_user:''; ?>">
					      	<?php if (!empty($idusError)): ?>
					      		<span class="help-inline"><?php echo $idusError;?></span>
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
					  
					  <div class="control-group <?php echo !empty($desError)?'error':'';?>">
					  
					    <label class="control-label">description</label>
					    <div class="controls">
					      	<input name="description" type="text" placeholder="description" value="<?php echo !empty($description)?$description:'';?>">
					      	<?php if (!empty($desError)): ?>
					      		<span class="help-inline"><?php echo $desError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

						<div class="control-group <?php echo !empty($posError)?'error':'';?>">
					  
					    <label class="control-label">position</label>
					    <div class="controls">
					      	<input name="position" type="double" placeholder="position" value="<?php echo !empty($position)?$position:'';?>">
					      	<?php if (!empty($posError)): ?>
					      		<span class="help-inline"><?php echo $posError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>

					  <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
					  
					    <label class="control-label">date</label>
					    <div class="controls">
					      	<input name="date" type="timestamp" placeholder="date" value="<?php echo !empty($date)?$date:'';?>">
					      	<?php if (!empty($dateError)): ?>
					      		<span class="help-inline"><?php echo $dateError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


					  <div class="control-group <?php echo !empty($razError)?'error':'';?>">
					  
					    <label class="control-label">razon</label>
					    <div class="controls">
					      	<input name="razon" type="text" placeholder="razon" value="<?php echo !empty($razon)?$razon:'';?>">
					      	<?php if (!empty($razError)): ?>
					      		<span class="help-inline"><?php echo $razError;?></span>
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