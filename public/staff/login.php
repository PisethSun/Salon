<?php
require_once('../../private/initialize.php');

$errors = [];
$employee_username = '';
$password = '';

if(is_post_request()) {

  $employee_username = $_POST['employee_username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($employee_username)) {
    $errors[] = "employee_username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    // Using one variable ensures that msg is the same
    $login_failure_msg = "Log in was unsuccessful.";

    $admin = find_admin_by_employee_username($employee_username);
    if($admin) {
      // try to login
      if(password_verify($password, $admin['employee_hashed_password '])) {
        // password matches
        log_in_admin($admin);
        redirect_to(url_for('/staff/index.php'));
      } else {
        // employee_username found, but password does not match
        $errors[] = $login_failure_msg;
      }

    } else {
      // no employee_username found
      $errors[] = $login_failure_msg;
    }
  }

}

?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <h1>Log in</h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    employee_username:<br />
    <input type="text" name="employee_username" value="<?php echo h($employee_username); ?>" /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
