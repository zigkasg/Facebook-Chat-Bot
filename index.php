<?php
/**
 * Webhook for Time Bot- Facebook Messenger Bot
 * User: adnan
 * Date: 24/04/16
 * Time: 3:26 PM
 */
$access_token = "EAAFdZAPv0XKsBACVIr8OeSiuMduLQCFayO9U7nEZAGn1ZBO1zzvdXxJ5j3j0ISb6UZAC0HuKlg97dAZAl5mRq3vj1MCRaZCJQmYvUu0TuclhOK67Fs8MHZAOfDUjMZCKLQkgaL5VC1F8TBz9y2Viwcmh6bA5rtUg5ydCC3GOhO7m3gZDZD";
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

$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];

$message_to_reply = '';

/**
 * Some Basic rules to validate incoming messages
 */
if(preg_match('[time|current time|now]', strtolower($message))) {

    // Make request to Time API
    ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
    $result = "you are here dude";
    if($result != '') {
        $message_to_reply = $result;
    }
} else {
    $message_to_reply = 'Huh! what do you mean?';
}

//API Url
$url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$access_token;


//Initiate cURL.
$ch = curl_init($url);

//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"'.$sender.'"
   },
   "message":{
       "text":"'.$message_to_reply.'"
   }
}';


$jsonData = '{
  "recipient":{
    "id":"'.$sender.'"
  },
  "message":{
    "attachment":{
      "type":"image",
      "payload":{
        "url":"https://petersapparel.com/img/shirt.png"
      }
    }
  }
}';

/*
$jsonData = '{
  "recipient":{
    "id":"'.$sender.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"receipt",
        "recipient_name":"Stephane Crozatier",
        "order_number":"12345678902",
        "currency":"USD",
        "payment_method":"Visa 2345",        
        "order_url":"http://petersapparel.parseapp.com/order?order_id=123456",
        "timestamp":"1428444852", 
        "elements":[
          {
            "title":"President profile",
            "subtitle":"100% Aluminium",
            "quantity":2,
            "price":50,
            "currency":"NOK",
            "image_url":"http://www.garderobemannen.no/var/garderobemannen/storage/images/garderobemannen/skyvedoerer/undersider-profiler/president/1776-24-nor-NO/PRESIDENT.jpg"
          },
          {
            "title":"Venus Frame",
            "subtitle":"Grey - 80% Aluminium",
            "quantity":1,
            "price":25,
            "currency":"NOK",
            "image_url":"http://www.garderobemannen.no/var/garderobemannen/storage/images/garderobemannen/skyvedoerer/undersider-profiler/venus/1793-24-nor-NO/VENUS.jpg"
          }
        ],
        "address":{
          "street_1":"3-5 Agiou Athanasiou",
          "street_2":"",
          "city":"Paphos",
          "postal_code":"8250",
          "state":"CA",
          "country":"Norway"
        },
        "summary":{
          "subtotal":75.00,
          "shipping_cost":4.95,
          "total_tax":6.19,
          "total_cost":56.14
        },
        "adjustments":[
          {
            "name":"New Customer Discount",
            "amount":20
          },
          {
            "name":"$10 Off Coupon",
            "amount":10
          }
        ]
      }
    }
  }
}';
*/

//Encode the array into JSON.
$jsonDataEncoded = $jsonData;

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

//Execute the request
if(!empty($input['entry'][0]['messaging'][0]['message'])){
    $result = curl_exec($ch);
}
