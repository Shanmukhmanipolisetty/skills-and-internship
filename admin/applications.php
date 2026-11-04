
<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../includes/db.php';

if (isset($_POST['update_status'])) {
    $id = (int)$_POST['application_id'];
    $status = $_POST['status'];

    if (in_array($status, ['Pending', 'Approved', 'Rejected'], true)) {
        $stmt = $conn->prepare("UPDATE applications SET status=? WHERE id=?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
    }

    header("Location: applications.php");
    exit;
}

$result = $conn->query("
    SELECT applications.id, users.name, users.email,
           internships.title, internships.company,
           applications.status, applications.applied_at
    FROM applications
    JOIN users ON applications.student_id = users.id
    JOIN internships ON applications.internship_id = internships.id
    ORDER BY applications.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Applications | SkillBridge</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<nav>
    <h2>SkillBridge Admin</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="internships.php">Internships</a>
        <a href="../logout.php">Logout</a>
    </div>
</nav>

<section class="hero">
    <h1>Student Applications</h1>
    <p>Review and update student application status.</p>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div style="background:white;padding:25px;margin:20px auto;max-width:650px;border-radius:12px;text-align:left;">
                <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                <p>Company: <?php echo htmlspecialchars($row['company']); ?></p>
                <p>Student: <?php echo htmlspecialchars($row['name']); ?></p>
                <p>Email: <?php echo htmlspecialchars($row['email']); ?></p>
                <p>Applied: <?php echo htmlspecialchars($row['applied_at']); ?></p>
                <p>Current Status: <strong><?php echo htmlspecialchars($row['status']); ?></strong></p>

                <form method="POST">
                    <input type="hidden" name="application_id" value="<?php echo $row['id']; ?>">
                    <select name="status">
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                    <button type="submit" name="update_status" class="btn">Update Status</button>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No student applications yet.</p>
    <?php endif; ?>
</section>

</body>
</html>
