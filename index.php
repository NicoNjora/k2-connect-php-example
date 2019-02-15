<?php
require 'vendor/autoload.php';
// include './k2-connect-php/src/K2.php';

use Kopokopo\SDK\K2;

$K2_CLIENT_ID="your_client_id";
$K2_CLIENT_SECRET="10af7ad062a21d9c841877f87b7dec3dbe51aeb3";

$K2 = new K2($K2_CLIENT_ID, $K2_CLIENT_SECRET);

$router = new AltoRouter();


// $tokens = $K2->TokenService();
// $response = $tokens->getToken();

// map homepage
$router->map( 'GET', '/', function() {
    require __DIR__ . '/views/index.php';
});

$router->map( 'GET', '/webhook/subscribe', function() {
    require __DIR__ . '/views/subscribe.php';
});

$router->map( 'POST', '/webhook/subscribe', function () {
    global $K2;
    $webhooks = $K2->Webhooks();


    $options = array(
        'event_type' => $_POST['event_type'],
        'url' => $_POST['url'],
        'webhook_secret' => 'my_webhook_secret',
        'access_token' => 'my_access_token'
    );
    $response = $webhooks->subscribe($options);

    echo json_encode($response);
});

$router->map( 'POST', '/webhook', function () {
    global $K2;
    global $response;

    $webhooks = $K2->Webhooks();

    $json_str = file_get_contents('php://input');
    var_dump($json_str);

    $response = $webhooks->webhookHandler($json_str, $_SERVER['HTTP_X_KOPOKOPO_SIGNATURE']);

    echo json_encode($response);
    // print("POST Details: " .$json_str);
    // print_r($json_str);
    
});

$router->map( 'GET', '/webhook/details', function() {
    global $response;
    echo $response;
    print($response);
});


$match = $router->match();
if( $match && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

