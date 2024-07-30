<?php
require __DIR__ . "/../config/constants.php";
require __DIR__ . "/templates/head.php";
require BASE_PATH . "/app/helper/auth.helper.php";
?>

<body>
    <section>
        <div class="wrapper">
            <div class="card">
                <h1>Registration</h1>
                <hr>

                <?php flash_message(); ?>

                <form action="/app/controller/Register.cont.php" method="post">
                    <input type="hidden" name="type" value="register">
                    <div class="input-container">
                        <img src="/assets/icons/user-solid.svg" alt="First Name Icon">
                        <input type="text" placeholder="First Name" name="first_name" value="<?= htmlspecialchars($first_name) ?>">
                    </div>
                    <div class="input-container">
                        <img src="/assets/icons/user-solid.svg" alt="Last Name Icon">
                        <input type="text" placeholder="Last Name" name="last_name" value="<?= htmlspecialchars($last_name) ?>">
                    </div>
                    <div class="input-container">
                        <img src="/assets/icons/envelope-solid.svg" alt="Email Icon">
                        <input type="email" placeholder="Email" name="email" value="<?= htmlspecialchars($email) ?>">
                    </div>
                    <div class="input-container">
                        <img src="/assets/icons/key-solid.svg" alt="Password Icon">
                        <input type="password" placeholder="Password" name="password" value="<?= htmlspecialchars($password) ?>">
                    </div>
                    <div class="input-container">
                        <img src="/assets/icons/key-solid.svg" alt="Confirm Password Icon">
                        <input type="password" placeholder="Confirm Password" name="confirm_password">
                    </div>
                    <button type="submit" class="register-button">REGISTER</button>
                </form>
                <p>Already have an account? <a href="login.php">Login.</a></p>
            </div>
        </div>
    </section>
</body>

</html>