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

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle customer deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_customer"])) {
    $customerId = $_POST["delete_customer"];
    $deleteSql = "DELETE FROM customers WHERE customer_id = '$customerId'";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Customer deleted successfully";
    } else {
        echo "Error deleting customer: " . $conn->error;
    }
}

// Retrieve all customers
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

$customers = array();

if ($result->num_rows > 0) {
    // Output data of each row
    $serialNumber = 1; // Initialize serial number
    while ($row = $result->fetch_assoc()) {
        $row['serial'] = $serialNumber++; // Add serial number to row
        $customers[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();
?>
<<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer Dashboard</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.3/css/bootstrap.min.css">
        <!-- Include Font Awesome library -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .action-column {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    </head>

    <body>
        <div class="container" style="margin-top: 40px;">
            <h3>Customers Details</h3>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($customers)) {
                            foreach ($customers as $customer) {
                                echo "<tr>";
                                echo "<td>" . $customer['serial'] . "</td>"; // Display serial number
                                echo "<td>" . (isset($customer['customer_id']) ? $customer['customer_id'] : "N/A") . "</td>";
                                echo "<td>" . (isset($customer['name']) ? $customer['name'] : "N/A") . "</td>";
                                echo "<td>" . (isset($customer['address']) ? $customer['address'] : "N/A") . "</td>";
                                echo "<td>" . (isset($customer['phone']) ? $customer['phone'] : "N/A") . "</td>";
                                echo "<td>" . (isset($customer['email']) ? $customer['email'] : "N/A") . "</td>";
                                echo "<td class='action-column'>
                                    <form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
                                        <input type='hidden' name='delete_customer' value='" . $customer['customer_id'] . "'>
                                        <button type='submit' class='btn btn-danger'><i class='fas fa-trash-alt'></i></button>
                                    </form>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No customers found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>