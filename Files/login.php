<?php
//$name = filter_input(INPUT_POST, 'nnname');
$username = filter_input(INPUT_POST, 'uuname');
//$email = filter_input(INPUT_POST, 'eename');
$password = filter_input(INPUT_POST, 'ppname');

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "login";
// Create connection
//$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

session_start(); // Starting Session

$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
if (empty($username)){
echo "Username is invalid";
}
else if (empty($password)){
echo "Password is invalid";
}
else{
// Define $username and $password
$username = $_POST['uuname'];
$password = $_POST['ppname'];
// mysqli_connect() function opens a new connection to the MySQL server.
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT * FROM registration WHERE username= '$username' AND password = '$password' LIMIT 1";
// To protect MySQL injection for Security purpose
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($username);
$stmt->store_result();
if($stmt->fetch())
{
$_SESSION['username'] = $username;
header("location: index.php"); 
}
mysqli_close($conn); 
}
}
?>
