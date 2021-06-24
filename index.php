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
        <?php
            if (isset($_POST['btnedit'])) {
                $select = $pdo->prepare("select * from tbl_product where id={$_POST['btnedit']} ");
                $select->execute();
                while($row = $select->fetch(PDO::FETCH_OBJ)) {
                    print_r($row);
                }
            } else {

            }
        ?>
        <p><input type="text" name="textname" placeholder="Product Name"></p>
        <p><input type="text" name="textprice" placeholder="Product Price"></p>
        <input type="submit" name="submit" value="save">
        <br>
        <br>
        <table border="1" id="producttable">
            <thead>
            <th>ID</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Edit</th>
            <th>Delete</th>
            </thead>
            <tbody>
            <?php
            $select = $pdo->prepare("select * from tbl_product");
            $select->execute();
            while($row = $select->fetch(PDO::FETCH_OBJ)) {
                echo "<tr>";
                echo "<td>{$row->id}</td>";
                echo "<td>{$row->productname}</td>";
                echo "<td>{$row->productprice}</td>";
                echo "<td><button type='submit' value='{$row->id}' name='btnedit'>EDIT</button></td>";
                echo "<td><button type='submit' value='{$row->id}' name='btndelete'>DELETE</button></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>

    </form>


</body>
</html>
<hr>
