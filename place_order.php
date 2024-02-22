<?php
// Template Name: Place Order

  // allow cors
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: *");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
  
	
function get_body_data()
{
	$data = file_get_contents('php://input'); //outputs nothing
    
    $data = json_decode($data);

return $data;

	if ($data) {
		$data = json_decode($data);
    }else if (isset($_POST)) {
		$data = array_merge($data, $_POST);
	}
	if (isset($_FILES)) {
		$data = array_merge($data, $_FILES);
	}
	if (isset($_GET)) {
		$data = array_merge($data, $_GET);
	}




	return (object) $data;
}
$data = get_body_data();
$key = $data->key;
unset ($data->key);

$encoded_data = json_encode($data);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://developer.paytmmoney.com/orders/v1/place/regular',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$encoded_data,
  CURLOPT_HTTPHEADER => array(
    'x-jwt-token: '.$key,
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
