
<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "php";
$password = "kavip2004";
$dbname = "picproj";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
echo "Connection Successful";
}

$sql = "SELECT id, name, path, passcode FROM main";
$result = $conn->query($sql);
$allIDS = [];
$allNames = [];
$allPaths = [];
$allPasscodes = [];
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $allIDS[] = $row["id"];
	$allNames[] = $row["name"];
        $allPaths[] = $row["path"];
	$allPasscodes[] = $row["passcode"];
    }
} else {
    echo "0 results";
}

if (in_array("kp9kjab", $allPasscodes)){
echo "found</br>";
$key = array_search("kp9kjab", $allPasscodes);
echo "Name is " . $allNames[$key];

}

$conn->close();
?>

</body>
</html>
