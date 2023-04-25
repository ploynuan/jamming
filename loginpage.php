<?php 
session_start();
include_once('connect.php'); 

if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM Login WHERE user=? LIMIT 1");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['hashed_password'];
        if (password_verify($password, $hashed_password)) {
            $_SESSION['uname'] = $uname;
            header("Location:mainpage.php");
            die;
        }
        else {
            $error = "username or password incorrect";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System</title>
    <link rel="stylesheet" href="loginpage2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="circle"></div>
            <div class="circle2"></div>
            <div class="box">
                <div class="bluebox">
                    <div class="logo">
                        <img src="logo.svg" alt="">
                        <h1>GNSS Jamming Detection </h1>
                    </div>
                </div>
                <div class="whitebox">
                    <div class="login">
                        <img src="logojam2.svg" alt="" class="logoblack">
                        <h1>GNSS Jamming Detection </h1>
                        <form action="" method="POST">
                            <!--username-->
                            <div class="login-form">
                                <i class="fa-solid fa-user" id="logo-input"></i>
                                <input type="text" class="input" id="username"  name="username" placeholder="Username">
                                <label for="username"></label>
                            </div>
                            <!--password-->
                            <div class="login-form">
                                <i class="fa-solid fa-lock" id="logo-input"></i>
                                <input type="password" class="input" id="password" name ="password" placeholder="Password" >
                                <label for="Password"></label>
                            </div>  
                            <input type="submit" class="btn-submit" value="LOGIN" name="submit">  
                            <?php if (!empty($error)): ?>
                            <p class="error">username or password incorrect</p>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>
</html>