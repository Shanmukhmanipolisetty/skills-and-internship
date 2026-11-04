<?php
include 'includes/db.php';

$name = "SkillBridge Admin";
$email = "admin@skillbridge.com";
$password = password_hash("Admin@123", PASSWORD_DEFAULT);
$role = "admin";

$stmt = $conn->prepare(
    "INSERT INTO users (name, email, password, role)
     VALUES (?, ?, ?, ?)"
);

$stmt->bind_param("ssss", $name, $email, $password, $role);

if ($stmt->execute()) {
    echo "Admin account created successfully!";
} else {
    echo "Admin account may already exist.";
}
?>