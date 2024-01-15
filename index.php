<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start or resume session
session_start();
include('connect_db.php');
include('incs/header.php');

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

// Fetch recent blog posts
$postsQuery = $mysqli->query("SELECT id, title, content, author, post_timestamp FROM blog_posts ORDER BY post_timestamp DESC LIMIT 5");
$recentPosts = $postsQuery->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Blog Home</title>
</head>
<body>

<div class="container mt-5" style="max-width: 700px;">
    <h2>Recent Blog Posts</h2>
    <?php foreach ($recentPosts as $post) : ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $post['title']; ?></h5>
                <p class="card-content"><?php echo substr($post['content'], 0, 150) . '...'; ?></p>
                <p class="card-time">Posted <?php echo timeAgo(strtotime($post['post_timestamp'])); ?> by <?php echo $post['author']; ?></p>
                <a href="view.php?id=<?php echo $post['id']; ?>" class="btn btn-primary read-more-btn">Read More</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php include('incs/footer.php'); ?>
