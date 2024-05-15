<?php
// Start the session
session_start();
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

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the website if the user is already logged in
    header("Location: index.php");
    exit();
}

$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Prepare the SQL query to check if the user is an admin
    $adminQuery = "SELECT * FROM admins WHERE email = :email";
    $adminStmt = $pdo->prepare($adminQuery);
    $adminStmt->bindParam(':email', $email);
    $adminStmt->execute();

    // Check if the user is an admin
    if ($adminStmt->rowCount() > 0) {
        $adminRow = $adminStmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $adminRow['password'])) {
            // Login successful for admin user
            $_SESSION['is_admin'] = true;
            $_SESSION['user_id'] = $adminRow['id'];
            $_SESSION['user_email'] = $adminRow['email'];

            // Redirect to the website
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        // Prepare the SQL query for regular users
        $query = "SELECT id, email, password FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Check if the user exists and verify the password
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                // Login successful for regular user
                $_SESSION['is_admin'] = false;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];

                // Redirect to the website
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Invalid email or password.";
            }
        } else {
            $error_message = "Invalid email or password.";
        }
    }
}

include 'includes/header.php';
?>
<!-- The rest of the code remains the same -->
<!-- The rest of the code remains the same -->
<main class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1 class="text-center mb-4">Login</h1>
                <?php if (!empty($error_message)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php } ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <p class="mt-3">Don't have an account? <a href="register.php">Register</a></p>
                </form>
            </div>
        </div>
    </div>
</main>
<?php include 'includes/footer.php'; ?>