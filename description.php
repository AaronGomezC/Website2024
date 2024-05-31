<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/main.css">
</head>
<body>

<?php include "navbar.php";?>

<div class="container my-4">
    <div class="row">
        <?php
        include "connection.php";
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM products WHERE id=$id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "
                <div class='col'>
                    <div class='card'>
                        <img src='{$row['url']}' class='card-img-top small-image' alt='{$row['name']}'>
                        <div class='card-body'>
                            <h5 class='card-title'>{$row['name']}</h5>
                            <p class='card-text'>Price: \${$row['price']}</p>
                            <form method='post' action='checkout.php'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <input type='hidden' name='url' value='{$row['url']}'>
                                <input type='hidden' name='name' value='{$row['name']}'>
                                <input type='hidden' name='price' value='{$row['price']}'>
                                <button type='submit' class='btn btn-primary' name='purchase'>Purchase</button>
                            </form>
                        </div>
                    </div>
                </div>
                ";
            } else {
                echo "Product not found.";
            }
        } else {
            echo "No product selected.";
        }
        $conn->close();
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
</body>
</html>
