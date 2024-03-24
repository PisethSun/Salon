<?php
require_once('../private/initialize.php');


$errors = [];
$username = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $connection = db_connect();

    $username = db_escape($connection, $_POST['account_username']);
    $password = db_escape($connection, $_POST['account_password']);

    if (empty($username) || empty($password)) {
        $errors[] = 'Both fields are required.';
    } else {
        // Attempt to find the user in the database
        $query = "SELECT * FROM account WHERE account_username = '{$username}' LIMIT 1";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['account_password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['person_id'];
                $_SESSION['username'] = $user['account_username'];

                // Redirect the user to another page (e.g., dashboard)
               redirect_to(url_for('users/index.php'));
                
            } else {
                $errors[] = 'Invalid username or password.';
            }
        } else {
            $errors[] = 'Invalid username or password.';
        }
    }

    mysqli_close($connection);
}
?>

<?php $page_title = 'Login'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>
<section>
<div class="uk-container uk-align-center uk-text-center">
    <h1 class="title" style="font-size:50px; font-family: 'Faustina', serif;">Login to <?=APP_NAME?></h1>
    <hr class="uk-divider-icon">
    <form action="" method="POST">
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large uk-form-large" type="text" name="account_username" placeholder="Enter your username" required value="<?= htmlspecialchars($username) ?>">
        </div>
        <div class="uk-margin">
            <input class="uk-input uk-form-width-large uk-form-large" type="password" name="account_password" placeholder="Enter your password" required>
        </div>
        <button class="uk-button uk-button-primary" type="submit" name="login">Login</button>
    </form>
    <?php if (!empty($errors)): ?>
        <div>
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</section>
<?php include(SHARED_PATH . '/public_footer.php'); ?>
