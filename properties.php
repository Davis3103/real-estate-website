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

// Fetch all properties
$propertiesQuery = "SELECT * FROM properties";
$propertiesStmt = $pdo->prepare($propertiesQuery);
$propertiesStmt->execute();
$allProperties = $propertiesStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<main class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">All Properties</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($allProperties as $property): ?>
                <div class="col">
                    <div class="card">
                        <img src="<?php echo $property['image']; ?>" class="card-img-top" alt="<?php echo $property['title']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $property['title']; ?></h5>
                            <p class="card-text"><?php echo $property['description']; ?></p>
                            <p class="card-text">Price: <?php echo $property['price']; ?></p>
                            <p class="card-text">Location: <?php echo $property['location']; ?></p>
                            <a href="property-details.php?id=<?php echo $property['id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>