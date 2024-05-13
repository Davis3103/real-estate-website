<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    // Validate and sanitize email input
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (!$email) {
        // Invalid email format
        $response = array('success' => false, 'message' => 'Please provide a valid email address.');
    } else {
        // Database connection (already defined in your code)
        $host = 'mysql-container';
        $dbname = 'real_estate';
        $username = 'root';
        $password = 'your_password';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare the SQL query
            $query = "INSERT INTO newsletter_subscribers (email) VALUES (:email)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);

            // Execute the query
            if ($stmt->execute()) {
                $response = array('success' => true, 'message' => 'You have been subscribed to our newsletter!');
            } else {
                $response = array('success' => false, 'message' => 'Error subscribing to the newsletter.');
            }
        } catch (PDOException $e) {
            $response = array('success' => false, 'message' => 'Database error: ' . $e->getMessage());
        }
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

