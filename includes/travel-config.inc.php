<?php
$servername = "localhost";
$username = "agaby"; //DB username
$password = "123";//DB password
$database = "travel";//DB name
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;port=3306", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    } catch(PDOException $e) {    
    echo "Connection failed: " . $e->getMessage();
    }

define('DBCONNECTION', 'mysql:host=localhost;dbname=travel');
define('DBUSER', $username);
// DB USERNAME HERE
define('DBPASS', $password);
// DB PASSWORD HERE


spl_autoload_register(function ($class) {
    $file = 'lib/' . $class . '.class.php';
    if (file_exists($file)) 
      include $file;
});




