<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    echo "User ID: " . $_SESSION['user_id'] . "<br>";
    echo "User Email: " . $_SESSION['user_email'] . "<br>";
    
    // Display the content for logged-in users
} 
// Include the header
include 'includes/header.php';

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // SQL query to insert the data into the database
    $query = "INSERT INTO contact_messages(name, email, message) VALUES (:name, :email, :message)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);

    if ($stmt->execute()) {
        echo "<div id='success-message'>Message sent successfully!</div>";
    } else {
        echo "Error: " . $stmt->errorInfo()[2];
    }
}
?>

<main class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">Contact Us</h1>
        <div class="row">
            <div class="col-md-6">
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
                <h5>Our Office</h5>
                <p>123 Main Street<br>City, State ZIP</p>
                <h5>Contact Information</h5>
                <p>Phone: (123) 456-7890<br>Email: info@realestatewebsite.com</p>
            </div>
        </div>
    </div>
</main>

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