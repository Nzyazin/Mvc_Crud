<?php
 
// Define variables and initialize with empty values
$title = $description = $price = $sku = $image = "";
$title_err = $description_err = $price_err = $sku_err = $image_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a name.";
    } elseif(!filter_var($input_title, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $title_err = "Please enter a valid name.";
    } else{
        $title = $input_title;
    }

    // Validate description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter a description.";
    } else {
        $description = $input_description;
    }

    // Validate price
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Pleae enter a price.";
    } elseif(!ctype_digit($input_price)){
        $price_err = "Please enter a positive number.";
    } else {
        $price = $input_price;
    }

    // Validate sku
    $input_sku = trim($_POST["sku"]);
    if(empty($input_sku)){
        $sku_err = "Please enter a sku.";
    } elseif(!ctype_digit($input_sku)){
        $sku_err = "Please enter a positive number.";
    } else {
        $sku = $input_sku;
    }

    // Validate image
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please enter a address of image.";
    } else {
        $image = $input_image;
    }

    // Connect to DB
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
        if($conn === false) {
            die("ERROR: Could not connect: " . mysqli_connect_error());
        }

    // Check errors before inserting in database
    if(empty($title_err) && empty($description_err) && empty($price_err) && empty($sku_err) && empty($image_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO products (title, description, price, sku, image) VALUES (?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to prepared statement as parametrs
            mysqli_stmt_bind_param($stmt, "ssdds", $param_title, $param_description, $param_price, $param_sku, $param_image);

            // Set params
            $param_title = $title;
            $param_description = $description;
            $param_price = $price;
            $param_sku = $sku;
            $param_image = $image;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page.
                header("location: adding");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row>
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add product record to the database.</p>
                    <form action="" method="POST">
                        <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : '';?>">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo "$title";?>">
                            <span class="help-block"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : '';?>">
                            <label>Description</label>
                            <textarea name="description" class="form-control" value="<?php echo $description;?>"></textarea>
                            <span class="help-block><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : '';?>">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo "$price";?>">
                            <span class="help-block"><?php echo $price_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sku_err)) ? 'has-error' : '';?>">
                            <label>Sku</label>
                            <input type="text" name="sku" class="form-control" value="<?php echo "$sku";?>">
                            <span class="help-block"><?php echo $sku_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : '';?>">
                            <label>Image</label>
                            <input type="text" name="image" class="form-control" value="<?php echo "$image";?>">
                            <span class="help-block"><?php echo $image_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="<?php echo $routes->get('homepage')->getPath(); ?>" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>