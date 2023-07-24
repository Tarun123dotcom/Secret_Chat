<?php
session_start();
include("DBSConnection.php");

// Retrieve the last received message ID for the current user
if (!isset($_SESSION['lastReceivedMessageId'])) {
    $_SESSION['lastReceivedMessageId'] = 0;
}
$lastReceivedMessageId = $_SESSION['lastReceivedMessageId'];

// Set the timestamp in the session if it doesn't exist
if (!isset($_SESSION['timestamp'])) {
    $_SESSION['timestamp'] = time();
}

if (isset($_POST['submit'])) {
    $userId = $_SESSION['userId'];
    $message = $_POST['writeMessege'];

    if (!empty($message)) {
        // Update the message in the database
        $stmt = $connect->prepare("INSERT INTO messeges (FromUser, Messege) VALUES (?, ?)");
        $stmt->bind_param("ss", $userId, $message);
        if ($stmt->execute()) {
            // Message inserted successfully
        } else {
            echo "Error: " . $stmt->error; // Display error message
        }
    }
}

// Retrieve new messages
$msgs = mysqli_query($connect, "SELECT * FROM messeges WHERE Id > $lastReceivedMessageId") or die("Failed to query database: " . mysqli_error($connect));

// Update the last received message ID for the current user
if ($row = mysqli_fetch_assoc($msgs)) {
    $_SESSION['lastReceivedMessageId'] = $row['Id'];
}

// Update the timestamp in the session to the current time
$_SESSION['timestamp'] = time();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="chatStyle.css">
    <style>
        .messege {
            margin-left: 648px;
            margin-bottom: 500px;
            position: fixed;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="logo.jpg" id="logoImg" alt="" style="height: 100px; width: 100px; position: absolute; left: 0; top: 0;">
    </div>
    <div class="wrapper">
        <div class="circleOne"></div>
        <?php while ($msg = mysqli_fetch_assoc($msgs)): ?>
            <?php if ($msg['FromUser'] == $_SESSION['userId']): ?>
                <div class="outgoing">
                    <p><?php echo $msg['Messege']; ?></p>
                </div>
            <?php else: ?>
                <div class="incoming">
                    <p><?php echo $msg['Messege']; ?></p>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>

        <div class="messege">
            <form action="chat.php" method="post">
                <input type="text" name="writeMessege" placeholder="Type your message here..."><br>
                <button name="submit" type="submit">Send</button>
            </form>
        </div>
    </div>
</body>
</html>
