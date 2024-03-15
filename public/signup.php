<?php
require_once('../private/initialize.php');

$errors = [];

if (is_post_request()) {
    $account = [];
    $account['account_username'] = $_POST['account_username'] ?? '';
    $account['account_password'] = $_POST['account_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Customer information
    $customer = [];
    $customer['customer_first_name'] = $_POST['customer_first_name'] ?? '';
    $customer['customer_last_name'] = $_POST['customer_last_name'] ?? '';
    $customer['customer_email'] = $_POST['customer_email'] ?? '';
    $customer['customer_phone'] = $_POST['customer_phone'] ?? '';
}
?>

<!-- The rest of your HTML code remains unchanged -->

<?php $page_title = 'Create Account'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>
<section>
    <h2>User Sign Up</h2>
    <form action="signup.php" method="post" id="signupForm">
        <!-- Account information -->
        <label for="account_username">Username:</label>
        <input type="text" id="account_username" name="account_username" required>

        <!-- Customer information -->
        <label for="customer_first_name">First Name:</label>
        <input type="text" id="customer_first_name" name="customer_first_name" required>

        <label for="customer_last_name">Last Name:</label>
        <input type="text" id="customer_last_name" name="customer_last_name" required>

        <label for="customer_email">Email:</label>
        <input type="email" id="customer_email" name="customer_email" required>

        <label for="customer_phone">Phone:</label>
        <input type="tel" id="customer_phone" name="customer_phone" required>

        <label for="account_password">Password:</label>
        <input type="password" id="account_password" name="account_password" required>

        <!-- Confirm password -->
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit">Sign Up</button>

        <!-- Display errors -->
        <?php foreach ($errors as $error) {
            echo "<p>{$error}</p>";
        } ?>
    </form>
</section>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
