<?php
// Template Name: Paytm Money Login

function generage_paytm_login_code(){
  // allow cors
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: *");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
  

  $token = $_SERVER['HTTP_X_JWT_TOKEN'];

  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://developer.paytmmoney.com/orders/v1/position',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'x-jwt-token: '.$token
  ),
));

$response = curl_exec($curl);

curl_close($curl);
  
    return $response;
  
  }

  echo generage_paytm_login_code();