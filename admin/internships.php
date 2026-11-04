
<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include '../includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $company = trim($_POST['company']);
    $description = trim($_POST['description']);
    $eligibility = trim($_POST['eligibility']);
    $deadline = $_POST['deadline'];

    $stmt = $conn->prepare("INSERT INTO internships
        (title, company, description, eligibility, deadline)
        VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $title, $company, $description, $eligibility, $deadline);

    $message = $stmt->execute()
        ? "Internship added successfully!"
        : "Unable to add internship.";
}

$result = $conn->query("SELECT * FROM internships ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Internships | SkillBridge</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<nav>
    <h2>SkillBridge Admin</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="applications.php">Applications</a>
        <a href="../logout.php">Logout</a>
    </div>
</nav>

<section class="hero">
    <h1>Manage Internships</h1>
    <p>Add and manage internship opportunities for students.</p>

    <p><?php echo htmlspecialchars($message); ?></p>

    <form method="POST" style="max-width:500px;margin:30px auto;background:white;padding:30px;border-radius:12px;">
        <input name="title" placeholder="Internship Title" required>
        <br><br>

        <input name="company" placeholder="Company Name" required>
        <br><br>

        <textarea name="description" placeholder="Internship Description" required></textarea>
        <br><br>

        <input name="eligibility" placeholder="Eligibility Requirements" required>
        <br><br>

        <label>Application Deadline</label>
        <input type="date" name="deadline" required>
        <br><br>

        <button type="submit" class="btn">Add Internship</button>
    </form>

    <h2>Existing Internships</h2>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div style="background:white;padding:25px;margin:20px auto;max-width:600px;border-radius:12px;text-align:left;">
            <h2><?php echo htmlspecialchars($row['title']); ?></h2>
            <p><strong>Company:</strong> <?php echo htmlspecialchars($row['company']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
            <p><strong>Eligibility:</strong> <?php echo htmlspecialchars($row['eligibility']); ?></p>
            <p><strong>Deadline:</strong> <?php echo htmlspecialchars($row['deadline']); ?></p>
        </div>
    <?php endwhile; ?>

</section>

</body>
</html>
