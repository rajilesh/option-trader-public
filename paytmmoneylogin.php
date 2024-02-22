<?php
// Template Name: Paytm Money Login

function generage_paytm_login_code(){
  // allow cors
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: *");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
  
	
  if(!isset($_GET['rkn'])){
    return "rkn is missing";
  }
  if(!isset($_GET)){
    return "invalid method";

  }

  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://developer.paytmmoney.com/accounts/v2/gettoken',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
      "api_key" : "61f9bf4fd4ff4db8a99e265275194b6b",
      "api_secret_key" : "e6b92d326ee7442885ee821576c5615b",
      "request_token" : "'.$_GET['rkn'].'"
  }',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json'
    ),
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  
    return $response;
  
  }

  echo generage_paytm_login_code();