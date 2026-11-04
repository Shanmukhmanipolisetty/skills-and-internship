<?php
$host = "localhost";
$user = "root";
$pass = "toor"; // MySQL install chesetappudu pettina root password
$dbname = "password_checker";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");