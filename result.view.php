<?php
include 'result.php';

$results = get_results($conn);

$winners = $results['winners'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results - Employee Appreciation Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-primary p-5 text-dark bg-opacity-10">
    <div class="container shadow-lg p-3 bg-white rounded">
            <div class="p-5">
                <h1 class="display-6">Employee Appreciation Voting Results</h1>
                <h1 class="display-6">Winners</h1>
                <div class="results-list">
                    <?php 
                    foreach ($winners as $cat => $winner) {
                        echo "<div class='result-item'>";
                        echo "<h3>Winner for <mark>$cat</mark>:</h3>";
                        echo "<p class='lead'>Employee {$winner['nominee_name']} with {$winner['votes']} votes</p>";
                        echo "</div>";
                    }
                    ?>
                </div>

                <a href="index.php" class="btn btn-primary">Back to Voting</a>
            </div>
    </div>
</body>
</html>
