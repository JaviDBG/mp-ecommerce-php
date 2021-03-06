<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');
$_SERVER['REQUEST_METHOD'];
$_POST = json_decode(file_get_contents('php://input'), true);
require __DIR__ .  '/vendor/autoload.php';
MercadoPago\SDK::setAccessToken("APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe921a3d-617633181");

$response;
switch($_POST["type"]) {
    case "payment":
    $payment = MercadoPago\Payment::find_by_id((int)$_POST['id']);
        $response = $payment;
        break;
    case "plan":
        $plan = MercadoPago\Plan::find_by_id($_POST["id"]);
        $response = $plan;
        break;
    case "subscription":
        $plan = MercadoPago\Subscription::find_by_id($_POST["id"]);
        $response = $plan;
        break;
    case "invoice":
        $plan = MercadoPago\Invoice::find_by_id($_POST["id"]);
        $response = $plan;
        break;
      
}
file_put_contents(
    'registro.log',
    json_encode($response) . PHP_EOL,
    FILE_APPEND
  );
  file_put_contents(
    'post.log',
    json_encode($_POST) . PHP_EOL,
    FILE_APPEND
  );
  http_response_code(200);
?>