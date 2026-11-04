
<?php
session_start();
include 'includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: student/dashboard.php");
            }
            exit;
        }
    }

    $message = "Invalid email or password!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SkillBridge</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <h2>SkillBridge</h2>
    <div>
        <a href="index.php">Home</a>
        <a href="register.php">Register</a>
    </div>
</nav>

<section class="hero">
    <h1>Welcome Back!</h1>
    <p>Login to continue your SkillBridge journey.</p>

    <form method="POST" style="max-width:400px; margin:auto;">
        <input type="email" name="email"
               placeholder="Email Address" required>
        <br><br>

        <input type="password" name="password"
               placeholder="Password" required>
        <br><br>

        <button type="submit" class="btn">Login</button>
    </form>

    <p><?php echo htmlspecialchars($message); ?></p>
    <p>New to SkillBridge?
       <a href="register.php">Create Account</a>
    </p>
</section>

</body>
</html>
