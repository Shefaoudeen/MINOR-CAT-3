<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    if (!empty($name)) {
        echo "Hello, " . $name . "!";
    } else {
        echo "Please enter your name.";
    }
} else {
    echo "Invalid request.";
}
?>