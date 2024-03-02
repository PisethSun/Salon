<?php
session_start();  // Start or resume a session

// Check if the user is logged in
if (isset($_SESSION['account_id'])) {
    $user_id = $_SESSION['account_id'];
    $username = $_SESSION['username'];

    // Display information about the logged-in user
    echo "Welcome, $username! Your user ID is $account_id.";

    // You can use this information to customize the content for the logged-in user
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit;
}
?>
