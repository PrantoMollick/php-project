<h2> SQL Injection </h2>

<?php
    //';DROP TABLE login;'--
    include "db.php";
    error_reporting(0);
    $email = $_POST['email'];
//    if(isset($email)) {
//        $sql = $pdo->query("select * from tbl_email where email = '$email'");
//
//        if($sql->rowCount()) {
//            echo "Email matched" . " " . $email;
//        } else {
//            echo 'wrong email';
//        }
//    }

    $sql = $pdo->prepare("select * from tbl_email where email=:e");
    $sql->bindParam(':e', $email);
    $sql->execute();

    $row=$sql->fetch(PDO::FETCH_ASSOC);

    if ($row['email'] == $email) {
        echo "Email matched" . " " . $email;
    } else {
        echo 'wrong email';
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sql injection</title>
</head>
<body>
    <form action="" method="post">
        <p><input type="text" name="email"></p>
        <p><input type="submit" name="submit" value="check Email"></p>

    </form>
</body>
</html>