#!/usr/bin/env php
<?php 
include "lib/phpsockets.io.php";
function milliseconds() {
	    $mt = explode(' ', microtime());
	    return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
	}
	
/**
* The port to run this socket on
*/ 
$server_port="3009";

//initialize socket service
$socket=new PHPWebSockets("0.0.0.0",$server_port);

/**
* when a client is connect, send the client its own autogenerated id via emit
* 
*   @param  object  $socket    The socket object of the current client
*   @param  int  $uid		   The user id of the current client
* 
*/
$socket->on("connect",function($socket,$uid) { //print_r($socket['user']);

	$socket->emit('connect',$uid);
});

/**
* a callback to handle the command "add user" from a client
* this is used by the advanced example to process a user login
* 
*   @param  object  $socket    The socket object of the current client
*   @param  int  $username	   The username of the current client
*   @param  int  $userid	   The user id of the current client
* 
*/
$socket->on("add user",function($socket,$username,$userid) {
	print_r($userid); 
	$socket->username=$username;
	
	//add the client's username to the global list
	$socket->usernames["$username"] = $username;
	$socket->socketID["$userid"] = $username;
	$socket->numUsers++;
	
	//inform me that my login was successful
	$socket->emit('login', array(
	'numUsers'=>$socket->numUsers
	));

	//broadcast to others that i have joined
	$socket->broadcast('user joined', array(
	'username'=>$socket->username,
	'numUsers'=>$socket->numUsers
	));

	//broadcast the current user list e.g. tony,ayo - this is used in the chat im example
	$socket->broadcast('user list', array(
	    'users'=>json_encode(array_unique(array_values($socket->usernames)))
	),true);
	
	
	$socket->addedUser=true;

});


/**
* a callback to broadcast typing message to other connected users (other than the current client who is typing)
* this is used by the advanced example to handle a message being typed
* 
*   @param  object  $socket    The socket object of the current client
*   @param  string  $data	   Data sent along with callback
* 
*/
$socket->on('typing', function ($socket,$data) {

	$socket->broadcast('typing', array(
	'username'=>$socket->socketID[$socket->user->id],
	));
	
});


/**
* a callback to send message to a specific user
* this is used by the chat im example to handle a message being typed
* 
*   @param  object  $socket    The socket object of the current client
*   @param  object  $data	   Data object sent containing keys - to and data
* 
*/
$socket->on('im user', function ($socket,$data) {
	$sender=@$socket->socketID[$socket->user->id];
	if($sender!=null) {
		$to=$data->to;
		$data=$data->data;
		$re=$socket->getUserByName($to);
		$socket->push($re,'im user', array(
											 'sender'=>$sender,
											 'data'=>$data,
											));
		echo PHP_EOL."Something is happening here ".PHP_EOL;
		print_r($to);
	}
});

/**
* a callback to broadcast when client is no longer typing 
* this is used by the advanced example to handle a message being typed
* 
*   @param  object  $socket    The socket object of the current client
*   @param  string  $data	   Data sent along with callback
* 
*/
$socket->on('stop typing', function ($socket,$data) {

	$socket->broadcast('stop typing', array(
	'username'=>$socket->socketID[$socket->user->id],
	));
	
});

/**
* a callback to broadcast when client broadcasts a chat message
* this is used by the basic example to handle a chat message being sent
* 
*   @param  object  $socket    The socket object of the current client
*   @param  string  $data	   Data sent along with callback
*   @param  string  $sender	   The client sending the message
* 
*/
$socket->on('chat message', function ($socket,$data,$sender) {
	$socket->broadcast('chat message', $data,true); 
});


/**
* a callback to broadcast when client broadcasts a "new message"
* this is used by the advanced example to handle a chat message being sent
* 
*   @param  object  $socket    The socket object of the current client
*   @param  string  $data	   Data sent along with callback
*   @param  string  $sender	   The client sending the message
* 
*/
$socket->on('new message', function ($socket,$data,$sender) {
	// we tell the client to execute 'new message'
	$socket->broadcast('new message', array(
	'username'=>$socket->socketID[$socket->user->id],
	'message'=>$data
	));
	echo "new message to someone";
	
});

