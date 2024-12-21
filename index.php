<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ctf_challenge";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // استعلام SQL يحتوي على ثغرة حقن SQL
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // إذا تم تسجيل الدخول
        echo "<h1>Welcome, Admin!</h1>";
        echo "<p>Your flag is: CTF{sql_injection_master}</p>";
    } else {
        echo "<p>Invalid username or password</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Challenge</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username"><br><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
