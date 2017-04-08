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

if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    $hub_verify_token = $_REQUEST['hub_verify_token'];
}


if ($hub_verify_token === $verify_token) {
    echo $challenge;
}

$input = json_decode(file_get_contents('php://input'), true);
file_get_contents('http://onleave.online/rnd/save.php?context=json_encode($input));
?>
