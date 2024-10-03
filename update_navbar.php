<?php
session_start();

$total_count = 0;
$total_amount = 0;

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total_count += $item['quantity'];
        $total_amount += $item['total_price'];
    }
}

echo json_encode([
    'selected_count' => $total_count,
    'total_amount' => $total_amount
]);
?>
