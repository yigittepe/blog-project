<?php
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in
    $username = $_SESSION['username'];
    // You can include additional user-related functionalities here
} else {
    // User is not logged in
    // You can include login or registration links here
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>BiLog Home</title>
   
    <style>
        .bi-log {
            color: #3498db; 
            font-weight: bold;
            font-size: 1em;
        }
    </style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><span class="bi-log">Bi</span>Log</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['username'])) : ?>
                <!-- Display username and redirect link if logged in -->
                <li class="nav-item">
                    <a class="nav-link" href="admin_panel.php">
                        Welcome, <?php echo $_SESSION['username']; ?>!
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php else : ?>
                <!-- Display login and register links if not logged in -->
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
