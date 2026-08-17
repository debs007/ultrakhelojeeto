<!DOCTYPE html>
<html>
<head>
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        h1 {
            color: #FF0000;
        }
        p {
            font-size: 18px;
            margin-top: 20px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body onload="GetRequestParameters()">
    <h1>Pay Using</h1>
    <h2>Amount : <span id="amt"></span></h2>
    <button>PAY NOW</button>
    <button style="display: none;" id="confirm">CONFIRM PAYMENT</button>
    <div style="display: none;">
        <p id="upi"></p>
        <p id="pn">Snjay</p>
        <p id="amount">Snjay</p>
    </div>
    <script>


            var pa ; // "abc@upi"
            var pn ; // "Debasish"
            var am ; // "50"
            var cu ; // "INR"
            var tn = "Purchase Order";
        function GetRequestParameters()
        {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);

             pa = params.get("pa"); // "abc@upi"
             pn = params.get("pn"); // "Debasish"
             am = params.get("am"); // "50"
             cu = params.get("cu"); // "INR"
        }

        function ConfirmPayment()
        {
            
        }

        function redirectToLogin() {
            window.location.href = "upi://pay?pa="+pa+"&pn="+pn+"&tn="+tn+"&am="+am+"&cu=INR"; // Replace with vathe actual URL of your login page
        }
    </script>
</body>
</html>
