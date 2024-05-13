<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    echo "User ID: " . $_SESSION['user_id'] . "<br>";
    echo "User Email: " . $_SESSION['user_email'] . "<br>";
    // Display the content for logged-in users
}

// Include the header
include 'includes/header.php';

// Database connection settings
$host = 'mysql-container';
$dbname = 'real_estate';
$username = 'root';
$password = 'your_password';

try {
    // Create a PDO instance for database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate form data
        if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["message"])) {
            // Sanitize form data
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);
            $message = htmlspecialchars($_POST["message"]);

            // Prepare SQL query to insert data into database
            $query = "INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);

            // Execute the query
            if ($stmt->execute()) {
                echo "<div id='success-message' class='alert alert-success'>Message sent successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: Unable to send message.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Please fill in all required fields.</div>";
        }
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
        }
        .contact-container {
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .contact-form {
            padding-right: 50px; /* Add spacing between form and office info */
        }
        .office-info {
            background-color: #fcfcf7;
            padding: 80px;
            border-radius: 20px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<main class="contact-container">
    <div class="container">
        <h1 class="text-center mb-4">Contact Us</h1>
        <div class="row">
            <div class="col-md-6 contact-form">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="office-info">
                    <h5>Our Office</h5>
                    <p>#238 Kammanahalli main road, Kalyan Nagar<br>Bangalore, Karnataka</p>
                    <h5>Contact Information</h5>
                    <p>Phone: +91 8884443355<br>Email: info@realestatewebsite.com</p>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Include the footer
include 'includes/footer.php';
?>
</body>
</html>
<script>
    // Function to hide the success message after 3 seconds
    function hideSuccessMessage() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 3000); // 3000 milliseconds = 3 seconds
        }
    }

    // Call the function when the page loads
    window.onload = hideSuccessMessage;
</script>

