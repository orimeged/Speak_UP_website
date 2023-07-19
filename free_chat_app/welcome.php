<!DOCTYPE html>
<html>
<head>
    <title>Chat Page</title>
    <style>
        body {
            background-color: #eaf7eb;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .chat {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;

        }

        .chat h3 {
            color: #333;
            margin: 0 0 10px;
        }

        .chat-table {
            width: 30%;
        }

        .chat-table td {
            vertical-align: top;
        }

        .chat-name {
            font-weight: bold;
        }

        .chat-input {
            display: flex;
            margin-top: 20px;
        }

        .chat-input input[type="text"] {
            flex: 1;
            border: none;
            border-radius: 5px;
            padding: 10px;
        }

        .chat-input button {
            background-color: #c3e6d7;
            border: none;
            border-radius: 5px;
            color: #fff;
            padding: 10px 20px;
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        include 'connect.php';
        session_start();

        if (isset($_POST['data'])) {
            $name = mysqli_real_escape_string($conn, $_SESSION['username']);
            $data = mysqli_real_escape_string($conn, $_POST['data']);

            $sql = "INSERT INTO posts (name, data) VALUES ('$name' , '$data' )";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: welcome.php");
                exit();
            } else {
                echo "<script>alert('Sorry, please try again')</script>";
            }
        }

        $result = mysqli_query($conn, "SELECT * FROM posts");

        echo '<div class="chat">';
        echo '<h3><center>:שיעור 4 בשיווק</center></h3>';

        echo '<table class="chat-table">';

        while ($row_users = mysqli_fetch_array($result)) {
            $data_new = $row_users['data'];
            $name_new = $row_users['name'];
            echo '<tr><td class="chat-name">' . htmlentities('סטודנט/ית') . '</td><td>' . htmlentities($data_new) . '</td></tr>';
        }

        echo '</table>';
        echo '</div>';
        ?>

        <form action="welcome.php" method="post">
            <div class="chat-input">
                <input type="text" name="data" placeholder="Type your message">
                <button type="submit">Send</button>
            </div>
        </form>
    </div>
</body>
</html>
