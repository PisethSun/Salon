<?php
require_once('../private/initialize.php');

$errors = [];
$account_username = '';
$account_password = '';




if(is_post_request()) {
    $account_username = $_POST['account_username'] ?? '';
    $account_password = $_POST['account_password'] ?? '';

    if(is_blank($account_username)) {
        $errors[] = "Username cannot be blank.";
    }
    if(is_blank($account_password)) {
        $errors[] = "Password cannot be blank.";
    }

    if(empty($errors)) {
        $login_failure_msg = "Login was unsuccessful.";

        $UserLogIn = find_account_by_username($account_username);
        if ($UserLogIn) {
            if (password_verify($account_password, $UserLogIn['account_password'])) {
                // Password matches
                log_in_users($UserLogIn);
                redirect_to(url_for('public/users/index.php'));
            } else {
                // Username found, but password does not match
                $errors[] = $login_failure_msg;
            }
        } else {
            // Username not found
            $errors[] = $login_failure_msg;
        }
    }
}


?>

<?php $page_title = 'Login'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>
<div class="uk-container uk-container uk-align-center  uk-text-center ">
    <h1 class="title" style="font-size:50px; font-family: 'Faustina', serif;">Welcome To <?= APP_NAME ?></h1>
    <div class="uk-alert-danger" uk-alert>
    <a href class="uk-alert-close" uk-close></a>
    <p> <?php echo display_errors($errors); ?></p>
   
</div>
   
    <hr class="uk-divider-icon">
  
    <form action="" method="POST">
        <div class="form-outline " data-mdb-input-init>
            <div class="uk-margin  ">
                <div class="uk-inline uk-width-xlarge  ">
                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                    <input class="uk-input uk-width-1-1 uk-input uk-form-width-large uk-form-large " type="text"
                        name="account_username" value="<?= h($account_username); ?>" class="box"
                        placeholder="Enter your username">
                </div>
            </div>
            <div class="uk-margin ">
                <div class="uk-inline uk-width-xlarge ">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                    <input class="uk-input uk-width-1-1 uk-input uk-form-width-large uk-form-large" type="password"
                        name="account_password" value="" class="box" placeholder="Enter your password">
                </div>
            </div>
            <button class="uk-button uk-button-primary" type="submit" value="login now" class="btn"
                name="submit">Login</button>
        </div>
        
    </form>
  
    <hr class="uk-divider-icon">
    <button onclick="location.href='<?php echo url_for('/signup.php'); ?>" class="uk-button uk-button-secondary ">
        <p style="color:white; font-size: 3em;">Don't have an account? Sign Up Now</p>
    </button>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>

