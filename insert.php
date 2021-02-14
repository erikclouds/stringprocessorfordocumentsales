<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style_button.css">
</head>
<body>
<p  name="text_2" ><?php
	include 'connection.php';
$tampil = "SELECT * FROM data_outlet";
$query = mysqli_query($conn, $tampil);
        while($row = mysqli_fetch_array($query)){
        	$kodeOutlet[] = $row['kode_outlet'];
        	$newOutlet[] = $row['nama_outlet'];
        }
	$maxOutlet = count($kodeOutlet);

 ?></p>

<?php
	$pesanErr = '<div><a href="coba.php">
				<button type="button" class="btn_proses">Kembali</button>
				</a></div>
				<script type="text/javascript">
				var Caution = "mohon diinput dulu!";
				alert(Caution);
				</script>';
	$pesanOk = '<script type="text/javascript">
				var Caution = "Data berhasil diinput!";
				alert(Caution);
				</script>';
	$cek = "found";
	$dot = ".";
	$Message = "ada outlet baru, mohon diinput dulu!";
	$kodeArea = ['0602', '0603', '0604'];
	$string = $_POST['text_1'];
	$numberOfString = strlen($string);
	$partOfString = 4;
	for ($i=0; $i <= $numberOfString; $i++) { 
	$change = substr($string,$i,$partOfString);
		if ($change === "FKML" || $change === "FRML")  {
			$nomorFaktur[] = substr($string,$i,18);
			$ii = $i + 1;
			$endOfJ = $numberOfString;
			for ($j=$ii; $j <= $endOfJ; $j++) { 
				$change = substr($string,$j,$partOfString);
				if ($change === "SBF-" || $change === "CFL-" || $change === "RBT-" || $change === "RBI-" )  {
					$kodeItem[] = substr($string,$j,10);
				}else if ($change === "FKML" || $change === "FRML") {
					$j = $endOfJ;
				}
			}
		}
	}
	$countItem = count($kodeItem);
	echo $countItem."";
	$forEnd = count($kodeItem);
	$titik = $maxOutlet - 1;
	for ($kd=0; $kd <= $numberOfString; $kd++) { 
	$kodeApotik = substr($string,$kd,4);
		for ($i=0; $i <= 2 ; $i++) { 	
			if ($kodeApotik === $kodeArea[$i])  {
			$kodeApotik2 = substr($string,$kd,9);
			$JX[] = $kodeApotik2;
			}
		}
	}

$max = count($JX);
$h = $maxOutlet - 1;
for ($z=0; $z < $max; $z++) { 
	for ($j=0; $j < $maxOutlet; $j++) { 
		if ($JX[$z] === $kodeOutlet[$j]) {
			$cek = "not found";
			$idOutlet[] = $JX[$z];

		}else if (($j === $h) and ($cek === "found")) {
			// echo "<br>".$JX[$z];
			$OutletBaru[] = $JX[$z];
		}
	}
	$cek = "found";
}

// echo var_dump($OutletBaru);

// if ($countItem < $countFaktur) {
// 	$forEnd = $countFaktur;
// }else if($countItem > $countFaktur){
// 	$forEnd = $countItem;
// }
// echo $countFaktur."</br>";
// echo $forEnd;
// echo $_POST['demo'];
// for ($i=0; $i < $forEnd; $i++) { 
//     $insert = "INSERT INTO Penjualan(kode_outlet, tanggal_faktur, no_faktur, item, harga, jumlah, total)
//      VALUES ('$idOutlet[$i]', '12-12-2020', '$nomorFaktur[$i]', '$kodeItem[$i]', '2', '3', '4')";
//      mysqli_query($conn, $insert); 
// }

// for ($i=0; $i < $forEnd; $i++) { 
// 	echo $harga[$i]." <br>";

// }

// echo count($idOutlet);
$stringHarga = $_POST['cobaan'];


