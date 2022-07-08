<?php
require_once("PaytmKit/lib/config_paytm.php");
require_once("PaytmKit/lib/encdec_paytm.php");

// define("merchantMid", "dZlzzF17647713571019");
// Key in your staging and production MID available in your dashboard
// define("merchantKey", "O0zUdI1&G%OQViK_");
// Key in your staging and production merchant key available in your dashboard
// define("orderId", "order1");
// define("channelId", "WEB");
// define("website", "WEBSTAGING");
// define("industryTypeId", "Retail");
// define("callbackUrl", "http://127.0.0.1/devchandan/payment-using-paytm/response.php");
// define("txnAmount", "100.12");
// This is the staging value. Production value is available in your dashboard
// This is the staging value. Production value is available in your dashboard
// define("callbackUrl", "https://<Merchant_Response_URL>");




$course_id = $_SESSION['enroll'];
$user_id = $_SESSION['user_id'];
$orderId     = time();
$txnAmount     = $_SESSION['price'];
$custId     = 'ghhhf';
// $mobileNo     = $_SESSION['mobile'];

    $obj = new Database();
    $where = 'user_id =' . $user_id . ' And status = 0';
    $obj->delete('purchase', $where);
    if ($obj->insert('purchase', ['user_id' => $user_id, 'course_id' => $course_id, 'order_id' =>  $orderId])) {
        echo '<script>document.getElementById("jsform").submit();</script>';
    }



$paytmParams = array();
$paytmParams["ORDER_ID"]     = $orderId;
$paytmParams["CUST_ID"]     = $custId;
// $paytmParams["MOBILE_NO"]     = $mobileNo;
$paytmParams["EMAIL"]         = $email;
$paytmParams["TXN_AMOUNT"]     = $txnAmount;
$paytmParams["MID"]         = PAYTM_MERCHANT_MID;
$paytmParams["CHANNEL_ID"]     = PAYTM_CHANNEL_ID;
$paytmParams["WEBSITE"]     = PAYTM_MERCHANT_WEBSITE;
$paytmParams["INDUSTRY_TYPE_ID"] = PAYTM_INDUSTRY_TYPE_ID;
$paytmParams["CALLBACK_URL"] = PAYTM_CALLBACK_URL;
$paytmChecksum = getChecksumFromArray($paytmParams, PAYTM_MERCHANT_KEY);
$transactionURL = PAYTM_TXN_URL;
$transactionURL = "https://securegw-stage.paytm.in/theia/processTransaction";
// $transactionURL = "https://securegw.paytm.in/theia/processTransaction"; // for production
?>
<html>

<head>
    <title>Merchant Checkout Page</title>
</head>



<body>
    <center>
        <!-- <h1>Please do not refresh this page...</h1> -->
    </center>
    <form id="jsform" method='post' action='<?php echo $transactionURL; ?>' name='f1'>
        <?php
        foreach ($paytmParams as $name => $value) {
            echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
        }
        ?>
        <input type="hidden" name="CHECKSUMHASH" value="<?php echo $paytmChecksum ?>">
        <div class="d-grid gap-2" style="padding-right: 5%;padding-bottom:8%">
            <input id="f" type="submit" class="btn btn-primary " style="float: right;" name="submit" value="Buy" >

        </div>

</body>

</html>
<?php 
?>