<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Appreciation Voting</title>
    <style>
        body { 
            font-family: Tahoma, sans-serif !important; 
            margin: 0; 
            padding: 0;  
        }
        .container { max-width: 500px; margin: 50px auto; padding: 20px;}
        h1 { 
            text-align: center; 
        }
        label { 
            font-weight: bold; 
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-primary p-2 text-dark bg-opacity-10">
    <div class="container w-50 shadow-lg p-3 bg-white rounded">
        <div class="text-center mt-4">
            <img class="mb-4" src="https://pabau.com/wp-content/uploads/2022/05/logo-final.svg" alt="" width="225" height="80">
        </div>
        <h1 class="text-dark-emphasis h2">Vote for an Employee</h1>
        <form method="POST" action="vote.php" class="p-5">
            <label for="voter_id" class="form-label m-2">Your Name</label>
            <select name="voter_id" id="voter_id" class="form-control m-2"  required>
                <option value="">Select your name</option>
                <?php
                include 'db.php';
                $result = $conn->query("SELECT id, name FROM employees");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>

            <label for="nominee_id" class="form-label m-2">Nominee Name</label>
            <select name="nominee_id" id="nominee_id" class="form-control m-2"  required>
                <option value="">Select a nominee</option>
                <?php
                $result = $conn->query("SELECT id, name FROM employees");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>

            <label for="category" class="form-label m-2">Category</label>
            <select name="category" id="category" class="form-control m-2"  required>
                <option value="Makes Work Fun">Makes Work Fun</option>
                <option value="Team Player">Team Player</option>
                <option value="Culture Champion">Culture Champion</option>
                <option value="Difference Maker">Difference Maker</option>
            </select>

            <label for="comment" class="form-label m-2">Comment</label>
            <textarea name="comment" id="comment" class="form-control m-2" rows="2" required></textarea>
            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary w-25">Submit Vote</button>
            </div>
            <?php
                // Display the error message
                if (isset($_GET['error'])) {
                    echo "<div class='alert alert-danger mt-4' role='alert'>" . htmlspecialchars($_GET['error']) . "</div>";
                } 
            ?>
        </form>
    </div>
</body>
</html>
