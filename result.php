<?php
include 'db.php';

function get_results($conn) {
    $categories = ["Makes Work Fun", "Team Player", "Culture Champion", "Difference Maker"];
    $winners = [];

    foreach ($categories as $cat) {
        $query = "SELECT e.id AS nominee_id, e.name AS nominee_name, COUNT(*) AS votes
            FROM votes v
            JOIN employees e ON v.nominee_id = e.id
            WHERE v.category = '$cat'
            GROUP BY nominee_id
            ORDER BY votes DESC LIMIT 1";
        $result = $conn->query($query);
        $winner = $result->fetch_assoc();
        $winners[$cat] = $winner;
    }

    return [
        'winners' => $winners,
    ];
}


