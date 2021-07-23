<?php

function coinPrice($symbol){
    $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
    $parameters = [
    "symbol" => $symbol
    ];

    $headers = [
    'Accepts: application/json',
    'X-CMC_PRO_API_KEY: 2504149e-211a-4e9f-84d0-617396ca5c4c'
    ];
    $qs = http_build_query($parameters); // query string encode the parameters
    $request = "{$url}?{$qs}"; // create the request URL


    $curl = curl_init(); // Get cURL resource
      // Set cURL options
      curl_setopt_array($curl, array(
      CURLOPT_URL => $request,            // set the request URL
      CURLOPT_HTTPHEADER => $headers,     // set the headers
      CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
    ));

      $response = curl_exec($curl); // Send the request, save the response
    $json = (json_decode($response)); // print json decoded response
      curl_close($curl); // Close request
      foreach ($json->data as $data) {
          $price = $data->quote->USD->price;
      }
    return $price;
}


function depositAmount($symbol, $amount){
    $coinPrice = coinPrice($symbol);
    $total = $amount * 1;
    $total = $total / $coinPrice;
    $total = round($total, 6);
    return $total;
}

function earnings($amount, $percentage, $time){
  $earing = $percentage / 100;
  $earing *= $amount;
  $earing *= $time;
  return $earing;
}


?>