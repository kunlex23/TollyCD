<?php
require '../config.php';

if (isset($_POST['id'], $_POST['status'], $_POST['quantity'], $_POST['partner'], $_POST['product'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $partner = mysqli_real_escape_string($conn, $_POST['partner']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $returnReason = isset($_POST['returnReason']) ? $_POST['returnReason'] : '';

    // Start transaction
    mysqli_begin_transaction($conn);

    try {
        // Update the 'gbigbe' table
        $query = "UPDATE gbigbe SET status='Return', returnReason='$returnReason' WHERE id='$id'";
        if (!mysqli_query($conn, $query)) {
            throw new Exception("Error updating status: " . mysqli_error($conn));
        }

        // Update the 'products' table
        $updateProductsQuery = "UPDATE products SET quantity = quantity + '$quantity' WHERE partner = '$partner' AND productName = '$product'";
        if (!mysqli_query($conn, $updateProductsQuery)) {
            throw new Exception("Error updating products: " . mysqli_error($conn));
        }

        // Commit transaction
        mysqli_commit($conn);
        echo "Status and quantity updated successfully.";
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