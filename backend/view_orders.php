<?php
// Connect to the database (Replace with your database credentials)
include 'database_connect.php';

// Check if the form is submitted and the order_id is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_order'])) {
    // Retrieve the order_id from the form submission
    $order_id = $_POST['order_id'];

    // Update the status of the order to "On the way"
    $status = "On the way";
    $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $order_id);
    if ($stmt->execute()) {
        // Refresh the page to reflect the updated status
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        // Error handling if the update fails
        echo "Error updating status: " . $conn->error;
    }
}

// Retrieve orders from the database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Orders</title>
</head>

<body>
    <h2>View Orders</h2>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["order_id"] . "</td>";
                echo "<td>" . $row["customer_name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone_number"] . "</td>";
                echo "<td>" . $row["address"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>";
                // Display the "Send" button for each order
                echo "<form method='post'>";
                echo "<input type='hidden' name='order_id' value='" . $row["order_id"] . "'>";
                echo "<button type='submit' name='send_order'>Send</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No orders found</td></tr>";
        }
        ?>
    </table>
</body>

</html>

<?php
// Close database connection
$conn->close();
?>