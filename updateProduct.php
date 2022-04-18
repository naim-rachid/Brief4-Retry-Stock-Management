<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Product</title>
    <link rel="icon" href="logo.ico" type = "image/x-icon" />
    <link rel="stylesheet" href="./CSS/style.css" />
</head>
<body>
<?php include 'header.php' ?>
<main>
    <section>
        <h1>Updating Product</h1>
        <section>
            <form action="updateProduct.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend>Update a product</legend>
                    <div class="flex_section">
                        <div>
                            <label for="id_product">ID : </label>
                        </div>
                        <div>
                            <input type="text" name="id_product" id="id_product" value="<?= $_POST['id_product'] ?>" readonly />
                        </div>
                    </div>
                    <br />
                    <div class="flex_section">
                        <div>
                            <label for="name_p">Name : </label>
                        </div>
                        <div>
                            <input type="text" name="name_p" id="name_p" value="<?= $_POST['name_p'] ?>" readonly />
                        </div>
                    </div>
                    <br />
                    <div class="flex_section">
                        <div>
                            <label for="name_p">Category : </label>
                        </div>
                        <div>
                            <input cl type="text" name="category" id="category" value="<?= $_POST['category'] ?>" readonly />
                        </div>
                    </div>
                    <br />
                    <div class="flex_section">
                        <div>
                            <label for="quantity">Quantity : </label>
                        </div>
                        <div>
                            <input type="text" name="quantity" id="quantity" value="<?= $_POST['quantity'] ?>" />
                        </div>
                    </div>
                    <br />
                    <div class="flex_section">
                        <div>
                            <label for="price">Price : </label>
                        </div>
                        <div>
                            <input type="text" name="price" id="price" value="<?= $_POST['price'] ?>" />
                        </div>
                    </div>
                    <br />
                    <div class="flex_section">
                        <div>
                            <label for="image_url">Picture : </label>
                        </div>
                        <div>
                            <?php if (!isset($_POST['update'])) {
                            ?>
                                <img src="products_pictures/<?= $_POST['image_url'] ?>" alt="<?= $_POST['image_url'] ?>" width="50" />
                            <?php
                            } else {
                                ?>
                                <img src="products_pictures/<?= $_FILES['image_url']['name'] ?>" alt="<?= $_FILES['image_url']['name'] ?>" width="50" />
                            <?php
                            }
                            ?>
                        </div>
                        <div>
                            <input type="file" name="image_url" id="image_url" value="" />
                        </div>
                    </div>
                    <br />
                    <div>
                        <button type="submit" name="update">Update</button>
                    </div>
                </fieldset>
            </form>
            <?php
            $id = $name = $category = $quantity = $quantity = $price = $image_url = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['update'])) {
                if (isset($_POST["id_product"])) {
                    $id = test_input($_POST["id_product"]);
                    $name = test_input($_POST["name_p"]);
                    $category = test_input($_POST["category"]);
                    $quantity = test_input($_POST["quantity"]);
                    $price = test_input($_POST["price"]);
                    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
                        echo "OK!";
                        // Testing if the file is not very large
                        if ($_FILES['image_url']['size'] <= 1000000) {
                            // Testing if the extension is authorized
                            $fileInfo = pathinfo($_FILES['image_url']['name']);
                            $extension = $fileInfo['extension']; // extension file (.png || .jpg || ...)
                            $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
                            if (in_array($extension, $allowedExtensions)) {
                                $image_url = test_input($_FILES["image_url"]['name']);
                            }
                        }
                    }

                }
                // Call connection
                $conn = null;
                $result = 0;
                require 'PHP_Config/DB_Connection.php';
                // Prepare and Bind
                if (is_uploaded_file($_FILES['image_url']['tmp_name'])) {
                    echo "if 122";
                    $sqlRequest = "UPDATE product SET `name` = ?, category = ?, quantity = ?, price = ?, image_url = ? WHERE id_product = ?";
                } else {
                    echo "else 125 !";
                    $sqlRequest = "UPDATE product SET `name` = ?, category = ?, quantity = ?, price = ? WHERE id_product = ?";
                }
                $stmt = $conn->prepare($sqlRequest);
//                            $stmt->bind_param("ssssss", $id, $name, $category, $quantity, $price, $image_url);
                if (is_uploaded_file($_FILES['image_url']['tmp_name'])) {
                    echo "if 131";
                    $result = $stmt->execute([$name, $category, $quantity, $price, $image_url, $id]);
                } else {
                    echo "else 134 !";
                    $result = $stmt->execute([$name, $category, $quantity, $price, $id]);
                }

                if ($result) {
                    echo "The product with ID: " . $id . " was updated successfully";
                } else {
                    echo "Error with updating the product " . $id . "!!!";
                }
                $stmt->close();

                $conn->close();
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripcslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
        </section>
</main>
</body>
</html>