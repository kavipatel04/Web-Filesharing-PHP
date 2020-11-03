<?php
session_start();

if(isset($_POST['submit_pass']) && $_POST['pass'])
{
 $pass=$_POST['pass'];
 if($pass=="123"||$pass=="456")
 {
  $_SESSION['password']=$pass;
 }
 else
 {
  $error="Incorrect Pssword";
 }
}

if(isset($_POST['page_logout']))
{
 unset($_SESSION['password']);
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="password_style.css">
</head>
<body>
<div id="wrapper">
<link rel="stylesheet" type="text/css" href="password_style.css">
<?php
if($_SESSION['password']=="123")
{
 ?>
 
 <h1>Cool Pictures!</h1>
 <?php
 $dirname = "photos/";
 $images = glob($dirname."*.jpg");
 
 foreach($images as $image) {
     echo '<img src="'.$image.'" width="300" style="padding-left: 10px; padding-bottom: 10px; padding-top: 10px; padding-right: 10px;" />';
 }

$images = glob($dirname."*.png");
 
 foreach($images as $image) {
     echo '<img src="'.$image.'" width="300" style="padding-left: 10px; padding-bottom: 10px; padding-top: 10px; padding-right: 10px;"/>';
 }

 ?>
<link rel="stylesheet" type="text/css" href="password_style.css">
 <form method="post" action="" id="logout_form">
  <input type="submit" name="page_logout" value="LOGOUT">
  <input type="submit" name="button1" value="Download as Zip" />
  <input type="submit" name="button2" value="Refresh Zip File" />
 </form>
<link rel="stylesheet" type="text/css" href="password_style.css">
<form action="upload-manager.php" method="post" enctype="multipart/form-data">
        <label for="fileSelect">Filename:</label>
        <input type="file" name="photo" id="fileSelect">
        <input type="submit" name="submit" value="Upload">
  </form>

<?php

if(array_key_exists('button1', $_POST)) { 
   $zip_file = 'photos.zip';
   header('Content-type: application/zip');
	header('Content-Disposition: attachment; filename="'.basename($zip_file).'"');
	header("Content-length: " . filesize($zip_file));
	header("Pragma: no-cache");
   header("Expires: 0");
   ob_clean();
   flush();
   readfile($zip_file);
   unlink($zip_file);
   exit;

} 
if(array_key_exists('button2', $_POST)) { 
   $output = shell_exec('sudo bash zipScript.sh');
   echo $output;
   echo "Package has been zipped up successfully";
}

?>

 <?php
}elseif($_SESSION['password']=="456"){
echo "Second user in";
}

else
{
 ?>
 <form method="post" action="" id="login_form">
  <h1>LOGIN TO PROCEED</h1>
  <input type="password" name="pass" placeholder="*******">
  <input type="submit" name="submit_pass" value="DO SUBMIT">
  <p>"Password : 123"</p>
  <p><font style="color:red;"><?php echo $error;?></font></p>
 </form>
 <?php	
}
?>

</div>
</body>
</html>


