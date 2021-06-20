<?php
    $selt="";
    $url1 = "https://api.tej.com.tw/api/datatables/TRAIL/AIND.xml?opts.columns=tejind3_c&api_key=xtzrFPP2hos1q5eOMhYuSDM421IwRT";
    $data1 = file_get_contents("compress.zlib://".$url1);
    $xml1 = simplexml_load_string($data1);
    $cs = array();
    foreach($xml1 as $key => $val){
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_POST['sel']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body style="background-color: #FFF8F0;">
<div class="container"> 
    <form action="stock.php" method="post" class="row align-items-center my-2">
        <div class="col-2 text-center">
            產業別查詢：
        </div>
        <div class="col-3">
        <select name="sel" class="form-select">
            <option>請選擇</option>
        <?php 
            foreach($e as $key2 => $val2){
                foreach($val2 as $key3 => $selt) {           
                    echo "<option value='$selt'>".$selt."</option>";
                }
            } 
        ?>           
        </select>
        </div>
        <div class="col-4">
        <input type='submit' class='btn btn-success' name='submit' value='查詢'>
        &nbsp;<a href="index.html" class="btn btn-secondary">返回</a>
        </div>
    </form>
    <br>     
<?php
    if(isset($_POST['submit'])){
        $selt=$_POST['sel'];
        $f= urlencode($selt);
        $url = "https://api.tej.com.tw/api/datatables/TRAIL/AIND.xml?tejind3_c=".$f."&opts.columns=inamec,mkt,elist_day1,tseid&api_key=xtzrFPP2hos1q5eOMhYuSDM421IwRT";
        $data = file_get_contents("compress.zlib://".$url);
        $xml = simplexml_load_string($data);

        $items = array();
        foreach($xml as $key => $val){
            foreach($val as $key1 => $val1) {
                $items[] = $val1;
            }
        }
        echo '<input class="form-control" type="text" placeholder="產業別：'.$selt.'" readonly>';
        echo'<table class="table table-striped table-bordered">
            <tr>
                <th>公司簡稱</th>
                <th>上市別</th>
                <th>上市日</th>
                <th>代碼</th>
            </tr>';

        foreach($items[0] as $key2 => $val2) {
            echo'<tr>';
            foreach($val2 as $key3 => $val3) {
                if($val3=='TSE'){
                    echo '<td style="background-color: #bbeeaa">上市</td>';
                }
                elseif($val3=='OTC'){
                    echo '<td style="background-color: #eeff99">上櫃</td>';
                }
                elseif($val3==''){
                    echo '<td style="color: red"><b>下市/下櫃</b></td>';
                }
                elseif($val3=='ROTC'){
                    echo '<td style="background-color: #ffdddd">興櫃</td>';
                }
                elseif($val3=='GISA'){
                    echo '<td style="background-color: #ddaa11">創櫃</td>';
                }
                elseif(strlen($val3)==4){
                    echo '<td><form action="detail.php" method="post"><input type="submit" class="btn" name="val" value='.$val3.'></form></td>';
                }
                else{
                    echo '<td>'.$val3.'</td>';
                }
            }
            echo'</tr>';
        }
        echo'</table>';
    }
?>
</div>
</body>   
</html> 