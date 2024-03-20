<?php 
if(!isset($page_title)) { $page_title = 'User Home';}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Helen's - <?php echo $page_title;?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for('/css/style.css');?>">
    
    
</head>
<body>
    <head>
        <h1>Halen's Staff Area</h1>
    </head>
    <navigation>
    <ul>

        <li><a href="<?php echo url_for('/staff/index.php');?>">Home</a></li>
        <li>User: <?php echo $_SESSION['account_username'] ?? ''; ?> </li>
    </ul>
    </navigation>
