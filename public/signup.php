<?php
require_once('../private/initialize.php');

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Assuming all necessary validations are performed before this point
    
    $connection = db_connect();
    
    
    try {
        // Sanitize inputs
        $customerFirstName = db_escape($connection, $_POST['customer_first_name']);
        $customerLastName = db_escape($connection, $_POST['customer_last_name']);
        $customerEmail = db_escape($connection, $_POST['customer_email']);
        $customerPhone = db_escape($connection, $_POST['customer_phone']);
        $accountUsername = db_escape($connection, $_POST['account_username']);
        $accountPassword = db_escape($connection, $_POST['account_password']);
        
        // print "<h2>" . $customerFirstName . "</h2>";
        // Hash the password
        $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);
        
        // Insert into customer table
        $customerSql = "INSERT INTO customer (customer_first_name, customer_last_name, customer_email, customer_phone) VALUES ('$customerFirstName', '$customerLastName', '$customerEmail', '$customerPhone')";
      
        mysqli_query($connection, $customerSql);
        confirm_result_set(mysqli_affected_rows($connection)); // Custom function to confirm query success
        
      
        // Retrieve the ID of the newly inserted customer record
        $customer_id = mysqli_insert_id($connection);
        print "<h2>" . $customer_id . "</h2>";
        // Insert into account table
        $accountSql = "INSERT INTO account (account_username, account_password, account_access_level, account_status, account_creation_date, person_id) VALUES ('$accountUsername', '$hashedPassword', '0', 'active', NOW(), '$customer_id')";
        mysqli_query($connection, $accountSql);
        confirm_result_set(mysqli_affected_rows($connection)); // Custom function to confirm query success
    

        // After successful account creation, redirect to the login page
        // redirect_to('login.php');
        
    } catch (Exception $e) {
        // Rollback transaction if any part of the process fails
        mysqli_rollback($connection);
        echo "An error occurred while creating the account: " . $e->getMessage();
    } 

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
