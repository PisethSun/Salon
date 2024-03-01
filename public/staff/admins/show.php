<?php

require_once('../../../private/initialize.php');

require_login();

$id = $_GET['id'] ?? '1'; // PHP > 7.0
$admin = find_admin_by_id($id);

?>

<?php $page_title = 'Show Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/employee/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin show">

    <h1>Admin: <?php echo h($admin['username']); ?></h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/employee/edit.php?id=' . h(u($admin['id']))); ?>">Edit</a>
      <a class="action" href="<?php echo url_for('/staff/employee/delete.php?id=' . h(u($admin['id']))); ?>">Delete</a>
    </div>

    <div class="attributes">
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($admin['employee_first_name']); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($admin['employee_last_name']); ?></dd>
      </dl>
      <dl>
        <dt>employee_email</dt>
        <dd><?php echo h($admin['employee_email']); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($admin['username']); ?>
        </dd>
      </dl>
    </div>

  </div>

</div>
