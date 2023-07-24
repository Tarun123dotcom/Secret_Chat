<?php
session_start();
include('DBSConnection.php');
$randomNumber = generateRandomNumber();
$_SESSION['randomNumber'] = $randomNumber;
$userId = $_SESSION['userId'];
try{
    $stmt = $connect->prepare("INSERT INTO roomId (roomNo,userId) VALUES (?,?)");
    $stmt->bind_param("ss", $randomNumber,$userId);
    $stmt->execute();
}catch (Exception $e){
    echo "Error: " . $e->getMessage();
    header("Location: exception.php");
}
function generateRandomNumber() {
    return rand(10000, 99999);
}
// echo $userId;
// $_SESSION['randomNumber'] = rand(10000, 99999);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="roomNostyle.css">
    <title>Room No</title>
    <!-- <script src="createdRoomscrpt.js"></script> -->
</head>
<body>
    <div><a href="userId.php">
        <img src="logo.jpg" id="logoImg" alt="">
    </a> </div>
    <div class="containerOne">
        <h1>Your room has been created successfully</h1>
        <h2>Room No: <?php echo $randomNumber  ?> </h2>
        <h3>Share the room no to the person you want to chat and ask them to join</h3>
    </div>
    <div></div>

    <form action="createdRoom.php" method="post">
        <button id="chatButton" name="chatButton">Go To Chat</button>
    </form>
    <div class="containerThree">
    </div>
    <div class="containerFour">
    </div>

</body>
</html>
<?php 
    if(isset($_POST['chatButton'])){
        header("Location: chat.php");
    }
?>