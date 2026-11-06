<?php
// Tell the app we are returning JSON data
header("Content-Type: application/json");

//Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notes_app";

// 1. Connect to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed."]);
    exit();
}

// 2. Get the date from Android 
$user = $_POST['username'] ?? '';
$pass = $_POST['password'] ?? '';


?>