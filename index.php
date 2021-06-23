<?php
    include "./db.php";
    if(isset($_POST['submit'])) {
        $productName = $_POST['textname'];
        $productPrice = $_POST['textprice'];
        //echo $productName, $productPrice;

        if(!empty($productPrice && $productName)) {
            $insert = $pdo->prepare("insert into tbl_product(productname, productprice) values(:pname, :price)");
            $insert->bindParam(':pname', $productName);
            $insert->bindParam(':price', $productPrice);
            $insert->execute();
            if($insert->rowCount()){
                echo 'Insert Successful';
            } else {
                echo 'Insert Fail';
            }
        }else {
            echo "This field empty is not valid";
        }
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>PHP PDO CRUD OPERATIONS</h2>
    <hr>

    <form action="" method="post">
        <p><input type="text" name="textname" placeholder="Product Name"></p>
        <p><input type="text" name="textprice" placeholder="Product Price"></p>
        <input type="submit" name="submit" value="save">
    </form>
</body>
</html>
<hr>
<?php
    $select = $pdo->prepare("select * from tbl_product");
    $select->execute();
    echo "<pre>";

//    while($row = $select->fetch(PDO::FETCH_OBJ)) {
//        echo $row[1], "<br>";
//        print_r($row);
//        echo $row->productname, "<br>";
//    }

    $rows = $select->fetchAll();
    foreach ($rows as $row) {
        echo $row[1];
    }

?>