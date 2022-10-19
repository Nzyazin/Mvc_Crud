<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.png">
    <title>Simple PHP MVC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <section>
        <h1>Homepage</h1>
        <p>
            <a href="<?php echo $routeToProduct ?>">Check the first product</a>
        </p>
        <p>
            <a href="<?php echo $routes->get('adding')->getPath() ?>">Create the product</a>
        </p>
        <p>
            <?php
            $sql = "SELECT * FROM products";
            if($result = mysqli_query($conn, $sql)) {
                if(mysqli_num_rows($result) > 0) {
                    echo "<table class='table table-bordered table-stripped table-hover'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>#</th>";
                                echo "<th>Title</th>";
                                echo "<th>Description</th>";
                                echo "<th>Price</th>";
                                echo "<th>Sku</th>";
                                echo "<th>Image</th>";
                }           echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['title'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td>" . $row['sku'] . "</td>";
                                echo "<td>" . $row['image'] . "</td>";
                                echo "<td>";
                                    echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                    echo "</table>";
                    mysqli_free_result($result);
                }else {
                    echo "<p class='lead'><em>No records were found.</em></p>";
                }                           
            ?>
        </p>
    <section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>