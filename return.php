<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <?php  
 $orderId = $_POST["orderId"];
 $orderAmount = $_POST["orderAmount"];
 $referenceId = $_POST["referenceId"];
 $txStatus = $_POST["txStatus"];
 $paymentMode = $_POST["paymentMode"];
 $txMsg = $_POST["txMsg"];
 $txTime = $_POST["txTime"];
 $signature = $_POST["signature"];
 $data = $orderId.$orderAmount.$referenceId.$txStatus.$paymentMode.$txMsg.$txTime;
 $secretkey="348a00ab3ee5b662f0122897e3c7bfbf4082ddf2";
 $hash_hmac = hash_hmac('sha256', $data, $secretkey, true) ;
 $computedSignature = base64_encode($hash_hmac);
 if ($signature == $computedSignature) {
    echo "<h1 style='text-align:center;'>Succesfully purchased, Check your mail </h1>";
  } else {
    echo "<h1>Unsuccesfully try again</h1>";
 }
 header( "refresh:5;url=https://myknotpvt.herokuapp.com/index.html#services" );
 ?>
 <div style="text-align:center;">
     <h2 >Redirecting back to services in <span id="counter">5</span> second(s)</h2>
</div>
    <script>
     function countdown() {
    var i = document.getElementById('counter');
    
   if (parseInt(i.innerHTML)!=0) {
    i.innerHTML = parseInt(i.innerHTML)-1;
   }
}
setInterval(function(){ countdown(); },1000);
        </script>
</body>
</html>


<script type="text/javascript">

</script>
