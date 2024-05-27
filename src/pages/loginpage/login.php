<?php
session_start();
if (isset($_SESSION["user"])){
    header("Location: index.php");//ibutang ang landingpage
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="stylelog.css">
    <script src="https://kit.fontawesome.com/1392534d6b.js" crossorigin="anonymous"></script>

</head>
<body>
<div class="background">
        <img src="whiteback.png">
        <h1>Carolinian
            Council
            Choice</h1>
            <h3>An Online Voting System for Carolinians by Carolinians.</h3>
            
    </div>
    <div class="ssc"><img src="SSC Logo.png" alt="logo"></div>
    <div class="form">
        <div class="switch">
            <div class="switch1"><a href="signup.php"><button>REGISTER</button></a></div><div class="switch2"><a href="login.php" link="#"><button>SIGN IN</button></a></div> </div>
     <hr> 
        <?php
        if(isset($_POST["login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM user WHERE email= '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user){
                if(password_verify($password, $user["password"])){
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: src/pages/dashboard/dashboard.html");//ibutang ang dasgboard
                    die();
                }else{
                echo "<div class='alert alert-danger'>Email or Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email or Password does not match</div>";
            }
        }

        ?>
        <form action="login.php" method="post">
            <div class="login-form"">
                <label>Email</label><br><br>    
                <i class="fa-solid fa-envelope"></i>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="login-form"">
                <label>Password</label><br><br>
                <i class="fa-solid fa-key"></i>
                <input type="password" class="form-control"  name="password">
                <a href="forgotpass.php">Forgot Password?</a><br>
            </div>
            <div class="button">
                <input type="submit" class="btn btn-primary" value="Login" name="login">
                
            </div>
            
        </form>


     </div>
</body>
</html>