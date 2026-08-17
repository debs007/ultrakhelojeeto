<!DOCTYPE html>
<html>
<head>
    <title>Session Expired</title>
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
<body>
    <h1>Session Expired</h1>
    <p>Your session has expired. Please login again to continue.</p>
    <button onclick="redirectToLogin()">Go to Login Page</button>

    <script>
        function redirectToLogin() {
            window.location.href = "admin"; // Replace with the actual URL of your login page
        }
    </script>
</body>
</html>
