<?php
    session_start();
    include('../../db.php');

    if(!isset($_SESSION['admin_id'])) {
        header('Location: ../login.php');
        exit();
    }

    if(isset($_POST['submit'])) {
        $product_id = $_POST['product_id'];
        $name       = trim($_POST['name']);
        $category   = $_POST['category'];
        $price      = $_POST['price'];
        $stock      = $_POST['stock'];
        $image      = trim($_POST['image']);

        $errors = array();
        $is_edit = !empty($product_id);

        if(empty($name))     { $errors[] = "Product name is required."; }
        if(empty($category)) { $errors[] = "Please select a category."; }
        if(!is_numeric($price) || $price < 0) { $errors[] = "Please enter a valid price."; }
        if(!is_numeric($stock) || $stock < 0) { $errors[] = "Please enter a valid stock quantity."; }

        if(!empty($errors)) {
            $_SESSION['admin_errors'] = $errors;
            $redirect = $is_edit ? '../product_form.php?id=' . $product_id : '../product_form.php';
            mysqli_close($conn);
            header('Location: ' . $redirect);
            exit();
        }

        $name_safe     = mysqli_real_escape_string($conn, $name);
        $category_safe = mysqli_real_escape_string($conn, $category);
        $image_safe    = mysqli_real_escape_string($conn, $image);
        $price_safe    = (float) $price;
        $stock_safe    = (int) $stock;

        if($is_edit) {
            $product_id_safe = (int) $product_id;
            $sql = "UPDATE tblproducts
                    SET name = '$name_safe', category = '$category_safe', price = '$price_safe', stock = '$stock_safe', image = '$image_safe'
                    WHERE id = '$product_id_safe'";
        } else {
            $sql = "INSERT INTO tblproducts (name, category, price, stock, image)
                    VALUES ('$name_safe', '$category_safe', '$price_safe', '$stock_safe', '$image_safe')";
        }

        if(mysqli_query($conn, $sql)) {
            $_SESSION['admin_success'] = $is_edit
                ? "Product \"$name\" updated successfully."
                : "Product \"$name\" added successfully.";

            $admin_id_safe   = (int) $_SESSION['admin_id'];
            $admin_name_safe = mysqli_real_escape_string($conn, $_SESSION['admin_name']);
            $log_action      = $is_edit ? "Updated product: $name" : "Added new product: $name";
            $log_action_safe = mysqli_real_escape_string($conn, $log_action);
            $log_sql = "INSERT INTO tblaudit_log (admin_id, admin_name, action) VALUES ('$admin_id_safe', '$admin_name_safe', '$log_action_safe')";
            mysqli_query($conn, $log_sql);
        } else {
            $_SESSION['admin_error'] = "Something went wrong. Please try again.";
        }

        mysqli_close($conn);
        header('Location: ../products.php');
        exit();
    }
?>