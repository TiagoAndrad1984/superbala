<?php  
define('host','localhost');
define('user','root');
define('pass','@5T8i2wd9@');
define('dbname','cadsuperbala');


global $pdo;


try{
	
  $pdo= new PDO('mysql:host='.host.';dbname='.dbname,user, pass);	
  }catch(PDOExeception $e){
	
	echo "ERRO: ".$e->getMenssage();
    exit;
}




?>