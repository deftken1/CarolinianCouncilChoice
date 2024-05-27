<?php

$hostName = "aws-0-ap-southeast-1.pooler.supabase.comt";
$dbUser = "postgres.cxslarbifdavffxjhfqj";
$dbPassword = "RgUYSSf9c0L1JWN6";
$dbName = "postgres";
$conn = mysqli_connect($hostName , $dbUser, $dbPassword, $dbName);

if(!$conn){
    die("Something went wrong;");
}




?>
