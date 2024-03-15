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
<div class="uk-container uk-container uk-align-center  uk-text-center ">

  <h1 class="title" style="font-size:50px; font-family: 'Faustina', serif;">Welcome To <?=APP_NAME?></h1>
  

    <hr class="uk-divider-icon">
   
   
 <form action="" method="POST">
<div class="form-outline " data-mdb-input-init>


  <div class="uk-margin  ">
      
       <div class="uk-inline uk-width-xlarge  ">
           <span class="uk-form-icon" uk-icon="icon: mail"></span>
        <input class="uk-input uk-width-1-1 uk-input uk-form-width-large uk-form-large " type="email" name="email"class="box"  required aria-label="Large">
    </div>
     </div>
  <div class="uk-margin ">
      
      
       <div class="uk-inline uk-width-xlarge ">
           <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
        <input class="uk-input uk-width-1-1 uk-input uk-form-width-large uk-form-large" type="password" name="pass" class="box" required aria-label="Large">
    </div>
 </div>
      
      <button class="uk-button uk-button-primary" type="submit" value="login now" class="btn" name="submit">Login</button>
      
     
     </div>
  
 </form>
 <hr class="uk-divider-icon">
 <button onclick="location.href='signup.php';" class="uk-button uk-button-secondary "> <p style="color:white; font-size: 3em;">Don't have an account? Sign Up Now</p></button>
 
</div>

<?php include(SHARED_PATH .'/public_footer.php');?>
</body>

</html>
