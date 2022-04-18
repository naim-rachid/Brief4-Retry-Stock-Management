<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CSS/style.css" />
    <link rel="icon" href="logo.ico" type = "image/x-icon" />
    <title>Home</title>
</head>
<body id="">
    <?php include 'header.php' ?>
    <main>
        <section>
            <h1><a href="addProduct.php">Add Product</a></h1>
            <section>
                <?php
                // Call connection
                $conn = null;
                require 'PHP_Config/DB_Connection.php';

                $result = $conn->query("SELECT * FROM product");
                ?>
<!--                <form action="addProduct.php" method="POST">-->
                    <table>
                        <thead>
                        <tr>
                            <th id="hide"></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price ($)</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = $result->fetch_assoc()) {
                                    $id_product = $row['id_product'];
                                    $name_p = $row['name'];
                                    $category = $row['category'];
                                    $quantity = $row['quantity'];
                                    $price = $row['price'];
                                    $image_url = $row['image_url'];
                                    echo '<tr>';
                                        echo '<td>
                                                  <img src="products_pictures/' . $image_url . '" alt="' . $image_url . '" width="50" /> 
                                             </td>';
                                        echo '<td>' . $id_product . '</td>';
                                        echo '<td>' . $name_p . '</td>';
                                        echo '<td>' . $category . '</td>';
                                        echo '<td>' . $quantity . '</td>';
                                        echo '<td>' . $price . '</td>';
                                        echo '<td>
                                                  <form action="UpdateProduct.php" method="post">';
//                                                        echo 'id_product = ' . $id_product;

                                                        echo '           
                                                        <input type="hidden" name="id_product" value="' . $id_product . '" />
                                                        <input type="hidden" name="name_p" value="' . $name_p . '" />
                                                        <input type="hidden" name="category" value="' . $category . '" />
                                                        <input type="hidden" name="quantity" value="' . $quantity . '" />
                                                        <input type="hidden" name="price" value="' . $price . '" />
                                                        <input type="hidden" name="image_url" value="' . $image_url . '" />
                                                        
                                                        <input type="submit" name="updateFromIndex" value="Update" />
                                                  </form>
                                              </td>                 
                                              <td>
                                                  <a href="deleteProduct.php?id_product=' . $id_product . '">Delete</a>
                                              </td>';
                                    echo '</tr>';
                                }

                                $conn->close();
                            ?>
                        </tbody>
                    </table>
<!--                </form>-->
            </section>
        </section>
        </section>
    </main>
</body>
</html>