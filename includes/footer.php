<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-white">Home</a></li>
                    <li><a href="properties.php" class="text-white">Properties</a></li>
                    <li><a href="contact.php" class="text-white">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Follow Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="#" class="text-white"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="#" class="text-white"><i class="fab fa-instagram"></i> Instagram</a></li>
                    <li><a href="#" class="text-white"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt"></i> #238 Kammanahalli main road, Kalyan Nagar, Bengaluru, Karnataka.</li>
                    <li><i class="fas fa-phone"></i> +91 8884443355</li>
                    <li><i class="fas fa-envelope"></i> info@realestatewebsite.com</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Subscribe</h5>
                <p>Sign up for our newsletter to receive the latest updates and offers.</p>
                <div id="subscribe-response">
                    <!-- Subscription response message will be displayed here -->
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" id="subscribe-email" placeholder="Enter your email" aria-label="Enter your email" required>
                    <button class="btn btn-primary" type="button" id="subscribe-btn">Subscribe</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; <?php echo date('Y'); ?> Real Estate Website. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Subscribe button click event listener
    document.getElementById("subscribe-btn").addEventListener("click", function() {
        // Get email input value
        var email = document.getElementById("subscribe-email").value;

        // Create FormData object with email value
        var formData = new FormData();
        formData.append("email", email);

        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "subscribe.php", true); // Adjust the URL based on your backend PHP script
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Parse response JSON
                var response = JSON.parse(xhr.responseText);

                // Display success or error message
                var subscribeResponse = document.getElementById("subscribe-response");
                if (response.success) {
                    subscribeResponse.innerHTML = '<div class="alert alert-success" role="alert">' + response.message + '</div>';
                } else {
                    subscribeResponse.innerHTML = '<div class="alert alert-danger" role="alert">' + response.message + '</div>';
                }

                // Clear email input after submission
                document.getElementById("subscribe-email").value = '';
            }
        };

        xhr.send(formData);
    });
});
</script>
