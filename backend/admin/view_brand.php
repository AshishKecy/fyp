<?php
session_start(); // Start the session

// Check if the admin_email session variable is set
if (!isset($_SESSION['admin_email'])) {
    // If not set, redirect to the login page
    header("Location: admin_login.php");
    exit; // Stop further execution
}
include 'admin_logout_nav.php';

// Database connection code
$host = "localhost"; // Change this if your MySQL server is hosted elsewhere
$user = "Ashish"; // Your MySQL username
$password = "98087777"; // Your MySQL password
$database = "signup"; // Your database name

// Establish the database connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if brand_id is set for deletion
if (isset($_POST['delete_brand']) && isset($_POST['brand_id'])) {
    $brand_id = $_POST['brand_id'];

    // Prepare and execute the SQL statement to delete the brand
    $stmt = $conn->prepare("DELETE FROM brands WHERE brand_id = ?");
    $stmt->bind_param("i", $brand_id);
    $stmt->execute();

    // Check if deletion was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Brand deleted successfully.');</script>";
    } else {
        echo "<script>alert('Failed to delete brand.');</script>";
    }

    // Close statement
    $stmt->close();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_brand"])) {
    // Escape user inputs for security
    $brand_name = $conn->real_escape_string($_POST['name']);

    // Insert brand into database
    $insert_query = "INSERT INTO brands (brand_name) VALUES ('$brand_name')";

    if ($conn->query($insert_query) === TRUE) {
        echo "<script>alert('Brand added successfully');</script>";
    } else {
        echo "<script>alert('Error adding brand: " . $conn->error . "');</script>";
    }
}

// Query to retrieve brands from the database
$sql = "SELECT * FROM brands";
$result = $conn->query($sql);

// Array to hold retrieved brands
$brands = array();

// Fetch brands from the result set
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $brands[] = $row;
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.3/css/bootstrap.min.css">
    <style>
        .add-brand-button {
            margin-bottom: 20px;
            padding: 6px 14px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-brand-button:hover {
            background-color: #0056b3;
        }

        .brand-table {
            width: 50%;
            margin: 0 auto;
            /* Centering the table */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            border: 3px solid #dddddd;
            background-color: #ffffff;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 6px;
            text-align: center;
            font-size: 14px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn-edit,
        .btn-delete {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            background-color: #eee;
        }
    </style>

</head>

<body>
    <div class="container" style="margin-top: 40px;">
        <!-- Content inside the container -->
        <h3>Brand Dashboard</h3>
        <!-- Add Brand Form -->
        <div class="row mb-4">
            <div class="col-md-2">
                <form method="post" action="insert_brands.php">
                    <button type="submit" class="btn btn-primary add-brand-button">Add Brand</button>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="row">
            <div class="col-md-12 brand-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Brand Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP Loop to display brands -->
                        <?php foreach ($brands as $index => $brand): ?>
                            <tr>
                                <td>
                                    <?php echo $index + 1; ?>
                                </td>
                                <td>
                                    <?php echo $brand['brand_name']; ?>
                                </td>
                                <td>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                                        style="display: inline;">
                                        <input type="hidden" name="brand_id" value="<?php echo $brand['brand_id']; ?>">
                                        <button type="submit" class="btn-edit btn btn-primary">Edit</button>
                                    </form>
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                                        style="display: inline;">
                                        <input type="hidden" name="brand_id" value="<?php echo $brand['brand_id']; ?>">
                                        <button type="submit" name="delete_brand"
                                            class="btn-delete btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- End PHP Loop -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Font Awesome CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

        <!-- jQuery and Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>

</html>