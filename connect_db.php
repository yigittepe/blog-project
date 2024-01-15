<?php

// Database configuration
$host = 'localhost'; 
$username = 'yigit';
$password = 'yigitpass123';
$database = 'blog_db';

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>
