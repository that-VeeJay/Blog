<?php
require __DIR__ . "/../config/constants.php";
require __DIR__ . "/templates/head.php";
require BASE_PATH . "/app/helper/auth.helper.php";
?>

<body>
    <section>
        <div class="wrapper">
            <div class="card">
                <h1>Login</h1>
                <hr>

                <?php flash_message(); ?>

                <form action="/app/controller/Login.cont.php" method="post">
                    <input type="hidden" name="type" value="login">
                    <div class="input-container">
                        <img src="/assets/icons/envelope-solid.svg" alt="Email Icon">
                        <input type="email" placeholder="Email" name="email" value="<?= htmlspecialchars($email_login) ?>">
                    </div>
                    <div class="input-container">
                        <img src="/assets/icons/key-solid.svg" alt="Password Icon">
                        <input type="password" placeholder="Password" name="password">
                    </div>
                    <button type="submit" class="register-button">LOGIN</button>
                </form>
                <p>Not a member yet? <a href="register.php">Register.</a></p>
            </div>
        </div>
    </section>
</body>

</html>