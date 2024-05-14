<?php
// Database connection
$host = 'mysql-container';
$dbname = 'real_estate';
$username = 'root';
$password = 'your_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}

// Define your admin and user data
$adminData = [
    ['email' => 'admin@example.com', 'password' => 'admin123'],
    // Add more admin users as needed
];

$userData = [
    ['email' => 'user1@example.com', 'password' => 'password1'],
    ['email' => 'user2@example.com', 'password' => 'password2'],
    // Add more regular users as needed
];

// Insert admin users
foreach ($adminData as $admin) {
    $email = $admin['email'];
    $password = password_hash($admin['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO admins (email, password) VALUES (:email, :password)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
}

// Insert regular users
foreach ($userData as $user) {
    $email = $user['email'];
    $password = password_hash($user['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
}

echo "Admin and user data inserted successfully!";