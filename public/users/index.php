<?php require_once('../private/initialize.php');?>
<?php $page_title = 'Welcome -Book Appointment Today';?>
<?php include(SHARED_PATH .'/user_header.php');?>

<h1>Hello : <?php  echo $_SESSION['account_username'] ??'';?> </h1>


<?php include(SHARED_PATH .'/user_footer.php');?>