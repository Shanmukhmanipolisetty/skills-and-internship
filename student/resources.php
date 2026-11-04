<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Learning Resources - SkillBridge</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<nav>
    <h2>SkillBridge</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="../logout.php">Logout</a>
</nav>

<section class="hero">
    <h1>Learning Resources</h1>
    <p>Improve your skills with these free learning platforms.</p>

    <div class="internship-card">
        <h2>HTML & CSS</h2>
        <a href="https://www.w3schools.com/" target="_blank">Learn HTML and CSS</a>
    </div>

    <br>

    <div class="internship-card">
        <h2>JavaScript</h2>
        <a href="https://javascript.info/" target="_blank">Learn JavaScript</a>
    </div>

    <br>

    <div class="internship-card">
        <h2>PHP & MySQL</h2>
        <a href="https://www.w3schools.com/php/" target="_blank">Learn PHP</a>
    </div>
</section>

</body>
</html>