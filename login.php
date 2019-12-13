<?php
session_start();

$SERVERNAME = "sql302.epizy.com";
$USERNAME = "epiz_24832697";
$PASSWORD = "0SUWIaKqpC97jN";
$DATABASE = "epiz_24832697_anibase";

$user_sub = $_POST['sub'];
$user_email = $_POST['email'];
$status="Signed in";
$re=1;

if (isset($_SESSION['level'])) {
    $re=0;
}
    
    $con = mysqli_connect($SERVERNAME,$USERNAME,$PASSWORD,$DATABASE);

    if (!$con) {
        $status="Connection failed ".mysqli_connect_errno();
    }
    
    $query = "SELECT * FROM account WHERE sub = '$user_sub' AND email = '$user_email'";
    
    $obJQuery = mysqli_query($con, $query);
    $objResult = mysqli_fetch_array($obJQuery);
    
    if(!$objResult) {
        $querySearch = "INSERT INTO account (id, sub, email, level) VALUES (NULL, '$user_sub', '$user_email', '0')";
    
        if(!mysqli_query($con, $querySearch)) {
            $status="Registering";
        }
    }

    $_SESSION["sub"]=$user_sub;
    $_SESSION["email"]=$user_email;
    $_SESSION["level"]=$objResult["level"];

$userinfo = array("sub"=>$_SESSION["sub"],"email"=>$_SESSION["email"],"level"=>$_SESSION["level"],"status"=>$status,"re"=>$re);
echo json_encode($userinfo);
//echo $_SESSION["email"];
mysql_close();
?>