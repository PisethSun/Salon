<?php

require_once('../../../private/initialize.php');

require_login();

$admin_set = find_all_employee();

?>

<?php $page_title = 'employee'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="employee listing">
    <h1>employee</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/employee/new.php'); ?>">Create New Admin</a>
    </div>

    <table class="list">
      <tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>employee_email</th>
        <th>Username</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
        <tr>
          <td><?php echo h($admin['id']); ?></td>
          <td><?php echo h($admin['employee_first_name']); ?></td>
          <td><?php echo h($admin['employee_last_name']); ?></td>
          <td><?php echo h($admin['employee_email']); ?></td>
          <td><?php echo h($admin['username']); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/employee/show.php?id=' . h(u($admin['id']))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/employee/edit.php?id=' . h(u($admin['id']))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/employee/delete.php?id=' . h(u($admin['id']))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
    </table>

    <?php
      mysqli_free_result($admin_set);
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
