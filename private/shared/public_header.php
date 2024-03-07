<?php
if(!isset($page_title)) { $page_title = 'Welcome';}
?> 
<!DOCTYPE html>

<html lang="en">
<head>  
    <title>Helen's - <?php echo $page_title;?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo url_for('/styles/styles.css'); ?>">

    
</head>
<body>
<header>
    <h1>Welcome to Helen's Nail & Spa</h1>
</header>

<nav>
    <ul>
        <li><a href="<?php echo url_for('index.php'); ?>">Home</a></li>
        <li><a href="<?php echo url_for('gallery.php'); ?>">Gallery</a></li>
        <li><a href="<?php echo url_for('signup.php'); ?>">Sign up</a></li>
        <li><a href="<?php echo url_for('login.php'); ?>">Login</a></li>
    </ul>
</nav>

