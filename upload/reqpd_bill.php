<?php
session_start();
include_once('../../connect2.php');
include_once('../../head.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ใบรายการ เบิก-จ่าย สินค้า</title>
</head>
<style>
	@media print {
		#hid {
			display: none;
		}
	}
</style>
<?php

$reqbill = $_GET['reqbill'];

if (isset($_GET['act'])) {
	if ($_GET['act'] == 'excel') {
		header("Content-Type: application/xls");
		header("Content-Disposition: attachment; filename=" . $reqbill . ".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
	}
}

$date = Date("d-m-Y");
$time = Date("H:i:s");

$sql = "SELECT * FROM req_pd_list WHERE req_list_id = '$reqbill' ";
$res = mysqli_query($conn, $sql);
while ($list = mysqli_fetch_array($res)) {
	$req_op = $list['login_name'];
	$req_date = $list['req_list_date'];
	$req_time = $list['req_list_time'];
	$req_mem = $list['memid'];
	$req_remark = $list['req_list_remark'];
}

$sql1 = " SELECT * FROM req_pd_detail WHERE req_list_id = '$reqbill'";
$results = mysqli_query($conn, $sql1);
while ($row = mysqli_fetch_array($results)) {

	$re_list_id = $row["req_list_id"];
	$supid = $row["supid"];
	$re_detail_date = $row['req_detail_date'];
	$re_detail_time = $row['req_detail_time'];
	$re_detail_pdid = $row['req_detail_pdid'];
	$re_detail_pdname = $row['req_detail_pdname'];
	$re_detail_qty = $row['req_detail_qty'];
	$re_detail_cost = $row['req_detail_cost'];
}

?>

<body>
	<br>
	<div align="left" style="margin-left:20px; margin-top: 5px;">
		<button class="btn btn-primary" onclick="window.print();" id="hid">Print</button>
		<a href="?dmglist=<?= $dmglist ?>&act=excel" class="btn btn-success" id="hid"> Excel </a>
	</div>
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<!-- Product DMG List -->

			<table width="100%">
				<tr>
					<td style="text-align: center;">
						<h3>ใบรายการ เบิก-จ่าย สินค้า</h3>
					</td>
				</tr>

			</table>
			<hr>
			<table width="100%">
				<tr>
					<td style="text-align: left;" width="60%">
						<b>บริษัท ทัดดาว ซุปเปอร์สโตร์ จำกัด</b> <br>
						37/20 ถนนคลองหลวง ต.คลองห้า อ.คลองหลวง <br>
						จ.ปทุมธานี 12120 <br>

					</td>
					<td style="text-align: left;">
						เลขประจำตัวผู้เสียภาษี 0135564000241<br>
						โทร. 086-398-9793,02-101-3661
					</td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td style="text-align: left;" width="60%">
						ผู้ทำรายการ : <?= $req_op ?><br>
					</td>
					<td style="text-align: left;">
						รหัสบิล : <?= $reqbill ?><br>
						วันที่ : <?= $req_date ?><br>
						เวลา : <?= $req_time ?>
					</td>
				<tr>
			</table>
			<hr>
			<table class="table table-bordered" width="100%">
				<tr style="text-align: left;">
					<th>ลำดับ</th>
					<th>รหัสสินค้า</th>
					<th>ชื่อสินค้า</th>
					<th>จำนวน</th>
					<th>ทุน/ชิ้น</th>
					<th>ทุนรวม</th>
				</tr>
				<?php

				$sql = " SELECT * FROM req_pd_detail WHERE req_list_id = '$reqbill' ";
				$results = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($results)) {

					$total = $row['req_detail_qty'] * $row['req_detail_cost'];

					$sumcost = $row['sumcost'];

				?>
					<tr>
						<td><?php echo $i += 1 ?></td>
						<td><?php echo $row['req_detail_pdid']; ?></td>
						<td><?php echo $row['req_detail_pdname']; ?></td>
						<td><?php echo $row['req_detail_qty']; ?></td>
						<td><?php echo $row['req_detail_cost']; ?></td>
						<td><?php echo $row['req_detail_qty'] * $row['req_detail_cost']; ?></td>
					</tr>
				<?php
				}
				?>
			</table>
			<table width="100%">
					<?php
					$sql5 = " SELECT SUM(req_detail_sumcost) AS sumcost , SUM(req_detail_qty) AS req_detail_qty FROM req_pd_detail WHERE req_list_id = '$reqbill' ";
					$res = mysqli_query($conn, $sql5);
					while ($row = mysqli_fetch_array($res)) {
						$sumcost = $row['sumcost'];
						$sumqty = $row['req_detail_qty'];
					}
					?>
					
				<tr>
					<th rowspan="2" style="text-align: center;vertical-align: center;">( <?php echo Convert($sumcost) ?> )</th>
					<th style="text-align: right;">ราคารวม :</th>
					<th style="text-align: right;"><?php echo $sumcost; ?> </th>
					<th> บาท</th>
				</tr>
				<tr>
					<th style="text-align: right;">จำนวนรวม :</th>
					<th style="text-align: right;"><?php echo $sumqty; ?> </th>
					<th> ชิ้น</th>
				</tr>
			</table>
			หมายเหตุ : <?= $req_remark ?>
			<!-- End Product FS. List -->
		</div>
	</div>
	<?php
	function Convert($amount_number)
	{
		$amount_number = number_format($amount_number, 2, ".", "");
		$pt = strpos($amount_number, ".");
		$number = $fraction = "";
		if ($pt === false)
			$number = $amount_number;
		else {
			$number = substr($amount_number, 0, $pt);
			$fraction = substr($amount_number, $pt + 1);
		}

		$ret = "";
		$baht = ReadNumber($number);
		if ($baht != "")
			$ret .= $baht . "บาท";

		$satang = ReadNumber($fraction);
		if ($satang != "")
			$ret .= $satang . "สตางค์";
		else
			$ret .= "ถ้วน";
		return $ret;
	}
	function ReadNumber($number)
	{
		$position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
		$number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
		$number = $number + 0;
		$ret = "";
		if ($number == 0) return $ret;
		if ($number > 1000000) {
			$ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
			$number = intval(fmod($number, 1000000));
		}

		$divider = 100000;
		$pos = 0;
		while ($number > 0) {
			$d = intval($number / $divider);
			$ret .= (($divider == 10) && ($d == 2)) ? "ยี่" : ((($divider == 10) && ($d == 1)) ? "" : ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
			$ret .= ($d ? $position_call[$pos] : "");
			$number = $number % $divider;
			$divider = $divider / 10;
			$pos++;
		}
		return $ret;
	}
	?>
</body>

</html>