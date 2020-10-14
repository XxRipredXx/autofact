
<?php
define('USER', 'root');
define('PASSWORD', 'sasa');
define('HOST', 'localhost');
define('DATABASE', 'autofact');
 
try {
    $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

$db = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => 'sasa',
    'db' => 'autofact'
];
?>