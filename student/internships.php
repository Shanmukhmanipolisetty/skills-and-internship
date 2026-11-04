<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

include '../includes/db.php';

$result = $conn->query("SELECT * FROM internships ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Internships - SkillBridge</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<nav>
    <h2>SkillBridge</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="../logout.php">Logout</a>
</nav>

<section class="hero">
    <h1>Explore Internships</h1>
    <p>Find opportunities to build your career.</p>

    <?php if ($result && $result->num_rows > 0): ?>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="internship-card">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p>Company: <?php echo htmlspecialchars($row['company']); ?></p>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <p>Eligibility: <?php echo htmlspecialchars($row['eligibility']); ?></p>
                <p>Deadline: <?php echo htmlspecialchars($row['deadline']); ?></p>

                <a class="btn" href="apply.php?id=<?php echo $row['id']; ?>">
                    Apply Now
                </a>
            </div>
            <br>
        <?php endwhile; ?>

    <?php else: ?>
        <p>No internships available yet. Please check again later.</p>
    <?php endif; ?>

</section>

</body>
</html>