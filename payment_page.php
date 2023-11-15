<!DOCTYPE html>
<html>
<head>
    <title>Paystack Payment Form</title>
</head>
<body>

<form id="paymentForm">
    <input type="text" id="email" placeholder="Email">
    <input type="number" id="amount" placeholder="Amount">
    <button type="button" id="payButton">Pay Now</button>
</form>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="paystack_config.js"></script> <!-- Load your Paystack configuration -->

<script>
    document.getElementById('payButton').addEventListener('click', function() {
        var email = document.getElementById('email').value;
        var amount = document.getElementById('amount').value * 100; // Convert to kobo (100 kobo = 1 Naira)
        
        payWithPaystack(email, amount); // Function to initiate payment
    });
</script>


<script>
    var paystackPublicKey = 'your_test_public_key'; // Replace with your test public key

function payWithPaystack(email, amount) {
    var handler = PaystackPop.setup({
        key: paystackPublicKey,
        email: email,
        amount: amount,
        currency: 'NGN', // Currency code (e.g., NGN for Nigerian Naira)
        ref: '' + Math.floor((Math.random() * 1000000000) + 1), // Generate a unique reference
        callback: function(response) {
            // Callback function after payment is completed
            alert('Payment successful! Transaction ID: ' + response.reference);
            // You can handle further actions here, like updating your database
        },
        onClose: function() {
            alert('Payment closed without completion');
        }
    });
    handler.openIframe();
}

</script>
</body>
</html>
