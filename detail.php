<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_POST['val']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">  
</head>
<body style="background-color: #FFF8F0;">
<div class="container"> 
	<form action="ana.php" method="post" class="row align-items-center my-2 w-25">
    <input type='submit' class='btn btn-success col-4' name='history' value='報表'>
    &nbsp;<a href="stock.php" class="btn btn-secondary col-4">返回</a>
    <input type='hidden' class='btn btn-success col-4' name='val' value='<?php echo $_POST['val']; ?>'>
  </form>
<?php
	if(isset($_POST['val'])){
		$n=$_POST['val'];
    $data = file_get_contents("https://www.twse.com.tw/exchangeReport/STOCK_DAY_AVG_ALL?response=open_data");
		$rows = explode("\n",$data);
		$s = array();
		$r = array();
		foreach($rows as $row) {
		    $s[] = str_getcsv($row);
		}
		for($i=1;$i<count($s);$i++){
			if(($s[$i][0])==$n){
				$r=$s[$i];
				break;
			}
		}
		echo '<input class="form-control" type="text" placeholder="盤後資訊" readonly>';
		echo'<table class="table table-striped table-bordered table-info">
					<tr>
            <th>'.$s[0][0].'</th>
            <th>'.$s[0][1].'</th>
            <th>'.$s[0][2].'</th>
            <th>'.$s[0][3].'</th>
          </tr>';
		echo'<tr>';
		foreach($r as $key => $val){
            echo '<td>'.$val.'</td>';
    }
    echo'<tr>';
    echo'</table>';

    $data2 = file_get_contents("https://www.twse.com.tw/exchangeReport/TWT53U?response=open_data");
		$rows2 = explode("\n",$data2);
		$s2 = array();
		$r2 = array();
		foreach($rows2 as $row) {
		    $s2[] = str_getcsv($row);
		}
		for($i=1;$i<count($s2);$i++){
			if(($s2[$i][0])==$n){
				$r2=$s2[$i];
				break;
			}
		}
		echo '<input class="form-control" type="text" placeholder="零股交易行情" readonly>';
		echo'<table class="table table-striped table-bordered table-info">
					<tr>
            <th>'.$s2[0][2].'</th>
            <th>'.$s2[0][3].'</th>
            <th>'.$s2[0][4].'</th>
            <th>'.$s2[0][5].'</th>
            <th>'.$s2[0][6].'</th>
            <th>'.$s2[0][7].'</th>
            <th>'.$s2[0][8].'</th>
            <th>'.$s2[0][9].'</th>
          </tr>
          <tr>
            <td>'.$r2[2].'</td>
            <td>'.$r2[3].'</td>
            <td>'.$r2[4].'</td>
            <td>'.$r2[5].'</td>
            <td>'.$r2[6].'</td>
            <td>'.$r2[7].'</td>
            <td>'.$r2[8].'</td>
            <td>'.$r2[9].'</td>
          </tr>
        </table>';

    $data3 = file_get_contents("https://www.twse.com.tw/exchangeReport/BWIBBU_d?response=open_data");
		$rows3 = explode("\n",$data3);
		$s3 = array();
		$r3 = array();
		foreach($rows3 as $row) {
		    $s3[] = str_getcsv($row);
		}
		for($i=1;$i<count($s3);$i++){
			if(($s3[$i][0])==$n){
				$r3=$s3[$i];
				break;
			}
		}
		echo '<input class="form-control" type="text" placeholder="日本益比、殖利率及股價淨值比" readonly>';
		echo'<table class="table table-striped table-bordered table-info">
					<tr>
            <th>'.$s3[0][2].'</th>
            <th>'.$s3[0][3].'</th>
            <th>'.$s3[0][4].'</th>
            <th>'.$s3[0][5].'</th>
            <th>'.$s3[0][6].'</th>
          </tr>
          <tr>
            <td>'.$r3[2].'</td>
            <td>'.$r3[3].'</td>
            <td>'.$r3[4].'</td>
            <td>'.$r3[5].'</td>
            <td>'.$r3[6].'</td>
          </tr>
        </table>';

    $data4 = file_get_contents("https://www.twse.com.tw/exchangeReport/TWT48U_ALL?response=open_data");
		$rows4 = explode("\n",$data4);
		$s4 = array();
		$r4 = array();
		foreach($rows4 as $row) {
		    $s4[] = str_getcsv($row);
		}
		for($i=1;$i<count($s4);$i++){
			if(($s4[$i][1])==$n){
				$r4=$s4[$i];
				break;
			}
			else{
				$r4=null;
			}
		}
		if(count($r4)!=0){
		echo '<input class="form-control" type="text" placeholder="除權除息" readonly>';
		echo'<table class="table table-striped table-bordered table-info">
					<tr>
            <th>'.$s4[0][0].'</th>
            <th>'.$s4[0][3].'</th>
            <th>'.$s4[0][7].'</th>
          </tr>
          <tr>
            <td>'.$r4[0].'</td>
            <td>'.$r4[3].'</td>
            <td>'.$r4[7].'</td>
          </tr>
        </table>';
		}
	}
?>
</div>
</body>   
</html> 