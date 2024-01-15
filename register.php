<?php
// Start or resume session
session_start();

// Include database connection file
include('connect_db.php');

// Function to calculate time ago
function timeAgo($time_ago){
    // ... (same as before)
}

// Initialize variables
$errorMessage = "";
$successMessage = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $insertQuery = $mysqli->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $insertQuery->bind_param('ss', $username, $hashedPassword);

    if ($insertQuery->execute()) {
        // Registration successful
       // Registration successful
        $_SESSION['username'] = $username;
        $successMessage = "Registration successful. Redirecting to login...";
        header('Refresh: 3; URL=login.php'); // Redirect to login.php after 3 seconds
    } else {
        // Registration failed
        $errorMessage = "Registration failed. Please try again.";
    }

    $insertQuery->close();
}

// Include header
include('incs/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Register</title>
</head>
<body>

<div class="container mt-5">
    <h2>Register</h2>

    <?php if (!empty($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($successMessage)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $successMessage; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="register.php">
        <!-- Form fields go here -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
// Include footer
include('incs/footer.php');
?>