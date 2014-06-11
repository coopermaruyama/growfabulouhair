<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);

require $_SERVER['DOCUMENT_ROOT']."/lib/stripe-php/Stripe.php";
extract($_POST);
error_log(basename(__FILE__).' -> POST = '.print_r($_POST, true));

$metadata = array_intersect_key($_POST, array('order_id' => 1, 'first_name' => 1, 'last_name' => 1, 'email' => 1, 'total' => 1));
error_log('metadata: '.print_r($metadata, true));

if (isset($_POST['stripe_token'])) {
    Stripe::setApiKey("sk_test_JsbjJK07Z5mmV69D5fl5ZBEO");
    $error   = '';
    $success = '';
    try {
        if (!isset($_POST['stripe_token'])) {
            throw new Exception("The Stripe Token was not generated correctly");
        }
        Stripe_Charge::create(
            array(
                "amount"   => 7999,
                "currency" => "usd",
                "card"     => $_POST['stripe_token'],
                "metadata" => $metadata,
            )
        );
        $success = 'Your payment was successful.';
    } catch (Exception $e) {
        $error = $e->getMessage();
        die($error);
    }
}

?>
