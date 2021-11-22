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
        <section class="chat-area">
            <header>
                <?php
                include_once 'php/config.php';
                $user_id = mysqli_real_escape_string($con, $_GET['user_id']);
                $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = {$user_id}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_object($sql);
                }
                ?>

                <a href="users.php" class="back-icon">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                </a>
                <img src="php/images/<?php echo $row->image; ?>" alt="user Image" />
                <div class="details">
                    <span><?php echo ucwords(strtolower($row->fname)) . ' ' . ucwords(strtolower($row->lname)); ?></span>
                    <p><?php echo $row->status; ?></p>
                </div>
            </header>

            <div class="chat-box">


            </div>

            <form method="POST" onsubmit="event.preventDefault(); ajaxRequest();" class="typing-area">
                <input type="hidden" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>">
                <input type="hidden" name="incoming_id" value="<?php echo $user_id; ?>">
                <input type="text" name="message" class="input-field" placeholder="Type a message here" />
                <button type="button" class="send-button">
                    <i class="fab fa-telegram-plane"></i>
                </button>
            </form>
        </section>
    </div>
    <script src="js/chat.js"></script>
</body>

</html>