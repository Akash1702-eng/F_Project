<?php
include("connection.php");

if (isset($_POST['submit'])) 
{
    $email = $_GET['value2'];
    $amount = $_GET['value1'];
    $transaction  = $_POST['transaction'];
    $query = "UPDATE shops SET transaction='$transaction',amount='$amount' WHERE email='$email'";
    $data = mysqli_query($conn,$query);

    if($data)
    {
        header("Location: merchent_dashboard.php?value=" . $email);
    }
    else
    {
        echo "failed";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
<link rel="stylesheet" type="text/css" href="payment.css">
<title>Payment</title>
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
</head>
<body>
<div class="container">
    <div class="box form-box">
            <header>Online Clothier</header>
            <div class="image">
                <img src="" id="img" width="230px" /> 
                <h4>9011870635-4@ybl</h4>
            </div>

            <div class="image">
                <img src="img/pay/pay.jpg" width="260px">
            </div>

            <form action="" method="post">
                <div class="field input">
                        <input type="text" name="transaction" id="transaction" placeholder="Transaction Id" required>
                </div>
            
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Payment is done" />
                </div>
            </form>

            <div class="field">
                <a class="btn" href="payment_1.php">Go back</a>
            </div>
    </div>
</div>

<script>
    window.onload = function () {
        const params = new URLSearchParams(window.location.search);
        const value = params.get("value1");
        const upiId = "9011870635-4@ybl".trim();
        const name = "Akash Khurd".trim();
        const amount = value.trim();

        let upiString = `upi://pay?pa=${upiId}`;
        if (name) upiString += `&pn=${encodeURIComponent(name)}`;
        if (amount) upiString += `&am=${encodeURIComponent(amount)}`;
        upiString += `&cu=INR`;

        const qrCodeImage = document.getElementById('img');

        QRCode.toDataURL(upiString, function (error, url) {
            if (error) {
                console.error("Error generating QR code:", error);
                return;
            }
            qrCodeImage.src = url;
            qrCodeImage.style.display = 'block';
        });
    };
</script>

</body>
</html>