<?php
require_once('../private/initialize.php');


if (is_post_request()) {
  $account = [];
  $account['account_username'] = $_POST['account_username'] ?? '';
  $account['account_password'] = $_POST['account_password'] ?? '';
  $account['account_access_level'] = $_POST['account_access_level'] ?? '';
  $account['person_id'] = $_POST['person_id'] ?? '';

  // Add other necessary fields (e.g., account_status, account_creation_date)

  if (!empty($account['account_username']) && !empty($account['account_password']) && !empty($account['account_access_level']) && !empty($account['person_id'])) {

      // You may generate account_id, set account_status, account_creation_date here as needed

      //save to database
      $query = "INSERT INTO account (account_username, account_password, account_access_level, person_id) 
                VALUES ('{$account['account_username']}', '{$account['account_password']}', '{$account['account_access_level']}', '{$account['person_id']}')";

      mysqli_query($db, $query);

      // Redirect to a success page or login page
      header("Location: login.php");
      die;
  }
}
?>

<?php $page_title = 'Create Account'; ?>
<?php include(SHARED_PATH .'/public_header.php');?>
<section>
<h2>User Sign Up</h2>
    <form action="signup.php" method="post" id="signupForm">
        <label for="account_username">Username:</label>
        <input type="text" id="account_username" name="account_username" required>

        <label for="account_password">Password:</label>
        <input type="password" id="account_password" name="account_password" required>

        <label for="account_access_level">Access Level:</label>
        <select id="account_access_level" name="account_access_level">
            <option value="1">Admin</option>
            <option value="2">User</option>
            <!-- Add more options if needed -->
        </select>

        <label for="person_id">Person ID:</label>
        <input type="text" id="person_id" name="person_id" required>

        <button type="submit">Sign Up</button>
    </form>
</section>

<?php include(SHARED_PATH .'/public_footer.php');?>