/**
* a callback to handle disconnection of a client from its socket
* 
*   @param  object  $socket    The socket object of the current client
*   @param  string  $data	   Data sent along with callback
* 
*/
$socket->on("disconnect",function($socket,$data) {
	// remove the username from global usernames list
	if ($socket->addedUser) {
		unset($socket->usernames[$socket->username]);
		unset($socket->socketID[$socket->user->id]);
		$socket->numUsers--;

		// echo globally that this client has left
		$socket->broadcast('user left', array(
		'username'=> $socket->username,
		'numUsers'=> $socket->numUsers
		));
		

	  //broadcast the current user list e.g. tony,ayo - this is used in the chat im example
	   $socket->broadcast('user list', array(
	    'users'=>json_encode(array_unique(array_values($socket->usernames)))
	   ),true);
	
	}

});

/**
* 
*/
$socket->on('sync_process', function ($socket,$data,$sender) {
	$user_type = '';
	$users_message = $data->users_message;
	$post_id = $data->post_id;
	$post_type = $data->post_type;
	//print_r($data); die;
	if($user_type == ""){
		// mysql database connection 
		$conn = mysqli_connect("localhost","root","P@ssword@12","total_bhakti");
		// Check connection
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		//get count off all users 
		$sql = "SELECT count(id) as total  FROM users";

		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		// condition if we have users or not 
		if(($total = $row['total']) > 0 ){
			$socket->broadcast('sync_process', "Android device fetching start." ,true);
			/* send push for get android users start here */  
			$andro_count = $conn->query("SELECT count(id) as total  FROM users where device_type = 1 and device_tokken != '' ")->fetch_assoc();
			$andro_count = $andro_count['total'];
			if($andro_count > 0 ){
				for($ac=0;$ac<=$andro_count;$ac++){
					// now get 1000 users and their device tokken 
					$andro_device_tokken = $conn->query("SELECT id,device_tokken  FROM users where device_type = 1 and device_tokken != '' limit $ac,1000");
					$rall = array();
					while($row = $andro_device_tokken->fetch_assoc()) {
						$rall[] = $row['device_tokken'] ;//$andro_device_tokken['device_tokken'];
						$andr_user_ids[] = $row['id'];
					}

					foreach($andr_user_ids as $user_id){
						$creation_time=milliseconds();
						$result=$conn->query("INSERT into notification(post_id,post_type,user_id,description,creation_time) values ('$post_id','$post_type','$user_id','$users_message','$creation_time')");
					}
					$push_data = json_encode(
											array(
												'notification_code' => 90001,
												'message' =>"$users_message",
												'data' => array('message_target' => $post_type,'post_id'=>$post_id)
											)
										);
					$out = sendAndroidPush($rall, $push_data);
					$ac = $ac+1000-2;
					$socket->broadcast('sync_process', "Going to send message to all android  users and message sent to $ac users. Please stay on this page." ,true);					
				}
			}
			/* send push for get android android users end here */

			/* send push for get IOS users start here */  
			$ios_count = $conn->query("SELECT count(id) as total  FROM users where device_type = 2 and device_tokken != '' ")->fetch_assoc();
			$ios_count = $ios_count['total'];
			if($ios_count > 0 ){
				$socket->broadcast('sync_process', "sending message to $ios_count user in process . Please stay on this page." ,true);
				//$deviceToken = "79F6279B54AF02029A7E47D5D07A372A1190454858A4DF30E0A67C491D22D160";
				for($ic=0;$ic<=$ios_count;$ic++){ 
					// now get 500 users and their device tokken 
					$ios_device_tokken = $conn->query("SELECT id,device_tokken  FROM users where device_type = 2 and device_tokken != '' limit $ic,1000");
					$rall = array();
					while($row = $ios_device_tokken->fetch_assoc()) {
						$rall[] = $row['device_tokken'] ;//$andro_device_tokken['device_tokken'];
						$ios_user_ids[] = $row['id'];
					}


					foreach($ios_user_ids as $user_id){
						$creation_time=milliseconds();
						$result=$conn->query("INSERT into notification(post_id,post_type,user_id,description,creation_time) values ('$post_id','$post_type','$user_id','$users_message','$creation_time')");
					}


					$push_data = json_encode(
						array(
							'notification_code' => 90001,
							'message' =>"$users_message",
							'data' => array('message_target' => $post_type,'post_id'=>$post_id)
						)
					);
					//print_r($rall);
					$out = sendIphonePush($rall, $push_data ,$badge=0,$check=0,$version=1);
					$ic = $ic+1000-2;
					$socket->broadcast('sync_process', "Going to send message to all IOS  users and message sent to $ic users. Please stay on this page." ,true);					
				}
			}
			/* send push for get android android users end here */ 			
		}
	}

	$socket->broadcast('sync_process', "Message sent to all users." ,true);
});

