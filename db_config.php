<?php
// Database configuration for XAMPP
$host = 'localhost';
$dbname = '24pr14238_shareride_db';
$username = 'root';
$password = '';  // XAMPP default has no password

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>