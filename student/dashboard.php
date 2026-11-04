
<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

include '../includes/db.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM applications WHERE student_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$total_applications = $stmt->get_result()->fetch_assoc()['total'];

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM applications WHERE student_id = ? AND status = 'Approved'");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$approved_applications = $stmt->get_result()->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | SkillBridge</title>
    <link rel="stylesheet" href="../css/style.css">

    <style>
        .dashboard-welcome {
            padding: 65px 8%;
            background: linear-gradient(135deg, #dbeafe, #f5f7ff);
        }
        .dashboard-welcome h1 {
            font-size: 38px;
            color: #1e3a8a;
            margin-bottom: 12px;
        }
        .dashboard-welcome p {
            color: #64748b;
            font-size: 17px;
        }
        .dashboard-content {
            padding: 45px 8%;
        }
        .stats-grid, .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 22px;
            margin-top: 25px;
        }
        .dashboard-card {
            background: white;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }
        .dashboard-card h2 {
            color: #2563eb;
            margin-bottom: 12px;
        }
        .dashboard-card p {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #1e3a8a;
        }
        .dashboard-content h2 {
            color: #1e3a8a;
        }
    </style>
</head>
<body>

<nav>
    <h2>SkillBridge</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="profile.php">My Profile</a>
        <a href="internships.php">Internships</a>
        <a href="applications.php">My Applications</a>
        <a href="../logout.php">Logout</a>
    </div>
</nav>

<section class="dashboard-welcome">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h1>
    <p>Explore opportunities, improve your skills and build your future with SkillBridge.</p>
</section>

<section class="dashboard-content">

    <h2>Your Activity</h2>

    <div class="stats-grid">
        <div class="dashboard-card">
            <h2>Total Applications</h2>
            <div class="stat-number"><?php echo $total_applications; ?></div>
        </div>

        <div class="dashboard-card">
            <h2>Approved Applications</h2>
            <div class="stat-number"><?php echo $approved_applications; ?></div>
        </div>
    </div>

    <br><br>
    <h2>Explore SkillBridge</h2>

    <div class="actions-grid">
        <div class="dashboard-card">
            <h2>My Profile</h2>
            <p>Update your qualification, contact details and technical skills.</p>
            <a class="btn" href="profile.php">View Profile</a>
        </div>

        <div class="dashboard-card">
            <h2>Internships</h2>
            <p>Discover available internships and apply for opportunities.</p>
            <a class="btn" href="internships.php">Explore Now</a>
        </div>

        <div class="dashboard-card">
            <h2>Applications</h2>
            <p>Check the latest status of your internship applications.</p>
            <a class="btn" href="applications.php">Track Now</a>
        </div>

        <div class="dashboard-card">
            <h2>Learning Resources</h2>
            <p>Improve your knowledge with useful technical learning materials.</p>
            <a class="btn" href="resources.php">Start Learning</a>
        </div>
    </div>

</section>

</body>
</html>