function sendAndroidPush($deviceToken, $msg,$badge=0,$check=0,$type="") {
   // echo $type;die;
	$registrationIDs = array($deviceToken);

	if (is_array($deviceToken)) {

		$registrationIDs = $deviceToken;
	} else {
		$registrationIDs = array($deviceToken);
	}
	// Message to be sent
	$message = $msg;
	$type = json_decode($msg,true);
	$type = $type['notification_code'];
	$url = 'https://android.googleapis.com/gcm/send';

    $fields = array(
		'registration_ids' => $registrationIDs,
		'data' => array("message" => $message,"type"=> $type)

	);

	$headers = array(
		'Authorization: key=AIzaSyCEkOriDMhVyYFjIAcwg96eir9ERluLAvk',
		'Content-Type: application/json'
	);
	if(is_array($deviceToken) && count($deviceToken) > 1 ){
		
		$device_chunk =  array_chunk($deviceToken,20);
		$node_count = count($device_chunk);
		$curl_arr = array();
		$master = curl_multi_init();
		for($i = 0; $i <= $node_count; $i++){
			$fields['registration_ids'] = $device_chunk[$i];
			$curl_arr[$i] = curl_init();

			//Set the url, number of POST vars, POST data
			curl_setopt($curl_arr[$i], CURLOPT_URL, $url);

			curl_setopt($curl_arr[$i], CURLOPT_POST, true);
			curl_setopt($curl_arr[$i], CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);

			curl_setopt($curl_arr[$i], CURLOPT_POSTFIELDS, json_encode($fields));

			curl_multi_add_handle($master, $curl_arr[$i]);
		}

		do {
			curl_multi_exec($master,$running);
		} while($running > 0);

		echo "results: ";
		for($i = 0; $i < $node_count; $i++)
		{
			$results = curl_multi_getcontent  ( $curl_arr[$i]  );
			echo( $i . "\n" . $results . "\n");
		}
		echo 'done';
	}else{
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
		return  $result;
	}

	
}

function sendIphonePush($deviceToken,$msg,$badge=0,$check=0,$version=1) {

	//$apnsHost = 'gateway.push.apple.com';	   //production phase
	//$apnsCert = '../../production_ck.pem'; 

	$apnsHost = 'gateway.sandbox.push.apple.com';	   //sandbox phasesandbox.
	$apnsCert = '../../development_ck.pem';                            //certificate pem file
	
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

	$message  =  (array)(json_decode($message));

	if(is_array($message)  && array_key_exists('message', $message)  ){
		$body_var = $message['message'];
	}else{
		$body_var = $msg ;
	}

    $payload['aps'] = array(
                        'alert' => array(
                                'body' => $body_var,
                                'action-loc-key' => 'TOTAL_BHAKTI',
						),
						'json' => $message,
						'badge' => 1,
						'sound' => 'oven.caf',
                    );
	$payload = json_encode($payload);
	// make for loop here 
	if(is_array($deviceToken)){
		foreach($deviceToken as $dt){
			try {
				$dt = trim($dt);
				if ($message != "" && strlen($dt) == 64 ) {
					$apnsMessage = chr(0) . pack("n", 32) . pack('H*', str_replace(' ', '', $dt)) . pack("n", strlen($payload)) . $payload;
					$fwrite = fwrite($apnsConnection, $apnsMessage);
					if ($fwrite) {
						echo "sending message to $dt".PHP_EOL;
						//echo "true";
						//error_log($fwrite.chr(13), 3, "/mnt/srv/MOOVWORKER/push-errors.log");
					} else { 
						//echo "false";
					}
				}
			} catch (Exception $e) {
				echo 'Caught exception: '.  $e->getMessage(). "\n";
				//error_log($e->getMessage().chr(13), 3, "/mnt/srv/MOOVWORKER/push-errors.log");
			}
			
		}
	}				

}


// function sendAndroidPush($deviceToken, $msg,$badge=0,$check=0,$type="") {
//    // echo $type;die;
// 	$registrationIDs = array($deviceToken);

// 	if (is_array($deviceToken)) {

// 		$registrationIDs = $deviceToken;
// 	} else {
// 		$registrationIDs = array($deviceToken);
// 	}
// 	// Message to be sent
// 	$message = $msg;
// 	$type = json_decode($msg,true);
// 	$type = $type['notification_code'];
// 	$url = 'https://android.googleapis.com/gcm/send';

