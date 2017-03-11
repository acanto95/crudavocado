
<?php
/*****************************/
/***DESARROLLO HIDROCALIDO****/
/*****************************/
require 'database.php';
// TOMAMOS NUESTRO JSON RECIBIDO DESDE LA PETICION DE ANGULAR JS Y LO LEEMOS
 
$JSON       = file_get_contents("php://input");
$request    = json_decode($JSON);
$user    = $request->user; 
$password = $request->password;
 
consultarLogin($user,$password);
 
function consultarLogin($user,$password){
    $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO user (id,name,password, image,star) values(null, ?, ?, null,null)";           
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$password,$image,$star));           
            Database::disconnect();
            header("Location: index.php");
            return true;
}
?>