<?php
// Include database connection file
include('connect_db.php');

// Start or resume session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Initialize variables for error handling and user information
$titleErr = $contentErr = $categoryErr = "";
$title = $content = $category = "";
$blogCount = 0;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $title = sanitize_input($_POST['title']);
    $content = sanitize_input($_POST['content']);
    $category = sanitize_input($_POST['category']);

    // Validate title
    if (empty($title)) {
        $titleErr = "Title is required";
    }

    // Validate content
    if (empty($content)) {
        $contentErr = "Content is required";
    }

    // Validate category
    if (empty($category)) {
        $categoryErr = "Category is required";
    }

    // If there are no validation errors, insert data into the database
    if (empty($titleErr) && empty($contentErr) && empty($categoryErr)) {
        // Get the current timestamp
        $timestamp = date("Y-m-d H:i:s");

        // Insert data into the database
        $insertQuery = $mysqli->prepare("INSERT INTO blog_posts (title, content, author, category, post_timestamp) VALUES (?, ?, ?, ?, ?)");
        $insertQuery->bind_param("sssss", $title, $content, $_SESSION['username'], $category, $timestamp);

        if ($insertQuery->execute()) {
            $message = "Blog post created successfully!";
            // Redirect to index.php after 2 seconds
            header("refresh:2;url=index.php");
        } else {
            $error_message = "Error creating blog post. Please try again.";
        }

        // Close the prepared statement
        $insertQuery->close();
    }
}

// Get the number of blogs posted by the user
$blogCountQuery = $mysqli->prepare("SELECT COUNT(*) FROM blog_posts WHERE author = ?");
$blogCountQuery->bind_param("s", $_SESSION['username']);
$blogCountQuery->execute();
$blogCountQuery->bind_result($blogCount);
$blogCountQuery->fetch();
$blogCountQuery->close();

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Create Blog Post</title>
</head>
<body>
<?php include('incs/header.php'); ?>    

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <!-- Left Sidebar Content -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Left Sidebar</h5>
                    <p class="card-text">Author: <?php echo $_SESSION['username']; ?></p>
                    <p class="card-text">Number of Blogs: <?php echo $blogCount; ?></p>
                    <!-- Add your left sidebar content here -->
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Main Content (Create Post Form) -->
            <h2>Create a Blog Post</h2>

            <?php if (isset($message)) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter the title" value="<?php echo $title; ?>" required>
                    <span class="text-danger"><?php echo $titleErr; ?></span>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="5" placeholder="Enter the content" required><?php echo $content; ?></textarea>
                    <span class="text-danger"><?php echo $contentErr; ?></span>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="" disabled selected>Select a category</option>
                        <option value="technology">Technology</option>
                        <option value="travel">Travel</option>
                        <option value="lifestyle">Lifestyle</option>
                        <!-- Add more categories as needed -->
                    </select>
                    <span class="text-danger"><?php echo $categoryErr; ?></span>
                </div>

                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include('incs/footer.php'); ?>
</body>
</html>
