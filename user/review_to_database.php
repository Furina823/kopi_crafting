<?php
session_start ();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
include '../connection.php';

$rating = $_POST['rate'];
$order_id = $_POST['order_id'];
$description = $_POST['opinion'];

// Prepare the SQL statement with placeholders
$sql = "INSERT INTO reviews (order_id, review_rating, review_description) VALUES (?, ?, ?)";

// Prepare the statement
if ($stmt = mysqli_prepare($dbConn, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "iis", $order_id, $rating, $description);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // If insertion is successful, update order status
        $sql = "UPDATE orders SET order_status ='Reviewed' WHERE order_id = ?";
        if ($stmt = mysqli_prepare($dbConn, $sql)) {
            // Bind order_id parameter
            mysqli_stmt_bind_param($stmt, "i", $order_id);
            // Execute the update statement
            if (mysqli_stmt_execute($stmt)) {
                echo "<script>
                alert('We appreciate your valuable review. Thank you for sharing your thoughts.');
                window.location.href ='purchase.php?order_status=reviewed';
                </script>";
            } else {
                echo "Error updating order status: " . mysqli_error($dbConn);
            }
        } else {
            echo "Error preparing update statement: " . mysqli_error($dbConn);
        }
    } else {
        echo "Error inserting review: " . mysqli_error($dbConn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing statement: " . mysqli_error($dbConn);
}

// Close the database connection
mysqli_close($dbConn);

?>