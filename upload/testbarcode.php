<?
include("../DBEngine_onhost.php");
$Dbs=ConnectDB();

$productcode = $_GET[barcode]; 
$numprint =  $_GET[printnum]; 


$sql = "select * from product where pid='$productcode'";

$res = DBexec($Dbs,$sql);
$rows = DBNumrows($res);


if($rows <> "0"){

	$arr = DBfetch_array($res,0);

	$pname = $arr[pname]; 
	$userfor = $arr[usefor]; 
	$precom = $arr[preccom]; 
	$price = $arr[price1] ; 
	$pricebig = $arr[price1] * $arr[numpack] ; 
	$perpack = $arr[numpack] ;

			$sql1 = "select * from type where id='$arr[idtype]' ";
			$res1= DBexec($Dbs,$sql1);
			$rows1 = DBNumrows($res1);
			$arr1 = DBfetch_array($res1,0);
			$typename = $arr1[nametype] ; 

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?=$pname?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="mystyle_barcode.css" media="screen" >
</head>
<body style="margin:0px 0px;" >


<?
//$allrows = $numprint / 3 ; 
//$n=0;
//for($r=0;$r<$allrows;$r++){


?>



<!-- แนวตั้ง -->
<?

	if($_GET[printtype]  == "tp1"){



?>

<div id="pagex">


			<?
		
			//	for($rx=0;$rx<3;$rx++){
					//if($n < $numprint){




			
			?>

		


		
			<div class="boxbarcode">

					<div class="pdetail"  ><?=$pname?></div>
					<div class="pdetail" >หมวดหมู่ : <?=$typename?> </div>
					<div class="pdetail" >วิธีใช้งาน : <?=$userfor?> </div>
					<div class="pdetail" >ข้อแนะนำ : <?=$precom?> </div>
					<div class="pdetail" >ผู้จัดจำหน่าย : ทัดดาวซุปเปอร์สโตร์ </div>
						<div class="pdetail" >37/16 ม.5 ถ.คลองหลวง ต.คลองห้า</div>
							<div class="pdetail" >อ.คลองหลวง จ.ปทุมธานี 02-101-3661</div>
							<table class="tableprice" style="backgroud:#FFF; " >
							<tr>
							<td  class="td01">บรรจุ</td>	<td   class="td02">1</td>	<td   class="td03">ชิ้น</td>
							</tr>
							<tr>
							<td  class="td01">ราคา/ชิ้น</td>	<td  class="td02"><?=$price?></td>	<td  class="td03">บาท</td>
							</tr>
									<tr>
							<td  class="td01">ราคารวม</td>	<td  class="td02"><?=$price?></td>	<td  class="td03">บาท</td>
							</tr>
							</table>

<center>
<img src="barcode/examples/barcodes/testbarcode02.php?data=<?=$productcode?>" style="width:320px; height:80px; margin-top:10px;"  >
<div class="barcodenum" ><?=$productcode?></div>
</center>
			</div>



			<?
			



			//}
			//$n=$n+1; 
			
			//}
			
			?>


</div>

<?
}	

?>
<!--จบ แนวตั้ง -->


<!--แนวนอน -->
<?

	if($_GET[printtype]  == "tp2"){

?>

<div id="pagey">


			<?
		
			//	for($rx=0;$rx<3;$rx++){
				//	if($n < $numprint){




			
			?>


		
			<div class="boxbarcodey">

					<div class="bigprice"><span class="bb"><?=$pricebig?></span> บาท</div>
					<div class="bigprice_detail">
					<?=$perpack?> ชิ้น ชิ้นละ<br>
					<span class="bigperprice"><?=$price?></span>
					<br>
					บาท
					</div>
					<div class="clear"></div>

					<div class="pdetailb"  ><?=$pname?></div>
					<div class="pdetailb_x1" ><?=$typename?> </div>
					<div class="pdetailb_x2" >โซน : <?=$productzone?> </div>
						<div class="clear"></div>
							
<center>
<img src="barcode/examples/barcodes/testbarcode02.php?data=<?=$productcode?>" style="width:450px; height:100px; margin-top:10px;"  >
<div class="barcodenum" ><?=$productcode?></div>
</center>
			</div>

			
			<?
			



		//	}
			//$n=$n+1; 
			
			//}
			
			?>


			</div>


			<?
					}
			?>


<!-- จบแนวนอน-->



<?
//}

?>






<?
if($_GET[typelist] == "listbill"){

$sql = "select * from buylist where buyid='$_GET[billid]' ";
$res = DBexec($Dbs,$sql);
$rows = DBNumrows($res);
for($i=0;$i<$rows;$i++){
	$arr = DBfetch_array($res,$i);


	$sql1 = "select * from product where pid='$arr[pid]'";
	$res1= DBexec($Dbs,$sql1);
	$rows1 = DBNumrows($ers1);
	$arr1 = DBfetch_array($res1,0);

	$numpack = $arr[amount] / $arr1[numpack] ; 

	$imagename = "images/noimg.jpg";
	if($arr1[pic2] <> "") $imagename = "upload/".$arr1[pic2] ; 

?>
       <tr>
         
       

            <td width="5%"><?=$i+1?></td>
			<td width="10%"><img src="<?=$imagename?>" width="80" ></td>
			<td width="15%"><?=$arr[pid]?></td>
            <td width="30%"><?=$arr[pname]?></td>
            <td width="10%"  style="text-align:center;" ><?=$arr[amount]?></td>
            <td width="10%" style="text-align:center;" ><?=$numpack?></td>
            <td width="10%" style="text-align:center;" >1</td>
            <td width="5%"> </td>

    </tr>



<?
}
}?>
</body>
</html>