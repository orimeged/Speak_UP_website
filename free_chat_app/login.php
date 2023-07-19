<?php 
    include 'connect.php'; 
    session_start();
    
    if (isset($_POST['uname']) && isset($_POST['psw'])) {
        $uname = $_POST['uname']; 
        $psw = md5($_POST['psw']); 
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$uname' AND password='$psw'");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            header("Location: welcome.php");
        } else {
            echo "<script>alert('User does not exist.')</script>";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            background-color: #eaf7eb;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            background-color: white;
            border-radius: 10px;
            margin-top: 100px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            background-color: #c3e6d7;
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 10px 20px;
            margin-top: 10px;
            cursor: pointer;
        }

        .center {
            text-align: center;
        }

        a {
            color: #004d40;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 200px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="login.php" method="post">
            <div class="logo">
                <img src="icon.jpeg" alt="Logo">
            </div>
            <label for="uname">User Name</label>
            <input type="text" name="uname" placeholder="User Name">

            <label for="psw">Password</label>
            <input type="password" name="psw" placeholder="Password">

            <button type="submit">Login</button>

            <p class="center">
                Don't have an account? <a href="register.php">Sign up</a>
            </p>
        </form>
    </div>
</body>
</html>
