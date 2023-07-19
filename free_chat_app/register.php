<?php
    // include our connect script
    include 'connect.php';
    error_reporting(0);
    
    // check to see if there is a user already logged in, if so redirect them
    session_start();
    if (isset($_SESSION['username']) && isset($_SESSION['userid']))
        header("Location: ./index.php"); // redirect the user to the home page

    if (isset($_POST['registerBtn'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $passwd = md5($_POST['passwd']);
        $passwd_again = md5($_POST['confirm_password']);
    }
    
    // make sure the two passwords match
    if ($passwd === $passwd_again) {
        // make sure the password meets the minimum strength requirements
        if (strlen($passwd) >= 4 && strpbrk($email, "@.") != false) {
            $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND username = '$username'");
            
            if (mysqli_num_rows($result) > 0) {
                echo "<script>alert('The user already exists.')</script>";
            } else {
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username' , '$email' , '$passwd' )";
                $result = mysqli_query($conn, $sql);
                
                if ($result) {
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<script>alert('Sorry, please try again')</script>";
                }
            }
            
            $username = '';
            $email = '';
            $_POST['passwd'] = '';
        }
    } else {
        echo "<script>alert('Your passwords did not match.')</script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Site</title>
    <style>
        body {
            background-color: #eaf7eb;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: white;
            padding: 16px;
            width: 300px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
        }

        .form-input {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-input input[type="text"],
        .form-input input[type="password"] {
            padding: 12px 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-input p {
            text-align: center;
            margin-bottom: 10px;
        }

        .form-input input[type="submit"] {
            background-color: #eaf7eb;
            color: black;
            padding: 14px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        .form-input input[type="submit"]:hover {
            background-color: darkgreen;
            color: white;
        }

        .center {
            text-align: center;
            margin-top: 15px;
        }

        .center a {
            color: darkgreen;
            text-decoration: none;
        }

        .center a:hover {
            text-decoration: underline;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .logo img {
            width: 200px;
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="./register.php" class="form" method="POST">
            <div class="logo">
                <img src="icon.jpeg" alt="Logo">
            </div>
            <h1>!ברוך הבא</h1>

            <div class="form-input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $username ?>" placeholder="Enter a username" autocomplete="off" required />
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php echo $email ?>" placeholder="Provide an email" autocomplete="off" required />
            </div>
            <div class="form-input">
                <label for="passwd">Password</label>
                <input type="password" name="passwd" id="passwd" value="<?php echo $_POST['passwd'] ?>" placeholder="Enter a password" autocomplete="off" required />
            </div>
            <div class="form-input">
                <p>Password must be at least 5 characters and have a special character, e.g., !#$.,:;()</p>
            </div>
            <div class="form-input">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" value="<?php echo $_POST['confirm_password'] ?>" placeholder="Confirm your password" autocomplete="off" required />
            </div>
            <div class="form-input">
                <input class="submit-btn" type="submit" name="registerBtn" value="Create Account" />
            </div>

            <p class="center">
                Already have an account? <a href="login.php">Login here</a>
            </p>
        </form>
    </div>
</body>
</html>
