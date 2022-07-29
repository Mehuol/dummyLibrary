<?php 
namespace dummyLibrary;

// use dummyLibrary\simpaisaConfig;
require 'config.php';




class SIMPAISA {


     public function config(){
          $configuration = new CONFIG();
          $configUrl = $configuration->config();
          return $configUrl;
     }



     public function wallet_initiate($merchantId,$operatorId,$userKey,$msisdn,$transactionType,$amount){

          try
          {
               
               $configUrl = $this->config();
               if (!is_numeric($merchantId) || strlen($merchantId) != 7 ){
                    return  'merchant id invalid';

               }elseif(!is_numeric($operatorId) || strlen($operatorId) != 6 ){
                    return 'Operator id invalid';
                    
               }elseif(!is_numeric($msisdn) || strlen($msisdn) != 10 ){
                    return 'Number is invalid';

               }elseif(!is_numeric($amount) || $amount <= 0){
                    return 'Amount is invalid';
               }

               $initiateUrl = $configUrl["baseUrl"].$configUrl["initiateUrl"];
               
               // Collection object
               $data = [
                    "merchantId" => $merchantId,
                    "operatorId" => $operatorId,
                    "userKey" => $userKey,
                    "msisdn" => $msisdn,
                    "transactionType" => $transactionType,
                    "amount" => $amount,
                    // "productReference" => "xxxxx-xxxx-xxx"
               ];

               // Initializes a new cURL session
               $curl = curl_init($initiateUrl);
               // Set the CURLOPT_RETURNTRANSFER option to true
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
               // Set the CURLOPT_POST option to true for POST request
               curl_setopt($curl, CURLOPT_POST, true);
               // Set the request data as JSON using json_encode function
               curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
               // Set custom headers for RapidAPI Auth and Content-Type header
               curl_setopt($curl, CURLOPT_HTTPHEADER, [
               'Content-Type: application/json'
               ]);


               // Execute cURL request with all previous settings
               $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
               $response = curl_exec($curl);
               $jsonResponse = json_decode($response, true);
               $data["type"] = $_SERVER['REQUEST_METHOD'];
               $reqSent = json_encode($data, true);
               $reqlog  = date("Y-m-d h:i:s")."|wallet_initiate|Request - ".$reqSent.PHP_EOL;
               // file_put_contents($configUrl["logUrl"].date("j.n.Y").'log', $log, FILE_APPEND);
               error_log($reqlog, 3, $configUrl["logUrl"]);


               // echo 'Curl error: ' . curl_error($curl);
               $reslog  = date("Y-m-d h:i:s")."|wallet_initiate|Log - ".$response.PHP_EOL;
               error_log($reslog, 3, $configUrl["logUrl"]);

               // print_r('err');
               return $response;
                              
               if (curl_errno($curl)) {
                    $error_msg = curl_error($curl);
               }
               error_log('CURl Error | '.$error_msg, 3, $configUrl["logUrl"]);
               // Close cURL session
               curl_close($curl);
          }
          catch (Exception $e)
          {
               echo $e->getMessage();
               echo 'Exception ERROR';
               
          }
     }


     public function wallet_verify($merchantId,$operatorId,$userKey,$msisdn,$transactionType,$amount,$otp){
          // $this->bigTest();
          // $this->smallTest();
          try
          {
               
               if (!is_numeric($merchantId) || strlen($merchantId) != 7 ){
                    
                    return 'merchant id invalid';
               }elseif(!is_numeric($operatorId) || strlen($operatorId) != 6 ){
                    
                    return 'Operator id invalid';
               }elseif(!is_numeric($msisdn) || strlen($msisdn) != 10 ){
                    
                    return 'Number is invalid';
               }elseif(!is_numeric($amount) || $amount <= 0){
               
                    return 'Amount is invalid';
               }elseif(!is_numeric($otp)){
               
                    return 'OTP is invalid';
               }

               $configUrl = $this->config();

               $verifyUrl = $configUrl["baseUrl"].$configUrl["verifyUrl"];
               // Collection object
               $data = [
                    "merchantId" => $merchantId,
                    "operatorId" => $operatorId,
                    "userKey" => $userKey,
                    "msisdn" => $msisdn,
                    "transactionType" => $transactionType,
                    "amount" =>$amount,
                    "otp" => $otp
                    // "productReference" => "xxxxx-xxxx-xxx"
               ];
               // Initializes a new cURL session
               $curl = curl_init($verifyUrl);
               // Set the CURLOPT_RETURNTRANSFER option to true
               curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
               // Set the CURLOPT_POST option to true for POST request
               curl_setopt($curl, CURLOPT_POST, true);
               // Set the request data as JSON using json_encode function
               curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));
               // Set custom headers for RapidAPI Auth and Content-Type header
               curl_setopt($curl, CURLOPT_HTTPHEADER, [
               'Content-Type: application/json'
               ]);
               // Execute cURL request with all previous settings
               $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
               $response = curl_exec($curl);
               $jsonResponse = json_decode($response, true);
               $status = $jsonResponse['status'];
               $data["type"] = $_SERVER['REQUEST_METHOD'];
               $reqSent = json_encode($data, true);
               $reqlog  = date("Y-m-d h:i:s")."|wallet_verify|Request - ".$reqSent.PHP_EOL;
               // file_put_contents($configUrl["logUrl"].date("j.n.Y").'log', $log, FILE_APPEND);
               error_log($reqlog, 3, $configUrl["logUrl"]);


               // echo 'Curl error: ' . curl_error($curl);
               $reslog  = date("Y-m-d h:i:s")."|wallet_verify|Log - ".$response.PHP_EOL;
               error_log($reslog, 3, $configUrl["logUrl"]);

               // print_r('err');
               return $response;
                              
               if (curl_errno($curl)) {
                    $error_msg = curl_error($curl);
               }
               error_log('CURl Error | '.$error_msg, 3, $configUrl["logUrl"]);
               // Close cURL session
               curl_close($curl);
               echo "Verify";
          }
          catch (Exception $e)
          {
               echo $e->getMessage();
          }
     }

     // private function bigTest(){
     //     //Big Test Here
          
     // }

     // private function smallTest(){
     //     //Small Test Here
     // }

     // public function scoreTest(){
     //     //Scoring code here;
     // }

}

// $testObject = new simpaisa();

// $testObject->wallet_initiate(1000004,100007,123456,3482423523,0,1 );
// $testObject->wallet_verify(1000004,100007,123456,3482423523,0,1,8989);


// print_r ($testObject);