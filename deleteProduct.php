<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete Product</title>
    <link rel="icon" href="logo.ico" type = "image/x-icon" />
    <link rel="stylesheet" href="./CSS/style.css" />
</head>
<body>
    <?php include 'header.php' ?>
    <main>
        <section>
            <h1>Deleting Product</h1>
            <?php

        // Call connection
        $conn = null;
        require 'PHP_Config/DB_Connection.php';

        $stmt = $conn->prepare("DELETE FROM product WHERE id_product = ?");
        $result = $stmt->execute([$_GET['id_product']]);

        if ($result) {
            echo "<p>The product with ID: " . $_GET['id_product'] . " was successfully deleted !</p>";
        } else {
            echo "<p>Error with deleting</p>";
        }

        ?>
        </section>
        <section>
            <div>
                <a href="./">Retour</a>
            </div>
        </section>
    </main>
</body>
</html>