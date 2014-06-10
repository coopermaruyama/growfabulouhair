<?php 
// ini_set('display_errors', true);
// error_reporting(E_ALL);
extract($_POST);

$sdkConfig = array(
	"mode" => "sandbox"
);

$pageurl = "https://api.paypal.com/v1/oauth2/token";
$ch = curl_init($pageurl);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "AasvuxCNqCJrjKAoEPDHBbUEAYG6goDW5_YkfAvuwr9z-NPn-ThfhZUOGANL:EIUCCRBcd8W5p3KkhKgi1XM3oOe0fp-tXp4FiiKTqbmahJ8AHKzkx_zTFKRc");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$output = curl_exec($ch);


$json = json_decode($output, true);
$access_token = $json['access_token'];


$payment_url = "https://api.paypal.com/v1/payments/payment";
$data = array();
$data_string = json_encode($data);

$ch_payment = curl_init($payment_url);
curl_setopt($ch_payment, CURLOPT_HTTPHEADER, array('Content-Type:application/json', "Authorization: Bearer $access_token"));
curl_setopt($ch_payment, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_payment, CURLOPT_POSTFIELDS, '{
  "intent":"sale",
  "payer":{
    "payment_method":"credit_card",
    "payer_info": {
		"email": "'.$email.'"
    },
    "funding_instruments":[
      {
        "credit_card":{
          "type":"'.$card_type.'",
          "number":"'.$credit_card_number.'",
          "expire_month":"'.$cc_expiration_month.'",
          "expire_year":"'.$cc_expiration_year.'",
          "first_name":"'.$payment_first_name.'",
          "last_name":"'.$payment_last_name.'"
        }
      }
    ]
  },
  "transactions":[
    {
        "amount":{
        "total":"79.99",
        "currency":"USD"
      },
      "description":"creating a direct payment with credit card"
    }
  ]
}' );

$output_payment = curl_exec($ch_payment);
$json_response = json_decode($output_payment);


if ( $json_response->name == "VALIDATION_ERROR" ) { //validation error has occurred
	$invalid_field = $json_response->details[0]->field;
	header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
	echo json_encode($json_response->details);
} elseif ($json_response->state != "approved") {
  header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
  echo $output_payment;

} else {
	echo $output_payment;
}

 ?>