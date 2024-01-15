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

// Get the user's blog posts
$blogPostsQuery = $mysqli->prepare("SELECT id, title, content, category, post_timestamp FROM blog_posts WHERE author = ? ORDER BY post_timestamp DESC");
$blogPostsQuery->bind_param("s", $_SESSION['username']);
$blogPostsQuery->execute();
$blogPostsResult = $blogPostsQuery->get_result();
$blogPosts = $blogPostsResult->fetch_all(MYSQLI_ASSOC);
$blogPostsQuery->close();

// Function to calculate time ago
function timeAgo($time_ago){
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );

    // Seconds
    if ($seconds <= 60) {
        return "$seconds seconds ago";
    }
    // Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "one minute ago";
        } else {
            return "$minutes minutes ago";
        }
    }
    // Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            return "an hour ago";
        } else {
            return "$hours hours ago";
        }
    }
    // Days
    else if ($days <= 7) {
        if ($days == 1) {
            return "yesterday";
        } else {
            return "$days days ago";
        }
    }
    // Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            return "a week ago";
        } else {
            return "$weeks weeks ago";
        }
    }
    // Months
    else if ($months <= 12) {
        if ($months == 1) {
            return "a month ago";
        } else {
            return "$months months ago";
        }
    }
    // Years
    else {
        if ($years == 1) {
            return "one year ago";
        } else {
            return "$years years ago";
        }
    }
}

// Remove blog post
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['removePost'])) {
    $postId = $_POST['postId'];
    $removePostQuery = $mysqli->prepare("DELETE FROM blog_posts WHERE id = ? AND author = ?");
    $removePostQuery->bind_param("ss", $postId, $_SESSION['username']);
    if ($removePostQuery->execute()) {
        $removePostMessage = "Blog post removed successfully!";
        // Redirect to the same page to ensure it reloads
        header("Location: $_SERVER[PHP_SELF]");
        exit();
    } else {
        $removePostError = "Error removing blog post. Please try again.";
    }
    $removePostQuery->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Panel</title>
</head>
<body>
<?php include('incs/header.php'); ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <!-- Left Sidebar Content -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Admin Panel</h5>
                    <p class="card-text">Welcome, <?php echo $_SESSION['username']; ?>!</p>
                    <a href="change_password.php" class="btn btn-primary">Change Password</a>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Main Content (User's Blog Posts) -->
            <h2>Your Blog Posts
                <?php if (count($blogPosts) == 0) : ?>
                    <a href="create_post.php" class="btn btn-primary btn-sm ml-2">Post your first blog!</a>
                <?php else : ?>
                    <a href="create_post.php" class="btn btn-primary btn-sm ml-2">Post a new blog</a>
                <?php endif; ?>
            </h2>

            <?php if (isset($removePostMessage)) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $removePostMessage; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($removePostError)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $removePostError; ?>
                </div>
            <?php endif; ?>

            <?php if (count($blogPosts) == 0) : ?>
                <p>No blog posts found. Start sharing your thoughts!</p>
            <?php else : ?>
                <ul class="list-group">
                    <?php foreach ($blogPosts as $post) : ?>
                        <li class="list-group-item">
                            <h5><?php echo $post['title']; ?></h5>
                            <p><?php echo substr($post['content'], 0, 150) . '...'; ?></p>
                            <small>Category: <?php echo $post['category']; ?></small>
                            <p class="text-muted"><?php echo timeAgo(strtotime($post['post_timestamp'])); ?></p>

                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="reloadPage()">
                                <input type="hidden" name="postId" value="<?php echo $post['id']; ?>">
                                <button type="submit" name="removePost" class="btn btn-danger btn-sm">Remove Post</button>
                            </form>


                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include('incs/footer.php'); ?>
</body>
</html>
