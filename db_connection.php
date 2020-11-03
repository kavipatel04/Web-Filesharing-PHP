<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "php";
 $dbpass = "kavip2004";
 $db = "picproj";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   

