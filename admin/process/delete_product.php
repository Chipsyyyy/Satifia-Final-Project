<?php
    session_start();
    include('../../db.php');

    if(!isset($_SESSION['admin_id'])) {
        header('Location: ../login.php');
        exit();
    }

    if(isset($_POST['submit'])) {
        $product_id = (int) $_POST['product_id'];

        $name_sql = "SELECT name FROM tblproducts WHERE id = '$product_id'";
        $name_result = mysqli_query($conn, $name_sql);
        $product_name = "";
        if($name_row = mysqli_fetch_assoc($name_result)) {
            $product_name = $name_row['name'];
        }

        $sql = "DELETE FROM tblproducts WHERE id = '$product_id'";

        if(mysqli_query($conn, $sql)) {
            $_SESSION['admin_success'] = "Product deleted successfully.";

            $admin_id_safe   = (int) $_SESSION['admin_id'];
            $admin_name_safe = mysqli_real_escape_string($conn, $_SESSION['admin_name']);
            $log_action_safe = mysqli_real_escape_string($conn, "Deleted product: $product_name");
            $log_sql = "INSERT INTO tblaudit_log (admin_id, admin_name, action) VALUES ('$admin_id_safe', '$admin_name_safe', '$log_action_safe')";
            mysqli_query($conn, $log_sql);
        } else {
            $_SESSION['admin_error'] = "Could not delete product.";
        }
    }

    mysqli_close($conn);
    header('Location: ../products.php');
    exit();
?>