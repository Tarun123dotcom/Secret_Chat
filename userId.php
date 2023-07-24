<?php
 session_start();
 include('DBSConnection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secreat Chat</title>
    <link rel="stylesheet" href="userIdStyle.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&display=swap" rel="stylesheet">

</head>
<body>
    <div class="container">
        <a href="userId.php">
            <img src="logo.jpg" id="logopic" alt="logopic">
        </a>
        <h1><span class="secondMulticolor">Welocome To  </span><span class="multicolor">Secreat Chat</span></h1>    
        <div>
            <form action="userId.php" id="form" method="post">
                User ID : &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="userId" id="textBox" placeholder="ex:1"><br><br>
                User Name : &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="userName" id="textBox" placeholder="Siddu"><br>
                <button id="SubmitButton" type="submit" name="submit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Submit</button>
            </form>
        </div>
    </div>
        
</body>
</html>
<?php
// session_start();

// $userId = $_SESSION['userId'];
// if(isset($_POST['submit'])){
// echo $userId;}


if(isset($_POST['submit'])){
    $_SESSION['userId'] = $_POST['userId'];
    $_SESSION['userName'] = $_POST['userName'];
    $userId = $_SESSION['userId'];
    $userName = $_SESSION['userName'];
    // echo $userId;
    $result = mysqli_query($connect, "SELECT Id FROM users WHERE Id = '$userId'");
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "User Id Already Exists";
        } else {
            $stmt = $connect->prepare("INSERT INTO users (id, user) VALUES (?, ?)");
            $stmt->bind_param("ss", $userId, $userName);
            $stmt->execute();
            header("Location: roomSel.php");
            exit();
        }
    } else {
        echo "Query Execution Failed: " . mysqli_error($connect);
    }
}
?>