
<?php
/*****************************/
/***DESARROLLO HIDROCALIDO****/
/*****************************/
require 'database.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
 
$name = $_POST['name'];
 $password = $_POST['password'];
 
consultarLogin($name,$password);
 
function consultarLogin($name,$password){
    $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO user (id,name,password, image,star) values(null, ?, ?, null,null)";           
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$password,$image,$star));           
            Database::disconnect();
            return true;
}
?>