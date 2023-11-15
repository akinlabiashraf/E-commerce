<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cartegories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    require 'config.php';
    $sql = "SELECT * FROM product";

    $output = mysqli_query($db_con, $sql);

    ?>
    <div class="container">
        <div class="row">
            <?php
            while ($row = mysqli_fetch_array($output)) {
            ?>
                <div class="col-lg-4 mt-3 mb-3">
                    <div class="card-deck">
                        <div class="card border-info p-2">
                            <img src="<?php echo $row['product_image']; ?>" class="card-img-top" height="320">
                            <h5 class="card-title">Product : <?php echo $row['product_name']; ?></h5>
                            <h5>Price: $<?php echo number_format((float)$row['product_price'], 2); ?></h5>
                            <div class="col-md-12 d-flex justify-content-between">
                            <a href="order.php?id=<?= $row['id']; ?>" class="btn btn-warning btn block btn-lg px-5">Buy Now</a>
                            <a href="" class="btn btn-info btn block btn-lg px-5">Add to Cart</a>
                            </div>
                            
                            <!-- <div class="btn-wrapper text-center d-flex justify-content-between">
                                <a class="btn btn-secondary  btn-sm text-white d-flex align-items-center">Remove</a>
                                <a class="btn btn-warning" >Next</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</html>