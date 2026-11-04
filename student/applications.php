<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

include '../includes/db.php';

$id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT internships.title, internships.company, applications.status,
           applications.applied_at
    FROM applications
    JOIN internships ON applications.internship_id = internships.id
    WHERE applications.student_id = ?
    ORDER BY applications.id DESC
");

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Applications - SkillBridge</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<nav>
    <h2>SkillBridge</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="../logout.php">Logout</a>
</nav>

<section class="hero">
    <h1>My Applications</h1>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="internship-card">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p>Company: <?php echo htmlspecialchars($row['company']); ?></p>
                <p>Status: <?php echo htmlspecialchars($row['status']); ?></p>
                <p>Applied: <?php echo htmlspecialchars($row['applied_at']); ?></p>
            </div>
            <br>
        <?php endwhile; ?>
    <?php else: ?>
        <p>You haven't applied for any internships yet.</p>
    <?php endif; ?>

</section>

</body>
</html>