<?php
require '../config.php';

if (isset($_POST['id'], $_POST['status'], $_POST['quantity'], $_POST['partner'], $_POST['product'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $partner = mysqli_real_escape_string($conn, $_POST['partner']);
    $productList = mysqli_real_escape_string($conn, $_POST['product']);
    $returnReason = isset($_POST['returnReason']) ? $_POST['returnReason'] : '';

    // Parse the product list into an associative array
    $products = [];
    $pairs = explode(',', $productList);
    foreach ($pairs as $pair) {
        list($key, $value) = explode('=', $pair);
        $key = trim($key);
        $value = trim($value);
        $products[$key] = $value;
    }

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Update the 'gbigbe' table
        $query = "UPDATE gbigbe SET status='Return', returnReason='$returnReason' WHERE id='$id'";
        if (!mysqli_query($conn, $query)) {
            throw new Exception("Error updating status: " . mysqli_error($conn));
        }

        // Update the 'products' table for each product
        foreach ($products as $productName => $quantity) {
            $updateProductsQuery = "UPDATE products SET quantity = quantity + '$quantity' WHERE partner = '$partner' AND productName = '$productName'";
            if (!mysqli_query($conn, $updateProductsQuery)) {
                throw new Exception("Error updating product '$productName': " . mysqli_error($conn));
            }
        }

        // Commit transaction
        mysqli_commit($conn);
        echo "Status and quantities updated successfully.";
        echo "<script>alert('Product updated successfully!');</script>";
    } catch (Exception $e) {
        // Rollback transaction in case of error
        mysqli_rollback($conn);
        echo "Transaction failed: " . $e->getMessage();
    }
} else {
    echo "Required parameters are missing.";
}
?>