
<?php
include 'includes/db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "Email already registered!";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO users (name, email, password, role)
             VALUES (?, ?, ?, 'student')"
        );
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $message = "Registration successful! You can now login.";
        } else {
            $message = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | SkillBridge</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .register-section {
            min-height: 85vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }
        .register-card {
            background: white;
            padding: 40px;
            width: 100%;
            max-width: 430px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }
        .register-card h1 {
            text-align: center;
            margin-bottom: 10px;
            color: #1e3a8a;
        }
        .register-card p {
            text-align: center;
            margin: 15px 0;
            color: #64748b;
        }
        .register-card input {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }
        .register-card button {
            width: 100%;
            padding: 14px;
            margin-top: 15px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        .register-card button:hover {
            background: #1d4ed8;
        }
        .message {
            color: #2563eb !important;
        }
    </style>
</head>
<body>

<nav>
    <h2>SkillBridge</h2>
    <div>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
    </div>
</nav>

<section class="register-section">
    <div class="register-card">
        <h1>Create Account</h1>
        <p>Join SkillBridge and start your career journey.</p>

        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password (minimum 8 characters)" minlength="8" required>
            <button type="submit">Create Account</button>
        </form>

        <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <p>Already registered? <a href="login.php">Login here</a></p>
    </div>
</section>

</body>
</html>
