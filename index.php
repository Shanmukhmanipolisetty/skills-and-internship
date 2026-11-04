
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillBridge | Student Skill & Internship Portal</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .hero {
            min-height: 75vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 20px;
        }
        .hero h1 {
            max-width: 800px;
            font-size: 48px;
            line-height: 1.2;
        }
        .hero p {
            max-width: 650px;
            line-height: 1.7;
        }
        .features {
            padding: 65px 8%;
            text-align: center;
        }
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }
        .feature-card h3 {
            color: #2563eb;
            margin-bottom: 12px;
        }
        .feature-card p {
            color: #64748b;
            line-height: 1.6;
        }
        footer {
            background: #172554;
            color: white;
            text-align: center;
            padding: 22px;
        }
        @media(max-width:600px) {
            nav { flex-direction: column; gap: 15px; }
            nav a { margin: 6px; }
            .hero h1 { font-size: 34px; }
        }
    </style>
</head>
<body>

<nav>
    <h2>SkillBridge</h2>
    <div>
        <a href="index.php">Home</a>
        <a href="#about">About</a>
        <a href="student/internships.php">Internships</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </div>
</nav>

<section class="hero">
    <h1>Build Your Future with SkillBridge</h1>
    <p>Discover internship opportunities, develop industry-ready skills and take the next step towards your dream career.</p>
    <a href="register.php" class="btn">Get Started</a>
</section>

<section class="features" id="about">
    <h1>What SkillBridge Offers</h1>

    <div class="feature-grid">
        <div class="feature-card">
            <h3>Explore Internships</h3>
            <p>Discover internship opportunities that match your interests and qualifications.</p>
        </div>

        <div class="feature-card">
            <h3>Build Your Skills</h3>
            <p>Access useful learning resources to improve your technical knowledge.</p>
        </div>

        <div class="feature-card">
            <h3>Track Applications</h3>
            <p>Apply for internships and track your application status in one place.</p>
        </div>
    </div>
</section>

<footer>
    <p>© 2026 SkillBridge | Student Skill and Internship Portal</p>
</footer>

</body>
</html>
