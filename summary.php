<?php
session_start();

include 'db_connect.php';

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total_amount = 0;

$products = [];
if (!empty($cart)) {
    $ids = implode(',', array_keys($cart));
    $result = $conn->query("SELECT pid, pname, pic2, pcap2 FROM product WHERE pid IN ($ids)");
    while ($row = $result->fetch_assoc()) {
        $products[$row['pid']] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปรายการสินค้า</title>
    <link rel="stylesheet" href="css/summary.css">
</head>
<body>
    <header>
        <h1>สรุปรายการสินค้าที่เลือก</h1>
    </header><br><br>
    <div class="summary-container">
        <?php if (empty($cart)): ?>
            <p class="no-items">ไม่มีสินค้าที่เลือก</p>
        <?php else: ?>
            <table class="summary-table">
                <thead>
                    <tr>
                        <th>รูปภาพ</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคารวม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $pid => $item): ?>
                        <?php
                        $product = isset($products[$pid]) ? $products[$pid] : null;
                        $total_amount += $item['total_price'];
                        ?>
                        <?php if ($product): ?>
                            <tr>
                                <td>
                                    <img src="upload/<?php echo htmlspecialchars($product['pic2']); ?>" alt="<?php echo htmlspecialchars($product['pname']); ?>" class="summary-item-image">
                                </td>
                                <td><?php echo htmlspecialchars($product['pname']); ?></td>
                                <td><?php echo htmlspecialchars($item['quantity']); ?> ชิ้น</td>
                                <td>฿<?php echo number_format($item['total_price'], 2); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="summary-total">
                <h2>ยอดรวมทั้งหมด: ฿<?php echo number_format($total_amount, 2); ?></h2>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

