<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" type="text/css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script>

    </script>
</head>

<body>
    <?php
    $dat = $_GET['type'];
    if($dat == "paid")
    {
        echo('<div class="alert alert-success">
  <strong>Success!</strong> wallet refill was successful. Now go back to game!
</div>');
    }
    else
    {
        echo('<div class="alert alert-danger">
  <strong>Error!</strong> wallet refill was unsuccessful. Please try again!
</div>');
    }
    ?>
</body>
</html>
