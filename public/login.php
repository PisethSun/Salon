    
    <?php 
    require_once('../private/initialize.php');
    
    
    
    $errors =[];
    $employee_username ='';
    $password ='';

    if(is_post_request())

    {
        $employee_username = $_POST['employee_username'] ?? '';
        $password = $_POST['password'] ?? '';

        redirect_to(url_for('index.php'));

    }
    ?>
    
    
    

    
    
    <?php include('../private/shared/public_header.php');?>
    <section>
        <form action="login.php" method="post" >
            <label for="employee_username">employee_username:</label>
            <input type="text" id="employee_username" name="employee_username" required>

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
