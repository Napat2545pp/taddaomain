<?php
session_start();
include 'db_connect.php'; 

$idtype = isset($_GET['idtype']) ? $_GET['idtype'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$items_per_page = 32;
$offset = ($page - 1) * $items_per_page;
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : ''; 

// เรียงเริ่มต้น
$order_by = 'id DESC, time_exp DESC';

// กำหนดเรียงตามที่เลือก
if ($sort === 'asc') {
    $order_by = 'total_price ASC';
} elseif ($sort === 'desc') {
    $order_by = 'total_price DESC';
}

// เงื่อนไขการค้นหา
$search_query = $search ? "AND pname LIKE '%" . $conn->real_escape_string($search) . "%'" : '';

// SQL idtype
if ($idtype == '3') {
    $sql = "SELECT pid, pic2, pname, pcap2, numpack, (pcap2 * numpack) AS total_price
            FROM product 
            WHERE pic2 IS NOT NULL 
              AND pic2 <> '' 
              AND product_all = '1' 
              AND product_type = '3' 
              $search_query
            ORDER BY $order_by
            LIMIT $offset, $items_per_page";
} else {
    $sql = $idtype && $idtype != '0' ? 
        "SELECT pid, pic2, pname, pcap2, numpack, (pcap2 * numpack) AS total_price 
         FROM product 
         WHERE pic2 IS NOT NULL 
           AND pic2 <> '' 
           AND idtype = '$idtype' 
           AND product_all = '1' 
           $search_query
         ORDER BY $order_by 
         LIMIT $offset, $items_per_page" :
        "SELECT pid, pic2, pname, pcap2, numpack, (pcap2 * numpack) AS total_price 
         FROM product 
         WHERE pic2 IS NOT NULL 
           AND pic2 <> '' 
           AND (idtype = '0' OR product_all = '1') 
           $search_query
         ORDER BY $order_by 
         LIMIT $offset, $items_per_page";
}

$result = $conn->query($sql);


if ($idtype == '3') {
    $total_sql = "SELECT COUNT(*) as total 
                  FROM product 
                  WHERE pic2 IS NOT NULL 
                    AND pic2 <> '' 
                    AND product_all = '1' 
                    AND product_type = '3'
                    $search_query";
} else {
    $total_sql = $idtype && $idtype != '0' ? 
        "SELECT COUNT(*) as total 
         FROM product 
         WHERE pic2 IS NOT NULL 
           AND pic2 <> '' 
           AND idtype = '$idtype' 
           AND product_all = '1'
           $search_query" :
        "SELECT COUNT(*) as total 
         FROM product 
         WHERE pic2 IS NOT NULL 
           AND pic2 <> '' 
           AND (idtype = '0' OR product_all = '1')
           $search_query";
}
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_items = $total_row['total'];
$total_pages = ceil($total_items / $items_per_page);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการสินค้า</title>
    <link rel="stylesheet" href="css/formproduct.css">
    <link href="https://fonts.googleapis.com/css2?family=Promth:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="product-form-container">
    <div class="product-row">
        <?php
        if ($result->num_rows > 0) {
            $counter = 0;
            while($row = $result->fetch_assoc()) {
                $picPath = "upload/" . $row["pic2"];
                $price_per_item = floatval($row["pcap2"]);
                $num_pack = intval($row["numpack"]);
                $total_price = $price_per_item * $num_pack;
                if ($counter % 6 == 0 && $counter != 0) {
                    echo "</div><div class='product-row'>";
                }
                echo "<div class='product-item'>";
                echo "<img src='$picPath' alt='" . htmlspecialchars($row["pname"], ENT_QUOTES, 'UTF-8') . "' class='product-image'>";
                echo "<p>ชื่อสินค้า: " . htmlspecialchars($row["pname"], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<div class='product-info'>";
                echo "<div class='info-row'>";
                echo "<p>฿ " . number_format($price_per_item, 2) . " / ชิ้น</p>";
                echo "<p>" . number_format($num_pack) . " ชิ้น / แพ็ค</p>";
                echo "</div>";
                echo "<p>ราคาแพ็ค : ฿ " . number_format($total_price, 2) . " บาท</p>";
                echo "<button class='buy-button' data-pid='" . $row["pid"] . "' data-price='" . $total_price . "'>ซื้อสินค้า</button>"; // ปุ่มซื้อสินค้า
                echo "</div>";
                echo "</div>";                
                $counter++;
            }
            if ($counter % 6 != 0) {
                echo "</div>"; 
            }
        } else {
            echo "ไม่มีข้อมูลสินค้า";
        }
        ?>
    </div>
    <div class="pagination">
        <?php
        $start_page = max(1, $page - 3); 
        $end_page = min($total_pages, $page + 3); 

        if ($start_page > 1) {
            echo "<a href='formproduct.php?idtype=$idtype&page=1&sort=$sort'>หน้าแรก</a>";
        }
        if ($page > 1) {
            $prev_page = $page - 1;
            echo "<a href='formproduct.php?idtype=$idtype&page=$prev_page&sort=$sort'>« ก่อนหน้า</a>";
        }
        for ($i = $start_page; $i <= $end_page; $i++) {
            if ($i == $page) {
                echo "<span>$i</span>";
            } else {
                echo "<a href='formproduct.php?idtype=$idtype&page=$i&sort=$sort'>$i</a>";
            }
        }
        if ($page < $total_pages) {
            $next_page = $page + 1;
            echo "<a href='formproduct.php?idtype=$idtype&page=$next_page&sort=$sort'>ถัดไป »</a>";
        }
        if ($end_page < $total_pages) {
            echo "<a href='formproduct.php?idtype=$idtype&page=$total_pages&sort=$sort'>หน้าสุดท้าย</a>";
        }
        ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        function updateNavbar() {
            fetch('update_navbar.php')
                .then(response => response.json())
                .then(data => {
                    // ตรวจสอบว่า `data` มีข้อมูลที่คาดหวังหรือไม่
                    document.getElementById('selected-count').textContent = `จำนวนรายการที่เลือก: ${data.selected_count}`;
                    document.getElementById('total-amount').textContent = `ยอดรวม: ฿${data.total_amount.toFixed(2)}`;
                })
                .catch(error => console.error('Error:', error));
        }

        document.querySelectorAll('.buy-button').forEach(button => {
            button.addEventListener('click', () => {
                const pid = button.getAttribute('data-pid');
                const price = parseFloat(button.getAttribute('data-price'));

                fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `pid=${pid}&price=${price}`
                })
                .then(response => response.json())
                .then(data => {
                    // ตรวจสอบข้อมูลที่ส่งกลับจาก `update_cart.php`
                    console.log('Cart update response:', data);
                    // อัปเดตข้อมูลใน navbar
                    updateNavbar();
                })
                .catch(error => console.error('Error:', error));
            });
        });

        // Initial update of the navbar
        updateNavbar();
    });
</script>

</body>
</html>
