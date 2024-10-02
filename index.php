<?php

function connection(){
    $host = "localhost:3306";
    $user = "root";
    $pass = "xuxi";

    $bd = "northwind";

    $connect=mysqli_connect($host, $user, $pass);

    mysqli_select_db($connect, $bd);

    return $connect;

}

$con = connection();

$sql = "SELECT ProductName, UnitPrice, CategoryName FROM northwind.products JOIN categories
ON (products.categoryID = categories.categoryID)
WHERE UnitPrice > (SELECT AVG (UnitPrice )FROM northwind.products);";
$query = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso a datos</title>
</head>
<body>
    <div class="container d-flex justify-content-center .align-items-center gap-3">

        <table>
            <header>
                <tr>
                    <th>ProductID</th>
                    <th>ProductName</th>
                    <th>UnitsInStock</th>
                </tr>
            </header>
            <tbody>
                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><p><?= $row['ProductName'] ?></p></td>
                        <td><p><?= $row['UnitPrice'] ?></p></td>
                        <td><p><?= $row['CategoryName'] ?></p></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
        
</body>
</html>