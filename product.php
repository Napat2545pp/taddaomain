<?php
session_start();
$selected_count = isset($_SESSION['selected_count']) ? $_SESSION['selected_count'] : 0;
$total_amount = isset($_SESSION['total_amount']) ? $_SESSION['total_amount'] : 0.00;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/product.css">
    <link rel="icon" href="img/logo/logotaddao.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Promth:wght@400;700&display=swap" rel="stylesheet">
    <title>สินค้าของทัดดาว</title>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function updateNavbar() {
                fetch('update_navbar.php')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('selected-count').textContent = `จำนวนรายการที่เลือก: ${data.selected_count}`;
                        document.getElementById('total-amount').textContent = `ยอดรวม: ฿${data.total_amount.toFixed(2)}`;
                    })
                    .catch(error => console.error('Error:', error));
            }

            function filterProducts(category, page = 1, sort = '', search = '') {
                const idtype = category.dataset.idtype || '3'; 
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `formproduct.php?idtype=${idtype}&page=${page}&sort=${sort}&search=${encodeURIComponent(search)}`, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        document.getElementById('product-list').innerHTML = xhr.responseText;
                        // Re-bind event handlers after products are updated
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
                                    document.getElementById('selected-count').textContent = `จำนวนรายการที่เลือก: ${data.selected_count}`;
                                    document.getElementById('total-amount').textContent = `ยอดรวม: ฿${data.total_amount.toFixed(2)}`;
                                })
                                .catch(error => console.error('Error:', error));
                            });
                        });
                    }
                };
                xhr.send();
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
                        document.getElementById('selected-count').textContent = `จำนวนรายการที่เลือก: ${data.selected_count}`;
                        document.getElementById('total-amount').textContent = `ยอดรวม: ฿${data.total_amount.toFixed(2)}`;
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            const categoryBoxes = document.querySelectorAll('.category-box[data-idtype]');
            const searchInput = document.getElementById('search-input');

            categoryBoxes.forEach(box => {
                box.addEventListener('click', () => {
                    categoryBoxes.forEach(b => b.classList.remove('selected'));
                    box.classList.add('selected');
                    filterProducts(box, 1, '', searchInput.value);
                });
            });

            document.addEventListener('click', (event) => {
                if (event.target.matches('.pagination a')) {
                    event.preventDefault();
                    const url = new URL(event.target.href);
                    const page = url.searchParams.get('page');
                    const idtype = url.searchParams.get('idtype');
                    const sort = url.searchParams.get('sort') || '';
                    const search = url.searchParams.get('search') || '';
                    filterProducts({ dataset: { idtype } }, page, sort, search);
                }
            });

            document.getElementById('sort-asc').addEventListener('click', () => {
                const selectedCategory = document.querySelector('.category-box.selected');
                filterProducts(selectedCategory, 1, 'asc', searchInput.value);
            });

            document.getElementById('sort-desc').addEventListener('click', () => {
                const selectedCategory = document.querySelector('.category-box.selected');
                filterProducts(selectedCategory, 1, 'desc', searchInput.value);
            });

            searchInput.addEventListener('input', () => {
                const selectedCategory = document.querySelector('.category-box.selected');
                filterProducts(selectedCategory, 1, '', searchInput.value);
            });

            // Initial update of the navbar
            updateNavbar();
        });
    </script>
