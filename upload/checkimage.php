<?
include("DBEngine_onhost.php");
$Dbs=ConnectDB();


		$sql = "select* from type where  pic is not null ";
		$res = DBexec($Dbs,$sql);
		$rows = DBNumrows($res);
		for($i=0;$i<$rows;$i++){

			$arr = DBfetch_array($res,$i);


			$imagename= "admin/upload/".$arr[pic] ; 

$filesize = filesize($imagename);
			echo  $arr[id]." : ".$filesize." <br>";


		}

?>