<?php

require_once('../../private/initialize.php');

require_login();

$users_set = find_all_account();

?>

<?php $page_title = 'Admins'; ?>

<div id="content">
  <div class="users listing">
    <h1>Admins</h1>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>Username</th>
       
        
      </tr>

      <?php while($account = mysqli_fetch_assoc($users_set)) { ?>
        <tr>
          <td><?php echo h($account['account_id']); ?></td>
          <td><?php echo h($account['account_username']); ?></td>
        </tr>
      <?php } ?>
    </table>

    <?php
      mysqli_free_result($users_set);
    ?>
  </div>

</div>

<?php include('../private/shared/public_footer.php'); ?>
