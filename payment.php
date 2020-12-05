
<?php

$orderId=time();
$orderAmount=$_POST['order__amount'];
$customerName=$_POST['customer_name'];
$customerEmail=$_POST['customer_email'];
$customerPhone=$_POST['customer_phone'];
$orderCurrency="INR";
$orderNote=$_POST['order__note'];
$returnUrl="https://myknotpvt.herokuapp.com/return.php";

$notifyUrl="";

$orderDetails=array();

$orderDetails["orderId"]=$orderId;
$orderDetails["orderAmount"]=$orderAmount;
$orderDetails["customerName"]=$customerName;
$orderDetails["customerEmail"]=$customerEmail;
$orderDetails["customerPhone"]=$customerPhone;
$orderDetails["orderCurrency"]=$orderCurrency;
$orderDetails["orderNote"]=$orderNote;
$orderDetails["returnUrl"]=$returnUrl;
$orderDetails["notifyUrl"]=$notifyUrl;
$orderDetails["appId"]="16659e73fe0b71d24294caa1695661";
$orderDetails["signature"]=getSignature($orderDetails);

// echo json_encode($orderDetails);

function getSignature($postData)
{
  
  $secretKey = "348a00ab3ee5b662f0122897e3c7bfbf4082ddf2";
  ksort($postData);
  $signatureData = "";
  foreach ($postData as $key => $value){
       $signatureData .= $key.$value;
  }
  $signature = hash_hmac('sha256', $signatureData, $secretKey,true);
  $signature = base64_encode($signature);
  return $signature;
}



?>
 
<!-- //http://localhost/myKnot-gh-pages/payment.php -->

<form id="redirectForm" method="post" action="https://test.cashfree.com/billpay/checkout/post/submit">
    <input type="hidden" name="appId" value="<?php echo $orderDetails["appId"] ?>"/>
    <input type="hidden" name="orderId" value="<?php echo $orderDetails["orderId"] ?>"/>
    <input type="hidden" name="orderAmount" value="<?php echo $orderDetails["orderAmount"] ?>"/>
    <input type="hidden" name="orderCurrency" value="<?php echo $orderDetails["orderCurrency"] ?>"/>
    <input type="hidden" name="orderNote" value="<?php echo $orderDetails["orderNote"] ?>"/>
    <input type="hidden" name="customerName" value="<?php echo $orderDetails["customerName"] ?>"/>
    <input type="hidden" name="customerEmail" value="<?php echo $orderDetails["customerEmail"] ?>"/>
    <input type="hidden" name="customerPhone" value="<?php echo $orderDetails["customerPhone"] ?>"/>
    <input type="hidden" name="returnUrl" value="<?php echo $orderDetails["returnUrl"] ?>"/>
    <input type="hidden" name="notifyUrl" value="<?php echo $orderDetails["notifyUrl"] ?>"/>
    <input type="hidden" name="signature" value="<?php echo $orderDetails["signature"] ?>"/>
  </form>
  <script>document.getElementById("redirectForm").submit();</script>
