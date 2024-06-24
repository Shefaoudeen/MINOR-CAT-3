<?php
session_start();

$servername = "localhost";
$db_username = "root";
$db_password = ""; // Change this if you have set a root password
$dbname = "user_system";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashed_password);
            $stmt->fetch();
            
            if (password_verify($password, $hashed_password)) {
                // Password is correct, start a new session
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                echo "Login successful! Welcome, " . $username . ".";
                // Redirect to a different page if needed
                // header("location: welcome.php");
            } else {
                echo "The password you entered was not valid.";
            }
        } else {
            echo "No account found with that username.";
        }
        
        $stmt->close();
    }
}

$conn->close();
?>