<?php
/**
 * Webhook for Time Bot- Facebook Messenger Bot
 * User: adnan
 * Date: 24/04/16
 * Time: 3:26 PM
 */
$access_token = "EAADU14lUe40BAEYkkTZAYab2ZBQOAms8EkItK1ZCaeXSyw8z9kaljxp4F1vT7KiAZBRsMkRVoAWpZAZB3JyTrtB9gN0k0lbSsXuEOtVjRnjIt4Tsjfb2OthtjfvCbBf15yNnDNWdAevpn0aV0ZC8q2fdctx0ScucczCPseoS2C8MwZDZD";
$verify_token = "test";
$hub_verify_token = null;
ini_set('always_populate_raw_post_data', '-1');
if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}


if ($hub_verify_token === $verify_token) {
    echo $challenge;
    return;
}

$input = json_decode(file_get_contents('php://input'), true);
//file_get_contents('https://www.onleave.online/assets/php/v1/chatBot?context='.json_encode($input));
$url = 'https://www.onleave.online/assets/php/v1/chatBotWebhook';
$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($input));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    print_r($response);
?>
