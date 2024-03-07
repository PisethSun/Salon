<?php
require_once('../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if (is_post_request()) {
    $employee_username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Perform authentication here (you need to implement this part)
    $authenticated_user = authenticate_user($employee_username, $password );

    if ($authenticated_user) {
        if ($authenticated_user['account_access_level'] == '1') {
            // Redirect to admin page
            header("Location: ./staff/admin/index.php");
            exit;  // Important to exit after a header redirect
        } else {
            // Redirect to index page for regular users
            header("Location: ./users/index.php");
            exit;
        }
    } else {
        // Authentication failed
        $errors[] = 'Invalid username or password.';
    }
    
}
?>
<?php $page_title = 'Login'; ?>
<?php include(SHARED_PATH .'/public_header.php');?>

<section>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <?php foreach ($errors as $error) {
        echo "<p>{$error}</p>";
    } ?>
</section>

<?php include(SHARED_PATH .'/public_footer.php');?>
</body>

</html>
