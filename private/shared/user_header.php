<?php 
if(!isset($page_title)) { $page_title = 'User Home';}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Helen's - <?php echo $page_title;?></title>
    <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="<?php echo url_for('/css/style.css');?>">
      <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"/>
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css"
      rel="stylesheet"
    />
    
    
    
</head>
<body>
<header class="header style:box-shadow:none">

<div class="flex">
     <nav class="navbar">

     <a href="reservation.php">Reservation Record</a>
      <a href="schedule.php"></a>


       </nav>

   <a class="logo"><?=APP_NAME?><span>&trade;</span></a>

   <nav class="navbar">
        <?php if(isset($_SESSION['username'])): ?>
            <a>Hi,<?php echo htmlspecialchars($_SESSION['username']); ?></a>
            <a href="<?php echo url_for('index.php');?>">Logout</a>

          
        <?php endif; ?>
     </nav>




<div class="icons">
      <div id="menu-btn" class="fas fa-bars"></div>
   </div>
</div>

</header>



    