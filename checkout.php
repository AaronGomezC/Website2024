<?php
session_start(); // Start the session
include "connection.php";

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // User is logged in
    $purchase_message = "Thank you for your purchase";
    $button_text = "Purchase";
} else {
    // User is not logged in
    $purchase_message = "You must be logged in to purchase this";
    $button_text = "Log In";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body style="overflow:hidden;">
<?php include "navbar.php";?>

<div class="container my-4">
    <h2>Checkout Details</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Image</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($_POST['id']) && isset($_POST['url']) && isset($_POST['name']) && isset($_POST['price'])) {
            $product_id = $_POST['id'];
            $product_url = $_POST['url'];
            $product_name = $_POST['name'];
            $product_price = $_POST['price'];
            echo "
            <tr>
                <td>$product_id</td>
                <td>$product_name</td>
                <td>\$$product_price</td>
                <td><img src='$product_url' alt='$product_name' style='max-width: 100px;'></td>
            </tr>
            ";
        } else {
            echo "<tr><td colspan='4'>No product details found.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Display purchase button based on user's login status -->
    <?php if(isset($_SESSION['user_id'])): ?>
        <button class="btn btn-primary"><?php echo $button_text; ?></button>
    <?php else: ?>
        <p><?php echo $purchase_message; ?></p>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
