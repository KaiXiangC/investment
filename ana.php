<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_POST['val']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">  
</head>
<body style="background-color: #FFF8F0;">
<div class="container">
	<div class="row w-50">
		<form action="ana.php" method="post" class="col-3 align-items-center my-2">
	    <input type='submit' class='btn btn-warning' name='a' value='基本資訊'>
	    <input type='hidden' name='val' value='<?php echo $_POST['val']; ?>'>
	  </form>
	  <form action="ana.php" method="post" class="col-3 align-items-center my-2">
	    <input type='submit' class='btn btn-success' name='b' value='綜合損益表'>
	    <input type='hidden' name='val' value='<?php echo $_POST['val']; ?>'>
	  </form>
	  <form action="ana.php" method="post" class="col-3 align-items-center my-2">
	    <input type='submit' class='btn btn-primary' name='c' value='資產負債表'>
	    <input type='hidden' name='val' value='<?php echo $_POST['val']; ?>'>
	  </form>
	  <form action="detail.php" method="post" class="col-3 align-items-center my-2">
	    <input type='submit' class='btn btn-secondary' name='back' value='返回'>
	    <input type='hidden' name='val' value='<?php echo $_POST['val']; ?>'>
	  </form>
	</div>
	
<?php
	if(isset($_POST['a'])){
		$n=$_POST['val'];
    $data1 = file_get_contents("https://mopsfin.twse.com.tw/opendata/t187ap03_L.csv");
		$rows1 = explode("\n",$data1);
		$s1 = array();
		$r1 = array();
		foreach($rows1 as $row) {
		    $s1[] = str_getcsv($row);
		}
		for($i=1;$i<count($s1);$i++){
			if(($s1[$i][1])==$n){
				$r1=$s1[$i];
				break;
			}
		}
		echo '<input class="form-control" type="text" placeholder="基本資訊" readonly>';
    echo'<table border=1 class="table table-striped table-bordered table-info">
					<tr class="table-secondary">
            <th colspan="2">'.$s1[0][0].'</th>
            <th colspan="2">'.$r1[0].'</th>
            <th colspan="2">'.$s1[0][1].'</th>
            <th colspan="2">'.$r1[1].'</th>
          </tr>
          <tr class="table-secondary">  
            <th colspan="2">'.$s1[0][4].'</th>
            <th colspan="2">'.$r1[4].'</th>
            <th colspan="2">'.$s1[0][5].'</th>
            <th colspan="2">'.$r1[5].'</th>
          </tr>
          <tr>  
            <td>'.$s1[0][2].'</td>
            <td colspan="3">'.$r1[2].'</td>
            <td>'.$s1[0][3].'</td>
            <td colspan="3">'.$r1[3].'</td>
          </tr>
          <tr>  
            <td>'.$s1[0][6].'</td>
            <td colspan="3">'.$r1[6].'</td>
            <td>'.$s1[0][13].'</td>
            <td colspan="3">'.$r1[13].'</td>
          </tr>
          <tr>  
            <td>'.$s1[0][7].'</td>
            <td>'.$r1[7].'</td>
            <td>'.$s1[0][8].'</td>
            <td>'.$r1[8].'</td>
            <td>'.$s1[0][14].'</td>
            <td>'.$r1[14].'</td>
            <td>'.$s1[0][15].'</td>
            <td>'.$r1[15].'</td>
          </tr>
          <tr class="table-warning"> 
          	<td>'.$s1[0][9].'</td>
            <td>'.$r1[9].'</td> 
            <td>'.$s1[0][10].'</td>
            <td>'.$r1[10].'</td>
            <td>'.$s1[0][11].'</td>
            <td>'.$r1[11].'</td>
            <td>'.$s1[0][12].'</td>
            <td>'.$r1[12].'</td>
          </tr>
          <tr  class="table-warning">  
            <td>'.$s1[0][17].'</td>
            <td>'.$r1[17].'</td>
            <td>'.$s1[0][18].'</td>
            <td>'.$r1[18].'</td>
            <td>'.$s1[0][19].'</td>
            <td>'.$r1[19].'</td>
            <td>'.$s1[0][16].'</td>
            <td>'.$r1[16].'</td>
          </tr>
          <tr>  
            <td>'.$s1[0][21].'</td>
            <td colspan="2">'.$r1[21].'</td>
            <td>'.$s1[0][22].'</td>
            <td>'.$r1[22].'</td>
            <td>'.$s1[0][23].'</td>
            <td colspan="2">'.$r1[23].'</td>
          </tr>
          <tr>  
            <td colspan="2">'.$s1[0][24].'</td>
            <td colspan="2">'.$r1[24].'</td>
            <td>'.$s1[0][25].'</td>
            <td>'.$r1[25].'</td>
            <td>'.$s1[0][26].'</td>
            <td>'.$r1[26].'</td>
          </tr>
          <tr>  
            <td>'.$s1[0][27].'</td>
            <td>'.$r1[27].'</td>
            <td colspan="3">'.$s1[0][28].'</td>
            <td colspan="3">'.$r1[28].'</td>
          </tr>
          <tr>  
          	<td>'.$s1[0][29].'</td>
            <td>'.$r1[29].'</td>
            <td colspan="2">'.$s1[0][30].'</td>
            <td colspan="2">'.$r1[30].'</td>
            <td>'.$s1[0][31].'</td>
            <td>'.$r1[31].'</td>
          </tr>';
    echo'</table>';
  }
  if(isset($_POST['b'])){
  	$n=$_POST['val'];
		$data2 = file_get_contents("https://mopsfin.twse.com.tw/opendata/t187ap06_L_ci.csv");
		$rows2 = explode("\n",$data2);
		$s2 = array();
		$r2 = array();
		foreach($rows2 as $row) {
		    $s2[] = str_getcsv($row);
		}
		for($i=1;$i<count($s2);$i++){
			if(($s2[$i][3])==$n){
				$r2=$s2[$i];
				break;
			}
		}
		echo '<input class="form-control" type="text" placeholder="綜合損益表" readonly>';
    echo'<table class="table table-striped table-bordered table-info">
					<tr class="table-secondary">
            <th>'.$s2[0][0].'</th>
            <th>'.$r2[0].'</th>
            <th>'.$s2[0][1].'</th>
            <th>'.$r2[1].'</th>
            <th>'.$s2[0][2].'</th>
            <th>'.$r2[2].'</th>
          </tr>
          <tr class="table-secondary">
            <th>'.$s2[0][3].'</th>
            <th>'.$r2[3].'</th>
            <th>'.$s2[0][4].'</th>
            <th colspan="3">'.$r2[4].'</th>
          </tr>
          <tr>  
            <td colspan="3">'.$s2[0][5].'</td>
            <td colspan="3">'.$r2[5].'</td>
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][6].'</td>
            <td colspan="3">'.$r2[6].'</td>           
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][9].'</td>
            <td colspan="3">'.$r2[9].'</td>           
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][10].'</td>
            <td colspan="3">'.$r2[10].'</td>            
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][11].'</td>
            <td colspan="3">'.$r2[11].'</td>           
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][12].'</td>
            <td colspan="3">'.$r2[12].'</td>            
          </tr>
          <tr>  
            <td colspan="3">'.$s2[0][13].'</td>
            <td colspan="3">'.$r2[13].'</td>
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][14].'</td>
            <td colspan="3">'.$r2[14].'</td>            
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][15].'</td>
            <td colspan="3">'.$r2[15].'</td>            
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][16].'</td>
            <td colspan="3">'.$r2[16].'</td>            
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][17].'</td>
            <td colspan="3">'.$r2[17].'</td>            
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][18].'</td>
            <td colspan="3">'.$r2[18].'</td>            
          </tr>
          <tr class="table-warning">
            <td colspan="3">'.$s2[0][22].'</td>
            <td colspan="3">'.$r2[22].'</td>            
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][23].'</td>
            <td colspan="3">'.$r2[23].'</td>            
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][25].'</td>
            <td colspan="3">'.$r2[25].'</td>            
          </tr>
          <tr>
            <td colspan="3">'.$s2[0][26].'</td>
            <td colspan="3">'.$r2[26].'</td>            
          </tr>
          <tr class="table-warning">
            <td colspan="3">'.$s2[0][32].'</td>
            <td colspan="3">'.$r2[32].'</td>            
          </tr>';
    echo'</table>';
  }
  if(isset($_POST['c'])){
  	$n=$_POST['val'];
    $data3 = file_get_contents("https://mopsfin.twse.com.tw/opendata/t187ap07_L_ci.csv");
		$rows3 = explode("\n",$data3);
		$s3 = array();
		$r3 = array();
		foreach($rows3 as $row) {
		    $s3[] = str_getcsv($row);
		}
		for($i=1;$i<count($s3);$i++){
			if(($s3[$i][3])==$n){
				$r3=$s3[$i];
				break;
			}
		}
		echo '<input class="form-control" type="text" placeholder="資產負債表" readonly>';
		echo'<table class="table table-striped table-bordered table-info">
					<tr class="table-secondary">
            <th>'.$s3[0][0].'</th>
            <th>'.$r3[0].'</th>
            <th>'.$s3[0][1].'</th>
            <th>'.$r3[1].'</th>
            <th>'.$s3[0][2].'</th>
            <th>'.$r3[2].'</th>
          </tr>
          <tr class="table-secondary">
            <th>'.$s3[0][3].'</th>
            <th>'.$r3[3].'</th>
            <th>'.$s3[0][4].'</th>
            <th colspan="3">'.$r3[4].'</th>
          </tr>
          <tr>  
            <td>'.$s3[0][5].'</td>
            <td colspan="2">'.$r3[5].'</td>
            <td>'.$s3[0][8].'</td>
            <td colspan="2">'.$r3[8].'</td>            
          </tr>
          <tr> 
            <td>'.$s3[0][6].'</td>
            <td colspan="2">'.$r3[6].'</td>
            <td>'.$s3[0][9].'</td>
            <td colspan="2">'.$r3[9].'</td>
          </tr>
          <tr> 
            <td>'.$s3[0][7].'</td>
            <td colspan="2">'.$r3[7].'</td>
            <td>'.$s3[0][10].'</td>
            <td colspan="2">'.$r3[10].'</td>
          </tr>
          <tr class="table-secondary">             
            <td>'.$s3[0][13].'</td>
            <td>'.$r3[13].'</td>
            <td>'.$s3[0][14].'</td>
            <td>'.$r3[14].'</td>
            <td>'.$s3[0][15].'</td>
            <td>'.$r3[15].'</td>
          </tr>
          <tr class="table-warning">   
            <td>'.$s3[0][16].'</td>
            <td colspan="2">'.$r3[16].'</td>
            <td>'.$s3[0][21].'</td>
            <td colspan="2">'.$r3[21].'</td>
          </tr>
          <tr class="table-warning"> 
            <td>'.$s3[0][11].'</td>
            <td colspan="2">'.$r3[11].'</td>
            <td>'.$s3[0][25].'</td>
            <td colspan="2">'.$r3[25].'</td>
          </tr>';
    echo'</table>';
	}
?>
</div>
</body>   
</html> 