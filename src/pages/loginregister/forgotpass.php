<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="C:\Users\user\Desktop\new\signupandsignin\css\forgotpass.css">
    <script src="https://kit.fontawesome.com/1392534d6b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="forgotpass.css">
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
  
    

        if(isset($_POST["submit"])){
        $email = $_POST["email"];  
        $errors =array();
        require_once "database.php";
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        if($rowcount<=0){
            echo "<div class='alert alert-danger'>Email does not exist!</div>";
        }else{
            echo "<div class='alert alert-success'>Email Sent</div>";
        }
    }
         ?>


 <p> <h2>Enter your Email Address and we will send you an email to change your password.</h2></p>
 <form action="forgotpass.php" method="post">
        <div class="login-form">

            <input type="email" placeholder="Email" name="email">
    </div>
    <div class="button">
         <input type="submit" class="btn btn-primary" value="Send" name="submit">
</div>
</form>
</div>
</body>
</html>