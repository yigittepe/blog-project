<?php
// Start or resume session
session_start();

// Include database connection file
include('connect_db.php');

// Fetch the blog post based on the provided ID
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $postQuery = $mysqli->prepare("SELECT id, title, content, author, post_timestamp, category FROM blog_posts WHERE id = ?");
    $postQuery->bind_param('i', $postId);
    $postQuery->execute();
    $postResult = $postQuery->get_result();

    if ($postResult->num_rows > 0) {
        $post = $postResult->fetch_assoc();

        // Check if the logged-in user is the author of the blog post
        $isAuthor = isset($_SESSION['username']) && $_SESSION['username'] === $post['author'];
    } else {
        // Handle post not found
        header('Location: index.php'); // Redirect to home page or show an error message
        exit();
    }

    $postQuery->close();
} else {
    // Handle missing ID
    header('Location: index.php'); // Redirect to home page or show an error message
    exit();
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
    <title><?php echo $post['title']; ?></title>
    <style>
   .card-content {
        max-width: 100%; /* Set your desired maximum width */
        max-height: 30rem; /* Set your desired maximum height */
        overflow: auto;
        white-space: pre-line;
    }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="card-title"><?php echo $post['title']; ?></h2>
                <?php if ($isAuthor) : ?>
                    <a href="admin_panel.php?remove_post_id=<?php echo $post['id']; ?>" class="btn btn-outline-danger btn-sm">Remove</a>
                <?php endif; ?>
            </div>
            
            <p class="card-subtitle text-muted mb-2">
                <small>Created on <?php echo $post['post_timestamp']; ?> by <?php echo $post['author']; ?></small>
            </p>
            <div class="card-content"><?php echo $post['content']; ?></div>
                <?php if (!empty($post['category'])) : ?>
                    <span class="badge badge-primary"><?php echo $post['category']; ?></span>
                <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
// Include footer
include('incs/footer.php');
?>


</body>
</html>


