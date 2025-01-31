<?php

//function send_message_global($c_code, $mobile, $message) {
//	$c_code = '+91';
//	$mobile = urlencode($c_code . $mobile);
//	$message = urlencode($message);
//	$api_url = "http://ec2-13-127-166-4.ap-south-1.compute.amazonaws.com/awssms/index.php?mobile=$mobile&$message";
//	$response = file_get_contents($api_url);
//}

function send_message_global($c_code='+91', $mobile, $message) {
     $url = "smsidea.co.in/smsstatuswithid.aspx";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "mobile=9818524882&pass=soloidc123&senderid=SANSAT&to=$mobile&msg=$message");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $response = curl_exec($ch);
        if($response!=''){
            return true;
        }else{
            return false;
        }
}
 function send_whatsapp_msg($mobile) { 
        $message='संस्कार में आपका स्वागत है | हमारी संस्कृती हमारी विरासत !';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.wassenger.com/v1/messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"phone\":\"+91$mobile\",\"message\":\"$message\"}",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/json",
                "token: f5043576c67a61393803c427849be0c1bd985c9e86ff74651708c983c4c49c8630a51d4052a0e731"
            ),
        ));

        $response = curl_exec($curl);
        if($response!=''){
            return true;
        }else{
            return false;
        }
//        $response = json_decode($response, true);
//        $err = curl_error($curl);
//
//        curl_close($curl);
//
//        if ($err) {
//            return_data(false, 'cURL Error #:', $err);
//        } else {
//            return_data(true, 'Success.', $response);
//        }
    }
