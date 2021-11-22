<?php

while ($row = mysqli_fetch_assoc($sql)) {

    $sql2 = "SELECT * FROM messages  WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if (mysqli_num_rows($query2) > 0) {
        $result = $row2['msg'];
    } else {
        $result = "No message available";
    }

    // trimming message if word is more than 28 characters
    (strlen($result) > 28) ? $msg = substr($result, 0, 28) . "..." : $msg = $result;
    // Adding you: text before message if login user is the sender

    (isset($row2['outgoing_msg_id']) && $outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";

    // check user is online or offline
    ($row['status'] == 'Offline now') ? $offline = "offline" : $offline = "";

    $fullName = $row['fname'] . ' ' . $row['lname'];
    $image = $row['image'];
    $uniqueId = $row['unique_id'];
    $output .= <<<html
        <a href="chat.php?user_id=$uniqueId">
            <div class="content">
                <img src="php/images/$image" alt="" />
                <div class="details">
                    <span>$fullName</span>
                    <p>$you $msg</p>
                </div>
            </div>
            <div class="status-dot $offline">
                <i class="fas fa-circle" aria-hidden="true"></i>
            </div>
        </a>
        html;
}