<?php
require_once('../private/initialize.php');

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $connection = db_connect();
    try {

        $customerFirstName = db_escape($connection, $_POST['customer_first_name']);
        $customerLastName = db_escape($connection, $_POST['customer_last_name']);
        $customerEmail = db_escape($connection, $_POST['customer_email']);
        $customerPhone = db_escape($connection, $_POST['customer_phone']);
        $accountUsername = db_escape($connection, $_POST['account_username']);
        $accountPassword = db_escape($connection, $_POST['account_password']);

        $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);
        
      $insertDataToTwoTables = "INSERT INTO customer (customer_first_name, customer_last_name, customer_email, customer_phone) VALUES ('$customerFirstName', '$customerLastName', '$customerEmail', '$customerPhone'); ";
      $insertDataToTwoTables .= "SET @customer_id = (SELECT customer_id FROM customer WHERE customer_phone ='$customerPhone'); ";
   
     $insertDataToTwoTables .= "INSERT INTO account (account_username, account_password, account_access_level, account_status, account_creation_date, person_id) VALUES ('$accountUsername', '$hashedPassword', '0', 'active', NOW(), @customer_id);";
     mysqli_multi_query($connection, $insertDataToTwoTables);
     echo "$accountPassword";
        
    } catch (Exception $e) {
        mysqli_rollback($connection);
        echo "An error occurred while creating the account: " . $e->getMessage();
    } 
   
}
?>

<?php $page_title = 'Create Account'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>
<section>
<div class="uk-container uk-container uk-align-center uk-text-center">
    <h1 class="title" style="font-size:50px; font-family: 'Faustina', serif;">Welcome To <?=APP_NAME?></h1>
    <hr class="uk-divider-icon">
    <form action="" enctype="multipart/form-data" method="POST">
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="text" name="account_username" placeholder="Enter your username" required>
            </div>
        </div>
 
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="text" name="customer_first_name" placeholder="Enter your first name" required>
            </div>
        </div>
      
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: user"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="text" name="customer_last_name" placeholder="Enter your last name" required>
            </div>
        </div>
     
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="email" name="customer_email" placeholder="Enter your email" required>
            </div>
        </div>
      
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: receiver"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="tel" name="customer_phone" placeholder="Enter your phone" required>
            </div>
        </div>
      
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="password" name="account_password" placeholder="Enter your password" required>
            </div>
        </div>
     
        <div class="uk-margin">
            <div class="uk-inline uk-width-xlarge">
                <span class="uk-form-icon" uk-icon="icon: lock"></span>
                <input class="uk-input uk-form-width-large uk-form-large" type="password" name="confirm_password" placeholder="Confirm your password" required>
            </div>
        </div>
   
        <button class="uk-button uk-button-primary" type="submit" name="submit">Sign Up Now</button>

        <hr class="uk-divider-icon">
       
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
