 <?php
$servername = "localhost";
$username = "root";
$password = "YOURPASSWORD";
$dbname = "simpleblog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Change character set to utf8
mysqli_set_charset($conn,"utf8");

 
// sessione admin          
   ob_start();
   session_start();

if (isset($_POST['login']) && !empty($_POST['pwd'])) {
	
	if ($_POST['pwd'] == $password) {

		$_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = 'admin';

		$redirpag=$url."cfg/index.php";
		header("location: $redirpag");
	}

}
?> 
