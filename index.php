<?php

require 'vendor/autoload.php';
// include './k2-connect-php/src/K2.php';

use Kopokopo\SDK\K2;

$K2_CLIENT_ID = 'your_client_id';
$K2_CLIENT_SECRET = '10af7ad062a21d9c841877f87b7dec3dbe51aeb3';

$K2 = new K2($K2_CLIENT_ID, $K2_CLIENT_SECRET);

$router = new AltoRouter();

// $tokens = $K2->TokenService();
// $response = $tokens->getToken();

// $access_token = $response['access_token'];

// map homepage
$router->map('GET', '/', function () {
    require __DIR__.'/views/index.php';
});

$router->map('GET', '/webhook/subscribe', function () {
    require __DIR__.'/views/subscribe.php';
});

$router->map('GET', '/stk', function () {
    require __DIR__.'/views/receive.php';
});

$router->map('GET', '/transfer', function () {
    require __DIR__.'/views/transfer.php';
});

$router->map('GET', '/pay', function () {
    require __DIR__.'/views/pay.php';
});

$router->map('POST', '/webhook/subscribe', function () {
    global $K2;

    $tokens = $K2->TokenService();
    $response = $tokens->getToken();

    $access_token = $response['access_token'];

    echo $access_token;

    // $webhooks = $K2->Webhooks();

    // $options = array(
    //     'eventType' => $_POST['event_type'],
    //     'url' => $_POST['url'],
    //     'webhookSecret' => 'my_webhook_secret',
    //     'accessToken' => $access_token,
    // );
    // $response = $webhooks->subscribe($options);

    // echo json_encode($response);
});

$router->map('POST', '/stk', function () {
    global $K2;
    $stk = $K2->StkService();

    $options = [
        'paymentChannel' => 'M-PESA',
        'tillNumber' => '13432',
        'firstName' => $_POST['first_name'],
        'lastName' => $_POST['last_name'],
        'phone' => $_POST['phone'],
        'amount' => $_POST['amount'],
        'email' => 'example@example.com',
        'callbackUrl' => 'http://localhost:8000/test',
        'accessToken' => 'myRand0mAcc3ssT0k3n',
    ];
    $response = $stk->paymentRequest($options);

    echo json_encode($response);
});

$router->map('POST', '/transfer', function () {
    global $K2;
    $transfer = $K2->TransferService();

    $options = [
        'amount' => $_POST['amount'],
        'destination' => $_POST['destination'],
        'accessToken' => 'myRand0mAcc3ssT0k3n',
    ];
    $response = $transfer->settleFunds($options);

    echo json_encode($response);
});

$router->map('POST', '/pay', function () {
    global $K2;
    $pay = $K2->PayService();

    $options = [
        'destination' => $_POST['destination'],
        'amount' => $_POST['amount'],
        'accessToken' => 'myRand0mAcc3ssT0k3n',
        'callbackUrl' => 'http://localhost:8000/webhook',
    ];
    $response = $pay->sendPay($options);

    echo json_encode($response);
});

$router->map('POST', '/webhook', function () {
    global $K2;
    global $response;

    $webhooks = $K2->Webhooks();

    $json_str = file_get_contents('php://input');

    $response = $webhooks->webhookHandler($json_str, $_SERVER['HTTP_X_KOPOKOPO_SIGNATURE']);

    echo json_encode($response);
    // print("POST Details: " .$json_str);
    // print_r($json_str);
});

$router->map('GET', '/webhook/details', function () {
    global $response;
    echo $response;
    echo $response;
});

$match = $router->match();
if ($match && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
}
