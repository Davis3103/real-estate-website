<<<<<<< HEAD
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $query = "DELETE FROM properties WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Property deleted successfully!";
    } else {
        echo "Error deleting property.";
    }
}

// Fetch all properties
$propertiesQuery = "SELECT * FROM properties";
$propertiesStmt = $pdo->prepare($propertiesQuery);
$propertiesStmt->execute();
$allProperties = $propertiesStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">Delete Property</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="mb-3">
                        <label for="id" class="form-label">Select Property to Delete</label>
                        <select class="form-select" id="id" name="id" required>
                            <option value="">Select Property</option>
                            <?php foreach ($allProperties as $property): ?>
                                <option value="<?php echo $property['id']; ?>"><?php echo $property['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Delete Property</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
=======
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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $query = "DELETE FROM properties WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Property deleted successfully!";
    } else {
        echo "Error deleting property.";
    }
}

// Fetch all properties
$propertiesQuery = "SELECT * FROM properties";
$propertiesStmt = $pdo->prepare($propertiesQuery);
$propertiesStmt->execute();
$allProperties = $propertiesStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">Delete Property</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="mb-3">
                        <label for="id" class="form-label">Select Property to Delete</label>
                        <select class="form-select" id="id" name="id" required>
                            <option value="">Select Property</option>
                            <?php foreach ($allProperties as $property): ?>
                                <option value="<?php echo $property['id']; ?>"><?php echo $property['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Delete Property</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
>>>>>>> 8684dd3655dfe61c5c89ee8f02d7f0fcff21cb89
</html>