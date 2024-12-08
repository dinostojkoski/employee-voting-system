<?php
include 'db.php';

// Winners per category
$categories = ["Makes Work Fun", "Team Player", "Culture Champion", "Difference Maker"];
foreach ($categories as $cat) {
    $query = "SELECT nominee_id, COUNT(*) AS votes FROM votes WHERE category = '$cat' GROUP BY nominee_id ORDER BY votes DESC LIMIT 1";
    $result = $conn->query($query);
    $winner = $result->fetch_assoc();
    echo "<h2>Winner for $cat: Employee ID {$winner['nominee_id']} with {$winner['votes']} votes.</h2>";
}

// Most Active Voter
$query = "SELECT voter_id, COUNT(*) AS total_votes FROM votes GROUP BY voter_id ORDER BY total_votes DESC LIMIT 1";
$result = $conn->query($query);
$top_voter = $result->fetch_assoc();
echo "<h2>Most Active Voter: Employee ID {$top_voter['voter_id']} with {$top_voter['total_votes']} votes.</h2>";

