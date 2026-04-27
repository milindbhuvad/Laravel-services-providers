<!DOCTYPE html>
<html>
<head>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<button id="pay-btn">Pay ₹500</button>

<form name="razorpay-form" action="/payment/verify" method="POST">
    @csrf
    <input type="hidden" name="razorpay_payment_id">
    <input type="hidden" name="razorpay_order_id">
    <input type="hidden" name="razorpay_signature">
</form>

<script>
    var options = {
        "key": "{{ $key }}",
        "amount": "{{ $order['amount'] }}",
        "currency": "INR",
        "name": "Test Company",
        "description": "Test Payment",
        "order_id": "{{ $order['order_id'] }}",
        "handler": function (response){
            document.querySelector('input[name=razorpay_payment_id]').value = response.razorpay_payment_id;
            document.querySelector('input[name=razorpay_order_id]').value = response.razorpay_order_id;
            document.querySelector('input[name=razorpay_signature]').value = response.razorpay_signature;

            document.forms['razorpay-form'].submit();
        }
    };

    var rzp = new Razorpay(options);

    document.getElementById('pay-btn').onclick = function(e){
        rzp.open();
        e.preventDefault();
    }
</script>

</body>
</html>