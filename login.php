<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    header("Location: users.php");
}

include_once 'header.php';

?>

<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat App</header>
            <form action="#" method="post">
                <div class="error-txt"></div>

                <div class="field input">
                    <label for="">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" />
                </div>
                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter new password" />
                    <i class="fas fa-eye" aria-hidden="true"></i>
                </div>

                <div class="field button">
                    <input type="submit" value="Continue to Chat" />
                </div>
            </form>

            <div class="link">Not yet signed up? <a href="index.php">Sign Up Now</a></div>
        </section>
    </div>

    <script src="js/password-show-hide.js"></script>
    <script src="js/login.js"></script>

</body>

</html>