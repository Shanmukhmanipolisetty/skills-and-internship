# SkillBridge – Student Skill and Internship Portal

## 1. Project Overview

SkillBridge is a web-based Student Skill and Internship Portal developed to help students explore internship opportunities, improve their skills, and manage their internship applications.

The portal provides separate access for students and administrators.

## 2. Objectives

- Provide a platform for students to discover internships.
- Allow students to create and manage their profiles.
- Enable students to apply for internships.
- Help students track their application status.
- Allow administrators to manage internships and applications.

## 3. Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Local Server:** XAMPP
- **Code Editor:** Visual Studio Code
- **Database Tool:** MySQL Workbench

## 4. Main Features

### Student Module
- Student registration and login.
- Student profile management.
- Browse available internships.
- Apply for internships.
- Track application status.
- Access learning resources.

### Admin Module
- Admin login.
- Admin dashboard.
- Add and manage internships.
- View student applications.
- Approve or reject applications.
- View student and application statistics.

## 5. Database Structure

The project uses a MySQL database named `skillbridge`.

Main tables:

1. **users** – Stores student and admin account details.
2. **student_profiles** – Stores student profile information.
3. **internships** – Stores internship details.
4. **applications** – Stores student internship applications and their status.

## 6. Installation and Setup

1. Install XAMPP and Visual Studio Code.
2. Start Apache and MySQL from the XAMPP Control Panel.
3. Copy the SkillBridge project folder into:

   `C:\xampp\htdocs\`

4. Create a MySQL database named `skillbridge`.
5. Import the provided SQL file or execute the database table creation queries.
6. Configure the database connection in `includes/db.php`.
7. Set the correct MySQL username and password.
8. Open your browser and visit:

   `http://localhost/SkillBridge/`

## 7. How to Use

**Student:**
- Register a new account.
- Log in to the student dashboard.
- Complete your profile.
- Browse internships.
- Apply for suitable internships.
- Track application status.

**Administrator:**
- Log in using an administrator account.
- Open the admin dashboard.
- Add new internships.
- View student applications.
- Update application statuses.

## 8. Project Folder Structure

```text
SkillBridge/
│
├── index.php
├── login.php
├── register.php
├── logout.php
├── README.md
├── skillbridge.sql
│
├── css/
│   └── style.css
│
├── includes/
│   └── db.php
│
├── student/
│   ├── dashboard.php
│   ├── profile.php
│   ├── internships.php
│   ├── apply.php
│   ├── applications.php
│   └── resources.php
│
└── admin/
    ├── dashboard.php
    ├── internships.php
    └── applications.php
```

## 9. Expected Outcome

SkillBridge provides a centralized platform where students can explore internship opportunities, manage their profiles, apply for internships, and monitor their application progress. Administrators can manage internship listings and student applications efficiently.

## 10. Conclusion

SkillBridge aims to connect students with internship opportunities and support their career development through a simple and user-friendly web application.
