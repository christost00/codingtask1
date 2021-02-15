<?php
//Get temperature from openweathermap api
$Url = "";


//Open connection
$ch = curl_init();


//handling data

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $Url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//Getting Results
$response1 = curl_exec($ch);

//Closing Connection
curl_close($ch);

//Decoding data
$data = json_decode($response1);
$currentTime = time();

//Asign temperature to a variable
$tempk = $data->main->temp;


//Convert temperature from Kelvin to Celsius

$tempc = $tempk - 273.15;




//Handling the temperature response
if (tempc>20) {
  $tempg = "Temperature more than 20C." .$tempc."C";
} else {
  $tempg = "Temperature less than 20C." .$tempc."C";
}










//--Sending Sms from Api


//Opening connection
$curl = curl_init();
//using an associative array to send data
curl_setopt_array($curl, array(
  CURLOPT_URL => "URL",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{ \"body\": \"$tempg\",\"to\" : \"+30000000000\",\"from\": \"Sender\"}",
  CURLOPT_HTTPHEADER => array(
    "authorization: ",
    "content-type: application/json"
  ),
));


//Getting data
$response2 = curl_exec($curl);
$err = curl_error($curl);

//Closing connection
curl_close($curl);

//Error handling and getting response
if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response2;
}
?>
