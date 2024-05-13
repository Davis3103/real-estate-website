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

// Get property details
$id = $_GET['id'];
$query = "SELECT * FROM properties WHERE id = $id";
$property = $pdo->query($query)->fetch(PDO::FETCH_ASSOC);
?>
<main class="py-5">
    <div class="container">
        <h1 class="text-center mb-4"><?php echo $property['title']; ?></h1>
        <div class="row">
            <div class="col-md-6">
            <?php
                    // Convert binary image data to base64 for display
                    $imageData = base64_encode($property['image']);
                    ?>
              <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" class="card-img-top" alt="<?php echo $property['title']; ?>">
            </div>
            <div class="col-md-6">
                <h5>Description</h5>
                <p><?php echo $property['description']; ?></p>
                <h5>Price</h5>
                <p>&#8377;<?php echo $property['price']; ?></p>
                <h5>Location</h5>
                <p><?php echo $property['location']; ?></p>
                <!-- Add any additional property details here -->
            </div>
        </div>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
</body>
</html>

