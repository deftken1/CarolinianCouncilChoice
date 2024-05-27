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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styl.css">
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
    if(isset($_POST["submit"])){
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];   
        $uscid = $_POST["uscid"];
        $password = $_POST["password"];
        $repeatpass = $_POST["repeat_password"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $errors =array();

        if(empty($firstname) OR empty($lastname) OR empty($email) OR empty($uscid) OR empty($password) OR empty($repeatpass)){
        
            array_push($errors,"All fields are required to be filled");

        }
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {array_push($errors, "Email is not valid");}
        if (strlen($password)<8) {
            array_push($errors, "Password must be at least 8 characters");
        }
        if($password!==$repeatpass){
            array_push($errors, "Password does not match");
        }
        require_once "database.php";
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        if($rowcount>0){
            array_push($errors, "Email already exist!");
        }

        require_once "database.php";
        $sql = "SELECT * FROM user WHERE usc_id = '$uscid'";
        $result = mysqli_query($conn, $sql);
        $rowcount = mysqli_num_rows($result);
        if($rowcount>0){
            array_push($errors, "USC ID already exist!");
        }
        if(count($errors)>0){
            foreach ($errors as $error){
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }else{
        require_once "database.php";
        $sql = "INSERT INTO user (first_name, last_name, email, usc_id,password) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
        
        if($prepareStmt){
            mysqli_stmt_bind_param($stmt,"sssis", $firstname, $lastname, $email, $uscid, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>Signed up sucessfully!</div>";
        }else{
            die("Something went wrong");
        }


      }
    }

    ?>
    <form action="signup.php" method="post">

            <div class="name"> 
            <label>First Name</label><label>Last Name</label><br><br>
            <i class="fa-solid fa-user"></i>
            <input type="text" class="form-control" name="firstname"> 
            <input type="text" class="form-control" name="lastname">
            </div>
    
            <div class="signup-form">
            <label>Email</label><br><br>
            <i class="fa-solid fa-envelope"></i>
            <input type="email" class="form-control" name="email">
            </div>

            <div class="signup-form">
                <label>USC ID</label><br><br>
                <i class="fa-regular fa-id-card"></i>
                <input type="number" id="limitedNumberInput" class="form-control" name="uscid">
            </div>
            <script>
                var numberInput = document.getElementById("limitedNumberInput");
                var maxLength = 8; 
                numberInput.addEventListener("input", function() {
                if (numberInput.value.length > maxLength) {
                numberInput.value = numberInput.value.slice(0, maxLength);
               }
            });
            </script>
            <div class="signup-form">
                 <label>Password</label><br><br>
                <i class="fa-solid fa-key"></i>
                <input type="password" class="form-control"  name="password">
            </div>

            <div class="signup-form">
                 <label>Repeat Password</label><br><br>    
                 <i class="fa-solid fa-key"></i>
                <input type="password" class="form-control" name="repeat_password">
                <p><a href="forgotpass.php">Forgot Password?</a>
            </div>

            <div class="button">
                <input type="submit" class="btn btn-primary" value="Signup" name="submit">
            </div>
            <p>By clicking signup box, you agree to our
        <a href="termsofservice.html">Terms of Service</a> and <a href="privacypolicy.html">Privacy Policy</a></p></input>
        </form>
    </div>    
</body>
</html>