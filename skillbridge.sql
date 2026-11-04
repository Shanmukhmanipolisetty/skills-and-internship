USE skillbridge;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student','admin') DEFAULT 'student'
);

CREATE TABLE internships (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    company VARCHAR(150) NOT NULL,
    description TEXT,
    eligibility VARCHAR(255),
    deadline DATE
);

CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    internship_id INT,
    status VARCHAR(30) DEFAULT 'Pending',
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (internship_id) REFERENCES internships(id)
);

CREATE TABLE student_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE,
    phone VARCHAR(20),
    qualification VARCHAR(100),
    skills TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);