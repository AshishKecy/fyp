<?php
// Connect to the database
$host = "localhost"; // Change this if your MySQL server is hosted elsewhere
$user = "Ashish"; // Your MySQL username
$password = "98087777"; // Your MySQL password
$database = "signup"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data
$sql = "SELECT name FROM users";
$result = $conn->query($sql);

$userNames = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $userNames[] = $row["name"];
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>User Dashboard</h1>
        <div class="card">
            <div class="card-header">
                All Users
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach ($userNames as $name): ?>
                    <li class="list-group-item">
                        <?php echo $name; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>