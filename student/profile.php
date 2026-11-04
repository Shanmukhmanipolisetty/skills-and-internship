
<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

include '../includes/db.php';

$id = $_SESSION['user_id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = trim($_POST['phone']);
    $qualification = trim($_POST['qualification']);
    $skills = trim($_POST['skills']);

    $stmt = $conn->prepare("
        INSERT INTO student_profiles (user_id, phone, qualification, skills)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
        phone = VALUES(phone),
        qualification = VALUES(qualification),
        skills = VALUES(skills)
    ");

    $stmt->bind_param("isss", $id, $phone, $qualification, $skills);

    $message = $stmt->execute()
        ? "Profile saved successfully!"
        : "Unable to save profile.";
}

$stmt = $conn->prepare("SELECT * FROM student_profiles WHERE user_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$profile = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | SkillBridge</title>
    <link rel="stylesheet" href="../css/style.css">

    <style>
        .profile-section {
            min-height: 85vh;
            padding: 55px 20px;
            background: #f5f7ff;
        }
        .profile-card {
            max-width: 600px;
            margin: auto;
            padding: 35px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
        }
        .profile-card h1 {
            color: #1e3a8a;
            text-align: center;
            margin-bottom: 10px;
        }
        .profile-card .intro {
            text-align: center;
            color: #64748b;
            margin-bottom: 25px;
        }
        .profile-card label {
            display: block;
            margin: 15px 0 7px;
            color: #334155;
            font-weight: bold;
        }
        .profile-card input,
        .profile-card textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            font-family: Arial, sans-serif;
        }
        .profile-card textarea {
            min-height: 120px;
            resize: vertical;
        }
        .profile-card button {
            width: 100%;
            margin-top: 22px;
            border: none;
            cursor: pointer;
        }
        .success-message {
            color: #15803d;
            text-align: center;
            margin-bottom: 15px;
        }
        @media(max-width: 600px) {
            .profile-card { padding: 22px; }
            nav { flex-wrap: wrap; gap: 12px; }
        }
    </style>
</head>
<body>

<nav>
    <h2>SkillBridge</h2>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="internships.php">Internships</a>
        <a href="applications.php">Applications</a>
        <a href="../logout.php">Logout</a>
    </div>
</nav>

<section class="profile-section">
    <div class="profile-card">
        <h1>My Student Profile</h1>
        <p class="intro">Complete your details to showcase your skills.</p>

        <?php if ($message): ?>
            <p class="success-message">
                <?php echo htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <label>Phone Number</label>
            <input type="tel" name="phone"
                placeholder="Enter your phone number"
                value="<?php echo htmlspecialchars($profile['phone'] ?? ''); ?>"
                required>

            <label>Qualification</label>
            <input type="text" name="qualification"
                placeholder="Example: B.Tech CSE"
                value="<?php echo htmlspecialchars($profile['qualification'] ?? ''); ?>"
                required>

            <label>Your Skills</label>
            <textarea name="skills"
                placeholder="Example: HTML, CSS, Java, Python"
                required><?php echo htmlspecialchars($profile['skills'] ?? ''); ?></textarea>

            <button type="submit" class="btn">Save Profile</button>
        </form>
    </div>
</section>

</body>
</html>
