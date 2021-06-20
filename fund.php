<?php
		$etf="";
		$d=0;
		$curl = "https://api.tej.com.tw/api/datatables/TRAIL/TANAV.xml?opts.columns=coid&api_key=xtzrFPP2hos1q5eOMhYuSDM421IwRT";
		$cdata = file_get_contents("compress.zlib://".$curl);
    $cxml = simplexml_load_string($cdata);
    $cs = array();
    foreach($cxml as $key => $val){
        foreach($val as $key1 => $val1) {
            $cs[] = $val1;
        }
    }
    $c = array();
    foreach($cs[0] as $key2 => $val2) {
        foreach($val2 as $key3 => $val3) {           
            $c[] = $val3;
        }
    }
    $e = array();
    $e[] = array_unique($c);
    if(isset($_POST['etf'])){
	    $curr=$_POST['curr'];
	    $cur = "https://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
			$curdata = file_get_contents("compress.zlib://".$cur);
	    $curxml = simplexml_load_string($curdata);
	    $curs = array();
	    $curs1 = array();
	    foreach($curxml as $key => $val){
	        foreach($val as $key1 => $val1) {
	            $curs[] = $val1;
	        }
	    }
	    foreach($curs[0] as $key => $val){
	    	$curs1[] = $val;
	    }
	    if($curr=='NTW'){
	    		$d=33;
	    }else{
	    	for($i=0;$i<count($curs1);$i++){
		    	if($curs1[$i]['currency']==$curr){
		    		$d=$curs1[$i]['rate'];
		    		break;
		    	}
		    }
	    }
	    
	  }
	if(isset($_POST['submit'])){
		$selt=$_POST['selt'];
		$etf=$selt;
		$d=$_POST['curr'];

    $url1 = "https://api.tej.com.tw/api/datatables/TRAIL/TANAV.xml?coid=".$etf."&opts.columns=mdate&api_key=xtzrFPP2hos1q5eOMhYuSDM421IwRT";
		$url = "https://api.tej.com.tw/api/datatables/TRAIL/TANAV.xml?coid=".$etf."&opts.columns=fld004&api_key=xtzrFPP2hos1q5eOMhYuSDM421IwRT";
    $data = file_get_contents("compress.zlib://".$url);
    $xml = simplexml_load_string($data);
    $data1 = file_get_contents("compress.zlib://".$url1);
    $xml1 = simplexml_load_string($data1);
    $items = array();
    $items1 = array();

    foreach($xml as $key => $val){
        foreach($val as $key1 => $val1) {
            $items[] = $val1;
        }
    }
    $item = array();
    foreach($items[0] as $key2 => $val2) {
        foreach($val2 as $key3 => $val3) {           
            $item[] = $val3;
        }
    }

    foreach($xml1 as $key => $val){
        foreach($val as $key1 => $val1) {
            $items1[] = $val1;
        }
    }
    $item1 = array();
    foreach($items1[0] as $key2 => $val2) {
        foreach($val2 as $key3 => $val3) {           
            $item1[] = $val3;
        }
    }

    $data3 = file_get_contents("https://www.twse.com.tw/exchangeReport/STOCK_DAY_ALL?response=open_data");
		$rows3 = explode("\n",$data3);
		$s3 = array();
		$r3 = array();
		foreach($rows3 as $row) {
		    $s3[] = str_getcsv($row);
		}
		for($i=1;$i<count($s3);$i++){
			if(($s3[$i][0])==$etf){
				$r3=$s3[$i];
				break;
			}
		}
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $etf; ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
<script>
	var value = [];
	var date = [];

  var a = JSON.parse('<?php echo json_encode($item); ?>');
    for(var i=0; i<a.length; i++){
        value.push(a[i][0]*0.03*<?php echo ($d); ?>);
    }
  var b = JSON.parse('<?php echo json_encode($item1); ?>');
    for(var i=0; i<b.length; i++){
        date.push(b[i][0]);
    }

	var lineChartData = {
	    labels: date, //顯示區間名稱
	    datasets: [{
	        label: '淨值(元)', // tootip 出現的名稱
	        lineTension: 0, // 曲線的彎度，設0 表示直線
	        backgroundColor: "#29b288",
        	borderColor: "#29b288",
	        borderWidth: 3,
		      data: value, // 資料
	        fill: false, // 是否填滿色彩
	    },]
	};
	function drawLineCanvas(ctx,data) {
	    window.myLine = new Chart(ctx, {  //先建立一個 chart
	        type: 'bar', // 型態
	        data: data,
	        options: {
	                responsive: true,
	                legend: { //是否要顯示圖示
	                    display: true,
	                },
	                tooltips: { //是否要顯示 tooltip
	                    enabled: true
	                },
	                scales: {  //是否要顯示 x、y 軸
	                    xAxes: [{
	                        display: false
	                    }],
	                    yAxes: [{
	                        display: true
	                    }]
	                },
	            }
	    });
	};
	window.onload = function () {
	    var ctx = document.getElementById("canvas");
	    drawLineCanvas(ctx,lineChartData);
	};
</script>
<body style="background-color: #FFF8F0;">
<div class="container">
	<div class="row align-items-center my-2">
		<div class="col-4">
			<input class="form-control" type="text" placeholder="基金代碼：<?php echo "$etf" ?>" readonly>
		</div>
		<form action="fund.php" method="post" class="row col-6">
	    <div class="col-4">
				<select class="form-control form-select" name="selt">
					<option>請選擇</option>
					<?php
						foreach($e as $key2 => $val2){
							foreach($val2 as $key3 => $selt) {           
			          echo "<option value=".$selt.">".$selt."</option>";
			        }
						}
					?>
				</select>
			</div>
			<div class="col-4">
	      <input type='submit' class='btn btn-success' name='submit' value='查詢'>
	      <input type='hidden' name='curr' value='<?php echo $d; ?>'>
	      &nbsp;<a href="index.html" class="btn btn-secondary">返回</a>
	    </div>
		</form>
	</div>
	<hr>
	<div>
	<?php
		if(isset($s3)){
		echo '<input class="form-control" type="text" placeholder="日成交資訊" readonly>';
		echo'<table class="table table-striped table-bordered table-info">
					<tr>
						<th>'.$s3[0][1].'</th>
            <th>'.$s3[0][2].'</th>
            <th>'.$s3[0][3].'</th>
            <th>'.$s3[0][4].'</th>
            <th>'.$s3[0][5].'</th>
            <th>'.$s3[0][6].'</th>
            <th>'.$s3[0][7].'</th>
            <th>'.$s3[0][8].'</th>
            <th>'.$s3[0][9].'</th>
          </tr>
          <tr>
          	<td>'.$r3[1].'</td>
            <td>'.$r3[2].'</td>
            <td>'.($r3[3]*0.03*$d).'</td>
            <td>'.($r3[4]*0.03*$d).'</td>
            <td>'.($r3[5]*0.03*$d).'</td>
            <td>'.($r3[6]*0.03*$d).'</td>
            <td>'.($r3[7]*0.03*$d).'</td>
            <td>'.$r3[8].'</td>
            <td>'.$r3[9].'</td>
          </tr>
        </table>';
      }
  ?>
	</div>
	<canvas id="canvas"></canvas>
</div>

</body>
</html>