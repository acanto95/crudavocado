<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');   
    }
 
    /
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        *)";
 
        exit(0);
    }
 
 
    
    $postdata = file_get_contents("php://input");
 if (isset($postdata)) {
 $request = json_decode($postdata);
 $name = $request->name;
 $password = $request->password;
 
 if ($username != "") {
 echo "Server returns: " . $name;
 echo "and" . $password;
 }
 else {
 echo "Empty username parameter!";
 }
 }
 else {
 echo "Not called properly with username parameter!";
 }
?>