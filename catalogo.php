<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Style/main.css">
  </head>
  <body>
    <?php include "navbar.php";?>

    <div class="container my-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            include "connection.php";
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <div class='col'>
                        <div class='card h-100'>
                            <img src='{$row['url']}' class='card-img-top' alt='{$row['name']}'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$row['name']}</h5>
                                <p class='card-text'>Price: \${$row['price']}</p>
                                <a href='description.php?id={$row['id']}' class='btn btn-primary'>View Details</a>
                            </div>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "No products found.";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php include 'footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
</body>
</html>