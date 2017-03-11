<?php
	class Database {
		private static $dbName 			= 'avocado' ; 
		private static $dbHost 			= 'root@198.199.101.234' ;
		private static $dbUsername 		= 'admin';
		private static $dbUserPassword 	= '56add18d8204bdf3e6d9bdb12fa2f9a5f1e3942be3adab53';
		
		private static $cont  = null;
		
		public function __construct() {
			exit('Init function is not allowed');
		}
		
		public static function connect(){
		   // One connection through whole application
	    	if ( null == self::$cont ) {      
		    	try {
		        	self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
		        }
		        catch(PDOException $e) {
		        	die($e->getMessage());  
		        }
	       	} 
	       	return self::$cont;
		}
		
		public static function disconnect() {
			self::$cont = null;
		}
	}
?>