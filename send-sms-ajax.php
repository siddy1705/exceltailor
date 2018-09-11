<?php
// ob_start();
require_once './config/config.php';

$number = $_POST['number'];
$message = $_POST['message'];

$url = "http://173.45.76.227/send.aspx?username=excel&pass=excel&route=trans1&senderid=EXCELL&numbers=" . $number . "&message=";
echo $url;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url . curl_escape($curl, $message),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo json_encode($response);
}