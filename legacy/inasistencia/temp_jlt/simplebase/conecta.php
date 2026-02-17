 <?php
$servername = "localhost";
$username = "fgoicoechea";
$password = "sobral2011"; 
$dbname = "DBF2MYSQL";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> 