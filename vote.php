<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voter_id = $_POST['voter_id'];
    $nominee_id = $_POST['nominee_id'];
    $category = $_POST['category'];
    $comment = trim($_POST['comment']);

    // Check if voter and nominee are not the same
    if ($voter_id === $nominee_id) {
        header("Location: index.php?error=" . urlencode("You cannot vote for yourself!"));
        exit();
    }

    // Check if the voter has already voted in this category
    $stmt = $conn->prepare("SELECT * FROM votes WHERE voter_id = ? AND category = ?");
    $stmt->bind_param("is", $voter_id, $category);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: index.php?error=" . urlencode("You have already voted in this category!"));
        exit();
    }

    // Check if comment is empty
    if (empty($comment)) {
        header("Location: index.php?error=" . urlencode("Comment is required!"));
        exit();
    }

    // Insert Vote into Database
    $stmt = $conn->prepare("INSERT INTO votes (voter_id, nominee_id, category, comment, timestamp) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiss", $voter_id, $nominee_id, $category, $comment);
    $stmt->execute();

    echo "Vote successfully submitted!";
    $stmt->close();
    $conn->close();
}

