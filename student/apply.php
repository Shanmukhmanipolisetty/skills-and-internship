<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

include '../includes/db.php';

$student_id = $_SESSION['user_id'];
$internship_id = intval($_GET['id'] ?? 0);

$check = $conn->prepare("SELECT id FROM internships WHERE id = ?");
$check->bind_param("i", $internship_id);
$check->execute();

if ($check->get_result()->num_rows == 0) {
    die("Internship not found.");
}

$check = $conn->prepare(
    "SELECT id FROM applications WHERE student_id = ? AND internship_id = ?"
);
$check->bind_param("ii", $student_id, $internship_id);
$check->execute();

if ($check->get_result()->num_rows > 0) {
    $message = "You have already applied for this internship.";
} else {
    $stmt = $conn->prepare(
        "INSERT INTO applications (student_id, internship_id) VALUES (?, ?)"
    );
    $stmt->bind_param("ii", $student_id, $internship_id);

    $message = $stmt->execute()
        ? "Application submitted successfully!"
        : "Application failed. Please try again.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply - SkillBridge</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h1>Internship Application</h1>
<p><?php echo htmlspecialchars($message); ?></p>

<a href="internships.php">Back to Internships</a>
<br><br>
<a href="dashboard.php">Dashboard</a>

</body>
</html>