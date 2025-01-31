<?php

function sendAndroidPush($deviceToken, $msg, $image = "", $badge = 0, $check = 0, $type = "") {
    // echo $type;die;
    $registrationIDs = array($deviceToken);
    if (is_array($deviceToken)) {
        $registrationIDs = $deviceToken;
    } else {
        $registrationIDs = array($deviceToken);
    }
    // Message to be sent
    $message = $msg;
    
    $type = json_decode($msg, true);
    if ($image) {
        $fields = array(
            'registration_ids' => $registrationIDs,
            'notification' => array('body' => $message, "title" => CONFIG_PROJECT_FULL_NAME, "image" => ($image))
        );
    } else if (!is_array($type)) {
        $fields = array(
            'registration_ids' => $registrationIDs,
            'data' => array(
                "message" => array(
                    "notification_code" => 101,
                    "message" => $message,
                    "data" => array(
                        "post_id" => 0)
                    ), 
                "type" => ($type) ? $type : 0, 
                "image" => ($image) ? $image : ""
                )
            );
    }else{
        $fields = array(
            'registration_ids' => $registrationIDs,
            'data' => array(
                "message" => $type, 
                "type" => ($type) ? $type : 0, 
                "image" => ($image) ? $image : ""
                )
            );
    }
    $url = 'https://fcm.googleapis.com/fcm/send';

    /* in codeigniter GSM_KEY set in constatnt folder */
    $headers = array(
        'Authorization: key=' . GSM_KEY,
        'Content-Type: application/json'
    );

    $ch = curl_init();

    //Set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    //Execute post
    $result = curl_exec($ch);
    curl_close($ch);
//    pre($result);die;
    return $result;
}

function sendIphonePush($deviceToken, $msg, $badge = 0, $check = 0, $version = 1) {

    $apnsHost = 'gateway.push.apple.com';    //production phase
    $apnsCert = 'production_ck.pem';

    $apnsHost = 'gateway.sandbox.push.apple.com';    //sandbox phasesandbox.
    $apnsCert = 'devlopment_ck.pem';                            //certificate pem file

    $apnsPort = '2195';                                //.pem file ko project root per paste karna hai
    $passPhrase = '1234';                            //cetificate password
    $streamContext = stream_context_create();
    stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
    $apnsConnection = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 60, STREAM_CLIENT_CONNECT, $streamContext);
    if ($apnsConnection == false) {

        return;
    } else {
        
    }
    $message = $msg;

    $message = (array) (json_decode($message));

    if (is_array($message) && array_key_exists('message', $message)) {
        $body_var = $message['message'];
    } else {
        $body_var = $msg;
    }

    $payload['aps'] = array(
        'alert' => array(
            'body' => $body_var,
            'action-loc-key' => 'DAMS',
        ),
        'json' => $message,
        'badge' => (int) get_ios_user_badges($deviceToken),
        'sound' => 'oven.caf',
    );
    $payload = json_encode($payload);

    try {
        $deviceToken = trim($deviceToken);
        if ($message != "" && strlen($deviceToken) == 64) {
            $apnsMessage = chr(0) . pack("n", 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload;
            $fwrite = fwrite($apnsConnection, $apnsMessage);
            if ($fwrite) {
                //echo "true";
                //error_log($fwrite.chr(13), 3, "/mnt/srv/MOOVWORKER/push-errors.log");
            } else {
                //echo "false";
            }
        }
    } catch (Exception $e) {
        //echo 'Caught exception: '.  $e->getMessage(). "\n";
        //error_log($e->getMessage().chr(13), 3, "/mnt/srv/MOOVWORKER/push-errors.log");
    }
}

function generatePush($deviceType, $deviceToken, $message, $image = "") {
    if ($deviceType == 'android') {
        return sendAndroidPush($deviceToken, $message, $image);
    } else if ($deviceType == 'ios') {
        sendIphonePush($deviceToken, $message);
    } else {
        
    }
}

/* conditional fx to get total notification of user saved in database for ios to show in badges */

function get_ios_user_badges($d_tokken) {

    $CI = & get_instance();
    $query = "SELECT count(uag.id) as total
				FROM user_activity_generator as uag 
				join users as u on u.id = uag.action_for_user_id 
				WHERE u.device_tokken = '$d_tokken' 
				and view_state = 0";
    return $CI->db->query($query)->row()->total;
}
