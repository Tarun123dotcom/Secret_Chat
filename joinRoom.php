<?php 
    // include "createdRoom.php";
    session_start();
    include('DBSConnection.php');
    $errorMessege = "";
    ob_start(); // Start output buffering
    
    include "createdRoom.php"; // Include the file that defines the $randomNumber variable
    
    ob_end_clean(); // Discard the captured output buffer
    
    if(isset($_POST['submit'])){
        $roomID = $_POST['roomID'];
        $userID = $_SESSION['userId'];
        $query = mysqli_query($connect, "SELECT roomNo FROM roomid WHERE roomNo = '$roomID'");
        $row = mysqli_fetch_assoc($query);
        
        if ($row && $row['roomNo'] == $roomID) {
            $stmt = $connect->prepare("INSERT INTO roomid (roomNo, userId) VALUES (?, ?)");
            $stmt->bind_param("ss", $roomID, $userID);
            $stmt->execute();
            header("Location: chat.php");
        } else {
            $errorMessege = "You have entered the wrong room Id.";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Room</title>
    <link rel="stylesheet" href="joinRoomstyle.css">
    <script src="joinRoomscript.js"></script>
</head>
<body>
    <div><a href="userId.html">
        <img src="logo.jpg" id="logoImg" alt="">
    </a> </div>
    <div class="container">
        <form action="joinRoom.php" id="myForm" method="post">
            <span>Enter the room no : </span> <input type="number" name="roomID" id="textBox" placeholder="ex:12345">
            <p></p>
            <button type="submit" name = "submit" id="SubmitButton">Submit</button> <br>
            <span><?php echo $errorMessege ?></span>
        </form>
    </div>
    <div class="containerThree">
    </div>
    <div class="containerFour">
    </div>

</body>
</html>