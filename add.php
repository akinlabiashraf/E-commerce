<?php
require'config.php';

$msg = "";

if(isset($_POST['submit'])){
    $p_name = $_POST['pname'];
    $p_price = $_POST['pprice'];

    $target_dir = "image/";
    $target_file = $target_dir.basename($_FILES['pimage']['name']);
    move_uploaded_file($_FILES['pimage']['tmp_name'], $target_file);

    $sql = "INSERT INTO product(product_name, product_price, product_image) VALUES ('$p_name','$p_price','$target_file')";

    if(mysqli_query($db_con, $sql)){
        $msg = '<h4 style="color:Green;">Product Successfully Added To Database</h4>';
    }else{
        $msg = '<h4 style="color:Red;"Failed To Add Product To Database</h4>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->


    <!-- jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body class="bg-info">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 bg-light mt-5 rounded">
                <h2 class="text-center p-2">Add Product Information</h2>
                <form action="" method="post" class="p-2" enctype="multipart/form-data" id="form-box">
                    <div class="form-group mb-3">
                        <input type="text" name="pname" class="form-control" placeholder="Product Name" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="pprice" class="form-control" placeholder="Product price" required>
                    </div>
                    <div class="form-group mb-3">
                        <div class="custom-file">
                            <label class="form-label" for="customFile">Upload Product Image</label>
                            <input type="file" class="form-control" id="customFile" name="pimage" />
                        </div>
                    </div>
                    <div class="form-group btn btn-danger btn-block px-5">
                        <input type="submit" name="submit" class="btn btn-danger btn-block px-5" value="Add">
                    </div>
                    <div class="form-group">
                        <h4 class="text-center">
                            <?= $msg;?>
                        </h4>
                    </div>
                </form>
                
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 mt-3 bg-light rounded btn btn-warning btn-block btn-lg">
                <a href="index.php" class="btn btn-warning btn-block btn-lg"> Go to Product Page</a>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>