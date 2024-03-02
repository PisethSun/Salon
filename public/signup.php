<?php include('../private/shared/public_header.php');?>
    <section>
        <form action="signup.php" method="post" id="signupForm">
            <label for="employee_username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Sign Up</button>
        </form>
    </section>

    <?php include('../private/shared/public_footer.php');?>
