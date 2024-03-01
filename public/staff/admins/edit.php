<?php

require_once('../../../private/initialize.php');

require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/employee/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $admin = [];
  $admin['id'] = $id;
  $admin['employee_first_name'] = $_POST['employee_first_name'] ?? '';
  $admin['employee_last_name'] = $_POST['employee_last_name'] ?? '';
  $admin['employee_email'] = $_POST['employee_email'] ?? '';
  $admin['employee_username'] = $_POST['employee_username'] ?? '';
  $admin['password'] = $_POST['password'] ?? '';
  $admin['confirm_password'] = $_POST['confirm_password'] ?? '';

  $result = update_admin($admin);
  if($result === true) {
    $_SESSION['message'] = 'Admin updated.';
    redirect_to(url_for('/staff/employee/show.php?id=' . $id));
  } else {
    $errors = $result;
  }
} else {
  $admin = find_admin_by_id($id);
}

?>

<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/employee/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin edit">
    <h1>Edit Admin</h1>

    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/staff/employee/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>First name</dt>
        <dd><input type="text" name="employee_first_name" value="<?php echo h($admin['employee_first_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Last name</dt>
        <dd><input type="text" name="employee_last_name" value="<?php echo h($admin['employee_last_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>employee_username</dt>
        <dd><input type="text" name="employee_username" value="<?php echo h($admin['employee_username']); ?>" /></dd>
      </dl>

      <dl>
        <dt>employee_email</dt>
        <dd><input type="text" name="employee_email" value="<?php echo h($admin['employee_email']); ?>" /><br /></dd>
      </dl>

      <p>Passwords should be at least 12 characters and include at least one uppercase letter, lowercase letter, number, and symbol.</p>

      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>
      </dl>

      <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd>
      </dl>
      <br />

      <div id="operations">
        <input type="submit" value="Edit Admin" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
