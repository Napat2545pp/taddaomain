<?php
session_start();

$pid = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
$price = isset($_POST['price']) ? floatval($_POST['price']) : 0.00;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_SESSION['cart'][$pid])) {
    $_SESSION['cart'][$pid]['quantity'] += 1;
    $_SESSION['cart'][$pid]['total_price'] += $price;
} else {
    $_SESSION['cart'][$pid] = [
        'quantity' => 1,
        'total_price' => $price
    ];
}

// Calculate total items and total amount
$total_count = 0;
$total_amount = 0;

foreach ($_SESSION['cart'] as $item) {
    $total_count += $item['quantity'];
    $total_amount += $item['total_price'];
}

echo json_encode([
    'selected_count' => $total_count,
    'total_amount' => $total_amount
]);
?>
