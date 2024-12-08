<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voter_id = $_POST['voter_id'];
    $nominee_id = $_POST['nominee_id'];
    $category = $_POST['category'];
    $comment = trim($_POST['comment']);

    // Validation: Ensure voter and nominee are not the same
    if ($voter_id === $nominee_id) {
        // Redirect to error page with the error message
        header("Location: index.php?error=" . urlencode("You cannot vote for yourself!"));
        exit(); // Make sure the script stops executing
    }

    // Check if the voter has already voted in this category
    $stmt = $conn->prepare("SELECT * FROM votes WHERE voter_id = ? AND category = ?");
    $stmt->bind_param("is", $voter_id, $category);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Redirect to error page with a specific error message
        header("Location: index.php?error=" . urlencode("You have already voted in this category!"));
        exit();
    }

    // Validation: Ensure comment is not empty
    if (empty($comment)) {
        header("Location: index.php?error=" . urlencode("Comment is required!"));
        exit();
    }

    // Check if the voter has already voted for the nominee in the same category
    $stmt = $conn->prepare("SELECT * FROM votes WHERE voter_id = ? AND nominee_id = ? AND category = ?");
    $stmt->bind_param("iis", $voter_id, $nominee_id, $category);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If a matching vote exists, prevent duplicate votes
        echo "<script>alert('You have already voted for this person in this category!');</script>";
        die();
    }

    // Insert Vote into Database
    $stmt = $conn->prepare("INSERT INTO votes (voter_id, nominee_id, category, comment, timestamp) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiss", $voter_id, $nominee_id, $category, $comment);
    $stmt->execute();

    echo "Vote successfully submitted!";
    $stmt->close();
    $conn->close();
}

