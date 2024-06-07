<?php
$dsn = "mysql:host=localhost; dbname=gcs1001b";
$username = "root";
$password = "";
try {
$conn = new PDO($dsn, $username, $password);
$conn->setAttribute(PDO::ATTR_PERSISTENT, true);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOExeption $ex) {
    echo "Connection error: " . $ex->getMessage();
}
?>