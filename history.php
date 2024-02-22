<?php
// Template Name: Paytm Money Login

function generage_paytm_login_code(){
  // allow cors
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: *");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
  

  // $token = $_SERVER['HTTP_X_JWT_TOKEN'];
  $kid = $_GET['kid'];
$interval = $_GET['interval'];

  // if($kid==13){
  // $kid = 256265;
  // }
  // if($kid==35003){
  // $kid = 8960770;
  // }
  $from = $_GET['from'];
  $to = $_GET['to'];
  
  $prev_30_days = date('Y-m-d',strtotime('-30 days',strtotime($from)));
  $prev_60_days = date('Y-m-d',strtotime('-30 days',strtotime($prev_30_days)));

  
  $token = $_GET['access_token'];

  $token = trim($token);

  $token = str_replace(' ','+',$token);

  if($interval=='day'){



  $curlaa = curl_init();
  curl_setopt_array($curlaa, array(
    CURLOPT_URL => 'https://kite.zerodha.com/oms/instruments/historical/'.$kid.'/minute?user_id=DW8712&oi=1&from='.$prev_60_days.'&to='.$prev_30_days,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'authorization: enctoken '.$token,
    ),
  ));
  
  $responseaa = curl_exec($curlaa);
  curl_close($curlaa);
  
  

$prev_responseaa = json_decode($responseaa);

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://kite.zerodha.com/oms/instruments/historical/'.$kid.'/minute?user_id=DW8712&oi=1&from='.$prev_30_days.'&to='.$from,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'authorization: enctoken '.$token,
    ),
  ));
  
  $response = curl_exec($curl);
  curl_close($curl);
  

$prev_response = json_decode($response);
if(is_array($prev_responseaa->data->candles) && is_array($prev_response->data->candles)){

  $all_responsea = array_merge($prev_responseaa->data->candles,$prev_response->data->candles);
}else{
  $all_responsea = $prev_response->data->candles;
}

$prev_response->data->candles =  $all_responsea;



  $curl2 = curl_init();
  curl_setopt_array($curl2, array(
    CURLOPT_URL => 'https://kite.zerodha.com/oms/instruments/historical/'.$kid.'/minute?user_id=DW8712&oi=1&from='.$from.'&to='.$to,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'authorization: enctoken '.$token,
    ),
  ));
  
  $responsea = curl_exec($curl2);
  curl_close($curl2);

  $new_response = json_decode($responsea);
  if(is_array($prev_response->data->candles) && is_array($new_response->data->candles)){

    $all_response = array_merge($prev_response->data->candles,$new_response->data->candles);
  }else{

    $all_response = $new_response->data->candles;
  }


  $new_response->data->candles =  $all_response;

  echo json_encode($new_response);

}else{

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://kite.zerodha.com/oms/instruments/historical/'.$kid.'/minute?user_id=DW8712&oi=1&from='.$from.'&to='.$to,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'authorization: enctoken '.$token,
    ),
  ));
  
  $response = curl_exec($curl);
  
  curl_close($curl);
  echo $response;
}
  
  
  }

  echo generage_paytm_login_code();