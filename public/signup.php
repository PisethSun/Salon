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
<!--container-->
<div class="uk-container uk-container uk-align-center uk-text-center">
    <h1 class="title" style="font-size:50px; font-family: 'Faustina', serif;">Welcome To <?=APP_NAME?></h1>
    <hr class="uk-divider-icon">
    <form action="" enctype="multipart/form-data" method="POST">
        <!-- Name (Username) -->
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="text" name="account_username" placeholder="Enter your username" required>
            </div>
        </div>
        <!-- First Name -->
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="text" name="customer_first_name" placeholder="Enter your first name" required>
            </div>
        </div>
        <!-- Last Name -->
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="text" name="customer_last_name" placeholder="Enter your last name" required>
            </div>
        </div>
        <!-- Email -->
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="email" name="customer_email" placeholder="Enter your email" required>
            </div>
        </div>
        <!-- Phone -->
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: receiver"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="tel" name="customer_phone" placeholder="Enter your phone" required>
            </div>
        </div>
        <!-- Password -->
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="password" name="account_password" placeholder="Enter your password" required>
            </div>
        </div>
        <!-- Confirm Password -->
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
        </div>
        <!-- Submit Button -->
        <button class="uk-button uk-button-primary" type="submit" name="submit">Sign Up Now</button>
        <!-- Forget Password -->
        <button onclick="location.href='forgetpw.php';" class="uk-button uk-button-secondary" type="button">Forget Password?</button>
        <hr class="uk-divider-icon">
        <!-- Login Redirect -->
        <button onclick="location.href='login.php';" class="uk-button uk-button-secondary" type="button">
            <p style="color:white; font-size: 2em;">Already have an account? Login Now</p>
        </button>
    </form>
</div>

        <?php foreach ($errors as $error) {
            echo "<p>{$error}</p>";
        } ?>
</section>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