</head>
<body>
<div class="category-container">
    <div class="category-box" data-idtype="3">
        <img src="img/logo/logotaddao.png" alt="สินค้าของทัดดาว" class="category-icon">
        สินค้าของทัดดาว
    </div>
    <div class="category-box">
        <img src="img/logo/logotaddao.png" alt="สินค้าแนะนำ" class="category-icon">
        สินค้าแนะนำ
    </div>
    <div class="category-box">
        <img src="img/logo/logotaddao.png" alt="สินค้ามาใหม่" class="category-icon">
        สินค้ามาใหม่
    </div>
    <div class="category-box" data-idtype="7">
        <img src="img/logo/logotaddao.png" alt="กระเป๋า" class="category-icon">
        กระเป๋า
    </div>
    <div class="category-box" data-idtype="8">
        <img src="img/logo/logotaddao.png" alt="เสริมความงาม" class="category-icon">
        เสริมความงาม
    </div>
    <div class="category-box" data-idtype="9">
        <img src="img/logo/logotaddao.png" alt="ชุดกิ๊ฟช๊อป" class="category-icon">
        ชุดกิ๊ฟช๊อป
    </div>
    <div class="category-box" data-idtype="10">
        <img src="img/logo/logotaddao.png" alt="ประดับศรีษะ" class="category-icon">
        ประดับศรีษะ
    </div>
    <div class="category-box" data-idtype="11">
        <img src="img/logo/logotaddao.png" alt="อิเล็กทรอนิกส์" class="category-icon">
        อิเล็กทรอนิกส์
    </div>
    <div class="category-box" data-idtype="12">
        <img src="img/logo/logotaddao.png" alt="เครื่องมือช่างเเละDIY" class="category-icon">
        เครื่องมือช่างเเละDIY
    </div>
    <div class="category-box" data-idtype="13">
        <img src="img/logo/logotaddao.png" alt="เครื่องครัว" class="category-icon">
        เครื่องครัว
    </div>
    <div class="category-box" data-idtype="14">
        <img src="img/logo/logotaddao.png" alt="อุปกรณ์ทำความสะอาด" class="category-icon">
        อุปกรณ์ทำความสะอาด
    </div>
    <div class="category-box" data-idtype="15">
        <img src="img/logo/logotaddao.png" alt="เบ็ดเตล็ด" class="category-icon">
        เบ็ดเตล็ด
    </div>
    <div class="category-box" data-idtype="16">
        <img src="img/logo/logotaddao.png" alt="เครื่องเขียน" class="category-icon">
        เครื่องเขียน
    </div>
    <div class="category-box" data-idtype="17">
        <img src="img/logo/logotaddao.png" alt="ของเล่นเด็ก" class="category-icon">
        ของเล่นเด็ก
    </div>
    <div class="category-box" data-idtype="18">
        <img src="img/logo/logotaddao.png" alt="ผ้าเเละเครื่องนุ่งห่ม" class="category-icon">
        ผ้าเเละเครื่องนุ่งห่ม
    </div>
    <div class="category-box" data-idtype="19">
        <img src="img/logo/logotaddao.png" alt="พลาสติก" class="category-icon">
        พลาสติก
    </div>
    <div class="category-box" data-idtype="20">
        <img src="img/logo/logotaddao.png" alt="สินค้าลิขสิทธิ์" class="category-icon">
        สินค้าลิขสิทธิ์
    </div>
    <div class="category-box" data-idtype="21">
        <img src="img/logo/logotaddao.png" alt="เครื่องประดับ" class="category-icon">
        เครื่องประดับ
    </div>
    <div class="category-box" data-idtype="25">
        <img src="img/logo/logotaddao.png" alt="ชั้นวางสินค้า" class="category-icon">
        ชั้นวางสินค้า
    </div>
    <div class="category-box" data-idtype="26">
        <img src="img/logo/logotaddao.png" alt="ของเทศกาล" class="category-icon">
        ของเทศกาล
    </div>
    <div class="category-box">
        <img src="img/logo/logotaddao.png" alt="สินค้าโปรโมชั่น" class="category-icon">
        สินค้าโปรโมชั่น
    </div>
</div>
<div class="search-container">
    <input type="text" id="search-input" placeholder="ค้นหาชื่อสินค้า...">
</div>
<div class="sort-options">
    <button id="sort-asc" class="sort-button">ราคาต่ำไปสูง</button>
    <button id="sort-desc" class="sort-button">ราคาสูงไปต่ำ</button>
</div>

<div id="product-list">
    <!-- แสดงสินค้า -->
</div>

<!-- Include this in your main HTML file -->
<nav class="bottom-navbar">
    <div class="navbar-left">
        <span id="selected-count">จำนวนรายการที่เลือก: <?php echo $selected_count; ?></span>
        <span id="total-amount">ยอดรวม: ฿<?php echo number_format($total_amount, 2); ?></span>
    </div>
    <button id="summary-button">สรุปรายการ</button>
    <script>
        document.getElementById('summary-button').addEventListener('click', () => {
            window.location.href = 'summary.php';
        });
    </script>
</nav>



</body>
</html>
