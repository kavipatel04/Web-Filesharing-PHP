<?php
session_start();
function getRandomHex($num_bytes=4) {
    return bin2hex(openssl_random_pseudo_bytes($num_bytes));
  }
$random1 = getRandomHex(3);
$allNames = $_SESSION['ALLNAMES'];
$allPasscodes = $_SESSION['ALLPASSCODES'];

?>
<link rel="stylesheet" type="text/css" href="password_style.css">
 <form method="post" action="" id="register_form">
  <h1>Register Below</h1>
  <input type = "text" name="possible_name" placeholder="First Name Only">
  <input type = "text" name="initials" placeholder="initials only -two letters">
  <input type="password" name="possible_password" placeholder="Password < 10 characters">
  <input type="submit" name="pass_submit" value="SUBMIT">
  <p></p>
  <p><font style="color:red;"><?php echo $error;?></font></p>
 </form>



 <?php
 if(isset($_POST['pass_submit']) && $_POST['possible_password'] && $_POST['possible_name'] && $_POST['initials'])
 {
  $pass=$_POST['possible_password'];
  $name=$_POST['possible_name'];
  if(in_array($pass, $allPasscodes))
  {
    echo "You have already registered - or please try another passcode";
  }
  else
  {
   $initials = $_POST['initials'];
   $initials = strtolower($initials);
   $initialsLen = strlen($initials);
   if ($initialsLen != 2){
       echo "You have entered too many or too little characters for your initals, please try again! </br>";
   }else{
       $passLen = strlen($pass);
       if ($passLen > 10 || $passLen < 3){
           echo "You have entered too many/little characters for your password";
       }else{
           $accountPossible = TRUE;
       }
       
   }
  }
 }

if ($accountPossible){
    $path = 'assets/' . $initials . $random1;
    $dirName = $initials . $random1;

    $servername = "localhost";
    $username = "php";
    $password = "kavip2004";
    $dbname = "picproj";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }



    $sql = "INSERT INTO main (name, path, passcode)
    VALUES ( '$name', '$path', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>New account created successfully</p></br>";
        $output = shell_exec('sudo bash makeDir.sh ' . $dirName);
        echo "Taking you back to sign in page automatically";
        header("refresh:5; url=index.php");
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>