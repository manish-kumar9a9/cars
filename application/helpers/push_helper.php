<?php

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

	$url = 'https://android.googleapis.com/gcm/send';


    $fields = array(
		'registration_ids' => $registrationIDs,
		'data' => array("message" => $message,"type"=> $type)

	);

	$headers = array(
		'Authorization: key=AIzaSyBtEWdbtChpfiC34toyGzk-6oI30SM2TUg',
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

	//echo $result;
}

function sendIphonePush($deviceToken,$msg,$badge=0,$check=0,$version=1) {

	$apnsHost = 'gateway.push.apple.com';	   //production phase
	$apnsCert = 'ck.pem'; 

	//$apnsHost = 'gateway.sandbox.push.apple.com';	   //sandbox phasesandbox.
	//$apnsCert = 'ck.sandbox.pem';                            //certificate pem file
	
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
                                'action-loc-key' => 'Urend',
							),
						'json' => $message,
						'badge' => 1,
						'sound' => 'oven.caf',
                    );
	$payload = json_encode($payload);

	try {

		if ($message != "") {
			//echo $deviceToken;
			//echo $message;
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
		echo 'Caught exception: '.  $e->getMessage(). "\n";
		error_log($e->getMessage().chr(13), 3, "/mnt/srv/MOOVWORKER/push-errors.log");
	}
}

function generatePush($deviceType, $deviceToken, $message) {

	if ($deviceType == 'android') {

		sendAndroidPush($deviceToken, $message);
	} else if ($deviceType == 'ios') {

		sendIphonePush($deviceToken, $message);
	} else {

	}
}

function sendDriverPush($deviceToken, $msg) {

	$apnsHost = 'gateway.push.apple.com';
	$apnsPort = '2195';
	$apnsCert = 'driver_dis.pem';
	$passPhrase = '';
	$streamContext = stream_context_create();
	stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
	$apnsConnection = stream_socket_client('ssl://' . $apnsHost . ':' . $apnsPort, $error, $errorString, 60, STREAM_CLIENT_CONNECT, $streamContext);
	if ($apnsConnection == false) {

		error_log($error . chr(13), 3, "/mnt/srv/MOOVWORKER/push-errors.log");
		return;
	} else {
		//	echo "Connection successful";
		error_log('Connection successful', 3, "/mnt/srv/MOOVWORKER/push-errors.log");
	}
	$message = $msg;
	$payload['aps'] = array('alert' => $message, 'sound' => 'default');
	$payload = json_encode($payload);


	try {

		if ($message != "") {
			//echo $deviceToken;
			//echo $message;
			$apnsMessage = chr(0) . pack("n", 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload;
			$fwrite = fwrite($apnsConnection, $apnsMessage);
			if ($fwrite) {
				echo "true";
				error_log($fwrite . chr(13), 3, "/mnt/srv/MOOVWORKER/push-errors.log");
			} else {
				echo "false";
			}
		}
	} catch (Exception $e) {
		echo 'Caught exception: '.  $e->getMessage(). "\n";
		error_log($e->getMessage() . chr(13), 3, "/mnt/srv/MOOVWORKER/push-errors.log");
	}
}

?>
