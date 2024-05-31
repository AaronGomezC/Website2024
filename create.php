<?php
    include "connection.php";

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $url = $_POST['url'];

        // Prepare the SQL statement using placeholders
        $q = "INSERT INTO `products`(`name`, `price`, `url`) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $q);

        // Bind the parameters to the placeholders
        mysqli_stmt_bind_param($stmt, 'sss', $name, $price, $url);

        // Execute the prepared statement
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            echo "Product added successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/main.css">
  </head>
  <body style="overflow:hidden;">
    <?php include "navbar.php";?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center">Create New Product</h2>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" name="price" class="form-control" id="price" required>
                            </div>
                            <div class="form-group">
                                <label for="url">URL:</label>
                                <input type="text" name="url" class="form-control" id="url" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            <a href="table.php" class="btn btn-info">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
