<?php
// Start or resume session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    $message = "You have been successfully logged out.";
} else {
    $message = "You are not currently logged in.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Logout</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include('incs/header.php'); ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Logout</h2>
            <p class="card-text"><?php echo $message; ?></p>
            <p class="card-text">
                <a href="login.php" class="btn btn-primary">Login again</a>
                <a href="index.php" class="btn btn-secondary">Go home</a>
            </p>
        </div>
    </div>
</div>

<!-- Bootstrap JS, jQuery, Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include('incs/footer.php'); ?>
</body>
</html>
