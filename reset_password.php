<?php
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $new_password = $_POST["password"];

    
    $sql = "UPDATE customers SET cus_password = '$new_password' WHERE cus_email = '$email'";

    if ($dbConn->query($sql) === TRUE) {
        $remove_token_sql = "DELETE FROM password_reset_tokens WHERE email = '$email'";
        $dbConn->query($remove_token_sql);

        echo "<script>alert('Password reset successful. You can now log in with your new password.'); window.location.href='./login.php';</script> ";

    } else {
        echo "Error updating password: " . $dbConn->error;
    }
}

$dbConn->close();
?>