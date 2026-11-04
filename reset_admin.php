<?php
include 'includes/db.php';

$email = "admin@skillbridge.com";
$newPassword = password_hash("Admin@123", PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "UPDATE users SET password = ? WHERE email = ? AND role = 'admin'"
);

$stmt->bind_param("ss", $newPassword, $email);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    echo "Admin password reset successfully!";
} else {
    echo "Admin account not found or password unchanged.";
}
?>