<?php
session_start();
include('../db.php');

if(!isset($_SESSION['buyer_id'])) {
    header('Location: ../login.php');
    exit();
}

if(isset($_POST['submit'])) {
    $recv_name = $_POST['recv_name'];
    $recv_address = $_POST['recv_address'];
    $recv_contact = $_POST['recv_contact'];
    $recv_email = $_POST['recv_email'];
    $payment_method = $_POST['payment_method'];
    
    $errors = array();

    if(isset($_POST['submit'])) {
        $recv_name = $_POST['recv_name'];
        $recv_address = $_POST['recv_address'];
        $recv_contact = $_POST['recv_contact'];
        $recv_email = $_POST['recv_email'];
        $payment_method = $_POST['payment_method'];

        $errors = array();

        if(empty(trim($recv_name))) {
            $errors[] = "Please enter the recipient's name.";
        }

        if(empty(trim($recv_address))) {
            $errors[] = "Please enter a delivery address.";
        }

        if(empty(trim($recv_contact))) {
            $errors[] = "Please enter the recipient's contact information.";
        }

        if(empty(trim($recv_email))) {
            $errors[] = "Please enter the recipient's email address for confirmation.";
        }

        if(!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: ../checkout.php');
            exit();
        } 

        $cart = $_SESSION['cart'];

        if(empty($cart)) {
            header('Location: ../cart.php');
            exit();
        }

        $subtotal = 0;

        foreach($cart as $item) {
            $price = (float) str_replace(',','', $item['price']);
            $subtotal += $price * $item['qty'];
        }

        $shipping = ($subtotal >= 1500) ? 0 : 150;
        $total = $subtotal + $shipping;

        $method_labels = array(
            'cod' => 'Cash On Delivery (COD)',
            'gcash' => 'Gcash',
            'bank' => 'Bank Transfer',
        );

        $payment_label = isset($method_labels[$payment_method])
        ? $method_labels[$payment_method]
        : $payment_method;

        $buyer_id_safe = (int) $_SESSION['buyer_id'];

        $recv_name_safe = mysqli_real_escape_string(
            $conn,
            $recv_name
        );

        $recv_address_safe = mysqli_real_escape_string(
            $conn,
            $recv_address
        );

        $recv_contact_safe = mysqli_real_escape_string(
            $conn,
            $recv_contact
        );

        $recv_email_safe = mysqli_real_escape_string(
            $conn,
            $recv_email
        );

        $payment_label_safe = mysqli_real_escape_string(
            $conn,
            $payment_label
        );

        $total_safe = (float) $total;

        $order_sql = "
        INSERT INTO tblorders
        (
        buyer_id,
        recipient_name,
        address,
        contact,
        email,
        payment_method,
        total
        )
        VALUES
        (
        '$buyer_id_safe',
        '$recv_name_safe',
        '$recv_address_safe',
        '$recv_contact_safe',
        '$recv_email_safe',
        '$payment_label_safe',
        '$total_safe'
        )
        ";

        if(mysqli_query($conn, $order_sql)) {
            $order_id = mysqli_insert_id($conn);

            foreach($cart as $item) {
                $item_name_safe = mysqli_real_escape_string(
                    $conn,
                    $item['name']
                );

                $item_price_safe = (float) str_replace(
                    ',',
                    '',
                    $item['price']
                );

                $item_qty_safe = (int) $item['qty'];

                $item_sql = "
                INSERT INTO tblorder_items
                (
                order_id,
                product_name,
                price,
                qty
                )
                VALUES
                (
                '$order_id',
                '$item_name_safe',
                '$item_price_safe',
                '$item_qty_safe'
                )
                ";

                mysqli query($conn, $item sql);

                if(!empty($item['id'])) {
                    $product_id_safe = (int) $item['id'];

                    $update_stock_sql = "
                    UPDATE tblproducts
                    SET stock = stock - '$item_qty_safe'
                    WHERE id = '$product_id_safe'
                    AND stock >= '$item_qty_safe'
                    ";

                    mysql_query($conn, $update_stock_sql);
                }
            }

            $_SESSION['order_summary'] = array(
                'order_number' => 'ORD-' . str_pad(
                    $order_id,
                    6,
                    '0',
                    STR_PAD_LEFT
                ),
                'items' => $cart,
                'total' => $total,
                'address' => $recv_address,
                'email' => $recv_email,
                'payment_method' => $payment_label
            );

            mysqli_close($conn);

            header('Location: ../payment.php');
            exit();

        } else {
            $_SESSION['errors'] = array(
                "Something went wrong while placing your order. Please try again"
            );

            mysqli_close($conn);

            header('Location: ../checkout.php');
            exit();
        }
    }
?>


    



        