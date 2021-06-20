<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>近期上市公司</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">  
</head>
<body style="background-color: #FFF8F0;">
<div class="container"> 
<?php
    $data = file_get_contents("https://www.twse.com.tw/company/newlisting?response=open_data");
		$rows = explode("\n",$data);
		$s = array();
		foreach($rows as $row) {
		    $s[] = str_getcsv($row);
		}
		echo '<input class="form-control" type="text" placeholder="近期上市公司" readonly>';
		echo'<table class="table table-striped table-bordered table-info">';
		foreach($s as $key => $v){
			echo'<tr>';
			foreach($v as $k => $val){
	      echo '<td>'.$val.'</td>';
	    }
	    echo'<tr>';
	  }
    echo'</table>';
?>
</div>
</body>   
</html> 