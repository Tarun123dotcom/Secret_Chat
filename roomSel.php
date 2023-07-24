<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Room</title>
    <link rel="stylesheet" href="roomSelstyle.css">
    <!-- <script src="roomSelscript.js"></script> -->
</head>
<body>
    <div><a href="userId.php">
        <img src="logo.jpg" id="logoImg" alt="">
    </a> </div>
    <div class="container">
        <form action="roomSel.php" method="post">
            <button id="crRoom" name="crRoom"> Create Room</button>
            <button id="jrRoom" name="jrRoom"> Join Room</button>
            <button id="exit" name="exit">Exit</button>
        </form>
    </div>
    <div class="containerOne">
    </div>
    <div class="containerThree">
    </div>
    <div class="containerFour">
    </div>
</body>
</html>
<?php 
    if(isset($_POST['crRoom'])){
        header("Location: createdRoom.php");
    }
    if(isset($_POST['jrRoom'])){
        header("Location: joinRoom.php");
    }
    if(isset($_POST['exit'])){
        header("Location: userId.php");
    }
    session_start();
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    echo $userId;
} else {
    echo "User ID not set.";
}

?>
