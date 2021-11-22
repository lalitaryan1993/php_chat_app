<?php

session_start();
if (!isset($_SESSION['unique_id'])) {
    header("Location: login.php");
}
?>


<?php
include_once 'header.php';
?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                include_once 'php/config.php';
                $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_object($sql);
                }
                ?>
                <div class="content">
                    <img src="php/images/<?php echo $row->image; ?>" alt="user Image" />
                    <div class="details">
                        <span><?php echo ucwords(strtolower($row->fname)) . ' ' . ucwords(strtolower($row->lname)); ?></span>
                        <p><?php echo $row->status; ?></p>
                    </div>
                </div>
                <a href="php/logout.php" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" name="" id="" placeholder="Enter name to search..." />
                <button class="">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <div class="users-list">

            </div>
        </section>
    </div>
    <script src="js/users.js"></script>
</body>

</html>