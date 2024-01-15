<?php
session_start();

// Redirect the user if already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include('connect_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle login form submission
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify credentials
$query = "SELECT id, username, password, role FROM users WHERE username = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify the entered password with the hashed password from the database
    if (password_verify($password, $user['password'])) {
        // Password is correct, proceed with login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: index.php"); // Redirect to the home page or dashboard
        exit();
    } else {
        $error = "Invalid password";
    }
} else {
    $error = "Invalid username";
}
}

include('incs/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>

<div class="container mt-5">
    <h2>Login</h2>
    
    <!-- Your login form HTML -->
<form method="post" action="login.php">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>


    <?php if (isset($error)) : ?>
        <div class="alert alert-danger mt-3" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

</div>

<?php include('incs/footer.php'); ?>

</body>
</html>
