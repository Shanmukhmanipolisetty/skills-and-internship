
<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../includes/db.php';

$students = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role='student'")->fetch_assoc()['total'];
$internships = $conn->query("SELECT COUNT(*) AS total FROM internships")->fetch_assoc()['total'];
$applications = $conn->query("SELECT COUNT(*) AS total FROM applications")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SkillBridge</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<nav>
    <h2>SkillBridge Admin</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="internships.php">Internships</a>
        <a href="applications.php">Applications</a>
        <a href="../logout.php">Logout</a>
    </div>
</nav>

<section class="hero">
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</p>
    <p>Manage your SkillBridge platform from here.</p>

    <div style="display:flex; justify-content:center; gap:20px; flex-wrap:wrap; margin:35px;">
        <div style="background:white; padding:30px; border-radius:12px; min-width:180px;">
            <h2>Total Students</h2>
            <h1><?php echo $students; ?></h1>
        </div>

        <div style="background:white; padding:30px; border-radius:12px; min-width:180px;">
            <h2>Total Internships</h2>
            <h1><?php echo $internships; ?></h1>
        </div>

        <div style="background:white; padding:30px; border-radius:12px; min-width:180px;">
            <h2>Total Applications</h2>
            <h1><?php echo $applications; ?></h1>
        </div>
    </div>

    <p><a class="btn" href="internships.php">Manage Internships</a></p>
    <br>
    <p><a class="btn" href="applications.php">View Applications</a></p>
</section>

</body>
</html>
