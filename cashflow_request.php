<?php
    require('controller/Dbconnection.php');
    date_default_timezone_set("Asia/Manila");
    session_start();
    use Dompdf\Dompdf; 
    use Dompdf\Options;
    require 'dompdf/autoload.inc.php'; 
    $option = new Options();
    $option->set('chroot', realpath(''));
    $dompdf = new Dompdf($option);
    ob_start();
    if(isset($_SESSION['category'])&&isset($_SESSION['start'])&&isset($_SESSION['end'])){
        $category = $_SESSION['category'];
        $start_date = $_SESSION['start'];
        $end_date = $_SESSION['end'];

        try {
            $sql_query = mysqli_query($connect, "SELECT cin.cashin_date as trans_date, 'cashin' as trans_type ,CONCAT(u.firstname, ' ',u.lastname) as name, cin.ref_num as references_num, cin.cashin_amount as amount FROM cashin_tb as cin INNER JOIN user_tb as U ON u.user_id = cin.user_id UNION ALL SELECT cout.cashout_date as trans_date, 'cashout', t.firstname_teller, cout.cashout_refnum, cout.cashout_amount FROM cashout_tb as cout INNER JOIN telleruser_tb as t ON t.teller_id = cout.teller_id WHERE cout.cashout_status = 'accepted' ORDER BY trans_date DESC");
        } catch (\Throwable $th) {
            echo $th;
        }
        if(mysqli_num_rows($sql_query)!=0){
            $data_result = array();
            $balance_amount = 0;
            while($row = mysqli_fetch_assoc($sql_query)){
                if($row['trans_type']=='cashin'){
                    $balance_amount = $row['amount'] + $balance_amount;
                    $data_result[] = array('trans_type' => $row['trans_type'], 'trans_date' => $row['trans_date'], 'amount' => $row['amount'], 'references_num' => $row['references_num'], 'name'=>$row['name'], 'balance_amount' => $balance_amount);
                }elseif($row['trans_type']=='cashout'){
                    $balance_amount = $balance_amount-$row['amount'];
                    $data_result[] = array('trans_type' => $row['trans_type'], 'trans_date' => $row['trans_date'], 'amount' => $row['amount'], 'references_num' => $row['references_num'], 'name'=>$row['name'], 'balance_amount' => $balance_amount);
                }
            }
        }

        function getStartingBalance($endDate, $connect){
            try {
                $query = mysqli_query($connect,"SELECT cin.cashin_date as trans_date, 'cashin' as trans_type ,u.firstname as name, cin.ref_num as references_num, cin.cashin_amount as amount FROM cashin_tb as cin INNER JOIN user_tb as U ON u.user_id = cin.user_id WHERE CAST(cin.cashin_date AS DATE) < '$endDate' UNION ALL SELECT cout.cashout_date as trans_date, 'cashout', t.firstname_teller, cout.cashout_refnum, cout.cashout_amount FROM cashout_tb as cout INNER JOIN telleruser_tb as t ON t.teller_id = cout.teller_id WHERE cout.cashout_status = 'accepted' AND CAST(cout.cashout_date AS DATE) < '$endDate' ORDER BY trans_date DESC;");
                $cashin = 0;
                $cashout = 0;
                while($row = mysqli_fetch_assoc($query)){
                    if($row['trans_type']=='cashin'){
                        $cashin = $row['amount']+$cashin;
                    }elseif($row['trans_type']=='cashout'){
                        $cashout = $cashout+$row['amount'];
                    }
                }
            } catch (\Throwable $th) {
                echo $th;
            }
            return $cashin - $cashout;
        }
        
        function getDateRange($start, $end, $format = 'Y-m-d'){
            $date_range = array();
            $set_startDate = strtotime($start);
            $set_endDate = strtotime($end);
            while($set_startDate<=$set_endDate){
                $date_range[] = date('Y-m-d', $set_startDate);
                $set_date = date_create($start);
                date_add($set_date, date_interval_create_from_date_string('1 day'));
                $start = date_format($set_date, 'Y-m-d');
                $set_startDate = strtotime(date_format($set_date, 'Y-m-d'));
            }
            return $date_range;
        }

        function getDisplayData($setOfdate, $alldata){
            $data_display = array();
            for($x=0;$x<count($setOfdate);$x++){
                for($i=0;$i<count($alldata);$i++){
                    $date_string = strtotime(($alldata[$i])['trans_date']);
                    $arrayAllDate = date('Y-m-d', $date_string);
                    if($arrayAllDate==$setOfdate[$x]){
                        $data_dateDisplay = strtotime(($alldata[$i])['trans_date']);
                        $display_date = date('Y-m-d h:i A', $data_dateDisplay);
                        $data_display[] = array('type'=>($alldata[$i])['trans_type'], 'amount'=>($alldata[$i])['amount'], 'date'=>$display_date, 'name'=>($alldata[$i])['name'], 'ref_num'=>($alldata[$i])['references_num'], 'balance'=>($alldata[$i])['balance_amount']); 
                    }
                }
            }
            return $data_display;
        }  
        
        $date_range = getDateRange($start_date, $end_date);
        $dataDisplay = getDisplayData($date_range, $data_result);
        $startBalance = getStartingBalance($end_date, $connect);
        // http://localhost/finalcapstone/cashflow_request.php?category=All&&start=2024-01-01&&end=2024-01-06
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash flow</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            padding: 5%;
            font-family: 'Trebuchet MS', sans-serif;
        }
        .header-content{
            display: flex;
            flex-direction: column;
            text-align: center;
        }
        h3, .current-date{
            display: inline-block; 
        }
        h3{
            margin-right: -100px;
        }
        .current-date{
            float: right;
        }
        .bcc-logo{
            max-width: 15%;
        }
        .report-label{
            font-weight: 700;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table > thead> th{
            text-align: center;
        }
        table, th, td, tr{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="header-content">
            <div class="header-label">
                <h3>BCC Digital Payment System</h3>
                <div class="current-date"><?=date("Y-m-d") ?></div>
            </div>
            <img src="image/bcc_logo.png" class="bcc-logo">
            <div class="report-label">
                Cash Flow Transaction History
            </div>
            <p class="report-info">
                Cashier Statement of Account
            </p>
            <p class="state">
                (<?=($category=='All')?'Cash In and Cash Out':$category ?>)
            </p>
            <p class="date-range">
                <?=$start_date." to ".$end_date ?>
            </p>
        </div>
        <div class="table-info">
            <table id="table_result">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Description</th>
                        <th>Reference #</th>
                        <th>Cash In</th>
                        <th>Cash Out</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$start_date ?></td>
                        <td>Starting Balance</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?=$startBalance.".00" ?></th>
                    </tr>
                    <?php
                    $ending_balance = 0;
                    $total_cashin = 0;
                    $total_cashout = 0;
                    for($y=0;$y<count($dataDisplay);$y++){?>
                        <?php if(($category=='All'||$category=='Cashin')&&($dataDisplay[$y])['type']=='cashin'){?>
                            <tr>
                                <td><?=($dataDisplay[$y])['date'] ?></td>
                                <td>Received payment for Cash In to <?=($dataDisplay[$y])['name'] ?></td>
                                <td><?=($dataDisplay[$y])['ref_num'] ?></td>
                                <td><?=($dataDisplay[$y])['amount'].".00" ?></td>
                                <td></td>
                                <td><?=($dataDisplay[$y])['amount']+$startBalance.".00" ?></td>
                            </tr>
                        <?php 
                            $startBalance=($dataDisplay[$y])['amount']+$startBalance; 
                            $total_cashin = ($dataDisplay[$y])['amount']+$total_cashin;
                            }else if(($category=='All'||$category=='Cashout')&&($dataDisplay[$y])['type']=='cashout'){?>
                            <tr>
                                <td><?=($dataDisplay[$y])['date'] ?></td>
                                <td><?=($dataDisplay[$y])['name'] ?> sent payment for Cashout</td>
                                <td><?=($dataDisplay[$y])['ref_num'] ?></td>
                                <td></td>
                                <td><?=($dataDisplay[$y])['amount'].".00" ?></td>
                                <td><?=$startBalance-($dataDisplay[$y])['amount'].".00" ?></td>
                            </tr>
                        <?php
                            $total_cashout = ($dataDisplay[$y])['amount']+$total_cashout;
                            $startBalance=$startBalance-($dataDisplay[$y])['amount']; }
                            $ending_balance = $startBalance;
                            ?>    
                    <?php } ?>
                    <tr>
                        <td><?=$end_date ?></td>
                        <td>ENDING BALANCE</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?=$ending_balance.".00" ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Total Cash In</td>
                        <td></td>
                        <td><?=$total_cashin.".00" ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Total Cash Out</td>
                        <td></td>
                        <td></td>
                        <td><?=$total_cashout.".00" ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
    $html = ob_get_clean();
    $dompdf->loadHtml($html); 
    $dompdf->setPaper('A4', 'Portrait'); 
    $dompdf->set_option('defaultMediaType', 'all');
    $dompdf->set_option('isFontSubsettingEnabled', true);
    $dompdf->render(); 
    $dompdf->stream('cashflow', array("Attachment" => 0));
}else{
    header('location: signin.php');
}
?>