// Selection Price

	for ($i=0; $i <= $numberOfString; $i++) { 
		$findSharp = substr($stringHarga,$i,1);
		if ($findSharp === "#") {
			// echo $findSharp." - <br>".$i;
			$start = $i +1;
		}else if ($dot === $findSharp) {
			// echo $findSharp." - <br>".$i;
			$end = $i-$start;
			$str = substr($stringHarga,$start,$end);
			$ganti = str_replace(",", "", $str);
			$hargaItem[] = $ganti;
		}
	}
	


$databaseItem = mysqli_query($conn,"select * from data_item");
while($d = mysqli_fetch_array($databaseItem)){
	$itemDatabase[] = $d['kode_item'];
}


//ubah baris kode ini




$MaxitemDatabase = count($itemDatabase);
$MaxkodeItem = count($kodeItem);
$rangeitemDatabase = $MaxitemDatabase - 1;
for ($z=0; $z < $MaxkodeItem; $z++) {
	for ($i=0; $i < $MaxitemDatabase; $i++) { 
		if ($kodeItem[$z] === $itemDatabase[$i]) {
			$i = $MaxitemDatabase;
		}else if ($i === $rangeitemDatabase) {
			$itemBr[] = $kodeItem[$z];
			// echo "<br>".$kodeItem[$z];
			$itemBrHarga[] = $hargaItem[$z];
		}
	}
}
	// $itmNULL = is_null($itemBr);
if (!isset($OutletBaru)) {
	$OutletBaru = NULL;
}if (!isset($itemBr)) {
	$itemBr = NULL;
}
echo "<br>";
echo var_dump($itemBr);
echo " = ";
$OutletBaru[] = "asd";
echo var_dump($OutletBaru);
echo "<br>";

if (($OutletBaru != NULL) || ($itemBr != NULL)) {
	if ($OutletBaru != NULL) {
		$TT = array_unique($OutletBaru);
		$b = array_values($TT);
			for ($i=0; $i < count($b); $i++) { 
				echo "<br>".$b[$i];
				$insert = "INSERT INTO data_outlet(kode_outlet, nama_outlet)
				VALUES ('$b[$i]','New Outlet')";
				mysqli_query($conn, $insert);
			}
	}else if ($itemBr != NULL) {
		$TT = array_unique($itemBr);
		$b = array_values($TT);
		$c = count($b);
			for ($i=0; $i < $c; $i++) { 
				echo $b[$i]." =".$itemBrHarga[$i]."<br>";
				echo "<br>".$b[$i];
				$insert = "INSERT INTO data_item(kode_item, nama_item, harga, principal)
			     VALUES ('$b[$i]','New Item', '0', '-')";
			     mysqli_query($conn, $insert);
			}
	}
	echo $pesanErr;
	echo "<br>not null = not null";
}else if (($OutletBaru == NULL) || ($itemBr == NULL)) {
	if ($OutletBaru == NULL) {
		$countOutlet = count($newOutlet);
		for ($i=0; $i < $countOutlet ; $i++) { 
			if ($newOutlet[$i] === "New Outlet") {
				$varOutletBaru = "New Outlet";
			}else {
				$varOutletBaru = "Tidak Ada";
			}	
		}
		if ($varOutletBaru === "New Outlet") {
			echo "edit data dulu di database, ";
			echo $pesanErr;
		}else if ($varOutletBaru === "Tidak Ada") {
			// for ($i=0; $i < $forEnd; $i++) { 
			//     $insert = "INSERT INTO Penjualan(kode_outlet, tanggal_faktur, no_faktur, item, harga, jumlah, total)
			//      VALUES ('$idOutlet[$i]', '12-12-2020', '$nomorFaktur[$i]', '$kodeItem[$i]', '2', '3', '4')";
			//      mysqli_query($conn, $insert); 
			// }
			echo $pesanOk;
		}
	}else if ($itemBr == NULL) {
		echo "item baru NULL";
	}

}else{

	echo $pesanOk;
}
?>


</body>
</html>