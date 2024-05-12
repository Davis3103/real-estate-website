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

// Fetch featured properties
$featuredQuery = "SELECT * FROM properties WHERE featured = 1 LIMIT 3";
$featuredStmt = $pdo->prepare($featuredQuery);
$featuredStmt->execute();
$featuredProperties = $featuredStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all properties
$propertiesQuery = "SELECT * FROM properties";
$propertiesStmt = $pdo->prepare($propertiesQuery);
$propertiesStmt->execute();
$allProperties = $propertiesStmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <!-- Hero section -->
    <section class="bg-primary py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-4 text-white">Find Your Dream Home</h1>
                    <p class="lead text-white">Explore our selection of premium properties and discover your perfect place.</p>
                </div>
                <div class="col-md-6">
                    <img src="https://via.placeholder.com/500x300" alt="Hero Image" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Properties -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Featured Properties</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($featuredProperties as $property): ?>
                    <div class="col">
                        <div class="card">
                            <img src="<?php echo $property['image']; ?>" class="card-img-top" alt="<?php echo $property['title']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $property['title']; ?></h5>
                                <p class="card-text"><?php echo $property['description']; ?></p>
                                <p class="card-text">Price: <?php echo $property['price']; ?></p>
                                <p class="card-text">Location: <?php echo $property['location']; ?></p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <main class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">About Our Company</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="https://via.placeholder.com/500x300" alt="Company Image" class="img-fluid rounded mb-4">
            </div>
            <div class="col-md-6">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla auctor, nisl eget ultricies tincidunt, nisl nisl aliquam nisl, eget aliquam nisl nisl eget nisl. Sed euismod nisl nisl, eget aliquam nisl nisl eget nisl.</p>
                <p>Sed euismod nisl nisl, eget aliquam nisl nisl eget nisl. Sed euismod nisl nisl, eget aliquam nisl nisl eget nisl. Sed euismod nisl nisl, eget aliquam nisl nisl eget nisl.</p>
            </div>
        </div>
    </div>
</main>
<main class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">About Our Team</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Team Member 1">
                    <div class="card-body">
                        <h5 class="card-title">John Doe</h5>
                        <p class="card-text">CEO</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Team Member 2">
                    <div class="card-body">
                        <h5 class="card-title">Jane Smith</h5>
                        <p class="card-text">Sales Manager</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Team Member 3">
                    <div class="card-body">
                        <h5 class="card-title">Bob Johnson</h5>
                        <p class="card-text">Marketing Director</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<main class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">Our Services</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-house-user fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Residential Properties</h5>
                        <p class="card-text">We specialize in finding and selling residential properties, including houses, apartments, and condos.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-building fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Commercial Properties</h5>
                        <p class="card-text">Our experts can assist you with buying, selling, or leasing commercial properties for your business.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-money-check-alt fa-3x text-primary mb-3"></i>
                        <h5 class="card-title">Property Management</h5>
                        <p class="card-text">We offer comprehensive property management services to ensure your investment is well-maintained and profitable.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<main class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">Why Choose Us</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Experienced Professionals</h5>
                        <p class="card-text">Our team consists of experienced and knowledgeable real estate professionals who are dedicated to providing top-notch service.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Wide Selection of Properties</h5>
                        <p class="card-text">We offer a vast selection of properties to choose from, ensuring you find the perfect fit for your needs and preferences.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Personalized Service</h5>
                        <p class="card-text">We take the time to understand your unique requirements and provide personalized service tailored to your specific needs.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Commitment to Excellence</h5>
                        <p class="card-text">We are committed to delivering excellence in every aspect of our service, from property search to closing the deal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<?php include 'includes/footer.php'; ?>
</body>
</html>