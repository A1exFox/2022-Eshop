<?php

phpinfo();
//xdebug_info();


/* 
echo "<h2>Test write:</h2>";
mkdir('./testDir');
file_put_contents('./testDir/test.txt', 'test', FILE_APPEND);
exec('rm -rf ./testDir');
 */


/* 
echo "<h2>Test Xdebug:</h2>";
$a = 3;
$b = 4;
$c = $a + $b;
echo $c;
 */


/* 
echo "<h2>Test mysqli:</h2>";
$mysqli = new mysqli("mysql", "root", "root", "information_schema");
var_dump($mysqli->query("SELECT * FROM tables"));
 */


/* 
echo "<h2>Test PDO:</h2>";
$user = "root";
$pass = "root";
$dsn = "mysql:host=mysql;dbname=information_schema;charset=utf8";
$pdo = new PDO($dsn, $user, $pass);
$stmp = $pdo->query("SELECT * FROM tables");
$row = $stmp->fetch();
print_r($row);
 */


// "make dump" in cli to dump db

// "make help" to test composer