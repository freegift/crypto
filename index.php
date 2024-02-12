<?php
//test();
//btc_price();
$current_price = btc_price2();

function test() {

    $host = "https://api.binance.com";
    $api_key = "GqgspD9MpRz3Sb29Yo2LWN7fBuFIZHFAq9NI20dTtqmhFNc3inZbIaq1sUi4TtiT";
    $secret_key = "GcMrdXr211TrsAEL4RtpFhj5UK1vMrKfsRP59f92sTLNxfBIJPYSRzzpW8FJgx9D";

    $data = array();
    $data['timestamp'] = time()*1000;
//    $data['recvWindow'] = 1000;

    $signature = hash_hmac("sha256", http_build_query($data), $secret_key);
    $post_data = http_build_query($data). "&signature=".$signature;
    echo $post_data;

    $ch = curl_init($host . '/api/v3/account');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'X-MBX-APIKEY:'.$api_key));
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    var_dump($result);
    if (curl_error($ch)){
        echo curl_error($ch);
    }

    curl_close($ch);
    echo $result;
    $response = json_decode($result, true);
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
    /*if (is_array($response) && $response['result']=="SUCCESS" && $response['session']['id']!="" ){
        echo $response["session"]["id"];
    }*/
}

function get_server_time() {
    $host = "https://api.binance.com";
    $ch = curl_init($host . '/api/v3/time');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    var_dump($result);
    if (curl_error($ch)){
        echo curl_error($ch);
    }

    curl_close($ch);
    //echo $result;
    $response = json_decode($result, true);
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
}

function btc_price() {
    $host = "https://api.binance.com";
    $ch = curl_init($host . '/api/v3/avgPrice?symbol=BTCUSDT');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    var_dump($result);
    if (curl_error($ch)){
        echo curl_error($ch);
    }

    curl_close($ch);
    //echo $result;
    $response = json_decode($result, true);
    echo '<pre>';
    var_dump($response);
    echo '</pre>';
    /*if (is_array($response) && $response['result']=="SUCCESS" && $response['session']['id']!="" ){
        echo $response["session"]["id"];
    }*/
}
function btc_price2() {
    $host = "https://api.binance.com";
    $ch = curl_init($host . '/api/v3/ticker/price?symbol=BTCUSDT');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    //var_dump($result);
    if (curl_error($ch)){
        echo curl_error($ch);
    }

    curl_close($ch);
    //echo $result;
    $response = json_decode($result, true);
    echo '<pre>';
    //var_dump($response);
    echo '</pre>';
    if (is_array($response) && $response['price']!="" ){
        return $response['price'];
    }
}
?>

<div style="width: 500px;">
    <h3>Chart</h3>
    <?php include_once 'chart.php';?>
</div>
<div style="width: 500px;">
    <h3>Market</h3>
    <?php include_once 'market.php';?>
</div>


<h3>Trade</h3>
<!--<form method="post" action="">-->
Balance: $200
    <table border="1" style="width: 500px;" cellpadding="3">
        <tr>
            <td>Symbol</td>
            <td>BTCUSDT</td>
        </tr>
         <tr>
            <td>Price</td>
            <td><?php echo $current_price;?></td>
        </tr>
        <tr>
            <td>Duration</td>
            <td>
                <input id="pay-amount" name="pay-amount" type="radio" value="5.00"/>
                <label for="">30 secs (90% income)</label><br/>
                <input id="pay-amount" name="pay-amount" type="radio" value="10.00"/>
                <label for="">60 secs (80% income)</label><br/>
                <input id="pay-amount" name="pay-amount" type="radio" value="20.00"/>
                <label for="">90 secs (70% income)</label><br/>
                <input id="pay-amount" name="pay-amount" type="radio" value="20.00"/>
                <label for="">120 secs (60% income)</label><br/>
            </td>
        </tr>        
        <tr>
            <td>Amount$</td>
            <td><input id="pay-amount" name="pay-amount" type="number" value="5.00"/></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input id="btnSubmit" name="transaction_id" type="button" value="Up" onclick="Checkout.showPaymentPage();"/> ~ 
                <input id="btnSubmit" name="transaction_id" type="button" value="Down" onclick="Checkout.showPaymentPage();"/>
            </td>
        </tr>
        <tr>
            <td>Income</td>
            <td><div>$190<?php echo $current_price;?></div></td>
        </tr>
        
    </table>
<!--</form>-->
<br><!-- comment -->
<h3>Home | Markets | Trades | Investments | Assets</h3>
<strong>Assets</strong> - Deposit, Withdraw, Transfer, Buy, Sell, P2P, PayBills<br>

<br><!-- comment -->