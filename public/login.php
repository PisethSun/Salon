<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
</head>

<body>
    <header>
        <h1>Login</h1>
    </header> -->
    <?php include('../private/shared/public_header.php');?>
    <section>
        <form action="login.php" method="post" >
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Your Website</p>
    </footer>
</body>

</html>
