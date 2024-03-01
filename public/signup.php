<?php include('../private/shared/public_header.php');?>
    <section>
        <form action="signup.php" method="post" id="signupForm">
            <label for="employee_username">employee_username:</label>
            <input type="text" id="employee_username" name="employee_username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Sign Up</button>
        </form>
    </section>

    <?php include('../private/shared/public_footer.php');?>