//     $fields = array(
// 		'registration_ids' => $registrationIDs,
// 		'data' => array("message" => $message,"type"=> $type)

// 	);

// 	$headers = array(
// 		'Authorization: key=1111111111111111111',
// 		'Content-Type: application/json'
// 	);
// 	if(is_array($deviceToken) && count($deviceToken) > 1 ){
		
// 		$device_chunk =  array_chunk($deviceToken,20);
// 		$node_count = count($device_chunk);
// 		$curl_arr = array();
// 		$master = curl_multi_init();
// 		for($i = 0; $i <= $node_count; $i++){
// 			$fields['registration_ids'] = $device_chunk[$i];
// 			$curl_arr[$i] = curl_init();

// 			//Set the url, number of POST vars, POST data
// 			curl_setopt($curl_arr[$i], CURLOPT_URL, $url);

// 			curl_setopt($curl_arr[$i], CURLOPT_POST, true);
// 			curl_setopt($curl_arr[$i], CURLOPT_HTTPHEADER, $headers);
// 			curl_setopt($curl_arr[$i], CURLOPT_RETURNTRANSFER, true);

// 			curl_setopt($curl_arr[$i], CURLOPT_POSTFIELDS, json_encode($fields));

// 			curl_multi_add_handle($master, $curl_arr[$i]);
// 		}

// 		do {
// 			curl_multi_exec($master,$running);
// 		} while($running > 0);

// 		echo "results: ";
// 		for($i = 0; $i < $node_count; $i++)
// 		{
// 			$results = curl_multi_getcontent  ( $curl_arr[$i]  );
// 			echo( $i . "\n" . $results . "\n");
// 		}
// 		echo 'done';
// 	}else{
// 		$ch = curl_init();

// 		//Set the url, number of POST vars, POST data
// 		curl_setopt($ch, CURLOPT_URL, $url);

// 		curl_setopt($ch, CURLOPT_POST, true);
// 		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

// 		//Execute post
// 		$result = curl_exec($ch);

// 		curl_close($ch);
// 		return  $result;
// 	}

	
// }

// function sendIphonePush($deviceToken,$msg,$badge=0,$check=0,$version=1) {

// 	$apnsHost = 'gateway.push.apple.com';	   //production phase
// 	$apnsCert = '../../production_ck.pem'; 

// 	//$apnsHost = 'gateway.sandbox.push.apple.com';	   //sandbox phasesandbox.
// 	//$apnsCert = '../../production_ck.pem';                            //certificate pem file
	
// 	$apnsPort = '2195';                                //.pem file ko project root per paste karna hai
// 	$passPhrase = '1234';                            //cetificate password
// 	$streamContext = stream_context_create();
// 	stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
// 	$apnsConnection = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 60, STREAM_CLIENT_CONNECT, $streamContext);
// 	if ($apnsConnection == false) {

// 		return;
// 	} else {
// 	}
// 	$message = $msg;

// 	$message  =  (array)(json_decode($message));

// 	if(is_array($message)  && array_key_exists('message', $message)  ){
// 		$body_var = $message['message'];
// 	}else{
// 		$body_var = $msg ;
// 	}

//     $payload['aps'] = array(
//                         'alert' => array(
//                                 'body' => $body_var,
//                                 'action-loc-key' => 'TOTAL_BHAKTI',
// 							),
// 						'json' => $message,
// 						'badge' => 1,
// 						'sound' => 'oven.caf',
//                     );
// 	$payload = json_encode($payload);

// 	try {
// 		$deviceToken = trim($deviceToken);
// 		if ($message != "" && strlen($deviceToken) == 64 ) {
// 			$apnsMessage = chr(0) . pack("n", 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload;
// 			$fwrite = fwrite($apnsConnection, $apnsMessage);
// 			if ($fwrite) {
// 				//echo "true";
// 				//error_log($fwrite.chr(13), 3, "/mnt/srv/MOOVWORKER/push-errors.log");
// 			} else {
// 				//echo "false";
// 			}
// 		}
// 	} catch (Exception $e) {
// 		echo 'Caught exception: '.  $e->getMessage(). "\n";
// 		error_log($e->getMessage().chr(13), 3, "/mnt/srv/MOOVWORKER/push-errors.log");
// 	}
// }


//instantiate and start handling transactions
$socket->listen();
?>