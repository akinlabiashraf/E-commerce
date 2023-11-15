<?php
// require 'config.php';
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     $sql =  "SELECT * FROM product WHERE id=$id";
//     $result =  mysqli_query($db_con, $sql);
//     $row = mysqli_fetch_array($result);

//     $pnmae = $row['product_name'];
//     $price = $row['product_price'];
//     $deliv_charge = 50;
//     $total_price = $price - $deliv_charge;
//     $pimage = $row['product_image'];
// } else {
//     echo "No product found";
// }

require 'config.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $db_con->prepare("SELECT * FROM product WHERE id=?");
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $pname = $row['product_name']; 
        $price = $row['product_price'];
        $deliv_charge = 50;
        $total_price = $price + $deliv_charge; 
        $pimage = $row['product_image'];
    } else {
        echo "No product found";
        exit(); 
    }
} else {
    echo "Order Yet to be placed";
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <title>Complete your Order</title>
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5">
                <h2 class="text-center p-2 text-primary">Fill the details to compleate your orders</h2>
                <h3>Product details</h3>
                <table class="table table-bordered" width="500px">
                    <tr>
                        <th>Product Name : </th>
                        <td><?= $pname ?></td>
                        <td rowspan="4" class="text-center"><img src="<?= $pimage ?>"></td>
                    </tr>
                    <tr>
                        <th>Product Price :</th>
                        <td><?= $price ?></td>
                    </tr>
                    <tr>
                        <th>Delivwry Charge :</th>
                        <td><?= $deliv_charge ?></td>
                    </tr>
                    <tr>
                        <th>Total cost :</th>
                        <td><?= $total_price ?></td>
                    </tr>
                </table>
                <h4>Enter your details</h4>
                <form action="" method="post" accept-charset="utf-8" id="paymentForm">
                    <input type="hidden" name="product_name" value="<?= $pnmae ?>">
                    <input type="hidden" name="product_price" value="<?= $price ?>">
                    <div class="form-group mb-3">
                        <input type="text" name="c_name" class="form-control" placeholder="Enter Your Nmae" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" name="c_email" id="email" class="form-control" placeholder="Enter Your Email" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" name="c_phone" class="form-control" placeholder="Enter Your Phone Number" required>
                    </div>
                    <div class="form-group mb-3">
                        <input id="payButton" type="submit" class="btn btn-danger btn-lg" value="Make Payment of: $<?= number_format($total_price) ?> ">
                    </div>
                    <div id="paypal-button-container"></div>
                </form>

                <script src="https://js.paystack.co/v1/inline.js"></script>
                <script src="paystack_config.js"></script> <!-- Load your Paystack configuration -->

                <!-- <script>
                    document.getElementById('payButton').addEventListener('click', function() {
                        var email = document.getElementById('email').value;
                        var amount = <?= number_format($total_price) ?>.value * 100; // Convert to kobo (100 kobo = 1 Naira)

                        payWithPaystack(email, amount); // Function to initiate payment
                    });
                </script> -->

                <script>
                    document.getElementById('payButton').addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent the default form submission

                        var email = document.getElementById('email').value;
                        var amount = <?= $total_price ?> * 100;

                        payWithPaystack(email, amount);
                    });
                </script>

                <script>
                    var paystackPublicKey = 'pk_test_bcd49d44b985824c11b25d67a4a6ac64dcc451e0'; // Replace with your test public key

                    function payWithPaystack(email, amount) {
                        var handler = PaystackPop.setup({
                            key: paystackPublicKey,
                            email: email,
                            amount: amount,
                            currency: 'NGN',
                            ref: 'shopping' + Math.floor((Math.random() * 1000000000) + 1), // Generate a unique reference
                            callback: function(response) {
                                // Callback function after payment is completed
                                alert('Payment successful! Transaction ID: ' + response.reference);
                                // You can handle further actions here, like updating your database
                            },
                            onClose: function() {
                                window.location = "http://localhost/shopping/order.php?transaction=cancel";
                                alert('Payment closed without completion');
                            },
                            callback: function(response) {
                            let message = 'Payment Complete! Reference: ' + response.reference;
                            alert(message);
                            window.location.href = "http://localhost/shopping/verify_transaction.php?reference=" + response.reference;
                        }
                        });
                        handler.openIframe();
                    }
                </script>
            </div>
        </div>
    </div>
    <!-- Replace the "test" client-id value with your client-id -->
    <script src="https://www.paypal.com/sdk/js?client-id=AX5iH-jTY9TH8VZttT9d9X-FaByAjp-g0rnGKwSur8nBLZgj9qPKebfpQceU6TGFZh4SeTTog9Eb9vNF&currency=USD"></script>
</body>

</html>