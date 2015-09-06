<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Query Results</title>
</head>

<body>
    <h1>Query Results</h1>
    
    <?php

        try {
            $con = new PDO("mysql:host=localhost;dbname=chi", "root", "root");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT username FROM users WHERE username='$username' AND password='$password'";
            $q = $con->query($sql);
            $rows = $q->fetchAll();
            if (count($rows) == 0) {
                echo "<p>incorrect login credentials</p>";
            } else {
                    echo "<p>Welcome " .$rows[0]['username'] ."!</p>";
            }
        } 
        catch (PDOException $ex) {
        	echo 'ERROR: '.$ex->getMessage();
        }

    ?>

</body>
</html>