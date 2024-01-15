<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    include('connect_db.php');

    // Retrieve form data
    $title = $mysqli->real_escape_string($_POST["title"]);
    $content = $mysqli->real_escape_string($_POST["content"]);
    $author = $mysqli->real_escape_string($_POST["author"]);
    $category = $mysqli->real_escape_string($_POST["category"]);

    // SQL query to insert data into the database
    $sql = "INSERT INTO blog_posts (title, content, author, category) VALUES ('$title', '$content', '$author', '$category')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close the database connection
    $mysqli->close();
} else {
    // Redirect or handle other cases
    echo "Invalid request method";
}
?>
